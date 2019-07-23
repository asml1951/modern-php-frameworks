<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($request->hasHeader('x-username')
            && ($request->header('x-username') == 'admin')) {

            if ($request->HasHeader('x-password')
                && password_verify('123456', $request->header('x-password')))  {

                return $next($request);

            }
        }
        // return  response('Not Auth',401)->header('Content-Type', 'text/plain');
        return abort('401', 'Not Authorised');
    }
}

