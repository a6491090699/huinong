<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>用户中心</title>
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

</head><style>
    .layermbtn span:first-child{
        background-color: inherit;
        height:auto;
    }
</style>
<body>
<header class="user_header">
    <a href="/member/setting" class="user_settings fl">设置</a>
    <a href="#" class="user_message fr"><span class="iconfont">&#xe690;</span></a>
    <a href="/member/index"><img src="{{getPic($store->logo)}}" width="75px" height="75px" class="user_picture"/></a>
    <p class="user_name">{{$store->store_name}}</p>
    <div class="user_attestation">
        <!-- <span class="iconfont attestation-color-phone">&#xe68e;</span>
        <span class="iconfont attestation-color-phone">&#xe68f;</span> -->
        <span class="iconfont @if($store->phone_valid) attestation-color-phone @else color_9a @endif">&#xe68e;</span>
        <span class="iconfont @if($store->id_valid) attestation-color-phone @else color_9a @endif">&#xe6b9;</span>
        <span class="iconfont @if($store->jingying_valid) attestation-color-phone @else color_9a @endif">&#xe988;</span>
        <span class="iconfont @if($store->money_valid) attestation-color-phone @else color_9a @endif">&#xe6bb;</span>
        <span class="iconfont @if($store->shidi_valid) attestation-color-phone @else color_9a @endif">&#xe6ba;</span>
        <span class="iconfont @if($store->danbao_valid) attestation-color-phone @else color_9a @endif">&#xe68f;</span>

                        </div>
</header>
<main class="user_main">
    <div class="user_grade clearfix">
        @if($store->member->rank == 1)
        <a href="/wx/vip" class="user_grade_promote fl"><span class="iconfont">&#xe6a1;</span>升级会员</a>
        <!-- <a href="javascript:void(0)" class="user_grade_promote fl"><span class="iconfont">&#xe6a1;</span>您已是会员</a> -->
        @else
        <a href="/wx/vip" class="user_grade_promote fl"><span class="iconfont">&#xe6a1;</span>升级会员</a>
        @endif

        <a href="/member/valid-index" class="user_real_name fl"><span class="iconfont fontWeight_5">&#xe691;</span>认证中心</a>
    </div>
    <ul class="user_means_list">
        <li><a href="/store/index">我的店铺<b class="right_arrows fr">&#xe614;</b></a></li>
        <li><a href="/member/collect">我的收藏<b class="right_arrows fr">&#xe614;</b></a></li>
    </ul>
    <ul class="user_means_list">
        <li><a href="/supplyorder/index">供货订单<b class="right_arrows fr">&#xe614;</b></a></li>
        <li><a href="/want/order">采购订单<b class="right_arrows fr">&#xe614;</b></a></li>
        <li><a href="/member/my-goods">我的商品<b class="right_arrows fr">&#xe614;</b></a></li>
        <li><a href="/want/my-want">我的求购<b class="right_arrows fr">&#xe614;</b></a></li>
        <li><a href="/quote/my">我的报价<b class="right_arrows fr">&#xe614;</b></a></li>
        <li><a href="/yuyue/my-yuyue">我的预约看货<b class="right_arrows fr">&#xe614;</b></a></li>
        <li><a href="/yuyue/others-yuyue">别人预约我的货 我管理<b class="right_arrows fr">&#xe614;</b></a></li>
    </ul>
    <ul class="user_means_list">
        <li><a href="/member/address">收货地址<b class="right_arrows fr">&#xe614;</b></a></li>
    </ul>
</main>

<script type="text/javascript">
    function goto_open_store(){
        layer.open({
            content: "店铺尚未开通。去开通？"
            ,btn: ['确认', '取消']
            ,yes: function(index){
                var url="/store/add";
                layer.close(index);
                location = url;
            }
        });
    }
    function goto_profile(){
        layer.open({
            content: "还未完善个人信息。去完善？"
            ,btn: ['确认', '取消']
            ,yes: function(index){
                var url="/member/info";
                layer.close(index);
                location = url;
            }
        });
    }
</script>


@include('home.common.footer')


</body>
</html>
