<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class ClearSessionMiddleware
{
    public function handle($request, Closure $next)
    {
        // Здесь вы можете проверить текущий маршрут и, если это тот, который вы хотите очистить сессию,
        // выполнить очистку сессии.
        $url=substr($request->fullUrl(), strrpos($request->fullUrl(),'/'));
        if ($url != '/shop') {
            Session::remove('category_list');

        }

        return $next($request);
    }
}
