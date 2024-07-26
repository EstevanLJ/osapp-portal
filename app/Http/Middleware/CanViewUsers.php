<?php

namespace App\Http\Middleware;

use Gate;
use Closure;

class CanViewUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Gate::authorize('view-users');

        return $next($request);
    }
}
