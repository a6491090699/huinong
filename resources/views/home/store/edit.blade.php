<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>用户中心 - 店铺设置</title>
<meta name="keywords" content="竞苗平台,花木网,花木,中国苗木网,花木交易,花木求购,花木资讯,花木论坛,花木销售,绿化苗木" />

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
        var SITE_URL = ".";
        var REAL_SITE_URL = ".";
        var PRICE_FORMAT = '¥%s';

    </script>

</head>
<script type="text/javascript" src="/js/moxie.js"></script>
<script type="text/javascript" src="/js/plupload.min.js"></script>

<body class="bg-f8">
<header class="user_center_header bd_bottom-ddd">
    <a class="go_back_btn" href="javascript:history.go(-1)">
        <span class="iconfont">&#xe698;</span>
    </a>
    <h1>店铺信息</h1>
    <a href="javascript:$('#my_store_form').trigger('submit')" class="address_save">保存</a>
</header>
<div class="padding_flanks bg-fff">
    <form id="my_store_form" method="post">
        <div class="user_my_head" style="display: none;">
            <span class="font_3r color_34 goods_name-title">店铺Logo</span>
            <a><img src="/images/store_logo.png" alt="" id="store_logo_img"/></a>
            <input type="hidden" name="store_logo" id="store_logo" value="data/upload/store/73/de/73de7f96f98fced11e229d691a3cbea0/store_logo.png" />
        </div>
        <div class="user_my_head" style="display: none;">
            <span class="font_3r color_34 goods_name-title">店铺Banner</span>
            <input type="hidden" name="store_wapbanner" id="store_wapbanner" value="" />
            <div>
                                <img id="store_wapbanner_img" src="/images/store_banner.png" alt="店铺banner"/>
                            </div>
        </div>
        <div class="form_item">
            <span class="font_3r color_34 goods_name-title">店铺名称</span>
            <input type="text" placeholder="请填写您的店铺名称" class="fr user_nickname primary_business" name="store_name" id="store_name" value="{{$store ? $store->store_name : ''}}"/>
        </div>
        <div class="form_item">
            <span class="font_3r color_34 goods_name-title">主营</span>
            <input type="text" placeholder="请填写您的主营业务" class="fr user_nickname primary_business" name="biz_scope" value="{{$store ? $store->store_sale : ''}}"/>
        </div>
        <div id="region"  class="form_item">
            <input type="hidden" name="region_name" value="{{$store ? $store->base_address : ''}}" class="region_mls_names" />
            <input type="hidden" name="region_id" value="{{$store ? $store->region_id : 0}}" class="region_mls_id" />
            <fieldset>

                                <select>
                    <option>请选择...</option>
                    <option value="1079">山东</option><option value="903">河南</option><option value="1000">江苏</option><option value="1186">浙江</option><option value="922">河北</option><option value="1120">四川</option><option value="856">广东</option><option value="813">安徽</option><option value="952">湖南</option><option value="934">湖北</option><option value="1109">陕西</option><option value="831" selected>福建</option><option value="878">广西</option><option value="1036">辽宁</option><option value="1097">山西</option><option value="1014">江西</option><option value="841">甘肃</option><option value="986">黑龙江</option><option value="1169">云南</option><option value="1026">吉林</option><option value="809">北京</option><option value="810">上海</option><option value="812">重庆</option><option value="811">天津</option><option value="1051">内蒙古</option><option value="893">贵州</option><option value="1064">宁夏</option><option value="967">海南</option><option value="1070">青海</option><option value="1150">新疆</option><option value="1142">西藏</option><option value="654326501">其他</option>                </select>
                                                <select>
                    <option>请选择...</option>
                    <option value="832">福州</option><option value="833">厦门</option><option value="834">莆田</option><option value="835">三明</option><option value="836" selected>泉州</option><option value="837">漳州</option><option value="838">南平</option><option value="839">龙岩</option><option value="840">宁德</option>                </select>
                                                <select>
                    <option>请选择...</option>
                    <option value="350524">安溪</option><option value="350526">德化</option><option value="350503" selected>丰泽</option><option value="350521">惠安</option><option value="350582">晋江</option><option value="350527">金门</option><option value="350502">鲤城</option><option value="350504">洛江</option><option value="350583">南安</option><option value="350505">泉港</option><option value="350581">石狮</option><option value="350525">永春</option>                </select>
                                                <select>
                    <option>请选择...</option>
                    <option value="350503008" selected>北峰街道</option><option value="350503006">城东街道</option><option value="350503007">东海街道</option><option value="350503001">东湖街道</option><option value="350503002">丰泽街道</option><option value="350503005">华大街道</option><option value="350503004">清源街道</option><option value="350503003">泉秀街道</option>                </select>


                            </fieldset>
        </div>
        <div class="form_item">
            <span class="font_3r color_34 goods_name-title">地址</span>
            <input type="text" placeholder="请填写您的地址" class="fr user_nickname primary_business" name="address" value="{{$store ? $store->street : ''}}"/>
        </div>
        <div class="form_item">
            <span class="font_3r color_34 goods_name-title">二级域名</span>
            <input type="text" placeholder="请填写您的二级域名" class="fr user_nickname primary_business bg-fff" name="domain" value="{{$store ? $store->erji_yuming : ''}}" />
        </div>
        <div class="form_item">
            <span class="font_3r color_34 goods_name-title">手机号码</span>
            <input type="number" placeholder="请填写您的手机号码" class="fr user_nickname primary_business" name="pc_mobile" value="{{$store ? $store->phone : ''}}"/>
        </div>
        <div class="form_item">
            <span class="font_3r color_34 goods_name-title">固定电话</span>
            <input type="text" placeholder="请填写您的固定电话" class="fr user_nickname primary_business" name="pc_tel" value="{{$store ? $store->tel : ''}}"/>
        </div>
        <div class="form_item">
            <span class="font_3r color_34 goods_name-title">客服QQ</span>
            <input type="number" placeholder="请填写您的客服QQ" class="fr user_nickname primary_business" name="cs_qq" value="{{$store ? $store->qq : ''}}"/>
        </div>
        <div style="display: none;">
            <textarea class="goods_detailed_information" name="description" placeholder="请添加您的店铺简介"></textarea>
        </div>
    </form>
</div>

<div class="padding_flanks bg-fff bd_top_bottom-eee margin_bottom_16 user_store">
    <div class="form_item border_none">
        <a href="/store/showinfo" class="a_full">
            <span class="font_3r color_34 goods_name-title">实力展示</span>
            <b class="iconfont select_arrows-icon">&#xe614;</b>
        </a>
    </div>
</div>


<div class="mask_layer" id="mask_layer" style="display: none">

</div>

<script type="text/javascript">

    var error_msg_showed = false;
    var error_msg = "";
    var submited = false;
    wap_regionInit("region");
    $(function () {
        $('#my_store_form').validate({
            errorPlacement: function (error, element) {
                error_msg += error[0].textContent+'<br/>';
            },
            highlight: function (element, errorClass, validClass) {
                if(!error_msg_showed){
                    setTimeout(function(){
                        layer.open({content:error_msg,time:2});
                        error_msg_showed = true;
                    },200);
                }
                setTimeout(function(){
                    error_msg = "";
                    error_msg_showed = false;
                },500);
            },
            success: function (element) {

            },
            onkeyup : false,
            onclick : false,
            onfocusin : false,
            onfocusout : false,
            onblur  : false,
            submitHandler: function (form) {
                if (!submited){
                    $.post('index.php?app=my_store&ajax=true', $('#my_store_form').serialize(), function (json) {
                        layer.open({content:json.info, time:3});
                        if (json.status == 0) {
                            setTimeout(function () {
                                $('.ui-link').attr('href', json.my_store_domain);
                                $('.visit_store_link').show();
                            }, 3000);
                        }
                    }, 'json');
                    submited = true;
                    form.submit();
                    $(this).attr('disabled', "true");
                }
            },
            rules: {
                domain: {
                    required: true,
                    // remote: {
                    //     url: 'index.php?app=apply&act=check_subdomain&ajax=1',
                    //     type: 'get',
                    //     data: {
                    //         domain: function () {
                    //             return $('#domain').val();
                    //         },
                    //         store_id: '90714'
                    //     }
                    // },
                    rangelength: [3, 12],
                    is_alphameric: true
                },
                store_name: {
                    required: true,
                    is_chinese: true,
                    rangelength: [2, 20],
                    remote: {
                        url: 'index.php?app=apply&act=check_name&ajax=1',
                        type: 'get',
                        data: {
                            store_name: function () {
                                return $('#store_name').val();
                            },
                            store_id: '90714'
                        }
                    },
                    rangelength: [2, 20]
                },
                region_id: {
                    required: true
                },
                pc_tel : {
                    required : false,
                    is_tel : true
                },
                pc_mobile : {
                    required : false,
                    is_mobile : true
                },
                biz_scope: {
                    required: true,
                    rangelength: [2, 50]
                },
                cs_qq: {
                    number: true
                }
            },
            messages: {
                domain: {
                    required: '二级域名不能为空',
                    // remote: '域名已存在',
                    rangelength: '请填写3-12个英文字母或数字',
                    is_alphameric: '只能填写字母和数字'
                },
                store_name: {
                    required: '店铺名称不能为空',
                    rangelength: '请控制在2-20个字以内',
                    remote: '店铺名称已存在',
                    is_chinese: '店铺名称只能是汉字'
                },
                region_id: {
                    required: '地区必须填写'
                },
                pc_tel : {
                    is_tel : '无效的电话号码'
                },
                pc_mobile : {
                    required : '手机号码必须填写',
                    is_mobile : '无效的手机号码'
                },
                biz_scope: {
                    required: '主营必须填写',
                    rangelength: '主营长度为2-50个汉字'
                },
                cs_qq: {
                    number: '无效的客服QQ'
                }
            }
        });

        var uploader_store_logo = new plupload.Uploader({
            browse_button: 'store_logo_img', //触发文件选择对话框的按钮，为那个元素id
            url: 'index.php?app=comupload&act=uploadedfile&belong=3&instance=store_logo&flag=plupload', //swf文件，当需要使用swf方式进行上传时需要配置该参数
            flash_swf_url: 'http://img1.huamu.com/themes/mobile/mall/huamu/styles/default/plupload/Moxie.swf', //设置Flash路径
            silverlight_xap_url: 'http://img1.huamu.com/themes/mobile/mall/huamu/styles/default/plupload/Moxie.xap', //silverlight文件，当需要使用silverlight方式进行上传时需要配置该参数
            resize: {
                width: 300 //指定压缩后图片的宽度，如果没有设置该属性则默认为原始图片的宽度
                //height: 200, //指定压缩后图片的高度，如果没有设置该属性则默认为原始图片的高度
                //crop: true //是否裁剪图片
            },
            auto_start: true, //设置自动上传
            multi_selection: false,
            dragdrop: true,
            filters: {
                max_file_size: '1mb',
                mime_types: [
                    {
                        title: "店铺LOGO",
                        extensions: "jpg,gif,png,jpeg"
                    }
                ]
            },
            init: {
                PostInit: function () {},
                FilesAdded: function (up, files) {
                    uploader_store_logo.start();
                },
                UploadFile: function (up, file) {

                },
                UploadProgress: function (up, file) {
                    if (file.percent < 100) {
                        layer.open({content:file.percent + "%"});
                    } else {
                        layer.closeAll();
                    }
                },
                FileUploaded: function (up, file, responseObject) {
                    if (file.percent == 100) {
                        var res = $.parseJSON(responseObject.response);
                        if(res.done == true){
                            $("#store_logo").val(res.result.file_path);
                            $("#store_logo_img").attr('src', res.result.file_path + '?' + Date.parse(new Date()));
                            layer.open({content:"上传成功", time:2});
                        }else{
                            layer.open({content:"上传失败", time:2});
                        }

                    }
                },
                UploadComplete: function (up, file) {},
                exit: function (up, err) {
                    window.parent.location.href = window.parent.location.href;
                },
                Error: function (up, err) {

                }
            }
        });
        uploader_store_logo.init();
        /*上传手机端bannert*/
        var uploader_store_wapbanner = new plupload.Uploader({
            browse_button: 'store_wapbanner_img', //触发文件选择对话框的按钮，为那个元素id
            url: 'index.php?app=comupload&act=uploadedfile&belong=3&instance=store_wapbanner&flag=plupload', //swf文件，当需要使用swf方式进行上传时需要配置该参数
            flash_swf_url: 'http://img1.huamu.com/themes/mobile/mall/huamu/styles/default/plupload/Moxie.swf', //设置Flash路径
            silverlight_xap_url: 'http://img1.huamu.com/themes/mobile/mall/huamu/styles/default/plupload/Moxie.xap', //silverlight文件，当需要使用silverlight方式进行上传时需要配置该参数
            resize: {
                width: 640, //指定压缩后图片的宽度，如果没有设置该属性则默认为原始图片的宽度
                height: 235, //指定压缩后图片的高度，如果没有设置该属性则默认为原始图片的高度
                crop: true //是否裁剪图片
            },
            auto_start: true, //设置自动上传
            multi_selection: false,
            dragdrop: true,
            filters: {
                max_file_size: '2mb',
                mime_types: [
                    {
                        title: "店铺条幅",
                        extensions: "jpg,gif,png,jpeg"
                    }
                ]
            },
            init: {
                PostInit: function () {},
                FilesAdded: function (up, files) {
                    uploader_store_wapbanner.start();
                },
                UploadFile: function (up, file) {

                },
                UploadProgress: function (up, file) {
                    if (file.percent < 100) {
                        layer.open({content:file.percent + "%"});
                    } else {
                        layer.closeAll();
                    }
                },
                FileUploaded: function (up, file, responseObject) {
                    if (file.percent == 100) {
                        var res = $.parseJSON(responseObject.response);
                        if(res.done == true){
                            $("#store_wapbanner").val(res.result.file_path);
                            $("#store_wapbanner_img").attr('src', res.result.file_path + '?' + Date.parse(new Date()));
                            layer.open({content:"上传成功", time:2});
                        }else{
                            layer.open({content:"上传失败", time:2});
                        }

                    }
                },
                UploadComplete: function (up, file) {},
                exit: function (up, err) {
                    window.parent.location.href = window.parent.location.href;
                },
                Error: function (up, err) {
                    console.log(err);
                }
            }
        });
        uploader_store_wapbanner.init();

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
