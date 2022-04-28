<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Http;
use App\Http\Traits\UrlTrait;

class SidebarLayout extends Component
{
    use UrlTrait;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $allowedMenu = Http::get($this->url_dynamic() . 'accessRights/readByRoleId/'. session()->get('role_id'));
        $allowedMenu = json_decode($allowedMenu->body());
        $allowedMenu = $allowedMenu->data;
        
        $masterMenu = Http::get($this->url_dynamic() . 'master/menu/readMasterMenu');
        $masterMenu = json_decode($masterMenu->body());
        $masterMenu = $masterMenu->data;
        
        $lists = array();

        
        foreach($masterMenu as $menu) {
            $lists[] = array (  
                'id' => $menu->id,
                'name' => $menu->name,
                'link' => '/',
                'icon' => '',
                'childs' => []
            );
        }
        $menu_items = [];
        foreach($allowedMenu as $item) {
            $menu_items[] = array (  
                'name' => $item->menu_name,
                'url' => $item->url,
                'icon' => $item->icon,
                'master_menu' => $item->master_menu
            );
        }
        $allowedMenuCount = count($menu_items);
        $masterMenuCount = count($lists);
        for ($i = 0; $i < $masterMenuCount; $i++) { 
            for ($j = 0; $j < $allowedMenuCount; $j++) { 
                if($menu_items[$j]['master_menu'] == $lists[$i]['id']) {
                    $lists[$i]['childs'][] = $menu_items[$j];
                }
            }
        }
        
        return view('components.sidebar-layout', compact('lists'));
    }
}
