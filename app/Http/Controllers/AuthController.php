<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Traits\UrlTrait;
use Validator;

class AuthController extends Controller
{
    use UrlTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('auth.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $token = $request->session()->get('token');
        
		$checkToken = Http::post($this->url_dynamic() . 'auth/invitation/checkToken', [
            'token' =>  $token
        ]);
        $checkToken = json_decode($checkToken->body());
        if($checkToken->success) {
            return view('auth/invitational', compact('token'));
        } else {
            return redirect(route('auth.index'))->with('error', $checkToken->message);
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
        $login = Http::post($this->url_dynamic() . 'auth/login', [
            'email' => $request->email,
            'password' => $request->password,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'address' => $request->address,
        ]);
        $login = json_decode($login->body());
        if ($login->success){
            $request->session()->put('token', $login->credentials->token);
            $request->session()->put('email', $login->credentials->email);
            $request->session()->put('employee_id', $login->credentials->employee_id);
            $request->session()->put('full_name', $login->credentials->full_name);
            $request->session()->put('userId', $login->credentials->userId);
            $request->session()->put('role', $login->credentials->role);
            $request->session()->put('role_id', $login->credentials->role_id);
			
            return redirect()->route('dashboard.index')->with('status', 'Welcome, ' . $login->credentials->email);
        } else {
            return redirect()->route('auth.index')->with('error', $login->message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accept(Request $request)
    {
        Validator::make($request->all(), [
            'password' => 'required'
        ])->validate();
        
        $acceptingInvitation = Http::patch($this->url_dynamic() . 'auth/invitation/accepting', [
            'full_name' => $request->fname . ' ' . $request->lname,
            'password' => $request->password,
            'token' => $request->token
        ]);
        
        $acceptingInvitation = json_decode($acceptingInvitation->body());

        if ($acceptingInvitation->success){
            return redirect()->route('auth.index')->with('status', $acceptingInvitation->message);
        } else {
            return redirect()->back();
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
    public function destroy(Request $request)
    {
		$logout = Http::post($this->url_dynamic() . 'auth/logout', [
            'jwtToken' =>  $request->session()->get('token')
        ]);
        $logout = json_decode($logout->body());
        if ($logout->success){
            session()->flush();
            return redirect()->route('auth.index')->with('status', 'Logout has been successfully.');
        } else {
            return redirect()->route('auth.index')->with('status', $login->message);
        }
    }

    public function make(Request $request)
    {
        if($request->password != $request->passwordConfirm) {
            return back()->withInput()->withStatus('Password tidak sama!');
        } else {
            $devHost = env("HOST_API_DEV", "");
            $response = Http::post($devHost . 'users', [
        	    'full_name' => $request->full_name,
        	    'username' => $request->username,
        	    'email' => $request->email,
        	    'password' => $request->password,
        	    'RoleId' => $request->RoleId,
            ]);

		    $user = json_decode($response);

		    if ($response->successful()){
			    return redirect()->route('auth.index')->with('status', 'Register Has Been Successfully!');
		    } else {
			return $user->message;
		    }
        }
    }

    public function check_token(Request $request, $token)
    {
		$checkToken = Http::post($this->url_dynamic() . 'auth/invitation/checkToken', [
            'token' =>  $token
        ]);
        $checkToken = json_decode($checkToken->body());
        if($checkToken->success || $checkToken != null) {
            return redirect()->route('auth.invitational')->with('token', $token);
        } else {
            return redirect(route('auth.index'))->with('error', $checkToken->message || 'Internal error.');
        }
    }

    public function forgot_password(Request $request) {
        if ($request->has('token')) {
            $token = $request->input('token');
            $checkToken = Http::get($this->url_dynamic() . 'auth/passwordReset?token=' . $token);
            $checkToken = json_decode($checkToken->body());
            if($checkToken->success) {
                return view('auth.forgot-password.form', compact('checkToken'));
            } else {
                return redirect('dashboard');
            }
        } else {
            return view('auth.forgot-password.index');
        }
    }

    public function forgot_password_sent(Request $request) {
        
		$sendEmail = Http::post($this->url_dynamic() . 'auth/passwordReset', [
            'email' =>  $request->email
        ]);
        $sendEmail = json_decode($sendEmail->body());

        if($sendEmail->success) {
            return view('auth.forgot-password.sent');
        } else {
            return redirect()->back()->with('error', $sendEmail->message);
        }
    }

    public function set_new_password(Request $request) {
        
        Validator::make($request->all(), [
            'password' => 'required|confirmed',
        ])->validate();

        $token = $request->token;
        $password = $request->password;

		$setNewPassword = Http::patch($this->url_dynamic() . 'auth/setNewPassword?token=' . $token, [
            'password' =>  $password
        ]);
        $setNewPassword = json_decode($setNewPassword->body());

        if($setNewPassword) {
            return redirect(route('auth.index'))->with('status', $setNewPassword->message);
        } else {
            return redirect(route('auth.index'))->with('error', $setNewPassword->message);
        }
    }
}
