<?php

namespace App\Http\Middleware;

use Closure;

class Wechatauth
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
        $uid = session('uid');

        if(!$uid) reutrn back();
        return $next($request);
    }
}
