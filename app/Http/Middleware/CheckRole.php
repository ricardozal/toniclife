<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (! $request->user()->hasRole($role)) {

            \Auth::logout();
            $request->session()->flush();
            $request->session()->regenerate();

            return abort(403, 'Acción sin autorización.');
        }
        return $next($request);
    }
}
