<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>商家店铺-竞苗平台</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
    <link rel="stylesheet"  href="/css/mobile-select-area.css">
    <!--<link rel="stylesheet" href="/css/larea.css">-->
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="stylesheet" href="/css/index.css"/>
    <!--<link rel="stylesheet" href="/css/sm.min.css">-->
    <!--<script type='text/javascript' src='/js/zepto.min.js' charset='utf-8'></script>-->
    <!--<script type='text/javascript' src='/js/sm.min.js' charset='utf-8'></script>-->
    <script src="/js/jquery-1.11.2.js" type="text/javascript"></script>
    <script src="/js/layer.js"></script>
    <!--<script type="text/javascript" src="/js/index.js"></script>-->
    <script src="/js/mlselection.js"></script>
    <script src="/js/huamu.js" type="text/javascript"></script>
    <script src="/js/jquery.validate.js" type="text/javascript"></script>
    <script src="/js/jquery.validate.extend.js" type="text/javascript"></script>
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
        var REAL_SITE_URL = "/";
        var PRICE_FORMAT = '¥%s';

    </script>

</head>
<body class="bg-f8">
<header class="user_center_header bd_bottom-ddd">
  <a class="go_back_btn" href="javascript:history.go(-1)">
    <span class="iconfont color_9a">&#xe698;</span>
  </a>
  <h1>店铺</h1>
  <!-- <a class="univalence_affirm_btn font_3r" href="http://sanshan.m.huamu.com/store_67526/haibao/">
    <span class="iconfont font_35r color_34">&#xe6b8;</span>
  </a> -->
</header>
<div>
  <div  class="store_header clearfix">
    <dl class="fl clearfix store_header-left">
      <dt class="fl">
        <img src="/{{str_replace('public/','storage/',$info->logo)}}"/>
      </dt>
      <dd class="fl color_34">
        <p class="font_3r color_fff overflow_omit-8" style="    width:14em;">{{$info->store_name}}</p>

        <div>
		<p class="font_24r color_fff" style="margin-bottom: 5px;">信用值：<img src="/images/star_1.png" height="12px"><img src="/images/star_1.png" height="12px"><img src="/images/star_1.png" height="12px"><img src="/images/star_1.png" height="12px"><img src="/images/star_1h.png" height="12px"></p>
        </div>
      </dd>
    </dl>

  </div>
  <ul class="padding_container bd_top_bottom-eee bg-fff store_header-bottom clearfix ">
    <li style="width: 24.99999%;">
      <p class="font_28r color_34">942</p>
      <span class="font_24r color_9a">近期浏览</span>
    </li>
    <li style="width: 24.99999%;">
      <p class="font_28r color_34">{{$collect_num}}</p>
      <span class="font_24r color_9a">已关注</span>
    </li>
	<li style="width: 24.99999%;">
      <p class="font_28r color_34">24</p>
      <span class="font_24r color_9a">交易订单</span>
    </li>
    <li style="width: 24.99999%;">
      <p>
        <span class="color_9a iconfont" onclick="collect_store(67526);" id="store_not_collected_span" >&#xe641;</span>
        <span class="color_ff363e font_29r iconfont" id="store_collected_span" style="display:none">&#xe6d0;</span>
      </p>
      <span class="font_24r color_9a">收藏</span>
    </li>
  </ul>
</div>





<div class="bg-fff user_store">
  <ul class="bd_top_bottom-eee supply_purchase-list font_3r clearfix">
    <li class="hover_list" data-item="supply"><div>供应</div></li>
    <li class="middle_border"  data-item="want"></li>
    <li><div>采购</div></li>
  </ul>
  <ul class="supply_information-list list_bd_top_none">
      @forelse($supplys as $val)
        <li>
      <a href="/supply/view/{{$val->id}}">
        <dl class="clearfix hot_goods">
          <dt class="fl"><img src="/images/201710161710483319.jpg"/></dt>
          <dd class="fl">
            <p class="font_3r color_34">{{$val->goods_name}}</p>
            <div class="goods_prop color_ff7414">
                            <span>

                                @foreach($val->supplyAttrs as $v)
                                <b>{{$v->attrs->attr_name}}:{{$v->attr_value}}{{$v->attrs->short_unit}}</b>
                                @endforeach
                            </span>


                          </div>
            <div class="sell_information">
              <span class="color_ff7414">¥<b class="font_35r">{{$val->price}}</b>/{{$val->kinds->unit}}</span>
              <span class="sell_distance distance_info" data-lat="30.7627" data-lon="120.7509"></span>
            </div>
            <p>
              <span class="min_sell-num">库存：{{$val->number}}</span>
              <span class="fr">已售{{$val->saled_num?$val->saled_num:0}}件</span>
            </p>
          </dd>
        </dl>
      </a>
    </li>
    @empty
    <li class="text_center user_store padding_container font_2r color_9a">暂无符合条件的记录</li>
    @endforelse

        <!-- <li>
      <a href="./goods/1_10_10785_66699.html">
        <dl class="clearfix hot_goods">
          <dt class="fl"><img src="/images/201710161706347527.jpg"/></dt>
          <dd class="fl">
            <p class="font_3r color_34">7公分落羽杉</p>
            <div class="goods_prop color_ff7414">
                            <span><b>米:7cm</b></span>
                          </div>
            <div class="sell_information">
              <span class="color_ff7414">¥<b class="font_35r">110.00</b>/棵</span>
              <span class="sell_distance distance_info" data-lat="30.7627" data-lon="120.7509"></span>
            </div>
            <p>
              <span class="min_sell-num">库存：1000000</span>
              <span class="fr">已售0件</span>
            </p>
          </dd>
        </dl>
      </a>
    </li> -->
      </ul>
  <ul class="purchase_information-list" style="display: none;">
      @forelse($wants as $val)
      <li class="bg-fff bd_top_bottom-eee">
        <h3>{{$val->title}}</h3>
        <p>
        @foreach($val->wantAttrs as $v)
            {{$v->attrs->attr_name.$v->attr_value.$v->attrs->unit}}
        @endforeach
        </p>
         <!-- <p>高度10厘米 米径10厘米 冠幅10厘米 地径10厘米 </p> -->
         <p>苗源：{{$val->source}}</p>
         <p>手机号：{{$val->phone}}</p>
         <p class="purchase_information_quote">
             <span class="color_ff7414">已有{{$val->quotes_count}}人报价</span>
             <span>截止日期：{{date('Y-m-d',$val->cutday)}}</span>
         </p>
         <span class="purchase_num"><span class="color_ff7414">{{$val->number}}</span>{{$val->kinds->unit}}</span>
           <!-- <a href="/quote/add/1" class="quote_btn">报价</a> -->
        </li>
      @empty
      <li class="text_center user_store padding_container font_2r color_9a">暂无符合条件的记录</li>
      @endforelse


        <!-- <li class="text_center user_store padding_container font_2r color_9a">暂无符合条件的记录</li> -->
      </ul>
    <div class="padding_top_bottom">
        <a class="store_more_btn" href="/index.php?act=search">更多</a>
    </div>

</div>


<div class="padding_flanks bd_top_bottom-eee bg-fff user_store">
  <div class="form_item">
    <span class="font_3r color_34 goods_name-title">注册时间</span>
    <span class="font_26r color_67 fr">{{date('Y-m-d',$info->addtime)}}</span>
  </div>
  <div class="form_item">
    <span class="font_3r color_34 goods_name-title">主营</span>
    <span class="font_26r color_67 fr overflow_omit-16 text_right" style="display: inline-block">{{$info->store_sale}}</span>
  </div>
  <div class="form_item">
    <span class="font_3r color_34 goods_name-title">所在地</span>
    <span class="font_26r color_67 fr">{{$info->base_address}}</span>
  </div>
  <div class="clearfix icon_attestation-container">
    <span class="font_3r color_34 fl real_name-headline">实名认证</span>
    <div class="fr" style="width:70%;height:60px;overflow-x: auto;overflow-y: hidden;">
      <div style="width:400px;">
                <div class="icon_attestation">
          <span class="iconfont @if($info->phone_valid) attestation-color-phone @else color_9a @endif">&#xe68e;</span>
          <p>手机验证</p>
        </div>
                <div class="icon_attestation">
          <span class="iconfont @if($info->id_valid) attestation-color-phone @else color_9a @endif">&#xe6b9;</span>
          <p>身份证验证</p>
        </div>
                <div class="icon_attestation">
          <span class="iconfont @if($info->jingying_valid) attestation-color-phone @else color_9a @endif">&#xe988;</span>
          <p>经营许可证验证</p>
        </div>
                <div class="icon_attestation">
          <span class="iconfont @if($info->money_valid) attestation-color-phone @else color_9a @endif">&#xe6bb;</span>
          <p>上缴保证金</p>
        </div>
                <div class="icon_attestation">
          <span class="iconfont @if($info->shidi_valid) attestation-color-phone @else color_9a @endif">&#xe6ba;</span>
          <p>实地查验</p>
        </div>
            <div class="icon_attestation">
          <span class="iconfont @if($info->danbao_valid) attestation-color-phone @else color_9a @endif">&#xe68f;</span>
          <p>担保交易</p>
        </div>
              </div>
    </div>
  </div>

</div>

    <div class="form_item"  style="    text-align: center;">
    <span class="font_3r color_34 goods_name-title">卖家详情</span>
    <p class="font_24r color_67">{{$info->desc}}</p>
	<br>
	<br>
  </div>


<script type="text/javascript">
    $(function() {
        var lat = 0;
        var lon = 0;

        navigator.geolocation.getCurrentPosition(getPositionSuccess, getPositionError, position_option);

        function getPositionSuccess( position ){
            lat = position.coords.latitude;
            lon = position.coords.longitude;
            calc_item_distance();
        }
        function getPositionError(error) {
            switch (error.code) {
                case error.TIMEOUT:
                    //layer.open({content:'TIMEOUT', time:2});
                    break;
                case error.PERMISSION_DENIED:
                    //layer.open({content:'PERMISSION_DENIED', time:2});
                    break;
                case error.POSITION_UNAVAILABLE:
                    //layer.open({content:'POSITION_UNAVAILABLE', time:2});
                    break;
            }
            lat = "24.901652383991104";
            lon = "118.60036234322938";
            calc_item_distance();
        }

        function calc_item_distance(){
            if(lat !=0 && lon != 0){
                $(".distance_info").each(function(){
                    var this_lat=$(this).attr('data-lat');
                    var this_lon=$(this).attr('data-lon');
                    if(this_lat != 0 && this_lon != 0){
                        var distance_val=get_great_circle_distance(lat,lon,this_lat,this_lon);
                        $(this).html('<span class="iconfont font_3r">&#xe6c0;</span>' + distance_val);
                    }
                });
            }
        }
    });
</script>
<!-- 把按钮设置为js函数 点击获取data-item的值 supply want 还有page的值 然后用接口post获得数据 异步 填充数据 -->
<footer class="foot_border-top" style="background-color: #00ad8b;">
    <div class="foot_member foot_member_hover">
        <a href="#">
            <p><img src="/images/dh_01.png" width=50%></p>
        </a>
    </div>
    <div class="foot_member ">
        <a href="#">
            <p><img src="/images/dh_02.png" width=50%></p>
        </a>
    </div>
    <div class="foot_member ">
        <!--<a href="url app=discover">-->
            <!--<span class="iconfont" style="font-weight:900">&#xe694;</span>-->
            <!--<p>发现</p>-->
        <!--</a>-->
        <a class="goods_car-header" href="#">

            <p><img src="/images/dh_03.png" width=50%></p>
        </a>
    </div>
    <div class="foot_member ">
        <a href="#">
            <p><img src="/images/dh_04.png" width=50%></p>
        </a>
    </div>
</footer>






<span style='visible:hidden;'>
<script>
var _hmt = _hmt || [];
(function() {
    var hm = document.createElement("script");
    hm.src = "https://hm.baidu.com/hm.js?79ff8b04d2408694a6d3bf5a8f2d368e";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
})();
</script>
</span>
</body>
</html>
