<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use EasyWeChat\Payment\Order;
use EasyWeChat\Foundation\Application;
use App\Model\Want;
use App\Model\Supply;
use App\Model\Member;

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

        // \Log::info('heheh|||yyyyyyyyyy');
        $options=require config_path().'/wechat.php';
        $app = new Application($options);
        $response = $app->payment->handleNotify(function($notify, $successful){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            $order = Want::where('wx_out_trade_no',$notify->out_trade_no)->first();
            // $order = 查询订单($notify->out_trade_no);
            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->is_pay == 1) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }
            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                // $order->paid_at = time(); // 更新支付时间为当前时间
                $order->is_pay = 1;
                $order->save();

            } else { // 用户支付失败
                $order->is_pay = 0;
                // $order->delete();

            }
            $order->save(); // 保存订单
            return true; // 返回处理完成
        });
        return $response;

    }



    public function vip()
    {
        $user = session('wechat.oauth_user');
        // dd($user);
        $options=require config_path().'/wechat.php';
        $app = new Application($options);
        $js = $app->js;

        //订单详情
        $payment = $app->payment;
        // $prepayId = '123213213';
        // $config = $payment->configForJSSDKPayment($prepayId);
        // dump($js->config(array('onMenuShareQQ', 'onMenuShareWeibo','chooseWXPay'), true));
        // dd($config);


        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => '升级金牌会员',
            'detail'           => '升级金牌会员880块',
            // 'out_trade_no'     => '1217752501201407033233368019',
            'out_trade_no'     => date('Ymdhis').strrand(5),
            'total_fee'        => config('common.open_vip_price'), // 单位：分
            'notify_url'       => 'http://sj.71mh.com/api/wx/member-notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'openid'           => $user->id, // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];
        // dump($attributes);
        // dd($user->id);
        $order = new Order($attributes);

        $result = $payment->prepare($order);

        // dd($result);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
            $config = $payment->configForJSSDKPayment($prepayId);
        }

        $out_trade_no = $attributes['out_trade_no'];

        // return view('wx.paybutton',['js'=>$js,'config'=>$config]);



        return view('home.member.vip',['out_trade_no'=>$out_trade_no,'js'=>$js,'config'=>$config]);


        // return view('home.member.vip');
    }

    public function memberNotify()
    {
        // file_put_contents(public_path.'/123.txt','213213213213213');
        \Log::info('123213213');

        $options=require config_path().'/wechat.php';
        $app = new Application($options);
        $response = $app->payment->handleNotify(function($notify, $successful){
            \Log::info('receive-openid:'.$notify->openid);
            \Log::info('receive-successful:'.$successful);
            \Log::info('receive-package:'.$notify);
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            $member = Member::where('openid',$notify->openid)->first();
            // $order = 查询订单($notify->out_trade_no);
            if (!$member) { // 如果订单不存在
                return 'member not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($member->rank == 1) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }
            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                // $order->paid_at = time(); // 更新支付时间为当前时间
                $member->rank = 1;
                $member->vip_addtime = time();
                $member->vip_endtime = strtotime('+1 year');
                // $member->save();

            } else { // 用户支付失败
                $member->rank = 0;
                // $order->delete();

            }
            $member->save(); // 保存订单
            \Log::info('Memberinfo='.$member);
            return true; // 返回处理完成
        });
        return $response;
    }

    //订单加急处理回调
    public function supplyNotify()
    {
        $options=require config_path().'/wechat.php';
        $app = new Application($options);
        $response = $app->payment->handleNotify(function($notify, $successful){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            $order = Supply::where('wx_out_trade_no',$notify->out_trade_no)->first();
            // $order = 查询订单($notify->out_trade_no);
            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->is_emergency == 1) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }
            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                // $order->paid_at = time(); // 更新支付时间为当前时间
                $order->is_emergency = 1;
                $order->save();

            } else { // 用户支付失败
                $order->is_pay = 0;
                // $order->delete();

            }
            $order->save(); // 保存订单
            return true; // 返回处理完成
        });
        return $response;
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
        // dump($js->config(array('onMenuShareQQ', 'onMenuShareWeibo','chooseWXPay'), true));
        // dd($config);


        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => 'iPad mini 16G 白色',
            'detail'           => 'iPad mini 16G 白色',
            // 'out_trade_no'     => '1217752501201407033233368019',
            'out_trade_no'     => date('Ymdhis').strrand(5),
            'total_fee'        => 1, // 单位：分
            'notify_url'       => 'http://sj.71mh.com/api/wx/wantnotify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
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
        // return view('wx.paybutton',['js'=>$js]);

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
