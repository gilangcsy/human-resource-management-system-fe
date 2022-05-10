<?php
namespace App\Http\Traits;

trait UrlTrait {
    public static function url_dynamic() {
        return request()->getClientIp() == '127.0.0.1' || request()->getClientIp() == 'localhost' ? 'http://localhost:3000/api/v1/' : 'http://95.111.202.9:3068/api/v1/';
    }

    public static function url_storage() {
        return request()->getClientIp() == '127.0.0.1' || request()->getClientIp() == 'localhost' ? 'http://localhost:3000/' : 'http://95.111.202.9:3068/';
    }
}