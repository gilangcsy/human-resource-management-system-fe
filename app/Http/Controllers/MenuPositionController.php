<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\UrlTrait;
use Illuminate\Support\Facades\Http;
use Validator;

class MenuPositionController extends Controller
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

        $response = Http::get($this->url_dynamic() . 'master/menu/readSubMenu');
        $response = json_decode($response->body());
        $subMenu = $response->data;
        
        $response2 = Http::get($this->url_dynamic() . 'master/menu/readMasterMenu');
        $response2 = json_decode($response2->body());
        $masterMenu = $response2->data;
        
        $lists = array();
        
        foreach($masterMenu as $menu) {
            $lists[] = array (  
                'id' => $menu->id,
                'name' => $menu->name,
                'url' => $menu->url,
                'icon' => $menu->icon,
                'position' => $menu->position_number,
                'childs' => []
            );
        }
        $menu_items = [];
        foreach($subMenu as $item) {
            $menu_items[] = array (  
                'id' => $item->id,
                'name' => $item->name,
                'url' => $item->url,
                'icon' => $item->icon,
                'master_menu_id' => $item->master_menu_id,
                'position' => $item->position_number
            );
        }
        $allowedMenuCount = count($menu_items);
        $masterMenuCount = count($lists);

        //Memasukkan sub menu ke dalam masing-masing master menunya
        for ($i = 0; $i < $masterMenuCount; $i++) { 
            for ($j = 0; $j < $allowedMenuCount; $j++) { 
                if($menu_items[$j]['master_menu_id'] == $lists[$i]['id']) {
                    $lists[$i]['childs'][] = $menu_items[$j];
                }
            }
        }
        
        if($response2->success && $response->success) {
            return view('dashboard.pages.menu-position.index', compact('lists', 'base_url'));
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
}
