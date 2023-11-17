<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()){
            $currentMiddleware = $request->route()->middleware();
            if(!empty($currentMiddleware) && in_array('auth:doctor',$currentMiddleware)){
                return route('doctors.login');
            }
            return route('login');
        }
        return null;
    }
}
