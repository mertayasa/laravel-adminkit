<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Models\Permission;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            $route_name = Route::currentRouteName();
            $check_permission = Permission::where('name', $route_name)->first();

            if (!$check_permission || !Auth::user()->hasPermissionTo($route_name)) {
                throw new UnauthorizedException(403, trans('error.permission') . ' <b>' . $route_name . '</b>');
            }

            return $next($request);
        }

        abort(403);
    }
}
