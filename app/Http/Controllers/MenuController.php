<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\UrlTrait;
use Illuminate\Support\Facades\Http;
use Validator;

class MenuController extends Controller
{
    use UrlTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get($this->url_dynamic() . 'master/menu');
        $response = json_decode($response->body());
        $menu = $response->data;

        if($response->success) {
            return view('dashboard.pages.menu.index', compact('menu'));
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
        $response = Http::get($this->url_dynamic() . 'master/menu/readMasterMenu');
        $response = json_decode($response->body());
        $master_menu = $response->data;

        $menu = (object) [
            'id' => '',
            'data' => 0,
            'name' => '',
            'icon' => '',
            'url' => '',
            'master_menu' => ''
        ];
        
        if($response->success) {
            return view('dashboard.pages.menu.form', compact('menu', 'master_menu'));
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
            'name' => 'required'
        ])->validate();
        
        $response = Http::post($this->url_dynamic() . 'master/menu', [
            'name' => $request->name,
            'url' => $request->url,
            'icon' => $request->icon,
            'master_menu' => $request->master_menu,
            'is_active' => true,
            'createdBy' => session()->get('userId'),
        ]);
        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->route('menu.index')->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message)->withInput();
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
        $response = Http::get($this->url_dynamic() . 'master/menu/readMasterMenu');
        $response = json_decode($response->body());
        $master_menu = $response->data;


        $response2 = Http::get($this->url_dynamic() . 'master/menu/readById/' . $id);
        $response2 = json_decode($response2->body());
        $menu = $response2->data;
        
        if($response->success && $response2->success) {
            return view('dashboard.pages.menu.form', compact('menu', 'master_menu'));
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
        
        $response = Http::patch($this->url_dynamic() . 'master/menu/' . $id, [
            'name' => $request->name,
            'url' => $request->url,
            'icon' => $request->icon,
            'is_active' => true,
            'updatedBy' => session()->get('userId'),
        ]);
        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->route('menu.index')->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message)->withInput();
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
        $response = Http::delete($this->url_dynamic() . 'master/menu/' . $id, [
            'deletedBy' => session()->get('userId'),
        ]);

        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->back()->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }
}
