<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>用户中心 - 我的预约</title>
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
    <style media="screen">
        .order_nav-list li{
            width: 19.8%;
        }
    </style>

</head>
<body class="bg-f8">
<header class="user_center_header bg-02c5a3">
    <a class="go_back_btn" href="javascript:history.back()">
        <span class="iconfont color_fff">&#xe698;</span>
    </a>
    <h1 class="color_fff">预约看货</h1>
</header>
<div>
    <ul class="order_nav-list bg-fff bd_top_bottom-eee font_3r clearfix">
        <li class="hover_list" class="all">
        <div><a href="/yuyue/others-yuyue?type=all">全部</a></div>
        </li>
        <li  class="wait-comfirm">
        <div><a href="/yuyue/others-yuyue?type=wait-comfirm">待确认</a></div>
        </li>
        <li class="wait-look">
        <div><a href="/yuyue/others-yuyue?type=wait-look">待接待</a></div>
        </li>
        <li class="wait-comment">
        <div><a href="/yuyue/others-yuyue?type=wait-comment">待评价</a></div>
        </li>
		<li class="finish">
        <div><a href="/yuyue/others-yuyue?type=finish">已评价</a></div>
        </li>
    </ul>


    <ul id="order_list">





    </ul>
    <div id="loading01" class='load_more' style="display: none;">
        <a class="a_full text_center margin_top margin_bottom padding_container font_24r color_9a" href="javascript:void(0);">加载更多</a>
    </div>
</div>

<script type="text/javascript">
    $('.{!!$type!!}').siblings().removeClass('hover_list');
    $('.{!!$type!!}').addClass('hover_list');
    function confirm(id){
        var message = $('input[name=message]').val();
        location.href="/yuyue/confirm?id="+id+'&message='+message;
    }



    var order_goods_tpl = '<div class="padding_container goods_details clearfix"><dl class="clearfix fl"> <dt class="fl"><a href="{goods_url}"><img src="/images/7f24bfff2e17405284c673bdb5786431.gif"/></a></dt><dd class="fl"><p class="font_28r color_34">{goods_name}</p><p class="font_24r color_9a">{specification}</p></dd></dl><div class="fr"><p class="font_28r color_34">¥{price}</p><p class="font_24r color_9a"><span class="iconfont font_23r">&#xe689;</span>{quantity}</p></div></div>';

    var order_tpl = '<li class="user_store">';
    order_tpl += '    <div class="goods_status bg-fff padding_flanks">';
    order_tpl += '    <span class="font_28r color_34" onclick="location=\'{store_url}\';">{seller_name}<b class="iconfont fontWeight_4 padding_flanks color_9a">&#xe614;</b></span>';
    order_tpl += '    <span class="font_24r color_ff863a fr">{status_text}</span>';
    order_tpl += '    </div>';
    order_tpl += '    <a href="{order_url}">';
    order_tpl += '{goods_list}';
    order_tpl += '    <div class="goods_total font_28r bg-fff padding_flanks">';
    order_tpl += '    <p>合计¥{order_amount}</p>';
    order_tpl += '</div>';
    order_tpl += '</a>';
    order_tpl += '<div class="padding_flanks bg-fff">';
    order_tpl += '<div class="text_right bd_top-eee order_btn_padding order_ops">{buttons_html}</div>';
    order_tpl += '</div></li>';



    var yuyue_tpl = '';
    yuyue_tpl += '<li class="user_store">';
    yuyue_tpl += '<div class="goods_status bg-fff padding_flanks">';
    yuyue_tpl += '<span class="font_28r color_34">{name}<b class="iconfont fontWeight_4 padding_flanks color_9a">&#xe614;</b></span> ';
    yuyue_tpl += '<span class="font_24r fr" style="color:#ff3a3a;">{status_text}</span>';
    yuyue_tpl += '</div> <a href="{goods_url}"></a>';
    yuyue_tpl += '<div class="padding_container goods_details clearfix">';
    yuyue_tpl += '<a href="{goods_url}"></a>';
    yuyue_tpl += '<dl class="clearfix fl">';
    yuyue_tpl += '<a href="{goods_url}"> </a>';
    yuyue_tpl += '<dt class="fl">';
    yuyue_tpl += '<a href="{goods_url}"></a>';
    yuyue_tpl += '<a href="{goods_url}"><img src="{logo}" style="width:80px;height:80px;"/></a>';
    yuyue_tpl += '</dt>';
    yuyue_tpl += '<dd class="fl">';
    yuyue_tpl += '<p class="font_28r color_34">{goods_name}</p>';
    yuyue_tpl += '<p class="font_24r color_9a">{specification}</p>';
    yuyue_tpl += '</dd>';
    yuyue_tpl += '</dl>';
    yuyue_tpl += '<div class="fr">';
    yuyue_tpl += '<p class="font_28r color_34">';
    yuyue_tpl += '<a href="tel:{store_phone}" class="color_02c5a3 border_none">';
    yuyue_tpl += '<span class="iconfont font_45r"></span>';
    yuyue_tpl += '</a></p></div></div>';
    yuyue_tpl += '<div class="goods_total font_28r bg-fff padding_flanks">';
    yuyue_tpl += '<p>申请看货时间：{start_data} 至  {end_data}</p>';
    yuyue_tpl += '</div>';
    yuyue_tpl += '<div class="padding_flanks bg-fff">';
    yuyue_tpl += '<div class="text_right bd_top-eee order_btn_padding order_ops" style="    padding: 6px 0;">';
    yuyue_tpl += '{buttons_html}';
    yuyue_tpl += '</div></div></li>';
    // yuyue_tpl += '<div class="padding_flanks bg-fff">';
    // yuyue_tpl += '<div class="text_right bd_top-eee order_btn_padding order_ops" style="    padding: 6px 0;">';
    // yuyue_tpl += '<span><img src="/images/star_1.png" height="12px"><img src="/images/star_1.png" height="12px"><img src="/images/star_1.png" height="12px"><img src="/images/star_1.png" height="12px"><img src="/images/star_1h.png" height="12px"></span>';
    // yuyue_tpl += '</div></div></li>';


    $(function(){
        $("div").delegate("a.receive", 'click', function(){
            console.log(1111);
            var amount = $(this).attr('amount');
            var store_name = $(this).attr('store_name');
            var order_id = $(this).attr('order_id');
            var order_sn = $(this).attr('order_sn');
            var content = "确定要确认收货吗？" + '<br/>\n';
            content += "店铺名称：" + amount + '<br/>\n';
            content += "订单编号：" + order_sn + '<br/>\n';
            content += "订单金额：" + store_name;

            layer.open({
                content: content
                ,btn: ['确认', '取消']
                ,yes: function(index){
                    var url="index.php?app=buyer_order&act=confirm_order&order_id="+order_id;
                    layer.close(index);
                    location = url;
                }
            });
        });
        var page = 0;
        $('#loading01').click(function(){
            $(this).show();
            $(this).find('a').text('加载中......');
            page++;
            // var url = '/index.php?app=buyer_order&act=index&type=all_orders&order_sn=&ajax&page='+page;
            var url = '/api/get-yuyue?type={{$type}}&page='+page;
            $.getJSON(url, function(result){
                if(result.data.length==0){
                    var msg = "没有更多了";
                    if(page == 1){
                        msg = "没有符合条件的记录";
                    }
                    layer.open({content:msg, time:2});
                    $('#loading01').hide();
                    return true
                }
                for(var i = 0; i < result.data.length; i++){
                    // goods_url logo goods_name specification price quantity  || store_url seller_name status_text order_url goods_list order_amount buttons_html

                    var item = result.data[i];
                    item.goods_url = '/supply/view/'+item.supplys_id;
                    var imgs = item.supply.imgs.split(';');
                    item.logo = imgs[0].replace('public/','/storage/');

                    item.goods_name = item.supply.goods_name;
                    item.quantity = item.number;
                    item.price = item.supply.price;
                    item.specification ='';
                    for(var j=0;j<item.supply.supply_attrs.length;j++){
                        jtem = item.supply.supply_attrs[j];
                        item.specification += jtem.attrs.attr_name+':'+jtem.attr_value+jtem.attrs.unit;
                    }
                    item.store_url = '/store/view/'+item.member_id;
                    item.seller_name = item.supply.storeinfo.store_name;
                    item.order_url = '/supplyorder//view/'+item.id;
                    item.order_amount = item.total_price;
                    item.store_phone = item.phone;
                    if(item.message == null){
                        item.message = '无';
                    }



                    switch (item.status) {
                        case 0:
                            item.status_text = '对方已申请看货'; //状态
                            break;
                        case 1:
                            item.status_text = '已确认，等待对方看货';
                            break;
                        case 2:
                            item.status_text = '已接待';
                            break;
                        case 3:
                            item.status_text = '已评价';
                            break;
                        case 9:
                            item.status_text = '对方已取消看货预约';
                            break;

                        default:
                        item.status_text = '';

                    }
                    var buttons = '';
                    switch (item.status) {
                        case 0:

                        buttons += '<span style="color:#FF3a3a;    font-size: 2.3rem;">留言回复：<input type="text" name="message"></span>';
                        buttons += '<a class="border_box-02c5a3 font_24r color_02c5a3" href="javascript:void(0);" onclick="confirm('+item.id+')" style="color:#ff3a3a !important;border: 1px solid #ff3a3a;">确认</a>';
                        break;


                        case 9:
                        buttons += '<span style="color:#a0a0a0;    font-size: 2.3rem;">留言：'+item.message+'</span>';
                        buttons += '<a class="border_box-02c5a3 font_24r color_02c5a3" href="/yuyue/delete/'+item.id+'" style="color:#a0a0a0 !important;border: 1px solid #a0a0a0;">删除</a>';
                        break;


                        default:

                        buttons += '<span style="color:#FF3a3a;    font-size: 2.3rem;">留言：'+item.message+'</span>';


                    }

                    item.buttons_html = buttons;



                    // var goods_html = "";
                    // var goods_tpl = _.template(order_goods_tpl);
                    // goods_html = goods_tpl(item);
                    //
                    // item.goods_list = goods_html;


                    var order = _.template(yuyue_tpl);
                    try{
                        $("#order_list").append(order(item));
                    }catch(e){
                        console.log(e);
                    }
                }
                $('#loading01').find('a').text('加载更多');
            });
        });
        $('#loading01').trigger('click');


    });
</script>
@include('home.common.footer')
</body>
</html>
