<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\UrlTrait;
use Illuminate\Support\Facades\Http;
use Validator;

class LeaveTypeController extends Controller
{
    use UrlTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get($this->url_dynamic() . 'master/leaveType');
        $response = json_decode($response->body());
        $leaveTypes = $response->data;
        if($response->success) {
            return view('dashboard.pages.leave-type.index', compact('leaveTypes'));
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
        $leaveType = (object) [
            'id' => '',
            'data' => 0,
            'name' => ''
        ];

        return view('dashboard.pages.leave-type.form', compact('leaveType'));
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
            'name' => 'required'
        ])->validate();
        
        $response = Http::post($this->url_dynamic() . 'master/leaveType', [
            'name' => $request->name,
            'created_by' => session()->get('userId')
        ]);

        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->route('leave-type.index')->with('status', $response->message);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->url_dynamic() . 'master/leaveType/' . $id);
        $response = json_decode($response->body());
        $leaveType = $response->data;
        
        if($response->success) {
            return view('dashboard.pages.leave-type.form', compact('leaveType'));
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
            'name' => 'required'
        ])->validate();
        
        $response = Http::patch($this->url_dynamic() . 'master/leaveType/' . $id, [
            'name' => $request->name,
            'updated_by' => session()->get('userId'),
        ]);

        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->route('leave-type.index')->with('status', $response->message);
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
        $response = Http::delete($this->url_dynamic() . 'master/leaveType/' . $id, [
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
