<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>中国花木在线交易专业平台</title>
<meta name="keywords" content="中国花木网,花木网,花木,中国苗木网,花木交易,花木求购,花木资讯,花木论坛,花木销售,绿化苗木" />
<meta name="description" content="中国花木网，中国苗木网，中国花木在线交易专业平台，致力于为花木行业从业者提供更真实的花木在线交易平台，让您没有买不到的，没有卖不掉的。" />
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

</head>
<body class="bg-f8">
<header class="user_center_header text_left bd_bottom-eee">
  <a class="go_back_btn" href="javascript:history.go(-1)">
    <span class="iconfont">&#xe698;</span>
  </a>
  <ul class="clearfix collect_nav">
    <li class="collect_li-hover">商品收藏</li>
    <li class="">店铺收藏</li>
  </ul>
</header>
<div class="sell_index-main">

  <div class="collect_nav-0">
    <!-- <div class="text_center padding_bottom">
      <a  class="sell_header_search_box procurement_search color_67">
        <span class="iconfont">&#xe608;</span>
        <input type="text" class="color_67" id="keyword_goods" placeholder="搜索您想要的商品"/>
      </a>
    </div> -->
    <ul class="supply_information-list bg-fff list_bd_top_none">
        @forelse($goods as $val)
            <li>
        <dl class="clearfix">
          <a href="/supply/view/{{$val->goods->id}}">
            <dt class="fl"><img src="{{getPic(config('common.img_default'))}}" style="width:88px;height:88px"/></dt>
            <dd class="fl position_relative">
              <p class="font_3r color_34">{{$val->goods->goods_name}}</p>
              <div class="sell_information">
                <span class="color_ff7414">¥<b class="font_35r">{{$val->goods->price}}</b>/{{$val->goods->kinds->unit}}</span>
                <!--<span class="min_sell-num">库存：1000000</span>-->
              </div>
              <p>
                <span class="">已售{{$val->goods->saled_num}}件</span>
                <span class="fr">截止日期:{{date('Y-m-d',$val->goods->cutday)}}</span>
              </p>
              <span class="" data-lat="34.1005" data-lon="114.1885"></span>
            </dd>
          </a>
        </dl>
      </li>
      @empty
      <li class="release_goods-none">
        <span class="iconfont">&#xe6a5;</span>
        <p class="font_27r color_9a">目前还没有收藏商品</p>
    </li>

      @endforelse
          </ul>
    <p class="text_center user_store padding_container font_2r color_9a" style="display: none;">加载更多...</p>

    <div class="release_goods-none" style="display:none;">
      <span class="iconfont">&#xe6a5;</span>
      <p class="font_27r color_9a">目前还没有收藏商品</p>
    </div>
  </div>


  <div class="store_able-container collect_nav-1" style="display: none">
    <!-- <div class="text_center padding_bottom">
      <a class="sell_header_search_box procurement_search">
        <span class="iconfont color_67">&#xe608;</span>
        <input type="text" class="color_67" id="keyword_store" placeholder="搜索您想要的店铺"/>
      </a>
    </div> -->
    <div>
            <div class="padding_container bg-fff margin_bottom bd_top_bottom-eee">
                @forelse($stores as  $val)
        <dl class="clearfix goods_details_store">
          <dt class="fl">
            <img src="{{getPic($val->stores->logo)}}" style="object-fit:cover;width:103.5px;height:103.5px"/>
          </dt>
          <dd class="fl color_34 padding_flanks">
            <p class="font_3r">{{$val->stores->store_name}}</p>
            <p class="font_27r">主营：{{$val->stores->store_sale}}</p>
            <p class="font_24r color_9a">销量&nbsp;{{$store_saled_total}}&nbsp;共{{$val->goods_count}}个商品</p>
            <div>
                {!!str_repeat('<img src="/images/heart_1.png" height="12px">' ,floor($val->stores->xinyong))!!}
              <!-- <img src="/images/heart_1.png"/> -->
            </div>
            <a href="/store/view/{{$val->store_id}}" class="enter_store_btn border_color-67 font_28r" style="top: 60%;">进店</a>
          </dd>
        </dl>
        @empty
        <dl class="release_goods-none" >
          <span class="iconfont">&#xe6c8;</span>
          <p class="font_27r color_9a">目前还没有收藏店铺</p>
      </dl>
        @endforelse
      </div>
            <p class="text_center user_store padding_container font_2r color_9a" style="display: none;">加载更多...</p>
    </div>

    <div class="release_goods-none" style="display:none;">
      <span class="iconfont">&#xe6c8;</span>
      <p class="font_27r color_9a">目前还没有收藏店铺</p>
    </div>
  </div>

</div>
<script>
    var collect_index;
    $(".collect_nav li").click(function(){
        $(".collect_nav").find("li").removeClass("collect_li-hover");
        $(this).addClass("collect_li-hover");
        collect_index=$(this).index();
        switch (collect_index){
            case collect_index:
                $("[class*=collect_nav-]").hide();
                $("[class$=collect_nav-"+collect_index+"]").show();
        }
    });

    $(function() {

        $("#keyword_goods").keyup(function(event){
            if(event.keyCode == 13){
                // var keyword = $.trim($("#keyword_goods").val());
                // var url = "/index.php?app=search&keyword=" + keyword;
                // location = url;
            }
        });
        $("#keyword_store").keyup(function(event){
            if(event.keyCode == 13){

                // var keyword = $.trim($("#keyword_store").val());
                // var url = "/index.php?app=brand&store_name=" + keyword;
                // location = url;
            }
        });


        //navigator.geolocation.getCurrentPosition(getPositionSuccess, getPositionError, position_option);
        checkCookie("lat");checkCookie("lon");//2017-10-23
        if (lat!=0 && lon!=0)
        {
            calc_item_distance();
        }else{
            navigator.geolocation.getCurrentPosition(getPositionSuccess, getPositionError, position_option);
        }

        function getPositionSuccess( position ){
            lat = position.coords.latitude;
            lon = position.coords.longitude;
            setCookie("lat",lat,1);//2017-10-23
            setCookie("lon",lon,1);
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
@include('home.common.footer')
</body>
</html>
