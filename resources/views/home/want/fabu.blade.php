<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>发布求购</title>
<meta name="keywords" content="竞苗平台,花木网,花木,中国苗木网,花木交易,花木求购,花木资讯,花木论坛,花木销售,绿化苗木" />
<meta name="description" content="竞苗平台，中国苗木网，中国花木在线交易专业平台，致力于为花木行业从业者提供更真实的花木在线交易平台，让您没有买不到的，没有卖不掉的。" />
    <link rel="stylesheet"  href="/css/mobile-select-area.css?{{time()}}">
    <!--<link rel="stylesheet" href="/css/larea.css">-->
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="stylesheet" href="/css/index.css"/>
    <!--<link rel="stylesheet" href="/css/sm.min.css">-->
    <!--<script type='text/javascript' src='/js/zepto.min.js' charset='utf-8'></script>-->
    <!--<script type='text/javascript' src='/js/sm.min.js' charset='utf-8'></script>-->
    <script src="/js/jquery-1.11.2.js" type="text/javascript"></script>
    <script src="/js/layer.js"></script>
    <script type="text/javascript" src="/js/index.js"></script>


    <script src="/js/mlselection.js?{{time()}}"></script>
    <script src="/js/huamu.js" type="text/javascript"></script>
    <script src="/js/jquery.validate.js" type="text/javascript"></script>
    <script src="/js/jquery.validate.extend.js" type="text/javascript"></script>
    <script src="/js/additional-methods-huamu.js" type="text/javascript"></script>
    <script src="/js/index.js" type="text/javascript"></script>
    <script src="/js/common.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/dialog.js"></script>
    <script type="text/javascript" src="/js/mobile-select-area.js?{{time()}}"></script>
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


        <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript" charset="utf-8">
            wx.config(<?php echo $js->config(array('onMenuShareQQ', 'onMenuShareWeibo','chooseWXPay'), false) ?>);
        </script>

</head><body class="bg-f8">
<header class="user_center_header bd_bottom-eee">
    <a class="go_back_btn" href="javascript:history.go(-1)">
        <span class="iconfont">&#xe698;</span>
    </a>
    <h1>发布求购</h1>
</header>
<script src="/js/common.js" type="text/javascript"></script>
<script type="text/javascript">
    var page_initialized = false;

    var require_id = '';

    //过期时间
    var expire_options = [];
    if(parseInt(require_id) > 0){
        expire_options.push({id:-1,name:""});
    }
    expire_options.push({id:1,name:"3天"});
    expire_options.push({id:2,name:"5天"});
    expire_options.push({id:3,name:"7天"});
    expire_options.push({id:4,name:"10天"});
    expire_options.push({id:5,name:"15天"});
    expire_options.push({id:6,name:"30天"});

    //地址
    // var addresses_json = [{"id":"4717","name":"\u65b9\u680b \u6cb3\u5317\t\u90af\u90f8\t\u5927\u540d\t\u9ec4\u91d1\u5824\u4e61 \u5927\u6728\u82d7\u6728"}];
    // var addresses_json = [{!!$address_json!!}];
    var addresses_json = {!!$address_json!!};

    //单位
    var goods_unit_options = [{"id":"\u4ef6","name":"\u4ef6"},{"id":"\u68f5","name":"\u68f5"},{"id":"\u76c6","name":"\u76c6"},{"id":"\u7c73","name":"\u7c73"},{"id":"\u5398\u7c73","name":"\u5398\u7c73"},{"id":"\u514b","name":"\u514b"},{"id":"\u5343\u514b","name":"\u5343\u514b"},{"id":"\u5428","name":"\u5428"},{"id":"\u679d","name":"\u679d"}];

    //商品分类
    var gcategory_data_url = "/api/kinds";
    var gcategory_search_url = "/index.php?app=mlselection&act=gcategory_breadpiece&keyword=";
    // var gcategory_search_url = "/api/guige";
    var gcategory_data = [];

    //此处必须用localStorage
    localStorage.setItem('rcategory_old_value', '[,,]');

    //滑动选择插件
    var gcategorySelect = new MobileSelectArea();
    var expireSelect = new MobileSelectArea();
    var unitSelect = new MobileSelectArea();
    var area_select = new MobileSelectArea();
    var address_select = new MobileSelectArea();

    var areas_data = new Array();

    //商品属性数据
    var goods_attr_data = new Array();


    //模板
    // var spec_input_line_tpl = '<div class="specification"><span class="font_3r fontWeight_5 color_34 specification_name">{attr_name}({unit})</span> <span class="font_24r fontWeight_5 color_34 fr">以上</span> <input class="color_9a  border_none font_24r fr" type="number" fake_name="attr[{id}]"  class="spec_attr_input mobiselect_item" value="" attr_id="{id}" placeholder="请填写{attr_name}"/> </div>';
    var spec_input_line_tpl = '<div class="specification"><span class="font_3r fontWeight_5 color_34 specification_name">{attr_name}({unit})</span> <span class="font_24r fontWeight_5 color_34 fr">以上</span> <input class="color_9a  border_none font_24r fr" type="number" fake_name="requirement_spec[attr][{id}][]"  class="spec_attr_input mobiselect_item" value="" attr_id="{id}" placeholder="请填写{attr_name}"/> </div>';

    var spec_value_line_tpl = '<div class="goods_norms_con clearfix font_26r">{attribute_values}<b class="iconfont select_arrows-icon color_02c5a3" onclick="$(this).parent().remove();">&#xe607;</b></div>';

    var spec_input_num_tpl = '<div class="form_item"> <span class="font_3r fontWeight_5 color_34 goods_name-title">采购数量</span> <span class="fr text_right"> <input type="text" class="buy_release_num font_28r text_right" fake_name="requirement_spec[num][]" value=""/> <input type="hidden" class="buy_release_num font_28r text_center requirement_unit" fake_name="requirement_spec[unit][]" value=""/> </span> </div>';

    var error_msg_showed = false;
    var error_msg = "";
    var submited = false;

    $(function(){
        //表单校验
        $('#requirement_form').validate({
            onkeyup : false,
            onclick : false,
            onfocusin : false,
            onfocusout : false,
            onblur  : false,
            errorPlacement: function(error, element){
                error_msg+=error[0].textContent+'<br/>';
            },
            highlight:function(){
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
            ignore:'',
            rules : {
                title : {
                    required:true,
                    minlength:2
                },
                description: {
                    required:true,
                    minlength:10,
                    maxlength:100
                },
                address_id: {
                    required:true,
                }
            },
            messages : {
                title : {
                    required:'请填写求购标题',
                    minlength:'标题必须大于6个字符(2个汉字)'
                },
                description : {
                    required:'请填写求购备注信息',
                    minlength:'备注信息必须大于10个字',
                    maxlength:'备注信息必须不能超过100个字'
                },
                address_id: {
                    required:'联系人为空，请先添加联系人',
                }
            },
            submitHandler:function(form){

                $url = $('#requirement_form').attr('action');
                // var formData = new FormData($( "#requirement_form" )[0]);
                // if (!submited ){
                if (!submited && check_spec_value()){
                    $.ajax({
                        type:'post',
                        url:$url,
                        data:$('#requirement_form').serialize(),
                        // data:formData,
                        // async: false,
                        // cache: false,
                        // contentType: false,
                        // processData: false,
                        beforeSend:function(){
                            //
                        },
                        error:function(){
                            layer.open({content:'网络不给力', time:2});
                        },
                        success:function(data){
                            // eval("data ="+data);
                            // layer.open({content:data.errMsg, time:2});
                            if(data.errNum==0){
                                // setTimeout(function(){
                                //     window.location.href='/want/index';
                                // },1000);
                                wx.chooseWXPay({
                                    timestamp: <?= $config['timestamp'] ?>,
                                    nonceStr: '<?= $config['nonceStr'] ?>',
                                    package: '<?= $config['package'] ?>',
                                    signType: '<?= $config['signType'] ?>',
                                    paySign: '<?= $config['paySign'] ?>', // 支付签名
                                    success: function (res) {
                                        // 支付成功后的回调函数
                                        layer.open({content:data.errMsg, time:2});

                                        setTimeout(function(){
                                            window.location.href='/want/index';
                                        },1000);
                                    }
                                });

                            }
                        },
                        complete:function(){
                            //
                        }
                    });
                    submited = true;
                    $(this).attr('disabled', "true");
                }else{
                    return false;
                }

                // if(!submited && check_spec_value()){
                //     submited = true;
                //     form.submit();
                //     $(this).attr('disabled', "true");
                // }else{
                //     return false;
                // }
            }
        });


        //新旧地址选择
        $('.address_control').click(function(){

            var dataType=$(this).attr('data-type');
            $('.address_content[data-type="'+dataType+'"]').show();
            $('.address_content[data-type!="'+dataType+'"]').hide();
            $(this).addClass('select');
            $(this).siblings('.address_control').removeClass('select');
            if(dataType=='new'){
                $('input[name=address_id][value="0"]').trigger('click');
            }else{
                if(''!==''){
                    $('input[name=address_id][value=""]').trigger('click');
                }else{
                    $('input[name=address_id]:first').trigger('click');
                }
            }
        });

        //jquery控制ifreame自适应高度
        $("#iframepage").load(function(){
            var mainheight = $(this).contents().find("body").height();
            $(this).height(mainheight);
        });

    });


    //新地址检验
    function check_contact(){
        var result = true;
        if($('input[name=address_id]:checked').val()=='0'){
            //联系人
            if($.trim($("input[name='new_address[owner]']").val()) == ''){
                show_notice('请填写新地址联系人');
                $('#newAddressOwner').trigger('focus');
                result = false;
            }else{
                //手机号
                var value = $("input[name='new_address[tel]']").val();
                if($.trim(value) == ''){
                    show_notice('新联系人电话不能为空');
                    $('#newAddressTel').trigger('focus');
                    result = false;
                }else{
                    var tel = /^\d{3,4}[\-\d]{7,11}$/;
                    var mobile = /^1[3-8]+\d{9}$/;
                    if(!(tel.test(value) || (value.length == 11 && mobile.test(value)))){
                        show_notice('新联系电话的格式不正确, ');
                        $('#newAddressTel').trigger('focus');
                        result = false;
                    }else{
                        if(!$('.region_id[name="new_address[region_id]"]').val()){
                            //region
                            var region_id=$("input[name='new_address[region_id]']").val();
                            if(region_id==''){
                                show_notice('新联系人地区不能为空');
                                $('#newAddressAddress').trigger('focus');
                                result = false;
                            }else{
                                if(!$.trim($("input[name='new_address[address]']").val())){
                                    show_notice('请填写新地址具体地址');
                                    $('#newAddressAddress').trigger('focus');
                                    result = false;
                                }
                            }
                        }
                    }
                }
            }
        }
        return result;
    }

    //规格检验
    function check_spec_input(){
        var result = true;
        var msg = '';
        var count = 0;

        $('#specs_input_div').children().each(function(){
            $(this).find('input').each(function(){
                //判断采购量
                var value = $.trim($(this).val());
                var fake_name = $(this).attr('fake_name');
                if($(this).attr('fake_name') == 'requirement_spec[num][]'){
                    if(value == ''){
                        result = false;
                        msg = '请填写采购量';
                    }else if(!$.isNumeric(value)){
                        result = false;
                        msg = '采购量必须是数字';
                    }
                }else{
                    if($(this).attr('fake_name') != 'requirement_spec[unit][]'){
                        if(value != ''){
                            if(!$.isNumeric(value)){
                                result = false;
                                msg = '规格属性值必须是数字';
                            }else{
                                count++;
                            }
                        }
                    }
                }
            });
        });

        if(count == 0){
            result = false;
            msg = '每个规格至少填写一项属性';
        }

        if(msg != ''){
            layer.open({content:msg, time:2});
        }
        return result;
    }

    function check_spec_value(){
        if($("#specs_value_div").children().length < 2){
            layer.open({content:"请至少添加一个规格", time:2});
            return false;
        }else{
            return true;
        }
    }

</script>
<script type="text/javascript" src="/js/my_requirement.form.new.js?{{time()}}"></script>


<form action="/want/fabu" method="post" id="requirement_form" enctype="multipart/form-data">

{{csrf_field()}}
<input type="hidden" name="out_trade_no" value="{{$out_trade_no}}">
    <div class="padding_flanks bg-fff bd_bottom-eee">
	        <div class="form_item">
                <span class="font_3r color_34 goods_name-title">用苗地</span>
                <!--<label style=""><input id="bxian" name="miaoy" type="radio"/>不限</label>-->
                <label style="font-size: 10px"><input id="zdy" name="miaoy" type="radio" onclick="$('#zdytxt').css('display','inline');$('#region_name_select').css('display','none')" value="1"/>自定义 <input id="zdytxt" class="color_67  border_none" type="text" style="display: none;font-size: 10px" /></label>
                <label style="font-size: 10px"><input id="xdq" name="miaoy" type="radio" onclick="$('#region_name_select').click();$('#zdytxt').css('display','none');$('#region_name_select').css('display','inline')" value='2'/>选地区
                    <input class="color_67  border_none" style="display: inline;font-size: 10px" type="text" name="region_name_select" id="region_name_select" placeholder="" value=""/>
                </label>
                <input type="hidden" name="from_region_id" id="from_region_id" value="" class="region_id" />
                <input type="hidden" name="from_region_id_full" id="from_region_id_full" value="" class="region_id" />
                <input type="hidden" name="from_region_names" id="from_region_names" value="" class="region_names" />
            </div>
		<div class="form_item border_none">
            <span class="font_3r color_34 goods_name-title">商品种类</span>
            <a href="#" class="color_67 font_26r">
                <input class="color_67  border_none font_26r goods_kind" type="text"   name="gcategory_full_text" id="gcategory_full_text" placeholder="请选择商品种类" value=""/>
                <!-- <input type="hidden" id="gcategory_full_id" value=",,"/> -->
                <input type="hidden" id="gcategory_full_id" value=",,"/>
                <b class="iconfont select_arrows-icon">&#xe614;</b>
            </a>
            <input type="hidden" name="cate_id" id="cate_id" value=""/>
            <input type="hidden" name="cate_name" id="cate_name" value=""/>
        </div>

        <div class="form_item">
            <span class="font_3r color_34 goods_name-title">求购标题</span>
            <input class="color_67  border_none font_26r goods_name" type="text" name="title" id="title" value="" placeholder='请输入求购标题'/>
        </div>
         <!-- <div class="form_item">
            <span class="font_3r color_34 goods_name-title">求购数量</span>
            <input class="color_67  border_none font_26r goods_name" type="text" name="title" id="title" value="" placeholder='请输入求购数量'/>
        </div> -->
    </div>

    <div class="user_store bg-fff padding_flanks bd_top_bottom-eee">
        <div class="form_item">
            <span class="font_3r color_34 goods_name-title">商品规格</span>
            <a href="#" class="font_26r" id="goods_specification">
                <span class="color_9a">添加商品规格</span>
                <b class="iconfont select_arrows-icon color_02c5a3">&#xe604;</b>
            </a>
        </div>
        <div class="form_item">
                <span class="font_3r color_34 goods_name-title">截止日期</span>
                <a href="#" class="color_67 font_26r">
                    <input class="color_67  border_none font_24r goods_kind" type="text" readonly="readonly" name="expire_options" id="expire_options" placeholder="请选择截止日期" value="">
                    <input type="hidden" id="expire_option_id" value="1">
                    <input type="hidden" id="expire" name="expire" default_value="" value="2017-11-17">
                    <b class="iconfont select_arrows-icon"></b>
                </a>
            </div>
        <!-- <div class="form_item">
            <span class="font_3r color_34 goods_name-title">悬赏加急</span>

            <label style="font-size: 10px"><input  name="emergency" type="radio" value='1'/>是</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <label style="font-size: 10px"><input  name="emergency" type="radio" value='0'/>否
            </label>

        </div> -->
        <div class="bg-fff last_child-border" id="specs_value_div">
            <div class="goods_norms_con clearfix font_26r color_67">
                            </div>
                    </div>
    </div>









    <div class="user_store bg-fff padding_flanks bd_top_bottom-eee padding_bottom">


            <div class="form_item">
                <span class="font_3r color_34 goods_name-title">联系人</span>
                <a href="#" class="color_67 font_26r">
                    <input class="color_67  border_none font_24r goods_kind" type="text"  readonly name="address_options" id="address_options" placeholder="请选择联系人" value=""/>
                    <input type="hidden" id="address_id" name="address_id" value=""/>
                    <!-- <input type="hidden" id="address_phone" name="address_phone" value=""/> -->
                    <b class="iconfont select_arrows-icon">&#xe614;</b>
                </a>
            </div>

            <div class="upimg padding_flanks margin_bottom_16" >

                <input type="text" name="compressValue" id="compressValue" style="display:none;" value=""/><br/>
                <div id="upimgs" style="position: relative;    width: auto;    height: 11rem;margin-bottom:60px;">
                    <a href="javascript:;" class="file">
                        <input id="file_upload" type="file" name="imgs" multiple="multiple" accept="image/*;capture=camera">
                    </a>
                </div>
                <!--	<img src="" id='show' style="width: 30%;height: 14rem;">-->
                <div id="imglist"></div>
            </div>
        <div class="padding_top_bottom">
            <textarea name="description" class="add_remarks bg-f8 text_center font_28r" placeholder="添加备注"></textarea>
        </div>

    </div>










    <div class="buy_release_btn text_center padding_flanks">
        <button class="footer_btn color_fff bg-02c5a3" type="submit">确定发布</button>
    </div>

    <div class="mask_layer" id="mask_layer" style="display: none">

        <div class="goods_specification-container" style="display: none">
            <header class="user_center_header">
                <a class="header_abolish color_67 font_3r" onclick="$('.goods_specification-container').hide();close_popup();">取消</a>
                <h1>商品规格</h1>
                <a class="univalence_affirm_btn font_3r">确认</a>
            </header>
				<div class="bg-fff padding_flanks" id="specs_input_div">
					<div class="specification">
						<span class="font_3r fontWeight_5 color_34 specification_name">
							高度(厘米)
						</span>
						<span class="font_24r fontWeight_5 color_34 fr">
							以上
						</span>
						<input class="color_9a  border_none font_24r fr" type="number" fake_name="requirement_spec[attr][9][]"
						value="" attr_id="9" placeholder="请填写高度">
					</div>
					<div class="specification">
						<span class="font_3r fontWeight_5 color_34 specification_name">
							米径(厘米)
						</span>
						<span class="font_24r fontWeight_5 color_34 fr">
							以上
						</span>
						<input class="color_9a  border_none font_24r fr" type="number" fake_name="requirement_spec[attr][29][]"
						value="" attr_id="29" placeholder="请填写米径">
					</div>
					<div class="specification">
						<span class="font_3r fontWeight_5 color_34 specification_name">
							地径(厘米)
						</span>
						<span class="font_24r fontWeight_5 color_34 fr">
							以上
						</span>
						<input class="color_9a  border_none font_24r fr" type="number" fake_name="requirement_spec[attr][31][]"
						value="" attr_id="31" placeholder="请填写地径">
					</div>
					<div class="specification">
						<span class="font_3r fontWeight_5 color_34 specification_name">
							冠幅(厘米)
						</span>
						<span class="font_24r fontWeight_5 color_34 fr">
							以上
						</span>
						<input class="color_9a  border_none font_24r fr" type="number" fake_name="requirement_spec[attr][51][]"
						value="" attr_id="51" placeholder="请填写冠幅">
					</div>
					<div class="form_item">
						<span class="font_3r fontWeight_5 color_34 goods_name-title">
							采购数量
						</span>
						<span class="fr text_right">
							<input type="text" class="buy_release_num font_28r text_right" fake_name="requirement_spec[num][]"
							value="">
							<input type="hidden" class="buy_release_num font_28r text_center requirement_unit"
							fake_name="requirement_spec[unit][]" value="棵">
						</span>
					</div>
				</div>

        </div>
    </div>
</form>



<script>

function uploadBtnChange(){
    var scope = this;
    if(window.File && window.FileReader && window.FileList && window.Blob){
        //获取上传file
        var filefield = document.getElementById('file_upload'),
            file = filefield.files[0];
        //获取用于存放压缩后图片base64编码
        var compressValue = document.getElementById('compressValue');
        processfile(file,compressValue);
    }else{
        alert("此浏览器不完全支持压缩上传图片");
    }
}

function processfile(file,compressValue) {
    var reader = new FileReader();
    reader.onload = function (event) {
        var blob = new Blob([event.target.result]);
        window.URL = window.URL || window.webkitURL;
        var blobURL = window.URL.createObjectURL(blob);
        var image = new Image();
        image.src = blobURL;
        image.onload = function() {
            var resized = resizeMe(image);
            compressValue.value = resized;
        }
    };
    reader.readAsArrayBuffer(file);
}

function resizeMe(img) {
    //压缩的大小
    var max_width = 1920;
    var max_height = 1080;

    var canvas = document.createElement('canvas');
    var width = img.width;
    var height = img.height;

    if(width > height) {
        if(width > max_width) {
            height = Math.round(height *= max_width / width);

            width = max_width;

        }
    }else{
        if(height > max_height) {
            width = Math.round(width *= max_height / height);
            height = max_height;
        }
    }
    console.log('width:'+width+'||height'+height)
    canvas.width = width;
    canvas.height = height;

    var ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0, width, height);
    //压缩率
    return canvas.toDataURL("image/jpeg",0.7);
}

    //商品规格输入
    $("#goods_specification").click(function(){
        popup_bg();
        $(".goods_specification-container").show();
    });
    //关闭商品规格弹出
    $(".univalence_affirm_btn").click(function(){
        //添加规格
        var attribute_values = "";
        var test_passed = check_spec_input();
        if(test_passed){
            $("#specs_input_div").children().each(function(){
                attribute_values += "<span>";
                var inputs = $(this).find('input');
                for(var i=0; i < inputs.length; i++){
                    var input = inputs[i];
                    var input_name = $(input).attr('fake_name');
                    var input_value = $.trim($(input).val());
                    var input_value_display = input_value != '' ? input_value : '&nbsp;';
                    var input_tpl = _.template(general_input_tpl);
                    if($(input).attr('type') == 'text' || $(input).attr('type') == 'number'){
                        attribute_values += input_value_display;
                    }
                    attribute_values += input_tpl({type:'hidden', name:input_name, value:input_value});
                }
                attribute_values += '</span>';
            });

            var tpl_tmp = _.template(spec_value_line_tpl);
            $("#specs_value_div").append(tpl_tmp({attribute_values:attribute_values}));

            $(".goods_specification-container").hide();
            close_popup();
        }

    });
    $("#file_upload").change(function() {

                uploadBtnChange();
                $('.file').hide();
				// $('.file').css('background', 'url(/images/upbutton.png)  no-repeat');
				// $('.file').css('width', '100%');
				// $('.file').css('height', '11rem');
				// $('.file').css('background-size', '80% 80%');
				// $('.file').css('top', '0.5rem');

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
					var html = '<img src="' + dataURL + '" class="imgs" id="imgs_' + valuenum + '" onclick="showimg(' + valuenum + ')" style=""/>';
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
                // var copy = $('.file');
                // $('#file_upload').hide();
                // $('#file_upload').after('<input id="file_upload" type="file" name="imgs[]" multiple="multiple" accept="image/*;capture=camera">');
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
</body>
</html>
