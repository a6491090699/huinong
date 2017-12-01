<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>确认购物清单 - 中国花木在线交易专业平台</title>
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
    <script type="text/javascript" src="/js/index_1.js" ></script>
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
<script type="text/javascript" src="/js/cart.js"></script>
<body class="bg-f8">
<header class="user_center_header bd_bottom-ddd">
  <a class="go_back_btn" href="javascript:history.go(-1)">
    <span class="iconfont">&#xe698;</span>
  </a>
  <h1>购物车</h1>
</header>
<form action="/wx/buy" id="cart_form" method="post">
    {{csrf_field()}}
    <input type="hidden" name="id" value="{{$item->id}}">
      <div class="bg-fff bd_bottom-eee margin_bottom_16 " id="cart_store_7239">
    <div class="padding_flanks position_relative">
      <a class="input_radio a_full padding_top_bottom input_radio_select">
        <input type="radio" class="input-select" name="store_to_checkout" value="7239" checked/>
        <span class="font_3r">
                    <span class="padding_flanks">{{$item->storeinfo->store_name}}</span>
                    <b class="iconfont fontWeight_4">&#xe614;</b>
                </span>
      </a>
      <span class="font_26r color_67 cart_goods_btn cart_goods_btn-1">编辑</span>
      <span class="font_26r color_67 cart_goods_btn cart_goods_btn-2" onClick="changeNum()" style="display: none">完成</span>
    </div>
    <script type="text/javascript">
        function changeNum()
        {

            var num = $('input[name=buy_num]').val();
            $('#buy_num').html(num);
            var price = $('input[name=price]').val();
            var amount = formatCurrency(num*price);


            $('#cart_amount').html('¥'+amount);
        }
        function formatCurrency(num) {
            num = num.toString().replace(/\$|\,/g,'');
            if(isNaN(num))
            num = "0";
            sign = (num == (num = Math.abs(num)));
            num = Math.floor(num*100+0.50000000001);
            cents = num%100;
            num = Math.floor(num/100).toString();
            if(cents<10)
            cents = "0" + cents;
            for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
            num = num.substring(0,num.length-(4*i+3))+','+
            num.substring(num.length-(4*i+3));
            return (((sign)?'':'-') + num + '.' + cents);
        }

    </script>
          <div class="padding_container cart_goods_details clearfix bg-f8 margin_bottom">
        <!--
      <a class="input_checkbox fl padding_top_bottom">
        <input type="checkbox" class="input-select"/>
      </a>
      -->
      <dl class="clearfix fr">
          <dt class="fl"><a href="/supply/view/{{$item->id}}"><img src="{{ getPic( explode(';',$item->imgs)[0] ) }}" style="width:79px;height:79px;object-fit:cover;"/></a></dt>
        <dd class="fl compile_no" style="display: block">
          <p class="font_28r color_34">{{$item->goods_name}}</p>
          <p class="font_24r color_9a">
              @foreach($item->supplyAttrs as $val)
              {{$val->attrs->attr_name}} {{$val->attr_value}}{{$val->attrs->unit}}
              @endforeach

          </p>
          <div>
            <span class="color_ff7414">¥<b class="font_3r fontWeight_4">{{$item->price}}</b></span>
            <input type="hidden" name="price" value="{{$item->price}}">
            <span class="fr font_24r color_9a"><span class="iconfont font_23r">&#xe689;</span>&nbsp;<span id="buy_num">{{$item->minimum}}</span></span>
          </div>
        </dd>
        <dd class="compile_yes fl position_relative text_right" style="display:none">
                    <span class="cart_goods_num">
                        <button type="button" class="rect_circle" onClick="decrease_quantity(89501)">
                            <i class="iconfont">&#xe611;</i>
                        </button>
                        <button class="rect_circle flow_merch_num" type="button">
                            <input type="text" id="input_item_89501" name="buy_num" value="{{$item->minimum}}" >
                        </button>
                        <button type="button" class="rect_circle" onClick="add_quantity(89501);">
                            <i class="iconfont">&#xe612;</i>
                        </button>
                    </span>
          <!-- <button class="font_26r delete_cart_goods-btn" onclick="drop_cart_item(7239, 89501);return false;">删除</button> -->
        </dd>
      </dl>
    </div>
        </div>


  <div class="cart_goods-none" style="display:none;">
    <span class="iconfont">&#xe6c3;</span>
    <p class="font_27r color_9a">购物车空空如也!</p>
    <p class="font_28r color_67"><a class="color_02c5a3">点击此处</a>去选购商品吧!</p>
  </div>
</form>

<footer class="foot_border-top pay_btn" id="pay_btn_7239" >
  <div class="strength_show_img padding_flanks text_right bg-f8">
    <a href="#">
      <span class="font_3r">合计：<span class="color_ff7414" id="cart_amount"></span></span>
    </a>
  </div>
  <div class="add_img_complete"><a href="javascript:void(0)" onclick="$('#cart_form').submit()" class="font_3r">结算</a></div>
</footer>
<script type="text/javascript">
    var mini = $('input[name=buy_num]').val();
    var price = $('input[name=price]').val();
    var first = formatCurrency(mini*price)

    $('#cart_amount').html('¥'+first);
</script>

</body>
</html>
