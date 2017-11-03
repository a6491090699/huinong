<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>地球村竞苗在线交易专业平台</title>
<meta name="keywords" content="地球村竞苗网,花木网,花木,中国苗木网,花木交易,花木求购,花木资讯,花木论坛,花木销售,绿化苗木" />
<meta name="description" content="地球村竞苗网，中国苗木网，地球村竞苗在线交易专业平台，致力于为花木行业从业者提供更真实的花木在线交易平台，让您没有买不到的，没有卖不掉的。" />
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
        var SITE_URL = "http://m.huamu.com";
        var REAL_SITE_URL = "http://m.huamu.com";
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
<header class="user_center_header bg-02c5a3">
    <a class="go_back_btn" href="javascript:history.go(-1)">
        <span class="iconfont color_fff">&#xe698;</span>
    </a>
    <h1 class="color_fff">我的报价</h1>
</header>
<div>
    <ul class="order_nav-list quote_nav_list bg-fff font_3r clearfix">
        <li >
            <a href="/quote/my"><div>全部</div></a>
        </li>
        <li >
            <a href="/quote/my-pass"><div>已通过</div></a>
        </li>
        <li class="hover_list">
            <a href="/quote/my-nopass"><div>未通过</div></a>
        </li>
        <li >
            <a href="/quote/my-lose"><div>已失效</div></a>
        </li>
    </ul>

    <ul id="rquote_list" class="no_payment-list">
	<li class="li_padding_13 bg-fff margin_bottom_16 bd_top_bottom-eee">
<div class="border_radio bg_02c5a3-bg_02e3bb">
	<div class="goods_norms_container norms_list_padding clearfix font_26r">
		<span class="color_fff">单价(元)</span><span class="color_fff">供货量</span><span class="color_fff">备货时间(天)</span><span class="color_fff">发票类型</span>
	</div>
	<div class="goods_norms_container norms_list_padding clearfix font_26r">
		<span class="color_fff">1.00</span><span class="color_fff">3000</span><span class="color_fff">20</span><span class="color_fff">不提供</span>
	</div>
</div>
<div class="position_relative margin_top">
	<h3 class="font_28r margin_top overflow_omit fontWeight_4 color_67">工程采购红叶石楠、其他品种看图 <span>60000棵</span></h3>
	<p class="color_9a font_24r margin_top">
		高度:60&nbsp;冠幅:30&nbsp;
	</p>
	<p class="color_9a font_24r margin_top-5">
		<span>苗源要求：不限地区</span><span class="fr margin_none">截止日期：2017.11.24</span>
	</p>
	<span class="purchase_num top_right-0 color_ff7414 font_24r">审核通过</span>
</div>
</li>
    </ul>
    <p class="text_center margin_top margin_bottom padding_container font_24r color_9a" id="loading01" style="display: none;">加载更多...</p>
    <p class="text_center margin_top margin_bottom padding_container font_24r color_9a release_goods-none" style="display: none;">没有符合条件的记录</p>
</div>

<script type="text/javascript">

    var page = 0;

    //template
    var rquote_tpl = '<span class="color_fff">{price}</span><span class="color_fff">{number}</span><span class="color_fff">{beihuo_time}</span><span class="color_fff">{fapiao_type_name}</span>';

    var requirement_tpl = '<h3 class="font_28r margin_top overflow_omit fontWeight_4 color_67">{title} <span>{number}{unit}</span></h3>';
    requirement_tpl += '   <p class="color_9a font_24r margin_top">{spec}</p>';
    requirement_tpl += '<p class="color_9a font_24r margin_top-5"><span>苗源要求：{source}</span><span class="fr margin_none">截止日期：{cutday}</span></p>';
    requirement_tpl += '<span class="purchase_num top_right-0 color_ff7414 font_24r">{status_name}</span>';

    var requirement_quote_tpl = '<li class="li_padding_13 bg-fff margin_bottom_16 bd_top_bottom-eee">';
    requirement_quote_tpl += '    <div class="border_radio bg_02c5a3-bg_02e3bb">';
    requirement_quote_tpl += '    <div class="goods_norms_container norms_list_padding clearfix font_26r">';
    requirement_quote_tpl += '    <span class="color_fff">单价(元)</span>';
    requirement_quote_tpl += '    <span class="color_fff">供货量</span>';
    requirement_quote_tpl += '    <span class="color_fff">备货时间(天)</span>';
    requirement_quote_tpl += '    <span class="color_fff">发票类型</span>';
    requirement_quote_tpl += '    </div>';
    requirement_quote_tpl += '    <div class="goods_norms_container norms_list_padding clearfix font_26r">{quote_info}</div>';
    requirement_quote_tpl += '    </div>';
    requirement_quote_tpl += '    <div class="position_relative margin_top">{requirement_info}</div>';
    requirement_quote_tpl += '    </li>';

    $(function(){

        $('#loading01').click(function(){
            $(this).show();
            $(this).text('加载中......');

            if(page == 0){
                $("#rquote_list").empty();
            }

            page++;

            var url='/api/quote-all?page='+page+'&type=2';

            $.getJSON(url, function(response){
                // console.log(response)
                if(response){
                    var rquotes = response.data;
                    if(rquotes.length==0){
                        if(page == 1){
                            $(".release_goods-none").show();
                        }else{
                            layer.open({content:"没有更多了", time:2});
                        }
                        $('#loading01').hide();
                        return true;
                    }
                    for(var i = 0; i < rquotes.length; i++){
                        var item = rquotes[i];

                        var tpl_rquote = _.template(rquote_tpl);

                        var rquote = [];
                        rquote.price = item.price;
                        rquote.number = item.number;
                        rquote.beihuo_time = item.beihuo_time;
                        if(item.fapiao_type == 0){
                            rquote.fapiao_type_name = "不提供";
                        }else if(item.fapiao_type == 1){
                            rquote.fapiao_type_name = "普通";
                        }else if(item.fapiao_type == 2){
                            rquote.fapiao_type_name = "增值税";
                        }

                        var quote_info = tpl_rquote(rquote);

                        item.quote_info = quote_info;

                        var tpl_requirement = _.template(requirement_tpl);

                        var requirement = [];
                        requirement.title = item.wants.title;
                        requirement.number = item.wants.number;
                        requirement.unit = item.wants.kinds.unit;
                        myday = new Date(item.wants.cutday*1000);
                        requirement.cutday = myday.getFullYear() +'-'+(myday.getMonth()+1) +'-'+myday.getDate();
                        requirement.source = item.wants.source;
                        requirement.spec = '';
                        if(item.status == 0) requirement.status_name = '待审核';
                        if(item.status == 1) requirement.status_name = '已通过';
                        if(item.status == 2) requirement.status_name = '未通过';
                        if(item.status == 3) requirement.status_name = '已失效';


                        var want_attrs = item.wants.want_attrs;
                        if(null !== want_attrs){
                            for(var j=0; j<want_attrs.length;j++){
                                var jtem = want_attrs[j];
                                var attrs = jtem.attrs;
                                requirement.spec += attrs.attr_name + jtem.attr_value + attrs.unit +' ';

                            }
                        }

                        if(item.expires == 1){
                            requirement.formated_expire += "(已过期)";
                        }
                        requirement.from_region_name = item.from_region_name != '' ? item.from_region_name : "不限";




                        var requirement_info = tpl_requirement(requirement);

                        item.requirement_info = requirement_info;

                        var tpl = _.template(requirement_quote_tpl);
                        try{
                            $("#rquote_list").append(tpl(item));
                        }catch(e){
                            console.log(e);
                        }
                    }
                }else{
                    layer.open({content:response.msg, time:3});
                }

                $('#loading01').text('加载更多...');
            });
        });
		//静态的时候暂时关闭
        $('#loading01').trigger('click');
    });
</script>

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
