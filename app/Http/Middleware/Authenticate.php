<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    // protected function redirectTo($request)
    // {
    //     if (! $request->expectsJson()) {
    //         return route('login');
    //     }
    // }
    protected function redirectTo($request)
    {
        if (in_array('auth:admin', $request->route()->middleware())) {
            return route('admin.login');
        }
        if (in_array('auth:mentor', $request->route()->middleware())) {
            return route('mentor.login');
        }

        return route('login');
    }
}