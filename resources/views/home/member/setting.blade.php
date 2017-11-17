<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>设置</title>
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="stylesheet" href="/css/index.css"/>
    <script src="/js/jquery-1.11.2.js" type="text/javascript"></script>
    <script src="/js/index.js" type="text/javascript"></script>
</head>
<body class="bg-f8">
<header class="user_center_header bd_bottom-ddd">
    <a class="go_back_btn" href="javascript:history.go(-1)">
        <span class="iconfont">&#xe698;</span>
    </a>
    <h1>设置</h1>
</header>
<div class="padding_flanks bg-fff">
    <!-- <div class="form_item">
        <a href="#" class="a_full">
            <span class="font_3r color_34">修改密码</span>
            <b class="iconfont select_arrows-icon">&#xe614;</b>
        </a>
    </div> -->
        <!--
    <div class="form_item ">
        <span class="font_3r fontWeight_5 color_34 goods_name-title">清理缓存</span>
        <span class="fr font_24r">47.8M</span>
    </div>
    -->
</div>
<div class="padding_flanks bg-fff  user_store bd_top_bottom-eee">
    <!--
    <div class="form_item">
        <a href="http://m.huamu.com/index.php?app=member&act=feedback">
            <span class="font_3r fontWeight_5 color_34 goods_name-title">意见反馈</span>
            <b class="iconfont select_arrows-icon">&#xe614;</b>
        </a>
    </div>
    -->
    <div class="form_item">
        <a href="/member/xieyi" class="a_full">
            <span class="font_3r color_34 span_wd_35">服务条款与协议</span>
            <b class="iconfont select_arrows-icon">&#xe614;</b>
        </a>
    </div>
    <div class="form_item border_none">
        <a href="/member/xieyi" class="a_full">
            <span class="font_3r color_34">关于我们</span>
            <b class="iconfont select_arrows-icon">&#xe614;</b>
        </a>
    </div>

</div>
<!-- <div class="padding_flanks">
    <button class="secede_debark_btn" onclick="location='#'">退出当前登录</button>
</div> -->

@include('home.common.footer')
</body>
</html>
