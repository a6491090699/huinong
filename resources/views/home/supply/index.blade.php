<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>花木商城_花木在线交易_花卉苗木网上交易平台 -竞苗平台</title>
<meta name="keywords" content=",价格,行情,竞苗平台" />
<meta name="description" content="竞苗平台信息页,提供买卖,价格,行情,供求信息" />
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
        // var SITE_URL = "http://m.huamu.com";
        // var REAL_SITE_URL = "http://m.huamu.com";
        var PRICE_FORMAT = '¥%s';

    </script>

</head>
<body class="bg-f8">
<header class="user_center_header color_34 bd_bottom-ddd">
    <a class="go_back_btn" href="javascript:history.go(-1)">
        <span class="iconfont">&#xe698;</span>
    </a>
    <h1>商品</h1>
</header>
<style media="screen">
    .topnav{
        width:100%;
        height:44px;

    }
    .topnav li{
        float:left;
        width:50%;
        border:1px solid #eee;
        text-align: center;
        line-height: 44px;
        font-size:18px;
        border-top:0;


    }
    .cur_nav{
        background-color:#ff7414;
        color:#fff;
        border-radius: 3%;
    }

</style>
<input type="hidden" name="good_type" value="{{$type}}">

<div class="topnav" style="">
    <ul>
        <a href="/supply/index?type=normal"><li class="normal_good">商品</li></a>
        <a href="/supply/index?type=emergency"><li class="emergency_good">加急商品</li></a>
    </ul>
</div>
<script type="text/javascript">
    var good_type_val = $('input[name=good_type]').val();
    if(good_type_val == 'emergency'){
        $('.emergency_good').addClass('cur_nav');
    }else{
        $('.normal_good').addClass('cur_nav');
    }
</script>

<div class="sell_index-main">
    <div class="store_able-container" style="display: block">
        <div class="text_center">
            <a class="sell_header_search_box procurement_search">
                <span class="iconfont color_67">&#xe608;</span>
                <input type="text" name="keyword" id="keyword" placeholder="搜索您想要的商品" value=""/>
                <input name="app" type="hidden" value="search" />
                <input name="act" type="hidden" value="index" />
                <input type="hidden" name="cate_id"  id="cate_id" value="" />
                <input type="hidden" name="region_id"  id="region_id" value="" />
                <input type="hidden" name="price"  id="price" value="" />
                <input type="hidden" name="order" id="order" value="" />
                <!-- <input type="hidden" name="lat" id="lat" value="34.15718377" />
                <input type="hidden" name="lon" id="lon" value="113.48680406" />
				<input type="hidden" name="ip" id="ip" value="120.33.155.152" /> -->
            </a>
        </div>
        <ul id="region_province" style="display: none" class="bg-fff padding_flanks font_3r region_distribution_list bd_top_bottom-eee">
            <li region_id="">
                <span>全部</span>
            </li>

        </ul >
        <ul id="region_city" class="bg-fff padding_flanks font_3r region_distribution_list bd_top_bottom-eee" style="display: none">

        </ul>
        <div id="store_sort_con">
            <ul class="sort_nav_list padding_container bg-fff bd_top_bottom-eee clearfix font_3r" style="display: block">
                <li class="text_left ">
                <!-- <li class="text_left " order="distance asc" > -->
                    <span>筛选</span><span class="iconfont font_35r">&#xe6a0;</span>
                    <!-- <span>距离</span><span class="iconfont font_35r">&#xe6a0;</span> -->
                    <!--  向上箭头  <span class="iconfont font_35r">&#xe6c9;</span>-->
                </li>
                <li class="" order="saled_num asc">
                <!-- <li class="" order="orders_count asc"> -->
                    <span>销量</span><span class="iconfont font_35r">&#xe6a0;</span>
                    <!--  向上箭头  <span class="iconfont font_35r">&#xe6c9;</span>-->
                </li>
                <li class="" order="price asc">
                    <span>价格</span><span class="iconfont font_35r">&#xe6a0;</span>
                    <!--  向上箭头  <span class="iconfont font_35r">&#xe6c9;</span>-->
                </li>
                <li class="text_right" id="region_select">
                    <span id="region_name">地区</span><span class="iconfont font_35r">&#xe6a0;</span>
                    <!--  向上箭头  <span class="iconfont font_35r">&#xe6c9;</span>-->
                </li>
            </ul>

             <ul class="supply_information-list bg-fff" style="display: block" id="data_list_tuiguang_div"></ul>

			<ul class="supply_information-list bg-fff" style="display: block" id="data_list_div">

				<!-- <li class="border_top_none">
					<a href="#">
						<dl class="clearfix hot_goods">
							<dt class="fl">
								<img src="http://img.huamu.com/data/upload/goods/201502/06/100/201502061858209748.jpg?x-oss-process=image/resize,m_fill,h_130,w_130">
							</dt>
							<dd class="fl position_relative">
								<div class="store_grade-div" style="padding-left: 0px;">

								<p class="font_3r color_34 overflow_omit-8" style="width: 12em; font-size: 2.5rem !important;">【景观造型】香玲核桃苗</p>
								</div>
							<div class="goods_prop color_ff7414" style="float: right;margin-top: -1.8em;"><span><b>10分钟前</b></span></div>
							<div class="goods_prop color_ff7414" style="float: right;margin-top: 2.5em;"><span><b style="    font-size: 1.2em;color: #585252;">查看详情</b></span></div>
							<p style="    margin-top: 10px;">可供现货:2000</p>
							<p class="font_24r color_9a" style="margin-bottom: 5px;">供应商信用：<img src="/images/star_1.png" height="12px"><img src="/images/star_1.png" height="12px"><img src="/images/star_1.png" height="12px"><img src="/images/star_1.png" height="12px"><img src="/images/star_1h.png" height="12px"></p>
							<p>
								<span class="">福建漳州龙海市</span>
							</p>

							</dd>
						</dl>
					</a>
				</li>


				<li class="border_top_none">
					<a href="#">
						<dl class="clearfix hot_goods">
							<dt class="fl">
								<img src="/images/201502081354294549.jpg">
							</dt>
							<dd class="fl position_relative">
								<div class="store_grade-div" style="padding-left: 0px;">

								<p class="font_3r color_34 overflow_omit-8" style="width: 12em; font-size: 2.5rem !important;">【丛生乔木】木木木木</p>
								</div>
							<div class="goods_prop color_ff7414" style="float: right;margin-top: -1.8em;"><span><b>12分钟前</b></span></div>
							<div class="goods_prop color_ff7414" style="float: right;margin-top: 2.5em;"><span><b style="    font-size: 1.2em;color: #585252;">查看详情</b></span></div>
							<p style="    margin-top: 10px;">可供现货:6000</p>
							<p class="font_24r color_9a" style="margin-bottom: 5px;">供应商信用：<img src="/images/star_1.png" height="12px"><img src="/images/star_1.png" height="12px"><img src="/images/star_1.png" height="12px"><img src="/images/star_1h.png" height="12px"><img src="/images/star_1h.png" height="12px"></p>
							<p>
								<span class="">福建漳州龙海市</span>
							</p>

							</dd>
						</dl>
					</a>
				</li> -->




			</ul>

			<p class="text_center margin_top margin_bottom padding_container font_24r color_9a" id="loading01" style="display: none;">加载更多...</p>
        </div>


    </div>
    <script type="text/javascript">

        var search_goods_tpl = '<li class="border_top_none">';
        search_goods_tpl += '<a href="{goods_url}">';
        search_goods_tpl += '    <dl class="clearfix hot_goods">';
        search_goods_tpl += '    <dt class="fl"><img src="{litpic}"/></dt>';
        search_goods_tpl += '    <dd class="fl position_relative">';
        search_goods_tpl += ' {store_name_info} ';
        search_goods_tpl += '<div class="goods_prop color_ff7414">{spec_info}</div>';
        search_goods_tpl += '    <div class="sell_information">';
        search_goods_tpl += '    <span class="color_ff7414">¥<b class="font_35r">{price}</b>/{goods_unit}</span>';
//        search_goods_tpl += '    <span class="min_sell-num">库存：{stock}{goods_unit}</span>';
        search_goods_tpl += '</div>';
        search_goods_tpl += '<p>';
        search_goods_tpl += '<span class="">已售{sales}单</span>';
        search_goods_tpl += '    <span class="fr">截止日期:{formated_expire}</span>';
        search_goods_tpl += '</p>';
        search_goods_tpl += '<span class="color_ff7414 distance_icon font_26r">{distance_val}</span>';
        search_goods_tpl += '</dd>';
        search_goods_tpl += '</dl>';
        search_goods_tpl += '</a>';
        search_goods_tpl += '</li>';

        var goods_tpl = '<li class="border_top_none">';
        goods_tpl += '<a href="{goods_url}">';
        goods_tpl += '<dl class="clearfix hot_goods">';
        goods_tpl += '<dt class="fl" style="">';
        goods_tpl += '<img src="{litpic}" style="object-fit:cover;width:103.4px;height:103.4px;" >';
        goods_tpl += '</dt>';
        goods_tpl += '<dd class="fl position_relative">';
        goods_tpl += '<div class="store_grade-div" style="padding-left: 0px;">';
        goods_tpl += '<p class="font_3r color_34 overflow_omit-8" style="width: 12em; font-size: 2.5rem !important;">【{kind_name}】{goods_name}</p>';
        goods_tpl += '</div>';
        goods_tpl += '<div class="goods_prop color_ff7414" style="float: right;margin-top: -1.8em;"><span><b>{formate_time}</b></span></div>';
        goods_tpl += '<div class="goods_prop color_ff7414" style="float: right;margin-top: 2.5em;"><span><b style="    font-size: 1.2em;color: #585252;">查看详情</b></span></div>';
        goods_tpl += '<p style="    margin-top: 10px;">可供现货:{number}</p>';
        goods_tpl += '<p class="font_24r color_9a" style="margin-bottom: 5px;">供应商信用：{star}</p>';
        // goods_tpl += '<p class="font_24r color_9a" style="margin-bottom: 5px;">供应商信用：<img src="/images/star_1.png" height="12px"><img src="/images/star_1.png" height="12px"><img src="/images/star_1.png" height="12px"><img src="/images/star_1.png" height="12px"><img src="/images/star_1h.png" height="12px"></p>';
        goods_tpl += '<p>';
        goods_tpl += '<span class="">{address}</span>';
        goods_tpl += '</p>';
        goods_tpl += '</dd>';
        goods_tpl += '</dl>';
        goods_tpl += '</a>';
        goods_tpl += '</li>';


		var search_tuiguang_goods_tpl = '<li class="border_top_none">';
        search_tuiguang_goods_tpl += '<a href="{goods_url}">';
        search_tuiguang_goods_tpl += '    <dl class="clearfix hot_goods">';
        search_tuiguang_goods_tpl += '    <dt class="fl"><img src="{litpic}"/></dt>';
        search_tuiguang_goods_tpl += '    <dd class="fl position_relative">';
        search_tuiguang_goods_tpl += ' {store_name_info} ';
        search_tuiguang_goods_tpl += '<div class="goods_prop color_ff7414">{spec_info}</div>';
        search_tuiguang_goods_tpl += '    <div class="sell_information">';
        search_tuiguang_goods_tpl += '    <span class="color_ff7414">￥<b class="font_35r">{price}</b>/{goods_unit}</span>';
//        search_tuiguang_goods_tpl += '    <span class="min_sell-num">库存：{stock}{goods_unit}</span>';
        search_tuiguang_goods_tpl += '</div>';
        search_tuiguang_goods_tpl += '<p>';
        search_tuiguang_goods_tpl += '<span class="">已售{sales}单</span>';
        search_tuiguang_goods_tpl += '    <span class="fr">推广产品</span>';
        search_tuiguang_goods_tpl += '</p>';
        search_tuiguang_goods_tpl += '<span class="color_ff7414 distance_icon font_26r">{distance_val}</span>';
        search_tuiguang_goods_tpl += '</dd>';
        search_tuiguang_goods_tpl += '</dl>';
        search_tuiguang_goods_tpl += '</a>';
        search_tuiguang_goods_tpl += '</li>';

        var store_name_1_tpl = '    <p class="font_3r color_34 overflow_omit-8">{goods_name}</p>';

        var store_name_gt1_tpl = '<div class="store_grade-div">';
        store_name_gt1_tpl += '    <span class="store_grade_con grade-{sgrade}"></span>';
        store_name_gt1_tpl += '    <p class="font_3r color_34 overflow_omit-8">{goods_name}</p>';
        store_name_gt1_tpl += '    </div>';

        var areas_data = new Array();
        var area_data_url = "/api/city";

        var region_province_tpl = '<li region_id="{id}"><span>{name}</span></li>';
        var region_city_tpl = '<li region_id="{id}"><span class="city_name">{name}</span></li>';

        var page = 0;

        var lat = 0;
        var lon = 0;

        $(function() {

            //加载地址数据
            $.getJSON(area_data_url,function(response){
                // console.log(response)
                // eval('response='+response);
                if(response.code == 0){
                    //$("#region_province").empty();
                    areas_data = response.data;
                    for(var i in areas_data){
                        var region = areas_data[i];
                        var tpl = _.template(region_province_tpl);
                        $("#region_province").append(tpl(region));
                    }
                }
            });

            $("#keyword").keyup(function(event){
                if(event.keyCode == 13){
                    page = 0;
                    $('#loading01').trigger('click');
                }
            });

            $('#loading01').click(function () {
                $(this).show();
                $(this).text('加载中......');

                if(page == 0){
                    $("#data_list_div").empty();
                }
                var keyword = $('input[name=keyword]').val();
                var cate_id = $("#cate_id").val();
                var region_id = $("#region_id").val();
                var price = $("#price").val();
                var order = $("#order").val();
                var good_type = $("input[name=good_type]").val();
                lat = parseFloat($("#lat").val());
                lon = parseFloat($("#lon").val());
                page++;

                // var url = SITE_URL + '/index.php?app=search&act=index&ajax&cate_id=' + cate_id + '&region_id=' + region_id + '&price=' + price + '&keyword=' + keyword + '&page=' + page + '&order=' + order + '&lat=' + lat + '&lon=' + lon;
                var url = '/api/supply-all?keyword=' + keyword + '&page=' + page+'&order='+order+'&region_id='+region_id+'&good_type='+good_type;
                $.getJSON(url, function (result) {
                    if (result.tuiguang_goods_list) {
                        //加载推广商品列表
                        var tuiguang_goods_list = result.tuiguang_goods_list;

                        var tpl = _.template(search_tuiguang_goods_tpl);

                        for (var i in tuiguang_goods_list) {
                            var goods = tuiguang_goods_list[i];
                            // var this_lat = parseFloat(goods.lat);
                            // var this_lon = parseFloat(goods.lon);
							//alert(this_lat);alert(this_lon);
							//console.log(this_lat,this_lon);




                            // if (!(this_lat!=0 && this_lon!=0 && lat!=0 && lon!=0)) {
                            //     var distance_val = "";
                            // } else {
                            //     var distance_val = get_great_circle_distance(lat,lon,this_lat,this_lon);
                            //     if(distance_val == 'NaN(km)'){
                            //         distance_val = "";
                            //     }else{
                            //         distance_val= '<span class="iconfont font_26r">&#xe6c0;</span>&nbsp;' + distance_val;
                            //     }
                            // }
                            // goods.distance_val = distance_val;

                            if(goods.sgrade > 1){
                                var store_name_tpl = _.template( store_name_gt1_tpl );
                            }else{
                                var store_name_tpl = _.template( store_name_1_tpl );
                            }

                            var spec_info = "";
                            for(var j  in goods.goods_spec_short){
                                var spec_short = goods.goods_spec_short[j];
                                spec_info += "<span><b>" + spec_short + "</b></span>";
                            }
                            goods.spec_info = spec_info;

                            goods.store_name_info = store_name_tpl(goods);

                            goods.goods_url = goods.url;
                            //goods.formated_expire = "2016.02.21";
                            //console.log(goods);//return false;
                            $('#data_list_tuiguang_div').append(tpl(goods));
                        }
                    }

                    //加载商品列表
                    var goods_list = result.data;
                    if (goods_list.length == 0) {
                        if(page == 1){
                            layer.open({content:"没有相关记录", time:2});
                        }else{
                            layer.open({content:"没有更多了", time:2});
                        }
                        $('#loading01').hide();
                        return true;
                    } else {
                        // var tpl = _.template(search_goods_tpl);
                        var tpl = _.template(goods_tpl);
                        for (var i in goods_list) {
                            var goods = goods_list[i];
                            var this_lat = parseFloat(goods.lat);
                            var this_lon = parseFloat(goods.lon);


                            goods.goods_url = "/supply/view/"+goods.id;
                            goods.kind_name = goods.kinds.name;

                            function formate_time(t){
                                var date = new Date();
                                var now = date.getTime();
                                var tt = t*1000;
                                nstring = '';



                                if( (now-tt)>0 && (now-tt)<60000){
                                    nstring = '刚刚';
                                }
                                if( (now-tt)>=60000 && (now-tt)<60000*60){
                                    nstring = Math.floor((now-tt)/60000)+'分钟前';
                                }

                                if( (now-tt)>=60000*60 && (now-tt)<60000*60*24){
                                    nstring = Math.floor((now-tt)/(60000*60))+'小时前';
                                }

                                if( (now-tt)>=60000*60*24 && (now-tt)<60000*60*24*2){
                                    nstring = '昨天';
                                }
                                if(nstring == ''){
                                    myday = new Date(t*1000);
                                    nstring = myday.getFullYear() +'-'+(myday.getMonth()+1) +'-'+myday.getDate();
                                }
                                return nstring;

                            }

                            goods.formate_time = formate_time(goods.addtime);

                            goods.address = goods.source;
                            var star_html = '';
                            // console.log(goods.storeinfo.xinyong);
                            var floor_num = parseFloat(goods.storeinfo.xinyong);
                            var nn = Math.floor(floor_num);
                            // console.log(nn);
                            var bb = 5-parseInt(nn);
                            // console.log(bb)
                            for(var i=0 ;i<nn ;i++){
                                star_html+= '<img src="/images/star_1.png" height="12px">';
                            }
                            for(var i=0;i<bb;i++){
                                star_html+= '<img src="/images/star_1h.png" height="12px">';
                            }
                            goods.star = star_html;
                            // console.log(star_html);

                            goods.store_name_info = 1;
                            attrspec = '';
                            for(var i=0;i<goods.supply_attrs.length ;i++){
                                attr = goods.supply_attrs[i];
                                attrspec += '<span><b>'+ attr.attrs.attr_name +':'+ attr.attr_value + "</b></span>";
                            }
                            goods.spec_info = attrspec;

                            goods.goods_unit = goods.kinds.unit;
                            goods.stock = goods.number;
                            goods.sales = goods.orders_count;
                            goods.distance_val = '';
                            var items = goods.imgs.split(';');
                            var litpic = items[0];
                            if(!litpic) litpic = '/images/img_default.jpg';
                            goods.litpic = litpic.replace('public/' ,'/storage/');

                            myday = new Date(goods.cutday*1000);


                            goods.formated_expire = myday.getFullYear() +'-'+(myday.getMonth()+1) +'-'+myday.getDate();
                            // if (!(this_lat!=0 && this_lon!=0 && lat!=0 && lon!=0)) {
                            //     var distance_val = "";
                            // } else {
                            //     var distance_val = get_great_circle_distance(lat,lon,this_lat,this_lon);
                            //     if(distance_val == 'NaN(km)'){
                            //         distance_val = "";
                            //     }else{
                            //         distance_val= '<span class="iconfont font_26r">&#xe6c0;</span>&nbsp;' + distance_val;
                            //     }
                            // }
                            // goods.distance_val = distance_val;
                            //
                            if(goods.sgrade > 1){
                                var store_name_tpl = _.template( store_name_gt1_tpl );
                            }else{
                                var store_name_tpl = _.template( store_name_1_tpl );
                            }
                            //
                            // var spec_info = "";
                            // for(var j  in goods.goods_spec_short){
                            //     var spec_short = goods.goods_spec_short[j];
                            //     spec_info += "<span><b>" + spec_short + "</b></span>";
                            // }
                            // goods.spec_info = spec_info;
                            //
                            goods.store_name_info = store_name_tpl(goods);
                            //
                            // goods.goods_url = goods.url;
                            $('#data_list_div').append(tpl(goods));
                        }
                    }
                    $('#loading01').text('加载更多...');
                });
            });
            //定位并加载商品
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(getPositionSuccess, getPositionError, position_option);
            } else {
                // get_tuiguang_goods_list();
                // $("#lat").val("34.15718377");
                // $("#lon").val("113.48680406");
                $("#loading01").trigger('click');
            }

            $(".sort_nav_list").find("li").click(function () {
                var order = $(this).attr('order');
                console.log(order);
                if(! _.isUndefined(order) && order != ''){
                    if(order == 'price asc'){
                        if($(this).hasClass("color_02c5a3")){
                            if($("#order").val() == 'price asc'){
                                $("#order").val('price desc');
                                $(this).find('span').eq(1).html('&#xe6a0;');
                            }else{
                                $("#order").val('price asc');
                                $(this).find('span').eq(1).html(' &#xe6c9;');
                            }
                        }else{
                            $("#order").val('price asc') ;
                            $(this).find('span').eq(1).html(' &#xe6c9;');
                        }
                    }else if(order == 'saled_num asc'){
                        if($(this).hasClass("color_02c5a3")){
                            if($("#order").val() == 'saled_num asc'){
                                $("#order").val('saled_num desc');
                                $(this).find('span').eq(1).html('&#xe6a0;');
                            }else{
                                $("#order").val('saled_num asc');
                                $(this).find('span').eq(1).html(' &#xe6c9;');
                            }
                        }else{
                            $("#order").val('saled_num asc') ;
                            $(this).find('span').eq(1).html(' &#xe6c9;');
                        }
                    }else{
                        $("#order").val(order);
                    }
                    $(".sort_nav_list").find(".color_02c5a3").removeClass("color_02c5a3");
                    $(this).addClass("color_02c5a3");
                    page = 0;
                    $('#loading01').trigger('click');
                }

            });
            $("#region_select").click(function () {
                $("#store_sort_con").hide();
                $("#region_province").show();
            });
            $("ul#region_province").delegate('li','click',function(){
                $("#region_province").hide();
                $("#region_city").show();
                var region_id = $(this).attr('region_id');
                var region_name = $(this).find("span").html();
                $("#region_id").val(region_id);
                $("#region_name").html(region_name);
                //加载城市
                $("#region_city").empty();
                var region_data = _.findWhere(areas_data, {id:region_id});
                var tpl = _.template(region_city_tpl);
                $("#region_city").append(tpl({id:'', name:'全部'}));
                for(var i in region_data.child){
                    var city = region_data.child[i];
                    $("#region_city").append(tpl(city));
                }
            });
            $("ul#region_city").delegate('li','click',function(){
                var region_id = $(this).attr('region_id');
                var region_name = $(this).find("span").html();
                $("#region_city").hide();
                $("#store_sort_con").show();
                if(region_id != ''){
                    $("#region_id").val(region_id);
                    $("#region_name").html(region_name);
                }
                page = 0;
                $('#loading01').trigger('click');
            });

        });

        function getPositionSuccess( position ){
            var local_lat = position.coords.latitude;
            var local_lon = position.coords.longitude;
            $("#lat").val(local_lat);console.log(local_lat);
            $("#lon").val(local_lon);console.log(local_lon);
            $("#loading01").trigger('click');
        }

        function getPositionError(error) {
            switch (error.code) {
                case error.TIMEOUT:
                    //alert("定位失败,请求获取用户位置超时");
                    break;
                case error.PERMISSION_DENIED:
                    //alert("定位失败,用户拒绝请求地理定位");
                    break;
                case error.POSITION_UNAVAILABLE:
                    //alert("定位失败,位置信息是不可用");
                    break;
            }
            $("#lat").val("34.15718377");
            $("#lon").val("113.48680406");
            $("#loading01").trigger('click');
        }
    </script>

</div>
@include('home.common.footer')


</body>
</html>
