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
        $base_url = $this->url_dynamic();

        $response2 = Http::get($this->url_dynamic() . 'master/menu/readSubMenu');
        $response2 = json_decode($response2->body());
        $sub_menu = $response2->data;
        
        $master_menu = Http::get($this->url_dynamic() . 'master/menu/readMasterMenu');
        $master_menu = json_decode($master_menu->body());
        $master_menu = $master_menu->data;
        
        $lists = array();

        foreach($master_menu as $menu) {
            $lists[] = array (  
                'id' => $menu->id,
                'name' => $menu->name,
                'link' => '/',
                'icon' => '',
                'childs' => []
            );
        }
        $menu_items = [];
        foreach($sub_menu as $item) {
            $menu_items[] = array (  
                'id' => $item->id,
                'name' => $item->name,
                'master_menu' => $item->master_menu_id,
                'position' => $item->position_number
            );
        }
        $menuCount = count($menu_items);
        $master_menuCount = count($lists);
        for ($i = 0; $i < $master_menuCount; $i++) { 
            for ($j = 0; $j < $menuCount; $j++) { 
                if($menu_items[$j]['master_menu'] == $lists[$i]['id']) {
                    $lists[$i]['childs'][] = $menu_items[$j];
                }
            }
        }
        
        if($response2->success) {
            return view('dashboard.pages.menu.index', compact('lists', 'base_url'));
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
