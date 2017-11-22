<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>店铺升级第一步 - 中国花木在线交易专业平台</title>
<meta name="keywords" content="竞苗平台,花木网,花木,中国苗木网,花木交易,花木求购,花木资讯,花木论坛,花木销售,绿化苗木" />
<meta name="description" content="竞苗平台，中国苗木网，中国花木在线交易专业平台，致力于为花木行业从业者提供更真实的花木在线交易平台，让您没有买不到的，没有卖不掉的。" />
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

        function pay_wechat(){

        }

        function pay_alipay(){

        }

    </script>

</head><body class="bg-f8">
<header class="user_center_header bd_bottom-ddd">
  <a class="go_back_btn" href="javascript:history.go(-1)">
    <span class="iconfont">&#xe698;</span>
  </a>
  <h1>终身会员</h1>
</header>
<div>
  <img src="/images/upgrade_to_2.jpg"/>
</div>
<div class="bg-fff padding_top_bottom text_center bd_bottom-eee">
  <p class="font_28r padding_top_bottom">当前等级：<span class="color_ff7f03">终身会员</span></p>
  <p class="font_28r padding_top_bottom">支付金额：<span class="color_ff7f03">¥880.00</span></p>
  <!-- <label><input type="radio" name="chongzhi_type" value="1" checked>微信支付</label>
  <label><input type="radio" name="chongzhi_type" value="2">支付宝支付</label> -->
  <script type="text/javascript">
  // function shengji()
  // {
  //     var type = $('input[name=chongzhi_type]').val();
  //     alert(type)
  // }
  </script>
  <div class="text_center upgrade_btn padding_top_bottom">
    <!-- <a class="color_fff bg-02c5a3 font_26r" href="javascript:void(0)" onclick="shengji()">立即升级</a> -->
    <a class="color_fff bg-02c5a3 font_26r" href="javascript:void(0)" onclick="pay_wechat()">微信支付</a>
    <br>
    
  </div>
</div>
<div class="padding_flanks bg-fff user_store bd_top-eee">
  <div class="form_item">
    <span class="font_3r fontWeight_5 color_0281cd">会员特权</span>
  </div>
  <div class="form_item font_28r color_34">
    <span>发布报价</span>
    <span class="fr">无限条</span>
  </div>
  <div class="form_item font_28r color_34">
    <span>发布求购</span>
    <span class="fr">无限条</span>
  </div>
  <div class="form_item font_28r color_34">
    <span>发布商品</span>
    <span class="fr">50条</span>
  </div>
  <div class="form_item font_28r color_34">
    <span>每日发布报价</span>
    <span class="fr">20条</span>
  </div>
  <div class="form_item font_28r color_34">
    <span>商品每日刷新</span>
    <span class="fr">5次</span>
  </div>
  <div class="form_item font_28r color_34">
    <span>商品列表排名</span>
    <span class="fr">在普通会员前</span>
  </div>
</div>
<footer class="font_3r">
  <a class="footer_btn color_fff bg-02c5a3">咨询电话：8888-888-888</a>
</footer>
</body>
</html>
