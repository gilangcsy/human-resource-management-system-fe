<?php
namespace App\Http\Traits;

trait UrlTrait {
    public static function url_dynamic() {
        return request()->getClientIp() == '127.0.0.1' || request()->getClientIp() == 'localhost' ? 'https://localhost:3068/v1/' : 'https://95.111.202.9:3068/api/v1/';
    }

    public static function url_storage() {
        return request()->getClientIp() == '127.0.0.1' || request()->getClientIp() == 'localhost' ? 'https://localhost:3068/storage/' : 'https://95.111.202.9:3068/storage/';
    }
}