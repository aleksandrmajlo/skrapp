<?php


namespace App\Http\Middleware;
use Closure;

class RoleOperator
{
    public function handle($request, Closure $next)
    {
        if ($request->user()&&$request->user()->role=='2') {
            return $next($request);
        } else {
            return redirect('/no-access');
        }

    }

}
