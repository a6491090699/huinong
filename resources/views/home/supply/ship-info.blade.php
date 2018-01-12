<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>物流信息</title>
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
    <!--增加的开始-->
	<link rel="stylesheet" href="/css/up_file.css" />
	<script src="/js/photoswipe-ui-default.min.js" type="text/javascript"></script>
	<script src="/js/photoswipe.min.js" type="text/javascript"></script>
	<script>
	var valuenum = 0;
	</script>
	<!--增加的结束-->

    <!-- yytest -->
    <link rel="stylesheet" href="/css/yyupload.css" />
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(function(){
            $('#goods_form').validate({

                submitHandler: function (form) {


                    $(".yyimg-list li").each(function(){
                        $("#goods_form").append('<input type="hidden" name="compressValue[]" value="'+$(this).data('img')+'">');
                        // console.log($(this).data('img'));
                    });
                    $.ajax({
                        url: '/supplyorder/ship-info-add',
                        type:'post',
                        data:$('#goods_form').serialize(),
                        beforeSend:function(){
                            //
                        },
                        error:function(){
                            layer.open({content:'网络不给力', time:2});
                        },
                        success:function(data){
                            // eval("data ="+data);
                            // layer.open({content:data.errMsg, time:2});
                            if(data.status=='success'){
                                layer.open({content:data.msg, time:2});

                                setTimeout(function(){
                                    window.location.href='/supplyorder/index';
                                },1000);


                            }else{
                                layer.open({content:data.msg, time:2});

                                setTimeout(function(){
                                    window.location.reload();
                                },1000);
                            }
                        },
                        complete:function(){
                            //
                        }

                    });
                    // form.submit();

            }
    });
        })
    </script>

</head>

<style>
    #iframepage{
        width:100%;
        height:100%;
        overflow: hidden;
    }
    #iframepage *{
        max-width:100% !important;
        max-height:100% !important;
    }
    .add-pic>div{
        width:100% !important;
        max-height:100%;
    }
    .add-pic>div>input{
        width:100% !important;
        max-height:100%;
    }
    .add-pic .add-btn{
        width:100% !important;
        height:100% !important;
    }
</style>
<body>
<header class="user_center_header bd_bottom-ddd">
    <a class="go_back_btn" href="javascript:history.go(-1)">
        <span class="iconfont">&#xe698;</span>
    </a>
    <h1>物流信息</h1>
</header>
<form id="goods_form" method="POST" action="/supplyorder/ship-info-add" style="padding-top:1rem;">
    {{csrf_field()}}

    <div class="padding_flanks">
        <div class="form_item">
            <span class="font_3r color_34 goods_name-title">货运车牌号</span>
            <input class="color_67  border_none font_24r goods_name" type="text" name="driver_carno"  placeholder="请输入你的车牌号" value=""/>
        </div>
        <div class="form_item">
            <span class="font_3r color_34 goods_name-title">司机身份证</span>
            <input class="color_67  border_none font_24r goods_name" type="text" name="driver_id"  placeholder="请输入你的身份证号码" value=""/>
        </div>
        <div class="form_item">
            <span class="font_3r color_34 goods_name-title">司机电话</span>
            <input class="color_67  border_none font_24r goods_name" type="number" name="driver_phone"  placeholder="请输入你的手机" value=""/>
        </div>
        <div class="form_item">
            <span class="font_3r color_34 goods_name-title">运费价格</span>
            <input class="color_67  border_none font_24r goods_name" type="text" name="driver_price"  placeholder="" value=""/>
        </div>









        <div id="wap_description" style="display: block">
            <div class="form_item">
                <span class="font_3r color_34 goods_name-title">备注信息</span>

            </div>

        <textarea class="goods_detailed_information"  name="tip" id="description"  placeholder="备注 ，如：物流情况、杂费情况 包装情况等"></textarea>
        </div>


        <input type="file" id="yychoose" accept="image/*" multiple>
    <ul class="yyimg-list"></ul>
    <a id="yyupload">选择图片</a>
    <span class="yytips">只允许上传jpg、png等格式图片</span>
    <span class="yytips"><font color="red">请依次上传各种规定图片!</font></span>
    <!-- <a id="yyuploadimg">上传</a> -->
    <!-- <a id="yyuploadbut" href="javascript:void(0)" onClick="yyupload()">yyyy上传</a> -->
    <p class="yyshowimg" id="yyshowimg"></p>

        <ul class="sell_goods_img-list clearfix">
                        <li id="image_upload_notice" style="display:none;">
                <img src="/images//loading.gif" alt="上传" />
            </li>

            <!-- <input type="hidden" name="is_uploaded" id="is_uploaded" value="" /> -->
        </ul>
    </div>


    <div class="mask_layer" id="mask_layer" style="display: none">






    </div>
    <input type="hidden" id="goods_id" name="order_id" value="{{$order_id}}">

    <div class="buy_release_btn text_center padding_flanks">
        <button class="footer_btn color_fff bg-02c5a3" type="submit">确认发货</button>
    </div>
</form>

<script>

                $("#file_upload").change(function() {
            				$('.file').css('background', 'url(/images/upbutton.png)  no-repeat');
            				$('.file').css('width', '100%');
            				$('.file').css('height', '11rem');
            				$('.file').css('background-size', '80% 80%');
            				$('.file').css('top', '0.5rem');
            				$('.upimg').css('height', 'auto');
            				$('#upimgs').css('float', 'left');
            				$('#upimgs').css('width', '30%');
            				var $file = $(this);
            				var fileObj = $file[0];
            				var windowURL = window.URL || window.webkitURL;
            				var dataURL;
            				var para = document.createElement("div");
            				var html1 = '<img src="/images/delect.png" class="delects" onclick="delects(' + valuenum + ')"/>';
            				//				var $img = $("#show");
            				if(fileObj && fileObj.files && fileObj.files[0]) {
            					dataURL = windowURL.createObjectURL(fileObj.files[0]);
            					var html = '<img src="' + dataURL + '" class="imgs" id="imgs_' + valuenum + '" onclick="showimg(' + valuenum + ')"/>';
            				} else {
            					dataURL = $file.val();
            					var imgObj = document.getElementById("preview");
            					// 两个坑:
            					// 1、在设置filter属性时，元素必须已经存在在DOM树中，动态创建的Node，也需要在设置属性前加入到DOM中，先设置属性在加入，无效；
            					// 2、src属性需要像下面的方式添加，上面的两种方式添加，无效；
            					imgObj.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
            					imgObj.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = dataURL;

            				}
            				para.className = 'setimg del_' + valuenum;
            				valuenum++;
            				para.innerHTML += html1;
            				para.innerHTML += html;
            				$("#imglist").append(para);
            			});
                        function delects(numbers) {
            				$('.del_' + numbers).remove();
            			}

            			function showimg(j) {
            				var pswpElement = document.querySelectorAll('.pswp')[0];
            				var showimgs = {};
            				var showimage = [];
            				var imgs = new Image();
            				imgs.src = $('#imgs_' + j)[0].src;
            				showimgs = {
            					src: $('#imgs_' + j)[0].src,
            					w: imgs.width,
            					h: imgs.height
            				}
            				showimage.push(showimgs)

            				// build items array
            				var items = showimage;

            				// define options (if needed)
            				var options = {
            					// optionName: 'option value'
            					// for example:
            					index: j
            					// start at first slide
            				};

            				// Initializes and opens PhotoSwipe
            				var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items,
            					options);
            			}

</script>
<script type="text/javascript" src="/js/my_goods.form.new.js?{{time()}}"></script>
<script type="text/javascript" src="/js/yyupload.js?{{time()}}"></script>

</body>
</html>
