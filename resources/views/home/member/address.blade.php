<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>用户中心 - 我的地址</title>
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
<header class="user_center_header bd_bottom-eee">
    <a class="go_back_btn" href="javascript:history.go(-1)">
        <span class="iconfont">&#xe698;</span>
    </a>
    <h1>收货地址</h1>
</header>


<ul class="user_address-list">
    @foreach($addr as $val)
        <li class="bg-fff bd_top_bottom-eee" id="box_4717">
        <div>
            <p class="margin_bottom_5"><span>{{$val->name}}</span><span class="fr">{{$val->phone}}</span></p>
            <p>{{$val->street}}</p>
        </div>
        <div class="address_operation">
            <a class="input_radio">
                <input type="radio" class="input-select" name="default_address" value="{{$val->id}}"  @if($val->is_default == 1) checked @endif/>设为默认地址
            </a>
            <a href="javascript:delete_address({{$val->id}})" class="fr">
                <span class="iconfont">&#xe603;</span>删除
            </a>
            <a href="/member/address-edit/{{$val->id}}" class="fr">
                <span class="iconfont">&#xe6a9;</span>编辑
            </a>
        </div>
    </li>
    @endforeach

    </ul>
<script type="text/javascript">
    $(".input_radio input[type='radio']:checked").parent(".input_radio").addClass("input_radio_select");
    $(".input_radio").click(function(){
        $(".input_radio").removeClass("input_radio_select").find("input[type='radio']").attr("checked",false);
        $(this).addClass("input_radio_select").find("input[type='radio']").attr("checked","checked");
        var addr_id = $(this).find("input[type='radio']").val();
        // var url = "/index.php?app=my_address&act=set_default&ajax&addr_id=" + addr_id;
        var url = "/member/address-setdefault/" + addr_id;//设置默认地址
        $.get(url, function(result){
            layer.open({content:result.info, time:2});
        }, 'json');
    });

    function delete_address(addr_id){
        layer.open({
            content: "确定要删除该地址吗？不可恢复！"
            ,btn: ['确认', '取消']
            ,yes: function(index){
                // var url="index.php?app=my_address&act=drop&addr_id="+addr_id;
                var url="/member/address-del/"+addr_id;
                layer.close(index);
                location = url;
            }
        });
    }
</script>



<footer class="font_3r">
    <a class="footer_btn color_fff bg-02c5a3" href="/member/address-add">添加新地址</a>
</footer>

</body>
</html>
