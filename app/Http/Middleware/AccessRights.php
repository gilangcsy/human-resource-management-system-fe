<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Traits\UrlTrait;
use Illuminate\Support\Facades\Http;

class AccessRights
{
    use UrlTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $url = (explode("/", url()->current()));
        // 0 => "http:"
        // 1 => ""
        // 2 => "127.0.0.1:8000"
        // 3 => "approval-leave"
        
        //If user role is super admin, then next
        if(session()->get('role_id') == 12) {
            return $next($request);
        } else {
            // > 3 meaning that they trying to access some page (beacause array 4 is url)
            if(count($url) > 3) {
                $response = Http::post($this->url_dynamic() . 'accessRights/check', [
                    'role_id' => session()->get('role_id'),
                    'url' => $url['3']
                ]);
                $response = json_decode($response->body());
                $accessRights = $response->data;
                
                // Remember the order from $url variable. Index 4 is the route of pages.
                //If there is no url following behind, then they want to access index
                //Else, that's mean they want to access create, update, delete route.
    
                if($accessRights != null) {
                    $accessRights = $accessRights[0];
                    if(count($url) < 5) {
                        if($accessRights->allow_read == true) {
                            return $next($request);
                        } else {
                            abort(403);
                        }
                    } else {
                        if($url['4'] == 'create' && $accessRights->allow_create == true) {
                            return $next($request);
                        } else if($url['4'] == 'edit' && $accessRights->allow_update == true) {
                            return $next($request);
                        } else if($url['4'] == 'destroy' && $accessRights->allow_delete == true) {
                            return $next($request);
                        } else if($url['4'] == 'show' && $accessRights->allow_read == true) {
                            return $next($request);
                        } else {
                            abort(403);
                        }
                    }
                } else {
                    abort(403);
                }
            }
            
        }

        // return $next($request);
    }
}
