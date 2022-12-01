<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Traits\UrlTrait;

class DashboardController extends Controller
{
    use UrlTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Http::withHeaders([
            'x-access-token' => session()->get('token')
        ])->get($this->url_dynamic() . 'tasks/readByUser/' . session()->get('userId'), [
            'status' => 'Open'
        ]);
        $tasks = json_decode($tasks->body());

        $base_url = $this->url_dynamic();
        
        $leave = Http::get($this->url_dynamic() . 'leaves/readByUserId/' . session()->get('userId'));
        $leave = json_decode($leave->body());
        $leave = $leave->data;
        $leaveCount = count($leave);

        $countLeave = Http::get($this->url_dynamic() . 'leaves/allStatus/count', [
            'userId' => session()->get('userId')
        ]);
        $countLeave = json_decode($countLeave->body());
        $approvedLeave = $countLeave->data->approved;
        $waitingLeave = $countLeave->data->waiting;
        $rejectedLeave = $countLeave->data->rejected;
        
        $claim = Http::get($this->url_dynamic() . 'claims/readByUserId/' . session()->get('userId'));
        $claim = json_decode($claim->body());
        $claim = $claim->data;
        $claimCount = count($claim);

        $countClaim = Http::get($this->url_dynamic() . 'claims/allStatus/count', [
            'userId' => session()->get('userId')
        ]);
        $countClaim = json_decode($countClaim->body());
        $approvedClaim = $countClaim->data->approved;
        $waitingClaim = $countClaim->data->waiting;
        $rejectedClaim = $countClaim->data->rejected;

        $response = Http::get($this->url_dynamic() . 'attendances/readTodayAttendance/' . session()->get('userId'));
        $response = json_decode($response->body());
        
        $birthdayEmployee = Http::withHeaders([
            'x-access-token' => session()->get('token')
        ])->get($this->url_dynamic() . 'users/getBirthday/month', [
            'status' => 'Open'
        ]);
        $birthdayEmployee = json_decode($birthdayEmployee->body());
        $birthdayEmployee = $birthdayEmployee->data;

        if($tasks->success) {
            $tasks = $tasks->data;
            $attendanceStatus = $response->status;
            $attendanceData = $response->data;

            return view('dashboard.index', compact('attendanceStatus', 'attendanceData', 'base_url', 'leaveCount', 'approvedLeave', 'rejectedLeave', 'waitingLeave', 'claimCount', 'approvedClaim', 'rejectedClaim', 'waitingClaim', 'tasks', 'birthdayEmployee'));
        } else {
            dd('error nih bang');
            return redirect()->back()->with('error', $tasks->message);
        }
        dd('dashboard');
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
}
