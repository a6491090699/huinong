<?php

namespace App\Http\Middleware;

use Closure;

class NoStoreinfo
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
        $user = session('wechat.oauth_user');
        $openid = $user->id ;
        $mid = session('mid');
        $storeinfo = \App\Model\MemberStoreinfo::where('member_id' , $mid)->first(['id']);
        if(!$storeinfo) return response("<script>alert('请先填写你的店铺信息!');location.href='/store/add';</script>");
        return $next($request);
    }
}
