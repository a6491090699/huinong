<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>【{{$item->kinds->name}}】{{$item->goods_name}}价格_图片_行情_报价 - 竞苗平台</title>
<meta name="keywords" content="速生红叶李,红叶李价格,高度200厘米地径0.8厘米红叶李价格,河南红叶李价格,许昌红叶李价格,速生红叶李图片" />
<meta name="description" content="竞苗平台景轩的官方店铺为您提供最新红叶李报价、图片、价格等信息，高度200厘米地径0.8厘米红叶李价格1.00元/棵，价格更新时间：2014-11-07，所在地是河南许昌，花木在线交易，就上竞苗平台！" />
    <link rel="stylesheet"  href="/css/mobile-select-area.css">
    <!--<link rel="stylesheet" href="/css/larea.css">-->
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="stylesheet" href="/css/style_2.css"/>
    <link rel="stylesheet" href="/css/index.css"/>
    <!--<link rel="stylesheet" href="/css/sm.min.css">-->
    <!--<script type='text/javascript' src='/js/zepto.min.js' charset='utf-8'></script>-->
    <!--<script type='text/javascript' src='/js/sm.min.js' charset='utf-8'></script>-->
    <script src="/js/jquery-1.11.2.js" type="text/javascript"></script>
    <script src="/js/layer.js"></script>
    <script type="text/javascript" src="/js/index.js"></script>
    <script src="/js/mlselection.js"></script>
    <script src="/js/huamu.js?{{time()}}" type="text/javascript"></script>
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
<body class="bg-f8 padding_bottom-body">
<script type="text/javascript" src="/js/goodsinfo.new.js" charset="utf-8"></script>
<header class="user_center_header" id="header_bg">
	<a class="go_back_btn icon_container" href="javascript:history.go(-1)">
		<span class="iconfont font_3r">&#xe6c4;</span>
	</a>
	<h1>商品详情</h1>

</header>
<div class="sell_index-main">
	<div class="img_carousel">
		<div class="slipping-area">
			<div class="slipping-imgbox">
                <!-- 轮播图 -->
                @forelse(explode(';',trim($item->imgs,';')) as $val)
                <img src="{{getPic($val)}}" style="object-fit:cover;width:100%;height:100%"/>
                @empty
				<img src="/images/201411071500507139.jpg"/>
				<img src="/images/201411071501079398.jpg"/>
                @endforelse
			</div>
		</div>
	</div>
</div>



<form action="" name="ECS_FORMBUY">
	<div>
        <div class="padding_container bg-fff bd_bottom-eee">
			<p class="font_3r color_34">
				【{{$item->kinds->name}}】{{$item->goods_name}}
                <span class="fr color_ff363e font_28r relative_top-2 iconfont" id="goods_collected_span" onclick="cancel_collect_goods({{$item->id}})" @if(!$is_collect) style="display:none" @endif>&#xe6d0;</span>
				<span class="fr color_9a iconfont" onclick="collect_goods({{$item->id}});" id="goods_not_collected_span" @if($is_collect) style="display:none" @endif>&#xe641;</span>
			</p>
			<div class="sell_information font_24r padding_top_bottom">
				参考价：<span class="color_ff7414">¥<b class="font_35r">{{$item->price}}</b>/{{$item->kinds->unit}}</span>
				<span class="min_sell-num  position_bottom-right">库存：{{$item->number}}</span>
			</div>
			<p class="font_22r color_9a" style="text-align: center;">
				<span class="">现货 {{$item->number}} 棵</span>
				<span class="fr">{{$item->yuyue_count}}人预约</span>
				<span class="fl">{{$item->source}}</span>
				<!-- <span class="fl">河南 许昌</span> -->
			</p>
		</div>

        <div class="padding_container bg-fff user_store clearfix bd_top_bottom-eee">
			<dl class="fl clearfix goods_details_store">
				<dt class="fl">
					<img src="{{str_replace('public/' ,'/storage/',$item->storeinfo->logo)}}"/>
				</dt>
				<dd class="fl color_34 padding_flanks">
					<p class="font_3r">{{$item->storeinfo->store_name}}</p>


					<div>
						<p class="font_24r color_9a" style="margin-bottom: 5px;">信用值：<img src="/images/star_1.png" height="12px"><img src="/images/star_1.png" height="12px"><img src="/images/star_1.png" height="12px"><img src="/images/star_1.png" height="12px"><img src="/images/star_1h.png" height="12px"></p>
					</div>
					<p class="font_24r color_9a ">主营：{{$item->storeinfo->store_sale}}</p>
					<a href="/store/view/{{$item->member_id}}" class="enter_store_btn font_28r color_02c5a3" style="margin: 0;">进店</a>
				</dd>
			</dl>
		</div>


        <div class="bg-fff bd_top_bottom-eee goods_norms_box user_store">
			<p class="color_34 font_3r padding_flanks">规格</p>

			<div class="goods_norms_container clearfix font_26r">
                @foreach($item->supplyAttrs as $val)
                <span>{{$val->attrs->attr_name}}({{$val->attrs->unit}})</span>
                @endforeach

								<!-- <span>高度(厘米)</span>
												<span>地径(厘米)</span> -->
																			</div>
			<div class="goods_norms_container clearfix font_26r">
                @foreach($item->supplyAttrs as $val)
                <span>{{$val->attr_value}}</span>
                @endforeach
								<!-- <span>200</span>
												<span>0.8</span> -->

			</div>
		</div>

		<ul class="clearfix goods_details_select-list bg-fff user_store bd_top-eee">
			<li class="hover_li">图文详情</li>
			<li>商品评价</li>
			<li>商品推荐</li>
		</ul>
		<div class="user_store font_22r" style="display: block" id="hover_li-0">

            @forelse(explode(';',$item->imgs) as $val)
            <p>
                <img class="goods_desc_img" src="{{getPic($val)}}" style="float:none;" title=""/>
            </p>
            @empty
            <p>无图片</p>
            @endforelse












                    </div>
		<ul class="goods_evaluate-list bg-fff padding_flanks bd_bottom-eee margin_bottom" id="hover_li-1" style="display: none">
						<li class="padding_top_bottom">
				<div class="margin_bottom evaluate_con">
					<div class="evaluate_people">
						<img src="/images/my_head_03.jpg"/>
						<span class="font_24r">钻**杨</span>
					</div>
					<span class="font_24r color_9a text_right">2016.01.16</span>
				</div>
				<p class="font_24r"></p>
				<a class="a_full text_right">
					<span class="iconfont  color_ffd016">&#xe65a;</span>					<span class="iconfont  color_ffd016">&#xe65a;</span>					<span class="iconfont  color_ffd016">&#xe65a;</span>				</a>
			</li>
						<li class="padding_top_bottom">
				<div class="margin_bottom evaluate_con">
					<div class="evaluate_people">
						<img src="/images/my_head_03.jpg"/>
						<span class="font_24r">虹*</span>
					</div>
					<span class="font_24r color_9a text_right">2015.08.25</span>
				</div>
				<p class="font_24r"></p>
				<a class="a_full text_right">
					<span class="iconfont  color_ffd016">&#xe65a;</span>					<span class="iconfont  color_ffd016">&#xe65a;</span>					<span class="iconfont  color_ffd016">&#xe65a;</span>				</a>
			</li>
						<li class="padding_top_bottom">
				<div class="margin_bottom evaluate_con">
					<div class="evaluate_people">
						<img src="/images/my_head_03.jpg"/>
						<span class="font_24r">王**地</span>
					</div>
					<span class="font_24r color_9a text_right">2015.06.15</span>
				</div>
				<p class="font_24r"></p>
				<a class="a_full text_right">
					<span class="iconfont  color_ffd016">&#xe65a;</span>					<span class="iconfont  color_ffd016">&#xe65a;</span>					<span class="iconfont  color_ffd016">&#xe65a;</span>				</a>
			</li>
						<li class="padding_top_bottom">
				<div class="margin_bottom evaluate_con">
					<div class="evaluate_people">
						<img src="/images/my_head_03.jpg"/>
						<span class="font_24r">跪**苗</span>
					</div>
					<span class="font_24r color_9a text_right"></span>
				</div>
				<p class="font_24r"></p>
				<a class="a_full text_right">
																			</a>
			</li>






					</ul>

                    <!-- 商品推荐 -->
		<ul class="supply_information-list" id="hover_li-2" style="display: none">
            @forelse($tuijian as $val)
            <li>
                <a href="./goods/1_14_19738_4022.html">
                    <dl class="clearfix">
                        <dt class="fl"><img src="/images/201411071500507139.jpg"/></dt>
                        <dd class="fl">
                            <p class="font_3r color_34">{{$val->goods_name}}</p>
                            <div class="sell_information">
                                <span class="color_ff7414">¥<b class="font_35r">{{$val->price}}</b>/{{$val->kinds->unit}}</span>
                                <span class="sell_distance" data-lat="" data-lon="114.1885"></span>
                            </div>
                            <p>
                                <span class="min_sell-num">库存：{{$val->number}}</span>
                                <span class="fr">已售{{$val->saled_num}}件</span>
                            </p>
                        </dd>
                    </dl>
                </a>
            </li>
            @empty

            @endforelse

					</ul>
	</div>


</form>
<footer class="">

	<div class="bg-02c5a3 col-xs-4">
		<a  href="tel:{{$item->storeinfo->phone}}" class="font_3r color_fff">
			<span class="iconfont font_35r icon_relative-top-2">&#xe67d;</span>
			联系卖家
		</a>
	</div>

	<div class="col-xs-4 color_67 foot_left_enshrine" style="background-color:#ea8a1c">
		<div class="border_none">
			<a href="/wx/cart/{{$item->id}}"  class="font_3r color_fff">下单</a>
		</div>
	</div>

	<div class="col-xs-4" style="    background-color: #fe3a00;">
		<a href="#" class="yuyuekanmiao" style="color:#fff;font-size: 3rem !important;">预约看苗</a>
	</div>

	<input type="hidden" id="cart_items_count" value="2" />
</footer>
<script type="text/javascript" src="/js/slip.js"></script>

<script>
	$(function(){
        slip.iniT('.slipping-area',2000);
		$(".slipping-area").find("img").height($(".slipping-area").find("img").width());
        //数量加减
        $(".num_add").click(function(){
            var currQty = parseInt($('#quantity').val());
            var spec = goodsspec.getSpec();
            var maxStock = parseInt(spec.stock);
            if(currQty < maxStock){
                currQty = currQty + 1;
                $('#quantity').val(currQty);
            }
        });
        $(".num_reduce").click(function(){
            var currQty = parseInt($('#quantity').val());
            var spec = goodsspec.getSpec();
            var minimum = parseInt(spec.minimum);
            if(currQty > 1 && currQty > minimum){
                currQty = currQty - 1;
                $('#quantity').val(currQty);
            }
        });

        // navigator.geolocation.getCurrentPosition(getPositionSuccess, getPositionError, position_option);

        function getPositionSuccess( position ){
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;

            //alert( "您所在的位置： 纬度" + lat + "，经度" + lon );
            //根据地理位置谋算和基地的距离并对baseaddress_list_json重新排序
            //$(".distance").html(lat+'-'+lon+'-'+$(this).attr('data-lat')+'-'+$(this).attr('data-lon'));
            $(".sell_distance").each(function(){
                var this_lat=$(this).attr('data-lat');
                var this_lon=$(this).attr('data-lon');
                var distance_val=get_great_circle_distance(lat,lon,this_lat,this_lon);
                //$(this).html(lat+'-'+lon+'-'+this_lat+'-'+this_lon);
                $(this).html(distance_val);
            });
        }
        function getPositionError(error) {
            switch (error.code) {
                case error.TIMEOUT:
                    break;
                case error.PERMISSION_DENIED:
                    break;
                case error.POSITION_UNAVAILABLE:
                    break;
            }
        }
	});



	/* buy */
    function buy()
    {
        if (goodsspec.getSpec() == null)
        {
            layer.open({content:lang.input_quantity, time:2});
            return;
        }
        var spec_id = goodsspec.getSpec().id;

        var quantity = $("#quantity").val();
        if (quantity == '')
        {
            layer.open({content:lang.input_quantity, time:2});
            return;
        }
        if (parseInt(quantity) < 1)
        {
            layer.open({content:lang.invalid_quantity, time:2});
            return;
        }
        add_to_cart(spec_id, quantity);
    }

	/* add cart */
    function add_to_cart(spec_id, quantity)
    {
        var url = get_location_root() + '/index.php?app=cart&act=add'; //SITE_URL
        $.getJSON(url, {'spec_id':spec_id, 'quantity':quantity}, function(data){
            if (data.done)
            {
                $('.goods_car').text(data.retval.cart.kinds);
                $('.bold_mly').html(price_format(data.retval.cart.amount));
                $('.ware_cen').slideDown('slow');
                var cart_items_count=parseInt($("#cart_items_count").val());
                cart_items_count++;
                $(".goods_car").html(cart_items_count);
                layer.open({content:'添加到购物车成功', time:2});
                setTimeout(slideUp_fn, 5000);
            }
            else
            {
                layer.open({content:data.msg, time:2});
            }
        });
    }
	/* buy now */
    function buy_now(){
        if (goodsspec.getSpec() == null)
        {
            layer.open({content:lang.select_specs, time:2});
            return;
        }
        var spec_id = goodsspec.getSpec().id;

        var quantity = $("#quantity").val();
        if (quantity == '')
        {
            layer.open({content:lang.input_quantity, time:2});
            return;
        }
        if (parseInt(quantity) < 1)
        {
            layer.open({content:lang.invalid_quantity, time:2});
            return;
        }

        var url = get_location_root() + '/index.php?app=cart&act=add';
        $.getJSON(url, {'spec_id':spec_id, 'quantity':quantity}, function(data){
            if (data.done)
            {
                $('.bold_num').text(data.retval.cart.kinds);
                $('.bold_mly').html(price_format(data.retval.cart.amount));
                location.href=SITE_URL+'/index.php?app=cart';
            }else if(data.msg=="该商品已经在购物车中了"){
                location.href=SITE_URL+'/index.php?app=cart';
            }
            else
            {
                layer.open({content:data.msg, time:2});
            }
        });
    }

    function store_calls_plus(store_id, phone){
        var url = "/index.php?app=store&act=update_store_calls&store_id=" + store_id;
        $.get(url,function(result){

		});

        location = "tel:" + phone;
	}

    var specs = new Array();
        specs.push(new spec(6766, '200', '0.8', '','','', '', '', 1.00, '97500', '9.75万', '2500'));
        var specQty = 0;
    var specAttrQty = 2;
    var defSpec = 6766;
    var goodsspec = new goodsspec(specs, specAttrQty, specQty, defSpec);
//	图片超出隐藏
	var dt=$(".goods_details_store dt");
	dt.height(dt.width());
	$(window).resize(function() {
		dt.height(dt.width());
	});
</script>









<div class="cd-user-modal">
		<div class="cd-user-modal-container">


			<div id="cd-login"> <!-- 登录表单 -->
				<form class="cd-form" action="/yuyue/create" method="post">
                    {{csrf_field()}}

                    <input type="hidden" name="good_id" value="{{$item->id}}">

					<p class="fieldset">
						<label class="image-replace" for="signin-username">姓名</label>
						<input class="full-width has-padding has-border"  type="text" name="yuyue_name" placeholder="">
					</p>

					<p class="fieldset">
						<label class="image-replace" for="signin-password">电话</label>
						<input class="full-width has-padding has-border"  type="text" name="yuyue_phone"  placeholder="">
					</p>
					<p class="fieldset">
						<p>请选择可看货时间段：</p>
						<input class="full-width has-padding has-border"  type="date" name="start_data"  placeholder="" style="padding: 5% 0px 12px 0%;width: 48%;">
						<input class="full-width has-padding has-border"  type="date" name="end_data" placeholder="" style="padding: 5% 0px 12px 0%;width: 48%;">
						<p style="font-size: 0.6rem;color: red;">供应商会根据您提交的时间段选具体时间。</p>
					</p>



					<p class="fieldset" >
						<input class="full-width2" type="submit" value="预　约" style="    background: #02c5a3;">
					</p>
				</form>
			</div>



			<a href="#0" class="cd-close-form">关闭</a>
		</div>
	</div>


<script type="text/javascript">
	jQuery(document).ready(function($){
	var $form_modal = $('.cd-user-modal'),
		$form_login = $form_modal.find('#cd-login'),
		$form_signup = $form_modal.find('#cd-signup'),
		$form_modal_tab = $('.cd-switcher'),
		$tab_login = $form_modal_tab.children('li').eq(0).children('a'),
		$tab_signup = $form_modal_tab.children('li').eq(1).children('a'),
		$main_nav = $('.main_nav');
		$yuyuekanmiao = $('.yuyuekanmiao');

	//弹出窗口
	$yuyuekanmiao.on('click', function(event){

		if( $(event.target).is($main_nav) ) {
			// on mobile open the submenu
			$(this).children('ul').toggleClass('is-visible');
		} else {
			// on mobile close submenu
			$main_nav.children('ul').removeClass('is-visible');
			//show modal layer
			$form_modal.addClass('is-visible');
			//show the selected form
			( $(event.target).is('.cd-signup') ) ? signup_selected() : login_selected();
		}

	});

	//关闭弹出窗口
	$('.cd-user-modal').on('click', function(event){
		if( $(event.target).is($form_modal) || $(event.target).is('.cd-close-form') ) {
			$form_modal.removeClass('is-visible');
		}
	});
	//使用Esc键关闭弹出窗口
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$form_modal.removeClass('is-visible');
	    }
    });



	function login_selected(){
		$form_login.addClass('is-selected');
		$form_signup.removeClass('is-selected');
		$tab_login.addClass('selected');
		$tab_signup.removeClass('selected');
	}

	function signup_selected(){
		$form_login.removeClass('is-selected');
		$form_signup.addClass('is-selected');
		$tab_login.removeClass('selected');
		$tab_signup.addClass('selected');
	}

});
</script>











</body>
</html>
