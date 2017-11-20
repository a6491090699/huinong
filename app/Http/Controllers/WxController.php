<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WxController extends Controller
{
    //
    public function index()
    {
        $user = session('wechat.oauth_user'); // 拿到授权用户资料
        dd($user);
        return view('wx.index');
    }

    public function jsapi()
    {
        return view('wx.jsapi');
    }
}
