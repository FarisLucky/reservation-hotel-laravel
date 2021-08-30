<?php

use Illuminate\Support\Facades\Route;

/**
 * Daftarkan Helper melalui composer.json
 * Letakkan load pada autoload.files
 */
if (! function_exists('activeMenu')) {
    function activeMenu($uri, $output = 'active')
    {
        if (is_array($uri)) {
            foreach ($uri as $u) {
                return request()->is($u) ? $output : '';
            }
        } else {
            return request()->is($uri) ? $output : '';
        }
    }
}

if (!function_exists('activeSubMenu')) {
    function activeSubMenu($uri, $output='active') {
        return (request()->is($uri)) ? $output : '';
    }
}
