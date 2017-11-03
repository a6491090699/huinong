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
                <li class="text_left " order="distance asc" >
                    <span>距离</span><span class="iconfont font_35r">&#xe6a0;</span>
                    <!--  向上箭头  <span class="iconfont font_35r">&#xe6c9;</span>-->
                </li>
                <li class="" order="gst.sales desc">
                    <span>销量</span><span class="iconfont font_35r">&#xe6a0;</span>
                    <!--  向上箭头  <span class="iconfont font_35r">&#xe6c9;</span>-->
                </li>
                <li class="" order="g.price">
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

				<li class="border_top_none">
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
				</li>




			</ul>

			<p class="text_center margin_top margin_bottom padding_container font_24r color_9a" id="loading01" style="display: none;">加载更多...</p>
        </div>


    </div>
    <script type="text/javascript">

        var search_goods_tpl = '<li class="border_top_none">';
        search_goods_tpl += '<a href="{goods_url}">';
        search_goods_tpl += '    <dl class="clearfix hot_goods">';
        search_goods_tpl += '    <dt class="fl"><img src="/images/746f74e019a64e24929f8975fa9a7d4c.gif"/></dt>';
        search_goods_tpl += '    <dd class="fl position_relative">';
        search_goods_tpl += ' {store_name_info} ';
        search_goods_tpl += '<div class="goods_prop color_ff7414">{spec_info}</div>';
        search_goods_tpl += '    <div class="sell_information">';
        search_goods_tpl += '    <span class="color_ff7414">¥<b class="font_35r">{price}</b>/{goods_unit}</span>';
//        search_goods_tpl += '    <span class="min_sell-num">库存：{stock}{goods_unit}</span>';
        search_goods_tpl += '</div>';
        search_goods_tpl += '<p>';
        search_goods_tpl += '<span class="">已售{sales}件</span>';
        search_goods_tpl += '    <span class="fr">截止日期:{formated_expire}</span>';
        search_goods_tpl += '</p>';
        search_goods_tpl += '<span class="color_ff7414 distance_icon font_26r">{distance_val}</span>';
        search_goods_tpl += '</dd>';
        search_goods_tpl += '</dl>';
        search_goods_tpl += '</a>';
        search_goods_tpl += '</li>';

		var search_tuiguang_goods_tpl = '<li class="border_top_none">';
        search_tuiguang_goods_tpl += '<a href="{goods_url}">';
        search_tuiguang_goods_tpl += '    <dl class="clearfix hot_goods">';
        search_tuiguang_goods_tpl += '    <dt class="fl"><img src="/images/746f74e019a64e24929f8975fa9a7d4c.gif"/></dt>';
        search_tuiguang_goods_tpl += '    <dd class="fl position_relative">';
        search_tuiguang_goods_tpl += ' {store_name_info} ';
        search_tuiguang_goods_tpl += '<div class="goods_prop color_ff7414">{spec_info}</div>';
        search_tuiguang_goods_tpl += '    <div class="sell_information">';
        search_tuiguang_goods_tpl += '    <span class="color_ff7414">￥<b class="font_35r">{price}</b>/{goods_unit}</span>';
//        search_tuiguang_goods_tpl += '    <span class="min_sell-num">库存：{stock}{goods_unit}</span>';
        search_tuiguang_goods_tpl += '</div>';
        search_tuiguang_goods_tpl += '<p>';
        search_tuiguang_goods_tpl += '<span class="">已售{sales}件</span>';
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
                lat = parseFloat($("#lat").val());
                lon = parseFloat($("#lon").val());
                page++;
                // var url = SITE_URL + '/index.php?app=search&act=index&ajax&cate_id=' + cate_id + '&region_id=' + region_id + '&price=' + price + '&keyword=' + keyword + '&page=' + page + '&order=' + order + '&lat=' + lat + '&lon=' + lon;
                var url = '/api/supply-all?keyword=' + keyword + '&page=' + page+'&order='+order ;
                $.getJSON(url, function (result) {
                    if (result.tuiguang_goods_list) {
                        //加载推广商品列表
                        var tuiguang_goods_list = result.tuiguang_goods_list;

                        var tpl = _.template(search_tuiguang_goods_tpl);

                        for (var i in tuiguang_goods_list) {
                            var goods = tuiguang_goods_list[i];
                            var this_lat = parseFloat(goods.lat);
                            var this_lon = parseFloat(goods.lon);
							//alert(this_lat);alert(this_lon);
							//console.log(this_lat,this_lon);
                            if (!(this_lat!=0 && this_lon!=0 && lat!=0 && lon!=0)) {
                                var distance_val = "";
                            } else {
                                var distance_val = get_great_circle_distance(lat,lon,this_lat,this_lon);
                                if(distance_val == 'NaN(km)'){
                                    distance_val = "";
                                }else{
                                    distance_val= '<span class="iconfont font_26r">&#xe6c0;</span>&nbsp;' + distance_val;
                                }
                            }
                            goods.distance_val = distance_val;

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
                    var goods_list = result.goods_list;
                    if (goods_list.length == 0) {
                        if(page == 1){
                            layer.open({content:"没有相关记录", time:2});
                        }else{
                            layer.open({content:"没有更多了", time:2});
                        }
                        $('#loading01').hide();
                        return true;
                    } else {
                        var tpl = _.template(search_goods_tpl);
                        for (var i in goods_list) {
                            var goods = goods_list[i];
                            var this_lat = parseFloat(goods.lat);
                            var this_lon = parseFloat(goods.lon);
                            if (!(this_lat!=0 && this_lon!=0 && lat!=0 && lon!=0)) {
                                var distance_val = "";
                            } else {
                                var distance_val = get_great_circle_distance(lat,lon,this_lat,this_lon);
                                if(distance_val == 'NaN(km)'){
                                    distance_val = "";
                                }else{
                                    distance_val= '<span class="iconfont font_26r">&#xe6c0;</span>&nbsp;' + distance_val;
                                }
                            }
                            goods.distance_val = distance_val;

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
                //get_tuiguang_goods_list();
                $("#lat").val("34.15718377");
                $("#lon").val("113.48680406");
                $("#loading01").trigger('click');
            }

            $(".sort_nav_list").find("li").click(function () {
                var order = $(this).attr('order');
                if(! _.isUndefined(order) && order != ''){
                    if(order == 'g.price'){
                        if($(this).hasClass("color_02c5a3")){
                            if($("#order").val() == 'g.price asc'){
                                $("#order").val('g.price desc');
                                $(this).find('span').eq(1).html('&#xe6a0;');
                            }else{
                                $("#order").val('g.price asc');
                                $(this).find('span').eq(1).html(' &#xe6c9;');
                            }
                        }else{
                            $("#order").val('g.price asc') ;
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

<footer class="foot_border-top" style="background-color: #00ad8b;">
    <div class="foot_member foot_member_hover">
        <a href="#">
            <p><img src="/images/dh_01.png" width="50%"></p>
        </a>
    </div>
    <div class="foot_member ">
        <a href="#">
            <p><img src="/images/dh_02.png" width="50%"></p>
        </a>
    </div>
    <div class="foot_member ">
        <!--<a href="url app=discover">-->
            <!--<span class="iconfont" style="font-weight:900">&#xe694;</span>-->
            <!--<p>发现</p>-->
        <!--</a>-->
        <a class="goods_car-header" href="#">

            <p><img src="/images/dh_03.png" width="50%"></p>
        </a>
    </div>
    <div class="foot_member ">
        <a href="#">
            <p><img src="/images/dh_04.png" width="50%"></p>
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
