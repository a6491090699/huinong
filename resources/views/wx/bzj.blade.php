<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>缴纳保证金</title>
    <meta name="_token" content="{{ csrf_token() }}"/>
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
        var SITE_URL = "http://m.huamu.com";
        var REAL_SITE_URL = "http://m.huamu.com";
        var PRICE_FORMAT = '¥%s';

    </script>
    <script type="text/javascript">
    $.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
    });

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

        function pay_wechat(id){
            $.ajax({
                url:'/supplyorder/confirm',
                type:'post',
                data:{id:id},
                success:function(d){



                    wx.chooseWXPay({
                        timestamp: <?= $config['timestamp'] ?>,
                        nonceStr: '<?= $config['nonceStr'] ?>',
                        package: '<?= $config['package'] ?>',
                        signType: '<?= $config['signType'] ?>',
                        paySign: '<?= $config['paySign'] ?>', // 支付签名
                        success: function (res) {
                            // 支付成功后的回调函数
                            layer.open({content:'缴纳保证金成功,确认订单成功,等待买家付款.', time:2});
                            //异步
                            setTimeout(function(){
                                window.location.href='/supplyorder/index';
                            },1000);


                            // setTimeout(function(){
                            //     window.location.href='/member/index';
                            // },1000);
                        }
                    });


                    // layer.open({content:d.msg, time:2});



                }
            })


        }

        function pay_alipay(){

        }

    </script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        wx.config(<?php echo $js->config(array('onMenuShareQQ', 'onMenuShareWeibo','chooseWXPay'), false) ?>);
    </script>

</head><body class="bg-f8">
<header class="user_center_header bd_bottom-ddd">
  <a class="go_back_btn" href="javascript:history.go(-1)">
    <span class="iconfont">&#xe698;</span>
  </a>
  <h1>缴纳保证金</h1>
</header>
<!-- <div>
  <img src="/images/upgrade_to_2.jpg"/>
</div> -->
<div class="bg-fff padding_top_bottom text_center bd_bottom-eee">
  <p class="font_28r padding_top_bottom">为保证双方交易诚信</p>
  <p class="font_28r padding_top_bottom">您需缴纳保证金到平台,接受平台监管!</p>
  <p class="font_28r padding_top_bottom">保证金金额：<span class="color_ff7f03">¥{{(float)config('common.bzj_price')/100}}</span></p>
  <!-- <label><input type="radio" name="chongzhi_type" value="1" checked>微信支付</label>
  <label><input type="radio" name="chongzhi_type" value="2">支付宝支付</label> -->

  <div class="text_center upgrade_btn padding_top_bottom">
    <!-- <a class="color_fff bg-02c5a3 font_26r" href="javascript:void(0)" onclick="shengji()">立即升级</a> -->
    <a class="color_fff bg-02c5a3 font_26r" href="javascript:void(0)" onclick="pay_wechat({{$orderinfo->id}})">微信支付</a>
    <br>

  </div>
</div>

<footer class="font_3r">
  <a class="footer_btn color_fff bg-02c5a3">咨询电话：8888-888-888</a>
</footer>
</body>
</html>
