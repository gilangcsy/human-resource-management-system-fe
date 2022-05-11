<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Traits\UrlTrait;

class UserManagementController extends Controller
{
    use UrlTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $response = Http::get($this->url_dynamic() . 'users');
        $response = json_decode($response->body());
        $users = $response->data;
        if($response->success) {
            return view('dashboard.pages.employee.index', compact('users'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = (object) [
            'id' => '',
            'data' => 0,
            'email' => '',
            'employee_id' => '',
            'full_name' => '',
            'address' => '',
            'RoleId' => ''
        ];
        
        $response = Http::get($this->url_dynamic() . 'master/role');
        $response = json_decode($response->body());
        $roles = $response->data;

        return view('dashboard.pages.employee.form', compact('user', 'roles'));
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
        $response = Http::get($this->url_dynamic() . 'users/' . $id);
        $response = json_decode($response->body());
        dd($response);
        $user = $response->data;
        if($response->success) {
            return view('dashboard.pages.employee.edit',compact('user'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $deletedBy)
    {
        $response = Http::delete($this->url_dynamic() . 'users/' . $id . '/' . $deletedBy);
        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->back()->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }

    public function send_invitational(Request $request)
    {

        $userId = $request->session()->get('userId');
        $response = Http::post($this->url_dynamic() . 'auth/invitation/invite', [
            'email' =>  $request->email,
            'full_name' =>  $request->full_name,
            'employee_id' =>  $request->employee_id,
            'address' =>  $request->address,
            'RoleId' =>  $request->RoleId,
            'invitedBy' => $userId
        ]);
        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->route('employee.index')->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }

    public function set_active($id)
    {
        $response = Http::get($this->url_dynamic() . 'users/setActive/' . $id);
        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->back()->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }
}
