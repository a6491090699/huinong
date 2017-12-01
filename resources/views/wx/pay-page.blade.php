<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>地球村竞苗平台在线交易专业平台</title>
<meta name="keywords" content="地球村竞苗平台网,花木网,花木,中国苗木网,花木交易,花木求购,花木资讯,花木论坛,花木销售,绿化苗木" />
<meta name="description" content="地球村竞苗平台网，中国苗木网，地球村竞苗平台在线交易专业平台，致力于为花木行业从业者提供更真实的花木在线交易平台，让您没有买不到的，没有卖不掉的。" />
    <link rel="stylesheet"  href="/css/mobile-select-area.css">
    <!--<link rel="stylesheet" href="/css/larea.css">-->
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="stylesheet" href="/css/index.css"/>
    <!--<link rel="stylesheet" href="/css/sm.min.css">-->
    <!--<script type='text/javascript' src='/js/zepto.min.js' charset='utf-8'></script>-->
    <!--<script type='text/javascript' src='/js/sm.min.js' charset='utf-8'></script>-->
    <script src="/js/jquery-1.11.2.js" type="text/javascript"></script>
    <script src="/js/layer.js"></script>
    <script type="text/javascript" src="/js/index.js"></script>
    <script src="/js/mlselection.js"></script>
    <script src="/js/huamu.js" type="text/javascript"></script>
    <script src="/js/jquery.validate.js" type="text/javascript"></script>
    <script src="/js/jquery.validate.extend.js" type="text/javascript"></script>
    <script src="/js/additional-methods-huamu.js" type="text/javascript"></script>
    <script src="/js/index.js" type="text/javascript"></script>
    <script src="/js/common.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/dialog.js"></script>
    <script type="text/javascript" src="/js/mobile-select-area.js"></script>
    <script type="text/javascript" src="/js/json2.js" ></script>
    <script type="text/javascript" src="/js/underscore-min.js" ></script>
    <script src="/js/ydbonline.js" type="text/javascript"></script>
    <script>
        //模板设置
        _.templateSettings = {
            interpolate: /\{(.+?)}/g
        };
        var SITE_URL = "/";
        var REAL_SITE_URL = "/";
        var PRICE_FORMAT = '¥%s';

    </script>
    <script type="text/javascript">
        var lat = 0;
        var lon = 0;
        function getCookie(c_name)
        {
            if (document.cookie.length>0)
            {
                c_start=document.cookie.indexOf(c_name + "=");
                if (c_start!=-1)
                {
                    c_start=c_start + c_name.length+1;
                    c_end=document.cookie.indexOf(";",c_start);
                    if (c_end==-1) c_end=document.cookie.length;
                    return unescape(document.cookie.substring(c_start,c_end));
                }
            }
            return "";
        }

        function setCookie(c_name,value,expiredays)
        {
            var exdate=new Date();
            exdate.setDate(exdate.getDate()+expiredays);
            document.cookie=c_name+ "=" +escape(value)+
                ((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
        }

        function checkCookie(ll_name)
        {
            cookie_v=getCookie(ll_name);
            if (cookie_v!=null && cookie_v!="")
            {
                if(ll_name=="lat"){
                    lat=cookie_v;
                } else if(ll_name=="lon"){
                    lon=cookie_v;
                }
            }
        }
    </script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        wx.config(<?php echo $js->config(array('onMenuShareQQ', 'onMenuShareWeibo','chooseWXPay'), true) ?>);
    </script>

</head>
<body class="bg-f8">
<header class="user_center_header">
    <a class="go_back_btn" href="javascript:history.go(-1)">
        <span class="iconfont">&#xe698;</span>
    </a>
    <h1>订单支付</h1>
</header>
<div class="padding_container bg-fff foot_border-top text_center should_pay">
    <h3 class="color_34 font_3r fontWeight_5 " id="order_amount">应付金额 ¥ {{$orderinfo->total_price}}</h3>
    <div class="border_none">
        <span class="font_24r color_67">含运费：¥ {{$orderinfo->ship_price}}</span>
    </div>
</div>
<div class="pay_mode_container">
    <form id="form" action="" method="POST" style="background:none;" class='about-cancel'>
        <input type="hidden" name="hm_csrf" value="bWuaezggsB9XggCaDuEWWxMoRFt6LLLt" />
        <input type="hidden" name="choice" value="choice"/>
        <input type="hidden" name="pay_type" value="x_pay"/>
        <div class="form_item bg-fff user_store padding_flanks">
            <span class="font_3r fontWeight_5 color_34">订单编号:</span>
            <span class="fr font_26r">{{$orderinfo->order_sn}}</span>
        </div>
        <div class="form_item padding_flanks user_store bg-fff">
            <a class="input_checkbox-right a_full input_radio_select">
                <span class="font_3r">微信支付</span>
                <!-- <span class="font_3r">余额支付</span> -->
                <input type="checkbox" class="input-select" id="use_buyer_amount" />
                <!-- <input name="use_buyer_amount" value="0" type="hidden"/> -->

            </a>
        </div>

            </form>

</div>
<div class="padding_flanks">
    <button class="secede_debark_btn" type="button" onclick="wx_pay()">立即支付</button>
</div>
@include('home.common.footer')

<script type="text/javascript">
    function wx_pay(){
        wx.chooseWXPay({
            timestamp: <?= $config['timestamp'] ?>,
            nonceStr: '<?= $config['nonceStr'] ?>',
            package: '<?= $config['package'] ?>',
            signType: '<?= $config['signType'] ?>',
            paySign: '<?= $config['paySign'] ?>', // 支付签名
            success: function (res) {
                // 支付成功后的回调函数
                layer.open({content:'支付成功!', time:2});

                setTimeout(function(){
                    window.location.href='/buyorder/index';
                },1000);
            }
        });
    }

</script>

</body>
</html>
