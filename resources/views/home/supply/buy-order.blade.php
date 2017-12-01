<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>全部订单 - 我的订单</title>
<meta name="keywords" content="中国花木网,花木网,花木,中国苗木网,花木交易,花木求购,花木资讯,花木论坛,花木销售,绿化苗木" />
<meta name="description" content="中国花木网，中国苗木网，中国花木在线交易专业平台，致力于为花木行业从业者提供更真实的花木在线交易平台，让您没有买不到的，没有卖不掉的。" />
<meta name="_token" content="{{csrf_token()}}">

    <link rel="stylesheet"  href="/css/mobile-select-area.css">
    <!--<link rel="stylesheet" href="/css/larea.css">-->
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="stylesheet" href="/css/index.css?{{time()}}"/>
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
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
        }
    });
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
<header class="user_center_header bg-02c5a3">
    <a class="go_back_btn" href="/index.php?app=member">
        <span class="iconfont color_fff">&#xe698;</span>
    </a>
    <h1 class="color_fff">销售订单</h1>
</header>
<div>
    <ul class="order_nav-list bg-fff bd_top_bottom-eee font_3r clearfix">
        <li class="hover_list all_orders">
        <div><a href="/buyorder/index?type=all_orders">全部</a></div>
        </li>
        <li class="confirm">
        <div><a href="/buyorder/index?type=confirm">待确认</a></div>
        </li>
        <li class="pending">
        <div><a href="/buyorder/index?type=pending">待付款</a></div>
        </li>
        <li class="accepted">
        <div><a href="/buyorder/index?type=accepted">待发货</a></div>
        </li>
        <li class="shipped">
        <div><a href="/buyorder/index?type=shipped">待收货</a></div>
        </li>
        <li class="finished">
        <div><a href="/buyorder/index?type=finished">待评价</a></div>
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
    function order_pay(id)
    {
        location.href="/buyorder/pay/"+id;
        // if(confirm("确定取消该订单?")){
        //     $.ajax({
        //         url:'/buyorder/cancel',
        //         type:'post',
        //         data:{id:id},
        //         success:function(d){
        //
        //             layer.open({content:d.msg, time:2});
        //
        //             setTimeout(function(){
        //                 window.location.reload();
        //             },1000);
        //
        //         }
        //     })
        // }
    }
    function order_received(id)
    {
        if(confirm("确认已收货?")){
            $.ajax({
                url:'/buyorder/received',
                type:'post',
                data:{id:id},
                success:function(d){

                    layer.open({content:d.msg, time:2});

                    setTimeout(function(){
                        window.location.reload();
                    },1000);

                }
            })
        }
    }
    function order_comment(id)
    {
        location.href="/buyorder/comment/"+id;
        // if(confirm("确定发货?")){
        //     $.ajax({
        //         url:'/supplyorder/sended',
        //         type:'post',
        //         data:{id:id},
        //         success:function(d){
        //
        //             layer.open({content:d.msg, time:2});
        //
        //             setTimeout(function(){
        //                 window.location.reload();
        //             },1000);
        //
        //         }
        //     })
        // }
    }
    function order_del(id)
    {
        if(confirm("确定删除?")){
            $.ajax({
                url:'/buyorder/del',
                type:'post',
                data:{id:id},
                success:function(d){

                    layer.open({content:d.msg, time:2});

                    setTimeout(function(){
                        window.location.reload();
                    },1000);

                }
            })
        }
    }


    var order_goods_tpl = '<div class="padding_container goods_details clearfix"><dl class="clearfix fl"> <dt class="fl"><a href="{goods_url}"><img src="{logo}" style="width:80px;height:80px;object-fit:cover"/></a></dt><dd class="fl"><p class="font_28r color_34">{goods_name}</p><p class="font_24r color_9a">{specification}</p></dd></dl><div class="fr"><p class="font_28r color_34">¥{price}</p><p class="font_24r color_9a"><span class="iconfont font_23r">&#xe689;</span>{quantity}</p></div></div>';
    // var order_goods_tpl = '<div class="padding_container goods_details clearfix"><dl class="clearfix fl"> <dt class="fl"><a href="{goods_url}"><img src="/images/7f24bfff2e17405284c673bdb5786431.gif"/></a></dt><dd class="fl"><p class="font_28r color_34">{goods_name}</p><p class="font_24r color_9a">{specification}</p></dd></dl><div class="fr"><p class="font_28r color_34">¥{price}</p><p class="font_24r color_9a"><span class="iconfont font_23r">&#xe689;</span>{quantity}</p></div></div>';

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
            var url = '/api/get-supply-order?type={!!$type!!}&page='+page;
            // var url = '/index.php?app=buyer_order&act=index&type=all_orders&order_sn=&ajax&page='+page;
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

                // goods_url logo goods_name specification price quantity  || store_url seller_name status_text order_url goods_list order_amount buttons_html

                for(var i = 0; i < result.data.length; i++){
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
                    item.seller_name = item.storeinfo.store_name;
                    item.order_url = '/buyorder/view/'+item.id;
                    item.order_amount = item.total_price;


                    switch (item.status) {
                        case 0:
                            item.status_text = '待确认';
                            break;
                        case 1:
                            item.status_text = '已确认,待付款';
                            break;
                        case 2:
                            item.status_text = '已付款,待发货';
                            break;
                        case 3:
                            item.status_text = '已发货,待收货';
                            break;
                        case 4:
                            item.status_text = '已收货,待评价';
                            break;
                        case 5:
                            item.status_text = '已完成';
                            break;
                        case 9:
                            item.status_text = '订单被商家取消';
                            break;

                        default:
                        item.status_text = '';

                    }
                    var buttons = '<a class="border_box-9a font_24r color_67" href="'+item.order_url+'" >查看订单</a>';
                    switch (item.status) {
                        case 0:
                        buttons += '';
                        // buttons += '    <a class="border_box-9a font_24r color_67" href="javascript:void(0)" onclick="order_cancel('+item.id+')">取消接单</a>     <a class="border_box-9a font_24r color_67" >确认接单</a>';

                            break;
                        case 1:
                        buttons += ' <a class="border_box-9a font_24r color_67" href="javascript:void(0)" onclick="order_pay('+item.id+')">付款</a>';
                            break;
                        case 2:
                        // buttons += '    <a class="border_box-9a font_24r color_67 receive" >确认发货</a>';
                        buttons += '    ';
                            break;
                        case 3:
                            buttons += '    <a class="border_box-9a font_24r color_67 " href="javascript:void(0)" onclick="order_received('+item.id+')">确认收货</a>';
                            break;
                        case 4:
                            buttons += '    <a class="border_box-9a font_24r color_67 " href="javascript:void(0)" onclick="order_comment('+item.id+')">评价</a>';
                            break;
                        case 5:
                            buttons += '    ';
                            break;
                        case 9:
                            buttons += '    <a class="border_box-9a font_24r color_67 " href="javascript:void(0)" onclick="order_del('+item.id+')">删除</a>';
                            break;

                        default:
                        item.status_text = '';

                    }
                    // buttons += '    <a class="border_box-9a font_24r color_67 receive" order_id="'+item.order_id+'" order_sn="'+item.order_sn+'" amount="'+item.order_amount+'" store_name="'+item.seller_name+'" '+item.confirm_order_style+'>确认收货</a>';
                    // buttons += '    <a class="border_box-9a font_24r color_67" href="'+item.evaluate_url+'" '+item.evaluate_style+'>评价</a>';
                    // buttons += '    <a class="border_box-9a font_24r color_67" href="index.php?app=buyer_order&act=refund_order&order_id='+item.order_id+'" '+item.refund_order_style+'>申请退款</a>';
                    // buttons += '    <a class="border_box-9a font_24r color_67" href="index.php?app=buyer_order&act=cancel_order&order_id='+item.order_id+'" '+item.cancel_order_style+'>取消订单</a>';
                    // buttons += '    <a class="border_box-02c5a3 font_24r color_02c5a3" href="'+item.pay_url+'" '+item.pay_style+'>付款</a>';
                    item.buttons_html = buttons;


                    // if(item.evaluation_status != '0'){
                    //     item.status_text += ',&nbsp;已评价';
                    // }
                    var goods_html = "";
                    var goods_tpl = _.template(order_goods_tpl);
                    goods_html = goods_tpl(item);
                    // for(var j in item.order_goods){
                    //     var goods = item.order_goods[j];
                    //     try{
                    //         goods_html += goods_tpl(goods);
                    //     }catch(e){
                    //         console.log(e);
                    //     }
                    // }
                    item.goods_list = goods_html;
                    //
                    // if(item.phone_mob!=''){
                    //     item.phone = item.phone_mob;
                    // }else{
                    //     item.phone = item.phone_tel;
                    // }
                    // var buttons = '<a class="border_box-9a font_24r color_67" href="'+item.order_url+'" >查看订单</a>';
                    // buttons += '    <a class="border_box-9a font_24r color_67 receive" order_id="'+item.order_id+'" order_sn="'+item.order_sn+'" amount="'+item.order_amount+'" store_name="'+item.seller_name+'" '+item.confirm_order_style+'>确认收货</a>';
                    // buttons += '    <a class="border_box-9a font_24r color_67" href="'+item.evaluate_url+'" '+item.evaluate_style+'>评价</a>';
                    // buttons += '    <a class="border_box-9a font_24r color_67" href="index.php?app=buyer_order&act=refund_order&order_id='+item.order_id+'" '+item.refund_order_style+'>申请退款</a>';
                    // buttons += '    <a class="border_box-9a font_24r color_67" href="index.php?app=buyer_order&act=cancel_order&order_id='+item.order_id+'" '+item.cancel_order_style+'>取消订单</a>';
                    // buttons += '    <a class="border_box-02c5a3 font_24r color_02c5a3" href="'+item.pay_url+'" '+item.pay_style+'>付款</a>';
                    //
                    // item.buttons_html = buttons;

                    var order = _.template(order_tpl);
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
