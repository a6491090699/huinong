<?php

namespace App\Http\Middleware;

use Closure;

class SessionMid
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
        $member = \App\Model\Member::where('openid' , $openid)->first();
        if($member){
            $mid = $member->id;
        }else{
            $new = new \App\Model\Member;
            $new->openid = $openid;
            $new->addtime = time();
            $new->save();
            $mid = $new->id;
        }

        session(['mid'=>$mid,'nickname'=>$user->nickname ,'avatar'=>$user->avatar]);

        return $next($request);
    }
}
