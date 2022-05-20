<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\UrlTrait;
use Illuminate\Support\Facades\Http;
use Validator;

class LeaveController extends Controller
{
    use UrlTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $download_url = $this->url_dynamic() . 'leaves/download/';

        $response = Http::get($this->url_dynamic() . 'leaves/readByUserId/' . session()->get('userId'));
        $response = json_decode($response->body());
        $leave = $response->data;
        if($response->success) {
            return view('dashboard.pages.leave.index', compact('leave', 'download_url'));
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get($this->url_dynamic() . 'master/leaveType/');
        $response = json_decode($response->body());
        $leaveType = $response->data;

        $leave = (object) [
            'id' => '',
            'data' => 0,
            'start_date' => '',
            'end_date' => '',
            'description' => '',
            'attachment' => '',
            'LeaveTypeId' => ''
        ];

        return view('dashboard.pages.leave.form', compact('leave', 'leaveType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date' => 'required',
        ])->validate();

        if($request->file('attachment')) {
            $response = Http::attach(
                'attachment', file_get_contents($request->file('attachment')), $request->file('attachment')->getClientOriginalName()
            )->post($this->url_dynamic() . 'leaves', [
                'attachment' => $request->file('attachment')->getClientOriginalName(),
                'created_by' => session()->get('userId'),
                'UserId' => session()->get('userId'),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'description' => $request->description,
                'LeaveTypeId' => $request->LeaveTypeId,
            ]);
        } else {
            $response = Http::post($this->url_dynamic() . 'leaves', [
                'created_by' => session()->get('userId'),
                'UserId' => session()->get('userId'),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'description' => $request->description,
                'LeaveTypeId' => $request->LeaveTypeId,
            ]);
        }

        $response = json_decode($response->body());
        
        if($response->success) {
            return redirect()->route('leave.index')->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::get($this->url_dynamic() . 'leaves/' . $id);
        $response = json_decode($response->body());
        $leave = $response->data['0'];
        
        if($response->success) {
            return view('dashboard.pages.leave.detail',compact('leave'));
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->url_dynamic() . 'leaves/' . $id);
        $response = json_decode($response->body());
        $leave = $response->data['0'];
        
        $response = Http::get($this->url_dynamic() . 'master/leaveType/');
        $response = json_decode($response->body());
        $leaveType = $response->data;
        if($response->success) {
            return view('dashboard.pages.leave.form',compact('leave', 'leaveType'));
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date' => 'required',
        ])->validate();

        if($request->file('attachment')) {
            $response = Http::attach(
                'attachment', file_get_contents($request->file('attachment')), $request->file('attachment')->getClientOriginalName()
            )->patch($this->url_dynamic() . 'leaves/' . $id, [
                'attachment' => $request->file('attachment')->getClientOriginalName(),
                'created_by' => session()->get('userId'),
                'UserId' => session()->get('userId'),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'description' => $request->description,
                'LeaveTypeId' => $request->LeaveTypeId,
            ]);
        } else {
            $response = Http::patch($this->url_dynamic() . 'leaves/' . $id, [
                'updated_by' => session()->get('userId'),
                'UserId' => session()->get('userId'),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'description' => $request->description,
                'LeaveTypeId' => $request->LeaveTypeId,
            ]);
        }

        $response = json_decode($response->body());
        
        if($response->success) {
            return redirect()->route('leave.index')->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->url_dynamic() . 'leaves/' . $id, [
            'deleted_by' => session()->get('userId'),
        ]);

        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->back()->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }
}
