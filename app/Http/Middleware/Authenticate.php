<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return null|string
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            session()->flash('error','Anda Belum Login');
            return route('login');
        }
    }
}
