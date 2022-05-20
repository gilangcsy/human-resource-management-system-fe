<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\UrlTrait;
use Illuminate\Support\Facades\Http;
use Validator;


class ApprovalLeaveController extends Controller
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

        $response = Http::get($this->url_dynamic() . 'leaves/readByApproverNowId/' . session()->get('userId'));
        $response = json_decode($response->body());
        $leaves = $response->data;
        $history = $response->history;
        if($response->success) {
            return view('dashboard.pages.approval-leave.index', compact('leaves', 'history', 'download_url'));
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function action(Request $request)
    {
        if(!$request->action) {
            return redirect()->back()->with('error', 'Check minimum 1 data to continue.');
        }
        $totalOfAction = count($request->action);

        for ($i=0; $i < $totalOfAction ; $i++) { 
            $response = Http::post($this->url_dynamic() . 'leaves/approve', [
                'id' => $request->action[$i],
                'UserId' => session()->get('userId'),
                'isApproved' => $request->isApproved == 'true' ? '1' : '0'
            ]);
        }
        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->back()->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }
}
