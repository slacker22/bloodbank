<?php

namespace App\Http\Middleware;

use Closure;

class CanAccessRequest
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
        if(auth()->user()->user_type_id == 2 || auth()->user()->user_type_id == 4  ){
            return $next($request);
        }
        return response()->json('You do not have access to Requests');

    }
}
