<?php

namespace App\Http\Middleware;

use Closure;

class MidSession
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
        // dump(session('mid'));
        // session(['mid'=>2]);
        // session()->save();
        // session()->forget('mid');
        // dump(session()->all());


        if(empty(session('mid'))){
            $openid =getOpenid();
            $member = \App\Model\Member::where('openid',$openid)->first();
            if($member){
                //查到
                $mid = $member->id;
                $rank = $member->rank;
                session(['mid'=>$mid , 'rank'=>$rank]);
            }else{
                //没有 入库
                $new = new Member;
                $new->openid = $openid;
                $new->addtime = time();
                $new->rank = 0;
                $new->save();
                $mid = $new->id;
                session(['mid'=>$mid , 'rank'=>0]);
            }
            session()->save();

        }

        return $next($request);
    }
}
