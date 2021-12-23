<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Exceptions\UnauthorizedException;
use App\Models\Permission;

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
        $route_name = Route::currentRouteName();
        if(Auth::check()){
            $check_permission = Permission::where('name', $route_name)->first();

            if (!$check_permission || auth()->user()->hasPermissionTo($route_name) == false) {
                throw new UnauthorizedException(403, 'You dont have permission to '. $route_name);
            }

            return $next($request);
        }else{
            throw new UnauthorizedException(403, 'You dont have permission to '. $route_name ?? '-');
        }

        abort(403);
    }
}
