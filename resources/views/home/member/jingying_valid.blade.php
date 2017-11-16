<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>中国花木在线交易专业平台</title>
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
<body>
<link href="/css/edit-jm.css" type="text/css" rel=stylesheet />
<link href="/css/user-index.css" type="text/css" rel=stylesheet />
<script type="text/javascript" src="/js/moxie.js"></script>
<script type="text/javascript" src="/js/plupload.min.js"></script>
<header class="user_center_header">
    <a class="go_back_btn" href="javascript:history.go(-1)">
        <span class="iconfont">&#xe698;</span>
    </a>
    <h1>经营许可证</h1>
</header>
<div class="prove_warn clearfix">
    <!--<div class="fl">-->
        <span class="iconfont">&#xe6aa;</span>
    <!--</div>-->
    <p class="fr vertical_center-34">
        <b id="tip_state"><span class="cstate_0">未提交</span>,</b>请上传营业执照进行认证。
    </p>
</div>
<div class="padding_flanks">
    <div class="business_certificate_container">
        <div class='part' id='part'>
            <div data-role="content">
                <form class="idcard"  enctype="multipart/form-data" id="frm_cert">
                    <ul class="idcard-list">
                        <li>
                            <div class="example">
                                <input type=file id="upcard_image_permit" class="upcard" style="display: none;">
                                <input type="hidden" name="image_permit" value="" />
                                <div class='result'  id="image_permit">
                                    <img src="/images/pic-card-permit.png" alt=""/> </div>
                                <p>点击上传营业执照照片</p>
                            </div>
                            <p><b>01</b> 营业执照清晰照片</p>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="padding_flanks">
    <button class="secede_debark_btn" id="return_upload" >确定</button>
</div>

<script>
    $('#return_upload').click(function(){
        window.location.href='index.php?app=my_certification';
    });
    //上传正面
    $(document).on('click', '.image_permit', function () {
        $('#upcard_image_permit').trigger('click');
    });

    /*上传身份证正面*/
    var uploader_idcard_front= new plupload.Uploader({
        browse_button : 'image_permit', //触发文件选择对话框的按钮，为那个元素id
        url : 'index.php?app=comupload&act=uploadauthen&instance=image_permit', //swf文件，当需要使用swf方式进行上传时需要配置该参数
        flash_swf_url : 'http://img1.huamu.com/themes/mobile/mall/huamu/styles/default/plupload/Moxie.swf',//设置Flash路径
        silverlight_xap_url : 'http://img1.huamu.com/themes/mobile/mall/huamu/styles/default/plupload/Moxie.xap', //silverlight文件，当需要使用silverlight方式进行上传时需要配置该参数
        resize: {
            width: 800//指定压缩后图片的宽度，如果没有设置该属性则默认为原始图片的宽度
            //height: 200, //指定压缩后图片的高度，如果没有设置该属性则默认为原始图片的高度
            //crop: true//是否裁剪图片
        },
        auto_start : true,//设置自动上传
        multi_selection:false,
        dragdrop: true,
        filters : {
            max_file_size : '10mb',
            /*mime_types: [
                {title : "身份证正面", extensions : "jpg,gif,png,jpeg"}
            ]*/
        },
        init: {
            PostInit: function() {},
            FilesAdded: function(up, files) {
                uploader_idcard_front.start();

                for (var i = 0, len = files.length; i < len; i++) {
                    //$('.idcard_front_demo').remove();
                    !function (i) {
                        previewImage(files[i], function (imgsrc) {
                            $('#image_permit').html('<img class="image_permit_view"  src="' + imgsrc + '" name="' + files[i].name + '" />');
                        })}(i);
                }
            },
            UploadFile:function(up, file) {

            },
            UploadProgress: function(up, file) {
            },
            FileUploaded:function(up,file,responseObject){
                if(file.percent==100){
                    var res = $.parseJSON(responseObject.response);
                    if(res.result.code==1){
                        layer.open({content:'待审核', time:3})
                    }else {
                        layer.open({content:res.result.message, time:3})
                    }
                    //组合文件信息
                    var file_ext = file.name.substr(file.name.lastIndexOf(".")); // 图片后缀
                    $("input[name$='image_idcard_front']").val('data/files/mall/application/store_'+'90714'+'_permit'+file_ext);
                }
            },
            UploadComplete: function(up, file) {},
            exit: function(up, err) {
                window.parent.location.href = window.parent.location.href;
            },
            Error: function(up, err) {

            }
        }
    });
    uploader_idcard_front.init();
    //预览
    //plupload中为我们提供了mOxie对象
    //有关mOxie的介绍和说明请看：https://github.com/moxiecode/moxie/wiki/API
    function previewImage(file,callback){//file为plupload事件监听函数参数中的file对象,callback为预览图片准备完成的回调函数
        if(!file || !/image\//.test(file.type)) return; //确保文件是图片
        if(file.type=='image/gif'){//gif使用FileReader进行预览,因为mOxie.Image只支持jpg和png
            var fr = new mOxie.FileReader();
            fr.onload = function(){
                callback(fr.result);
                fr.destroy();
                fr = null;
            }
            fr.readAsDataURL(file.getSource());
        }else{
            var preloader = new mOxie.Image();
            preloader.onload = function() {
                preloader.downsize( 300, 300 );//先压缩一下要预览的图片,宽300，高300
                var imgsrc = preloader.type=='image/jpeg' ? preloader.getAsDataURL('image/jpeg',80) : preloader.getAsDataURL(); //得到图片src,实质为一个base64编码的数据
                callback && callback(imgsrc); //callback传入的参数为预览图片的url
                preloader.destroy();
                preloader = null;
            };
            preloader.load( file.getSource() );
        }
    }
</script>
@include('home.common.footer')
</body>
</html>
