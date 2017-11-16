<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>中国花木在线交易专业平台</title>
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
    <script>
        //模板设置
        _.templateSettings = {
            interpolate: /\{(.+?)}/g
        };
        var SITE_URL = ".";
        var REAL_SITE_URL = ".";
        var PRICE_FORMAT = '¥%s';

    </script>

</head>
<body class="bg-f8">
<header class="user_center_header bd_bottom-ddd">
    <a class="go_back_btn" href="javascript:history.go(-1)">
        <span class="iconfont">&#xe698;</span>
    </a>
    <h1>实名认证</h1>
</header>

<div class="padding_flanks bg-fff">
        <div class="form_item">
        <a  class="a_full">
            <span class="font_3r color_34">手机验证</span>
            <span class="user_enterprise fr"><span class="cstate_3">审核通过</span></span>
            <b class="iconfont select_arrows-icon">&#xe614;</b>
        </a>

    </div>
        <div class="form_item">
        <a href="#" class="a_full">
            <span class="font_3r color_34">身份证验证</span>
            <span class="user_enterprise fr"><span class="cstate_0">未提交</span></span>
            <b class="iconfont select_arrows-icon">&#xe614;</b>
        </a>

    </div>
        <div class="form_item">
        <a href="#" class="a_full">
            <span class="font_3r color_34">经营许可证验证</span>
            <span class="user_enterprise fr"><span class="cstate_0">未提交</span></span>
            <b class="iconfont select_arrows-icon">&#xe614;</b>
        </a>

    </div>
        <div class="form_item">
        <a href="#" class="a_full">
            <span class="font_3r color_34">上缴保证金</span>
            <span class="user_enterprise fr"><span class="cstate_0">未提交</span></span>
            <b class="iconfont select_arrows-icon">&#xe614;</b>
        </a>

    </div>
        <div class="form_item">
        <a href="#" class="a_full">
            <span class="font_3r color_34">实地查验</span>
            <span class="user_enterprise fr"><span class="cstate_0">未提交</span></span>
            <b class="iconfont select_arrows-icon">&#xe614;</b>
        </a>

    </div>
        <div class="form_item">
        <a  class="a_full">
            <span class="font_3r color_34">担保交易</span>
            <span class="user_enterprise fr"><span class="cstate_3">审核通过</span></span>
            <b class="iconfont select_arrows-icon">&#xe614;</b>
        </a>

    </div>
        <!--
    <div class="form_item">
        <a href="user_identity_prove.html" class="a_full">
            <span class="font_3r fontWeight_5 color_34 goods_name-title">身份证验证</span>
            <span class="user_enterprise fr">未认证</span>
            <b class="iconfont select_arrows-icon">&#xe614;</b>
        </a>
    </div>
    -->
</div>


<div class="mask_layer mask_layer-translucence" id="mask_layer" style="display: none">
    <div class="check_tooltip bg-fff">
        <p class="check_hint">确定要实地查验？</p>
        <div class="tooltip_select_btn">
            <a href="#" class="tooltip_abolish_btn">取消</a>
            <a href="#">确定</a>
        </div>
    </div>
</div>

@include('home.common.footer')

</body>
</html>
