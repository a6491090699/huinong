<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>花木求购信息_最新苗木求购信息_绿化苗木求购 - 中国花木网</title>
<meta name="keywords" content="花木求购,花木求购信息网,苗木求购信息,最新苗木求购,中国花木网" />
<meta name="description" content="中国花木网花木求购信息频道提供最新花木采购，苗木求购信息、花木求购信息大全 、免费发布苗木求购信息、优质苗木在线交易平台，中国花木网期待您的加入共创成功与辉煌！" />
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
    <h1 class="color_fff">采购大厅</h1>
</header>
<div class="sell_index-main">
    <div class="text_center padding_top_bottom">
        <a href="#" class="sell_header_search_box procurement_search">
            <span class="iconfont color_67">&#xe608;</span>
            <input type="text" id="keyword_sr" name="keyword_sr" value="" placeholder="搜索您想报价的商品"/>
            <input name="app" type="hidden" value="requirement" />
            <input name="act" type="hidden" value="index" />
            <input type="hidden" id="cate_id" name="cate_id" value="" />
            <input type="hidden" id="region_id" name="region_id" value="" />
            <input type="hidden" name="order" id="order" value="" />
            <input type="hidden" name="lat" id="lat" value="" />
            <input type="hidden" name="lon" id="lon" value="" />
        </a>
    </div>
    <ul class="purchase_information-list" id="data_list_div">

</ul>
    <p class="text_center font_24r color_9a" id="loading01" style="display: none;">点击加载更多</p>
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

</div>

<script type="text/javascript">

    var page = 0;

    var requirement_tpl = '<li class="bg-fff bd_top_bottom-eee">';
    requirement_tpl += '    <h3>{title}</h3>';
    requirement_tpl += '    <p>{spec}</p>';
    requirement_tpl += '<p>苗源：{source}</p>';
    requirement_tpl += '<p>手机号：{phone}</p>';
    requirement_tpl += '<p class="purchase_information_quote"><span class="color_ff7414">已有{quote_num}人报价</span><span>截止日期：{cutday}</span></p>';
    requirement_tpl += '<span class="purchase_num"><span class="color_ff7414">{number}</span>{unit}</span>';
    requirement_tpl += '    <a href="{url}" class="quote_btn">报价</a>';
    requirement_tpl += '    </li>';

    $(function(){

        //keyword input Enter event
        $("#keyword_sr").keyup(function(event){
            if(event.keyCode == 13){
                page = 0;
                $('#loading01').trigger('click');
            }
        });

        $('#loading01').click(function(){
            if(page == 0){
                $("#data_list_div").empty();
                $(".loadEffect").hide();
            }

            $(this).hide();
            $(".loadEffect").show();
//            $(this).find('a').text('加载中......');
            var keyword_sr = $('input[name=keyword_sr]').val();

            page++;

            var lat = parseFloat($('#lat').val());
            var lon = parseFloat($('#lon').val());
            var order=$("#order").val();
            // var url = SITE_URL+'/index.php?app=requirement&act=ajax_requirements&cate_id=&region_id=&keyword_sr='+keyword_sr+'&page='+page+'&lat='+lat+'&lon='+lon+'&order='+order;
            var url ='/api/want-list?keyword='+keyword_sr+'&page='+page;

            $.get(url, function(result){
                // eval('result = '+result)
                // console.log(result.data)
                gg = result.data;
                if(result.data.length==0){
                    if(page == 1){
                        $(".release_goods-none").show();
                    }else{
                        layer.open({content:"没有更多了", time:2});
                    }
                    $('#loading01').hide();
                    $(".loadEffect").hide();
                    return true;
                }

                for(var i=0; i<result.data.length; i++){
                    var item = result.data[i];
                    var tpl = _.template(requirement_tpl);
                    item.spec = '';
                    var want_attrs = item.want_attrs;
                    if(null !== want_attrs){
                        for(var j=0; j<want_attrs.length;j++){
                            var jtem = want_attrs[j];
                            var attrs = jtem.attrs;
                            item.spec += attrs.attr_name + jtem.attr_value + attrs.unit +' ';

                        }
                    }

                    item.quote_num = item.quotes.length;
                    // console.log(item.cutday);
                    myday = new Date(item.cutday*1000);

                    item.cutday = myday.getFullYear() +'-'+(myday.getMonth()+1) +'-'+myday.getDate();
                    item.unit = item.kinds.unit;
                    item.number = item.number
                    item.url = '/quote/add/'+item.id;




                    $('#data_list_div').append(tpl(item));

                    // if (item.requirements_spec){
                    //     for(var spec_i in item.requirements_spec){
                    //         item.spec_text = "";
                    //
                    //         var spec_item=item.requirements_spec[spec_i];
                    //
                    //         item.requirement_url = '/qiugou/'+item.pts+'_'+item.require_id+'_'+spec_item.rspec_id+'.html';
                    //         item.num = spec_item.num;
                    //         item.unit = spec_item.unit;
                    //
                    //         var attr_length = 0;
                    //
                    //         for(var attr_i in spec_item.attr){
                    //             attr_length++;
                    //         }
                    //
                    //         var attr_length_tmp=0;
                    //         for(var attr_i in spec_item.attr){
                    //             attr_length_tmp++;
                    //             var rattr=spec_item.attr[attr_i];
                    //             item.spec_text += rattr.attr_name+rattr.attr_value+result.attrs[rattr.attr_id];
                    //             if(attr_length_tmp<attr_length){
                    //                 item.spec_text += ',&nbsp;';
                    //             }
                    //         }
                    //
                    //         try{
                    //             $('#data_list_div').append(tpl(item));
                    //         }catch(e){
                    //
                    //         }
                    //     }
                    // }else{
                    //     item.spec_text = "";
                    //     item.requirement_url = '/qiugou/'+item.pts+'_'+item.require_id+'.html';
                    //     item.num = '';
                    //     item.unit = '';
                    //
                    //     try{
                    //         $('#data_list_div').append(tpl(item));
                    //     }catch(e){
                    //
                    //     }
                    // }
                }
                $('#loading01').show().find('a').text('加载更多');
                $(".loadEffect").hide();
            });
        });

		//加载商品列表功能，静态时暂且关闭，开发时再打开
        $("#loading01").trigger('click');
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
