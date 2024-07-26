<?php

namespace App\Http\Middleware;

use Gate;
use Closure;

class CanViewForms
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
        Gate::authorize('view-forms');

        return $next($request);
    }
}
