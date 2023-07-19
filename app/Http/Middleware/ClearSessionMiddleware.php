<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class ClearSessionMiddleware
{
    public function handle($request, Closure $next)
    {


        $url=substr($request->fullUrl(), strrpos($request->fullUrl(),'/'));
        if ($url != '/shop') {
            Session::remove('category_list');
            Session::remove('priceMin');
            Session::remove('priceMax');
        }

        return $next($request);
    }
}
