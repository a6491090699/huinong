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
        // dd($user);
        $or = $user->original;
        $openid = $user->id;
        $nickname = $or['nickname'];
        $avatar = $user->avatar;
        $province = $or['province'];
        $sex = $or['sex'];
        $headimgurl = $or['headimgurl'];
        $country = $or['country'];
        $city = $or['city'];
        $member = \App\Model\Member::where('openid' , $openid)->first();
        if($member){
            $mid = $member->id;
            $rank = $member->rank;
        }else{
            \DB::beginTransaction();
            $new = new \App\Model\Member;
            $new->openid = $openid;
            $new->addtime = time();
            if($new->save())
            {
                $mm = new \App\Model\MemberUserinfo;
                $mm->wx_nickname = $nickname;
                // $mm->wx_avatar = $avatar;
                $mm->wx_province = $province;
                $mm->wx_headimgurl = $headimgurl;
                $mm->wx_sex = $sex;
                $mm->wx_country = $country;
                $mm->wx_city = $city;
                $mm->mid = $new->id;
                if($mm->save()){
                    \DB::commit();
                    $mid = $new->id;
                    $rank = 0;
                    // return response()->view('home.common.404',['msg'=>'发生错误请重试！错误代码222']);

                }else{
                    \DB::rollback();
                    return response()->view('home.common.404',['msg'=>'发生错误请重试！错误代码222']);
                }
            }


        }

        session(['mid'=>$mid,'nickname'=>$user->nickname ,'avatar'=>$user->avatar ,'rank'=>$rank]);

        return $next($request);
    }
}
