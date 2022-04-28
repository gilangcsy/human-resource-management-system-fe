<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\UrlTrait;
use Illuminate\Support\Facades\Http;
use Validator;

class AccessRightsController extends Controller
{
    use UrlTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get($this->url_dynamic() . 'master/role');
        $response = json_decode($response->body());
        $roles = $response->data;
        if($response->success) {
            return view('dashboard.pages.access-rights.index', compact('roles'));
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
        $base_url = $this->url_dynamic();
        $response = Http::get($this->url_dynamic() . 'accessRights/readByRoleId/' . $id);
        $response = json_decode($response->body());
        $accessRights = $response->data;


        $response2 = Http::get($this->url_dynamic() . 'master/menu/readSubMenu');
        $response2 = json_decode($response2->body());
        $menus = $response2->data;

        $response3 = Http::get($this->url_dynamic() . 'master/role/' . $id);
        $response3 = json_decode($response3->body());
        $role = $response3->data;

        if($response->success && $response2->success && $response3->success) {
            return view('dashboard.pages.access-rights.form', compact('accessRights', 'menus', 'role', 'base_url'));
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
    public function destroy($id)
    {
        //
    }
}
