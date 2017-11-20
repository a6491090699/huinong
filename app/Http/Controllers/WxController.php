<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use EasyWeChat\Payment\Order;
use EasyWeChat\Foundation\Application;

class WxController extends Controller
{
    //
    public function index()
    {
        $user = session('wechat.oauth_user'); // 拿到授权用户资料
        // dd($user->id);
        return view('wx.index');
    }
    public function notify()
    {
        \Log::info('yynotify');
    }

    public function jsapi()
    {
        $user = session('wechat.oauth_user');
        $options=require config_path().'/wechat.php';
        $app = new Application($options);
        $js = $app->js;

        //订单详情
        $payment = $app->payment;
        // $prepayId = '123213213';
        // $config = $payment->configForJSSDKPayment($prepayId);


        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => 'iPad mini 16G 白色',
            'detail'           => 'iPad mini 16G 白色',
            'out_trade_no'     => '1217752501201407033233368018',
            'total_fee'        => 1, // 单位：分
            'notify_url'       => 'http://sj.71mh.com/wx/notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'openid'           => $user->id, // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];
        $order = new Order($attributes);

        $result = $payment->prepare($order);
        // dd($result);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
            $config = $payment->configForJSSDKPayment($prepayId);
        }



        return view('wx.paybutton',['js'=>$js,'config'=>$config]);

        // dd($js);
        // $openid = $user->id;

        // $user = session('wechat.oauth_user');
        // $openid = $user->id;
        // $appid = config('wechat.app_id');
        // $appsecret = config('wechat.secret');
        // $payment = config('wechat.payment');
        // $mch_id = $payment['merchant_id'];
        // $key = $payment['key'];
        // $business = new Business(
        //     $appid,
        //     $appsecret,
        //     $mch_id,
        //     $key
        // );
        //
        // $order = new Order();
        // $order->body = 'test body';
        // $order->out_trade_no = md5(uniqid().microtime());
        // $order->total_fee = '1'; // 单位为 “分”, 字符串类型
        // $order->openid = $openid;
        // $order->notify_url = 'http://sj.71mh.com/wx/notify';


        // return view('wx.jsapi');
    }
}
