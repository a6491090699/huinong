<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>用户中心 - 我的求购</title>
<meta name="keywords" content="地球村,花木网,花木,中国苗木网,花木交易,花木求购,花木资讯,花木论坛,花木销售,绿化苗木" />
<meta name="description" content="地球村，中国苗木网，中国花木在线交易专业平台，致力于为花木行业从业者提供更真实的花木在线交易平台，让您没有买不到的，没有卖不掉的。" />
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
<header class="user_center_header bg-02c5a3">
    <a class="go_back_btn" href="javascript:history.go(-1)">
        <span class="iconfont color_fff">&#xe698;</span>
    </a>
    <h1 class="color_fff">我的采购</h1>
</header>
<div class="sell_index-main">
    <div class="text_center padding_top_bottom">
        <a class="sell_header_search_box procurement_search">
            <span class="iconfont color_67">&#xe608;</span>
            <input type="text" id="keyword" name="keyword"  placeholder="搜索您的采购商品"/>
        </a>
    </div>
    <ul class="procurement_information-list" id="requirement_list">
	<!-- <li class="bg-fff bd_top_bottom-eee padding_flanks"><a href="/index.php?app=my_requirement&amp;act=find_quote&amp;id=12820">
<dl class="padding_top_bottom clearfix font_22r bd_bottom-eee">
	<dt class="procurement_information_dt" style="height: 86px;"><img src="http://img.huamu.com/data/upload/requirement/201710/27/142/201710271119026702.png"></dt>
	<dd>
	<h3 class="font_26r fontWeight_4">卷叶红</h3>
	<p>
		苗源：不限
	</p>
	<p class="purchase_information_quote">
		<span>截止日期：2017.11.26</span><span class="color_ff7414 fr margin_none">已有0人报价</span>
	</p>
	<span class="purchase_num color_ff7414 font_26r">待审</span></dd>
</dl>
</a>
<div class="padding_top_bottom_13 text_right">
	<a href="/index.php?app=my_requirement&amp;act=edit&amp;requirement_id=12820" class="border_box-67 font_24r color_67"><span class="padding_flanks">编辑</span></a><a class="border_box-67 font_24r color_67 delete_req" require_id="12820"><span class="padding_flanks">删除</span></a>
</div>
</li> -->
    </ul>
    <p class="text_center user_store padding_container font_2r color_9a" id="loading01" style="display: none;">点击加载更多</p>
    <div class="loadEffect" style="display: none">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div class="release_goods-none" style="display:none;">
        <span class="iconfont">&#xe6a5;</span>
        <p class="font_27r color_9a">没有符合条件的求购</p>
        <p class="font_28r color_67">点击下面“<span class="color_02c5a3">发布求购</span>”去发布吧!</p>
    </div>
</div>

<footer class="font_3r">
    <a class="footer_btn color_fff bg-02c5a3" href="/want/fabu">发布求购</a>
</footer>

<script type="text/javascript">
    var requirement_tpl = '<li class="bg-fff bd_top_bottom-eee padding_flanks">';
    requirement_tpl += ' <a href="{url}">';
    requirement_tpl += '   <dl class="padding_top_bottom clearfix font_22r bd_bottom-eee">';
    requirement_tpl += '    <dt class="procurement_information_dt">';
    requirement_tpl += '    <img src="{logo}"/>';//2017-7-24
    requirement_tpl += '    </dt>';
    requirement_tpl += '    <dd>';
    requirement_tpl += '    <h3 class="font_26r fontWeight_4">{title}</h3>';
    requirement_tpl += '    <p>苗源：{source}</p>';
    requirement_tpl += '    <p class="purchase_information_quote"><span>截止日期：{cutday}</span><span class="color_ff7414 fr margin_none">已有{quotes_count}人报价</span></p>';
    requirement_tpl += '    <span class="purchase_num color_ff7414 font_26r">{status_text}</span>';
    requirement_tpl += '    </dd>';
    requirement_tpl += '    </dl>';
    requirement_tpl += ' </a>';
    requirement_tpl += '    <div class="padding_top_bottom_13 text_right">{buttons_html}</div>';
    requirement_tpl += '    </div>';
    requirement_tpl += '    </li>';

    var page = 0;

    $(function(){

        $("div").delegate('a.delete_req', 'click', function(){
            var require_id = $(this).attr('require_id');
            if(""){
                var url="index.php?app=my_requirement&act=drop&require_id=" + require_id;
                layer.open({
                    content: "已删除该求购！"
                    ,time: 1000
                });
                location = url;
            }else {
            layer.open({
                content: "确定要删除该求购吗？不可恢复！"
                ,btn: ['确认', '取消']
                ,yes: function(index){
                    var url="index.php?app=my_requirement&act=drop&require_id="+require_id;
                    layer.close(index);
                    location = url;
                }
            });
          }
        });

        $("#keyword").keyup(function(event){
            if(event.keyCode == 13){
                page = 0;
                $("#requirement_list").empty();
                $('#loading01').trigger('click');
            }
        });

        $('#loading01').click(function(){
            $(this).hide();
//            $(this).text('加载中......');
            $(".loadEffect").show();
            page++;
            var keyword = $('input[name=keyword]').val();
            // var url = SITE_URL+'/index.php?app=my_requirement&act=index&ajax&keyword=' + keyword +'&page='+page;
            var url ='/api/want-list?mid={{$mid}}&keyword=' + keyword +'&page='+page;
            $.getJSON(url, function(result){
                if(result.data.length == 0){
                    if(page == 1){
                        $(".release_goods-none").show();
                    }else{
                        layer.open({content:"没有更多了", time:2});
                    }
                    $('#loading01').hide();
                    $(".loadEffect").hide();
                    return true;
                }
                for(var i = 0; i < result.data.length; i++){
                    var item = result.data[i];

                    item.url = '/want/view/'+item.id;
                    if(item.imgs){
                        var imgs = item.imgs.split(';');
                        item.logo = imgs[0].replace('public/','/storage/');
                    }
                    if(item.logo == null){
                        item.logo = '/images/logo_default.jpg';
                    }

                    var buttons = "";
                    if(item.status == 0){
                        buttons += '<a href="/want/edit/'+item.id+'" class="border_box-67 font_24r color_67"><span class="padding_flanks">编辑</span></a>';
                    }
                    buttons += '<a href="/want/delete/'+item.id+'" class="border_box-67 font_24r color_67"  require_id="' + item.id + '"><span class="padding_flanks">删除</span></a>';
                    // buttons += '<a href="/want/delete/'+item.id+'" class="border_box-67 font_24r color_67 delete_req"  require_id="' + item.id + '"><span class="padding_flanks">删除</span></a>';
                    // status_text
                    if(item.status == 1 ){
                        item.status_text = '已审';
                    }else if (item.status==2 ){
                        item.status_text = '违规';
                    }else{
                        item.status_text = '待审';
                    }


                    item.source = item.source != '' ? item.source : '不限';

                    item.buttons_html = buttons;

                    var tpl = _.template(requirement_tpl);
                    try{
                        $("#requirement_list").append(tpl(item));
                        var dt1=$(".procurement_information_dt");
                        dt1.height(dt1.width());
                        $(window).resize(function() {
                            dt1.height(dt1.width());
                        });
                    }catch(e){
                        console.log(e);
                    }
                }
                $('#loading01').text('点击加载更多').show();
                $(".loadEffect").hide();
            });
        });
        $('#loading01').trigger('click');
    });

</script>

</body>
</html>
