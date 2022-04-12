<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Traits\UrlTrait;
use Validator;

class AttendanceController extends Controller
{
    use UrlTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get($this->url_dynamic() . 'attendances/readByUserId/' . session()->get('userId'));
        $response = json_decode($response->body());
        $attendances = $response->data;
        if($response->success) {
            return view('dashboard.pages.my-attendance.index', compact('attendances'));
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
        $url_storage = $this->url_storage();
        $url = $this->url_dynamic();

        $attendanceData = (object) [
            'id' => '',
            'data' => 0,
            'clockIn' => '',
            'clockOut' => '',
            'workLoadStatus' => '',
            'location' => '',
            'longitude' => '',
            'latitude' => '',
            'planningActivity' => '',
            'clockInPhoto' => '',
            'clockOutPhoto' => '',
        ];

        $id = 0;

        $response = Http::get($this->url_dynamic() . 'attendances/readTodayAttendance/' . session()->get('userId'));
        $response = json_decode($response->body());
        if($response->success) {
            $attendanceStatus = $response->status;
            return view('dashboard.pages.my-attendance.form', compact('attendanceStatus', 'attendanceData', 'id', 'url', 'url_storage'));
        } else {
            return redirect()->back()->with('error', $response->message);
        }
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
            'photo' => 'required|mimes:jpg,png,jpeg'
        ])->validate();

        $photo = $request->file('photo')->getClientOriginalName();
        $response = Http::attach(
            'clockInPhoto', file_get_contents($request->file('photo')), $request->file('photo')->getClientOriginalName()
        )->post($this->url_dynamic() . 'attendances', [
            'clockInPhoto' => $request->file('photo')->getClientOriginalName(),
            'userId' => session()->get('userId'),
            'workLoadStatus' => $request->workLoadStatus,
            'planningActivity' => $request->planningActivity,
            'location' => $request->location,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude
        ]);

        $response = json_decode($response->body());
        
        if($response->success) {
            return redirect()->route('dashboard.index')->with('status', $response->message);
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
        $url_storage = $this->url_storage();
        $url = $this->url_dynamic();
        $response = Http::get($this->url_dynamic() . 'attendances/readTodayAttendance/' . session()->get('userId'));
        $response = json_decode($response->body());

        $attendance = Http::get($this->url_dynamic() . 'attendances/readById/' . $id);
        $attendance = json_decode($attendance->body());
        if($response->success) {
            $attendanceStatus = $response->status;
            $attendanceData = $attendance->data;
            return view('dashboard.pages.my-attendance.form', compact('attendanceStatus', 'attendanceData', 'url_storage', 'url', 'id'));
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
            'photo' => 'required|mimes:jpg,png,jpeg'
        ])->validate();

        $photo = $request->file('photo')->getClientOriginalName();
        $response = Http::attach(
            'clockOutPhoto', file_get_contents($request->file('photo')), $request->file('photo')->getClientOriginalName()
        )->post($this->url_dynamic() . 'attendances', [
            'clockOutPhoto' => $request->file('photo')->getClientOriginalName(),
            'userId' => session()->get('userId'),
            'location' => $request->location,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude
        ]);

        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->route('dashboard.index')->with('status', $response->message);
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
        //
    }
}
