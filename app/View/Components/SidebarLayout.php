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
        
        if(session()->get('role_id') == 12) {
            $subMenu = Http::get($this->url_dynamic() . 'master/menu/readSubMenu');
            $subMenu = json_decode($subMenu->body());
            $subMenu = $subMenu->data;
            
            $masterMenu = Http::get($this->url_dynamic() . 'master/menu/readMasterMenu');
            $masterMenu = json_decode($masterMenu->body());
            $masterMenu = $masterMenu->data;
            
            $lists = array();
            $unLists = array();
            
            
            foreach($masterMenu as $menu) {
                $lists[] = array (  
                    'id' => $menu->id,
                    'name' => $menu->name,
                    'url' => $menu->url,
                    'icon' => $menu->icon,
                    'childs' => []
                );
            }
            $menu_items = [];
            foreach($subMenu as $item) {
                $menu_items[] = array (  
                    'name' => $item->name,
                    'url' => $item->url,
                    'icon' => $item->icon,
                    'master_menu_id' => $item->master_menu_id
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
        }
        else {
            $allowedMenu = Http::get($this->url_dynamic() . 'accessRights/readByRoleId/'. session()->get('role_id'));
            $allowedMenu = json_decode($allowedMenu->body());
            $allowedMenu = $allowedMenu->data;
            
            $masterMenu = Http::get($this->url_dynamic() . 'master/menu/readMasterMenu');
            $masterMenu = json_decode($masterMenu->body());
            $masterMenu = $masterMenu->data;
            
            $lists = array();
            $unLists = array();

            
            foreach($masterMenu as $menu) {
                $lists[] = array (  
                    'id' => $menu->id,
                    'name' => $menu->name,
                    'url' => $menu->url,
                    'icon' => $menu->icon,
                    'childs' => []
                );
            }
            $menu_items = [];
            foreach($allowedMenu as $item) {
                $menu_items[] = array (  
                    'name' => $item->menu_name,
                    'url' => $item->url,
                    'icon' => $item->icon,
                    'master_menu_id' => $item->master_menu_id
                );
            }
            $allowedMenuCount = count($menu_items);
            $masterMenuCount = count($lists);
            $masterDataAllowed = [];
            $notAllowed = [];
            
            //Memasukkan sub menu ke dalam masing-masing master menunya
            for ($i = 0; $i < $masterMenuCount; $i++) { 
                for ($j = 0; $j < $allowedMenuCount; $j++) { 
                    if($menu_items[$j]['master_menu_id'] == $lists[$i]['id']) {
                        $lists[$i]['childs'][] = $menu_items[$j];
                    }
                }
            }

            //Mencari master menu yang berdiri sendiri atau tidak punya childs
            foreach($lists as $key => $value) {
                foreach ($allowedMenu as $al) {
                    if(!$value['childs'] && $al->master_menu_id == 0) {
                        if($al->menu_id == $value['id']) {
                            //Memasukkan master data yang berdiri sendiri dan statusnya allowed
                            $masterDataAllowed[] = $key;
                        } else {
                            //Memasukkan master data yang berdiri sendiri dan statusnya not allowed
                            $notAllowed[] = $key;
                        }
                    }
                }
            }
            
            // Jika tidak ada master data yang berdiri sendiri dan statusnya allowed, maka master data tersebut dibuang dari array lists
            // *array lists berisi menu-menu yang bisa diakses oleh user
            if(!$masterDataAllowed) {
                foreach($lists as $key => $value) {
                    if(!$value['childs']) {
                        unset($lists[$key]);
                    }
                }
            } else {
                // Menu yang ada dalam array lists masih belum sesuai dengan hak akses user. Langkah selanjutnya adalah mencari menu yang not allowed
                // Data dalam array not allowed belum sepenuhnya benar. Maka kita harus melakukan pengecekan
                // variable checking dibawah ini berfungsi mengecek apakah di dalam dua array tersebut mempunyai value yang sama
                $checking = array_intersect($notAllowed, $masterDataAllowed);

                // Jika kedua array tidak mempunyai value yang sama, maka data not allowed bisa dipastikan akurat
                if(!$checking) {
                    $excludedMenu = array_unique($notAllowed);

                // Namun jika sebaliknya, maka data not allowed belum akurat karena di dalamnya masih ada data yang seharusnya allowed
                // Untuk membuang value yang seharusnya allowed, maka dilakukan perbandingan antara kedua array
                } else {
                    $excludedMenu = array_merge(array_diff($masterDataAllowed, $notAllowed), array_diff($notAllowed, $masterDataAllowed));
                    $excludedMenu = array_unique($excludedMenu);
                }

                // Lalu saatnya membuang menu yang not allowed
                foreach($excludedMenu as $key => $value) {
                    unset($lists[$excludedMenu[$key]]);
                }
            }
        }
        return view('components.sidebar-layout', compact('lists'));
    }
}
