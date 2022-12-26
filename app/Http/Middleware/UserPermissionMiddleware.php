<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,  $permission)
    {
        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);
        foreach($permissions as $permission)
        {
            if($request->user()->hasPermission($permission))
            {
                return $next($request);
            }
        }
            return response()->json(["You don't have permission to access this page"]);        
    }
}
