<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\UrlTrait;
use Illuminate\Support\Facades\Http;
use Validator;

class ClaimController extends Controller
{
    use UrlTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $download_url = $this->url_dynamic() . 'claims/download/';

        $response = Http::get($this->url_dynamic() . 'claims/readByUserId/' . session()->get('userId'));
        $response = json_decode($response->body());
        $claim = $response->data;
        if($response->success) {
            return view('dashboard.pages.claim.index', compact('claim', 'download_url'));
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
        $response = Http::get($this->url_dynamic() . 'master/claimType/');
        $response = json_decode($response->body());
        $claimType = $response->data;

        $claim = (object) [
            'id' => '',
            'data' => 0,
            'start_date' => '',
            'end_date' => '',
            'description' => '',
            'attachment' => '',
            'ClaimTypeId' => ''
        ];

        return view('dashboard.pages.claim.form', compact('claim', 'claimType'));
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
            )->post($this->url_dynamic() . 'claims', [
                'attachment' => $request->file('attachment')->getClientOriginalName(),
                'created_by' => session()->get('userId'),
                'UserId' => session()->get('userId'),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'description' => $request->description,
                'ClaimTypeId' => $request->ClaimTypeId,
            ]);
        } else {
            $response = Http::post($this->url_dynamic() . 'claims', [
                'created_by' => session()->get('userId'),
                'UserId' => session()->get('userId'),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'description' => $request->description,
                'ClaimTypeId' => $request->ClaimTypeId,
            ]);
        }

        $response = json_decode($response->body());
        
        if($response->success) {
            return redirect()->route('claim.index')->with('status', $response->message);
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
        $response = Http::get($this->url_dynamic() . 'claims/' . $id);
        $response = json_decode($response->body());
        $claim = $response->data['0'];
        
        if($response->success) {
            return view('dashboard.pages.claim.detail',compact('claim'));
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
        $response = Http::get($this->url_dynamic() . 'claims/' . $id);
        $response = json_decode($response->body());
        $claim = $response->data['0'];
        
        $response = Http::get($this->url_dynamic() . 'master/claimType/');
        $response = json_decode($response->body());
        $claimType = $response->data;
        if($response->success) {
            return view('dashboard.pages.claim.form',compact('claim', 'claimType'));
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
            )->patch($this->url_dynamic() . 'claims/' . $id, [
                'attachment' => $request->file('attachment')->getClientOriginalName(),
                'created_by' => session()->get('userId'),
                'UserId' => session()->get('userId'),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'description' => $request->description,
                'ClaimTypeId' => $request->ClaimTypeId,
            ]);
        } else {
            $response = Http::patch($this->url_dynamic() . 'claims/' . $id, [
                'updated_by' => session()->get('userId'),
                'UserId' => session()->get('userId'),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'description' => $request->description,
                'ClaimTypeId' => $request->ClaimTypeId,
            ]);
        }

        $response = json_decode($response->body());
        
        if($response->success) {
            return redirect()->route('claim.index')->with('status', $response->message);
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
        $response = Http::delete($this->url_dynamic() . 'claims/' . $id, [
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
