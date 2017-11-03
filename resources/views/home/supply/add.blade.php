<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>发布悬赏处理</title>
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
<!-- <script type="text/javascript" src="/js/ueditor.config.js"></script>
<script type="text/javascript" src="/js/ueditor.all.min.js"></script> -->
<script type="text/javascript">

// $(function(){
//     var ue=UE.getEditor('description',{
// 			iframeCssUrl:"http://www.huamu.com/themes/mobile/store/default/styles/default/css.css",
//             //这里可以选择自己需要的工具按钮名称,此处仅选择如下五个
//             toolbars:[["fullscreen","source","|","fontfamily","fontsize","bold","forecolor","backcolor","link","|","justifyleft","justifycenter","justifyright"]],
//             imageUrl:"./index.php?app=comupload&act=uploadedfile&flag=ue&belong=22", //图片上传接口
//             imagePath: "http://img.huamu.com/",
//             imageManagerUrl:SITE_URL + "/index.php?app=comupload&act=manage_ue_/images/",       //图片在线管理的处理地址
//             imageManagerPath:SITE_URL + "/",
//             //focus时自动清空初始化时的内容
//             autoClearinitialContent:false,
//             //关闭字数统计
//             wordCount:false,
//             //自动粘贴为纯文本
//             pasteplain:true,
//             //关闭elementPath
//             elementPathEnabled:false,
//             //默认的编辑区域高度
//             initialFrameHeight:200
//             //更多其他参数，请参考ueditor.config.js中的配置项
//     });
//
//
// });

</script><style>
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
    <h1>发布商品</h1>
</header>
<form id="goods_form" method="POST" style="padding-top:1rem;">
	<img src="/images//scan.jpg" width=100%>
    <div class="padding_flanks">
        <div class="form_item">
            <span class="font_3r color_34 goods_name-title">商品名称</span>
            <input class="color_67  border_none font_24r goods_name" type="text" name="goods_name" id="goods_name" placeholder="请输入您的商品名称" value=""/>
        </div>
        <div class="form_item">
            <span class="font_3r color_34 goods_name-title">商品种类</span>
            <a href="#" class="color_9a font_24r">
                <input class="color_67  border_none font_24r goods_kind" readonly type="text"   name="gcategory_full_text" id="gcategory_full_text" placeholder="请选择商品种类" value="" onclick="$('#wap_description').css('display','none');"/>
                <input type="hidden" id="gcategory_full_id" value=",,"/>
                <b class="iconfont select_arrows-icon">&#xe614;</b>
            </a>
            <input type="hidden" name="cate_id" id="cate_id" />
            <input type="hidden" name="cate_name" id="cate_name" />
        </div>
        <div class="form_item bg-fff">
            <span class="font_3r color_34 goods_name-title">商品规格</span>
            <a href="#" class="color_9a font_24r" id="goods_specification" onclick="$('#wap_description').css('display','none');">
                <span>请填写商品规格</span>
                <b class="iconfont select_arrows-icon">&#xe614;</b>
            </a>
        </div>
        <div class="bg-fff last_child-border" id="specs_value_div" style="display:none;">
            <div class="goods_norms_con clearfix font_26r" id="specs_value_div_header">
            </div>
            <div class="goods_norms_con clearfix font_26r" id="specs_value_div_body">
            </div>
        </div>
        <div class="form_item">
            <span class="font_3r color_34 goods_name-title">商品单价</span>
            <a href="#" class="color_67 font_24r" id="goods_univalence" onclick="$('#wap_description').css('display','none');">
                <span>请填写商品单价及起售数量</span>
                <b class="iconfont select_arrows-icon">&#xe614;</b>
            </a>
        </div>
        <div class="form_item">
            <span class="font_3r color_34 goods_name-title">供货量</span>
                        <input item="stock"  class="color_9a  border_none font_24r goods_name spec_attr_input" type="text" name="stock[]" empty_name="stock[]" placeholder="请填写您的供货量" value=""/>
                    </div>
        <div class="form_item">
            <span class="font_3r color_34 goods_name-title">截止日期</span>
            <a href="#" class="color_9a font_24r">
                <input class="color_67  border_none font_24r goods_kind" type="text"  readonly="readonly" name="expire_options" id="expire_options" placeholder="请选择截止日期" value="" onclick="$('#wap_description').css('display','none');"/>
                <input type="hidden" id="expire_option_id" value="6"/>
                <input type="hidden" id="expire" default_value="" value=""/>
                <b class="iconfont select_arrows-icon">&#xe614;</b>
            </a>
        </div>
        <div class="form_item" id="baseaddress_block">
            <span class="font_3r fontWeight_5 color_34 goods_name-title">基地</span>
            <a href="#" class="color_9a font_24r">
                <input class="color_9a  border_none font_24r goods_kind" type="text"  readonly="readonly" name="baseaddress_options" id="baseaddress_options" placeholder="请选择基地" value="" onclick="$('#wap_description').css('display','none');"/>
                <input type="hidden" id="baseaddress_id" value=""/>
                <b class="iconfont select_arrows-icon">&#xe614;</b>
            </a>
        </div>
        <div id="wap_description" style="display: block">
            <div style="color: red;position: relative;top:0px;font-size: small">(必填项，优秀的商品描述为，①该苗木品种介绍②基地的优势介绍③内容排版美观。)</div>
        <textarea class="goods_detailed_information"  name="description" id="description"  placeholder="请添加您的商品的具体信息，如：商品特色、种植情况 包装及杂费情况等"></textarea>
        </div>
        <ul class="sell_goods_img-list clearfix">
                        <li id="image_upload_notice" style="display:none;">
                <img src="/images//loading.gif" alt="上传" />
            </li>

            <input type="hidden" name="is_uploaded" id="is_uploaded" value="" />
        </ul>
    </div>


    <div class="mask_layer" id="mask_layer" style="display: none">


        <div class="goods_univalence-container" style="display: none;padding-top:44px;">
            <header class="user_center_header">
                <a class="header_abolish color_67 font_3r" onclick="$('.goods_univalence-container').hide();close_popup();$('#wap_description').css('display','block');">取消</a>
                <h1>商品单价</h1>
                <a class="univalence_affirm_btn font_3r" id="univalence_btn" onclick="$('#wap_description').css('display','block');">确认</a>
            </header>
            <div>
                <div class="clearfix univalence_input_container bg-fff">
                                        <input type="number" item="price" class="fl font_26r color_34 spec_attr_input" name="price[]" empty_name="price[]" placeholder="点这里填写单价"/>
                                        <span class="fr font_26r color_34">元/
                        <input class="units" id="goods_unit_btn" type="button" value=""/>
                        <input type="hidden" id="goods_unit" name="goods_unit" value=""/>
                        <b class="iconfont">&#xe6a0;</b></span>
                </div>
                                <div class="clearfix univalence_input_container bg-fff">
                                        <input type="number" class="fl font_24r color_34 spec_attr_input" name="minimum[]" empty_name="minimum[]" placeholder="点这里填写起售数量"/>
                                        <span class="fr font_24r color_34">起售</span>
                </div>
            </div>

        </div>

        <div class="goods_specification-container" style="display: none;padding-top:44px;">
            <header class="user_center_header">
                <a class="header_abolish color_67 font_3r" onclick="$('.goods_specification-container').hide();close_popup();$('#wap_description').css('display','block');">取消</a>
                <h1>商品规格</h1>
                <a class="univalence_affirm_btn font_3r" id="spec_confirm_btn" onclick="$('#wap_description').css('display','block');">确认</a>
            </header>
            <div class="bg-fff padding_flanks" id="spec_editor">
				<div class="specification">
					<span class="font_3r color_34 specification_name">高度(厘米)</span><span class="font_24r fontWeight_5 color_34 fr">以上</span><input class="color_9a border_none font_24r fr" type="number" name="spec_attr_9[]" empty_name="spec_attr_9[]" value="" attr_id="9" placeholder="请填写高度">
				</div>
				<div class="specification">
					<span class="font_3r color_34 specification_name">米径(厘米)</span><span class="font_24r fontWeight_5 color_34 fr">以上</span><input class="color_9a border_none font_24r fr" type="number" name="spec_attr_29[]" empty_name="spec_attr_29[]" value="" attr_id="29" placeholder="请填写米径">
				</div>
				<div class="specification">
					<span class="font_3r color_34 specification_name">地径(厘米)</span><span class="font_24r fontWeight_5 color_34 fr">以上</span><input class="color_9a border_none font_24r fr" type="number" name="spec_attr_31[]" empty_name="spec_attr_31[]" value="" attr_id="31" placeholder="请填写地径">
				</div>
				<div class="specification">
					<span class="font_3r color_34 specification_name">冠幅(厘米)</span><span class="font_24r fontWeight_5 color_34 fr">以上</span><input class="color_9a border_none font_24r fr" type="number" name="spec_attr_51[]" empty_name="spec_attr_51[]" value="" attr_id="51" placeholder="请填写冠幅">
				</div>
			</div>
            <div id="spec_attr_items">

            </div>
        </div>
			<div class="ui-dialog ui-dialog-bottom" id="dialog_00445768217616882" style="z-index: 100; display: none; height: 215px; width: 100%; position: fixed; top: auto; left: 0px; bottom: 0px;">
				<span class="ui-dialog-close js-dialog-close">x</span>
				<div style="display: none;">
					<table class="ui-dialog-action">
					<tbody>
					<tr>
						<td>
							<button class="ui-confirm-no" data-type="no">取消</button>
						</td>
						<td>
							<button class="ui-confirm-submit " data-type="yes">确定</button>
						</td>
					</tr>
					</tbody>
					</table>
					<div class="ui-confirm-title">
						<div class="ui-scroller-mask">
							<div id="scroller_03253216776680228" class="ui-scroller">
								<div>
									<dl style="top: 30px;">
										<dd pid="0" class="undefined" ref="1">绿化苗木</dd><dd pid="0" class="" ref="2">盆景绿植</dd><dd pid="0" class="" ref="19678">其它苗木</dd><dd pid="0" class="" ref="22746">鲜花配花</dd><dd pid="0" class="" ref="3">资材配套</dd>
									</dl>
								</div>
								<div>
									<dl style="top: 30px;">
										<dd pid="0" class="undefined" ref="9">常绿乔木</dd><dd pid="0" class="" ref="11">常绿灌木</dd><dd pid="0" class="" ref="10">落叶乔木</dd><dd pid="0" class="" ref="12">落叶灌木</dd><dd pid="0" class="" ref="14">彩叶苗木</dd><dd pid="0" class="" ref="16">球类苗木</dd><dd pid="0" class="" ref="7">花类苗木</dd><dd pid="0" class="" ref="15">果树苗木</dd>
									</dl>
								</div>
								<div>
									<dl style="top: 30px;">
										<dd pid="0" class="undefined" ref="10678">红豆杉</dd><dd pid="0" class="" ref="10674">雪松</dd><dd pid="0" class="" ref="10684">桂花</dd><dd pid="0" class="" ref="10671">罗汉松</dd><dd pid="0" class="" ref="10676">白皮松</dd><dd pid="0" class="" ref="10719">苦丁茶</dd><dd pid="0" class="" ref="10715">花梨木</dd><dd pid="0" class="" ref="10752">杨梅</dd><dd pid="0" class="" ref="10670">香樟</dd><dd pid="0" class="" ref="10698">油茶</dd><dd pid="0" class="" ref="10690">金丝楠</dd><dd pid="0" class="" ref="10722">樟子松</dd><dd pid="0" class="" ref="10755">香榧</dd><dd pid="0" class="" ref="10747">棕榈</dd><dd pid="0" class="" ref="10683">大叶女贞</dd><dd pid="0" class="" ref="10727">黑松</dd><dd pid="0" class="" ref="10686">广玉兰</dd><dd pid="0" class="" ref="10702">侧柏</dd><dd pid="0" class="" ref="10750">石楠</dd><dd pid="0" class="" ref="23946">火焰木</dd><dd pid="0" class="" ref="23947">水蜡球</dd><dd pid="0" class="" ref="23957">川柏</dd><dd pid="0" class="" ref="24036">黄花楹</dd><dd pid="0" class="" ref="24037">塔柏</dd><dd pid="0" class="" ref="10673">龙柏</dd><dd pid="0" class="" ref="26696">杜松</dd><dd pid="0" class="" ref="24165">土石楠</dd><dd pid="0" class="" ref="10685">香泡</dd><dd pid="0" class="" ref="10726">云杉</dd><dd pid="0" class="" ref="10679">油松</dd><dd pid="0" class="" ref="10761">苏铁</dd><dd pid="0" class="" ref="10720">马尾松</dd><dd pid="0" class="" ref="10731">竹柏</dd><dd pid="0" class="" ref="10672">五针松</dd><dd pid="0" class="" ref="10714">秋枫</dd><dd pid="0" class="" ref="10677">弗吉尼亚</dd><dd pid="0" class="" ref="10687">杜英</dd><dd pid="0" class="" ref="10682">乐昌含笑</dd><dd pid="0" class="" ref="10737">桧柏</dd><dd pid="0" class="" ref="10753">枇杷树</dd><dd pid="0" class="" ref="10721">华山松</dd><dd pid="0" class="" ref="10689">羊蹄甲</dd><dd pid="0" class="" ref="10718">天竺桂</dd><dd pid="0" class="" ref="10681">日本红枫</dd><dd pid="0" class="" ref="10734">红果冬青</dd><dd pid="0" class="" ref="10680">蜀桧</dd><dd pid="0" class="" ref="10730">金合欢</dd><dd pid="0" class="" ref="10691">红千层</dd><dd pid="0" class="" ref="10743">加拿利海枣</dd><dd pid="0" class="" ref="10697">油橄榄</dd><dd pid="0" class="" ref="10760">湿地松</dd><dd pid="0" class="" ref="10754">深山含笑</dd><dd pid="0" class="" ref="10748">木荷</dd><dd pid="0" class="" ref="10700">桢楠</dd><dd pid="0" class="" ref="10701">黄桷树</dd><dd pid="0" class="" ref="10723">木麻黄</dd><dd pid="0" class="" ref="10704">人面子</dd><dd pid="0" class="" ref="10744">青枫</dd><dd pid="0" class="" ref="10740">中东海枣</dd><dd pid="0" class="" ref="10708">格木</dd><dd pid="0" class="" ref="10692">水松</dd><dd pid="0" class="" ref="10699">椤木石楠</dd><dd pid="0" class="" ref="10717">细叶榕</dd><dd pid="0" class="" ref="10694">海南蒲桃</dd><dd pid="0" class="" ref="10729">红花木莲</dd><dd pid="0" class="" ref="10757">铅笔柏</dd><dd pid="0" class="" ref="10732">日本冷杉</dd><dd pid="0" class="" ref="10709">红翅槭</dd><dd pid="0" class="" ref="10696">五桠果</dd><dd pid="0" class="" ref="10724">乳源木莲</dd><dd pid="0" class="" ref="10716">假槟榔</dd><dd pid="0" class="" ref="10706">海南红豆</dd><dd pid="0" class="" ref="10705">桃花芯木</dd><dd pid="0" class="" ref="10688">金球桂</dd><dd pid="0" class="" ref="10693">黄金香柳</dd><dd pid="0" class="" ref="10758">圆柏</dd><dd pid="0" class="" ref="10756">日本柳杉</dd><dd pid="0" class="" ref="10675">中山杉</dd><dd pid="0" class="" ref="10703">老人葵</dd><dd pid="0" class="" ref="10695">红花玉蕊</dd><dd pid="0" class="" ref="10759">日本花柏</dd><dd pid="0" class="" ref="10751">蚊母树</dd><dd pid="0" class="" ref="10710">刨花楠</dd><dd pid="0" class="" ref="10707">霸王棕</dd><dd pid="0" class="" ref="10733">乐东拟单</dd><dd pid="0" class="" ref="10735">香港四照</dd><dd pid="0" class="" ref="10736">地龙柏</dd><dd pid="0" class="" ref="10725">红楠</dd><dd pid="0" class="" ref="10738">国皇椰子</dd><dd pid="0" class="" ref="10739">皇后葵</dd><dd pid="0" class="" ref="10741">华盛顿棕</dd><dd pid="0" class="" ref="10742">布迪椰子</dd><dd pid="0" class="" ref="10713">阴香</dd><dd pid="0" class="" ref="11223">其它常绿</dd><dd pid="0" class="" ref="10746">构骨</dd><dd pid="0" class="" ref="10712">盆架子</dd><dd pid="0" class="" ref="10711">山矾</dd><dd pid="0" class="" ref="10749">银荆</dd><dd pid="0" class="" ref="10728">醉香含笑</dd>
									</dl>
								</div>
								<p>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
    </div>
    <input type="hidden" id="goods_id" name="goods_id" value="">
    <input type="hidden" name="if_show" value="1">
    <input type="hidden" name="recommended" value="1">
    <div class="buy_release_btn text_center padding_flanks">
        <button class="footer_btn color_fff bg-02c5a3" type="submit">确定发布</button>
    </div>
</form>

<script>
    var page_initialized = false;

    var goods_id = '0';

    //过期时间
    var expire_options = [];
    if(goods_id != '0'){
        expire_options.push({id:-1,name:""});
    }
    expire_options.push({id:1,name:"一天"});
    expire_options.push({id:2,name:"三天"});
    expire_options.push({id:3,name:"一周"});
    expire_options.push({id:4,name:"一个月"});
    expire_options.push({id:5,name:"三个月"});
    expire_options.push({id:6,name:"半年"});
    expire_options.push({id:7,name:"一年"});

    //单位
    var goods_unit_options = [{"id":"\u4ef6","name":"\u4ef6"},{"id":"\u68f5","name":"\u68f5"},{"id":"\u76c6","name":"\u76c6"},{"id":"\u7c73","name":"\u7c73"},{"id":"\u5398\u7c73","name":"\u5398\u7c73"},{"id":"\u514b","name":"\u514b"},{"id":"\u5343\u514b","name":"\u5343\u514b"},{"id":"\u5428","name":"\u5428"},{"id":"\u679d","name":"\u679d"}];

    //商品分类
    var gcategory_data_url = "/api/kinds";
    var gcategory_search_url = "/index.php?app=mlselection&act=gcategory_breadpiece&keyword=";
    var gcategory_data = [];

    //此处必须用localStorage
    localStorage.setItem('gcategory_old_value', '[]');

    var edit_baseaddress_id = '';
    var goods_specs_old = {"spec_qty":0,"spec_1_name":"\u81ea\u5b9a\u4e491","spec_2_name":"\u81ea\u5b9a\u4e492","specs":null};
    var goods_spec_attr_1_old = "";
    var goods_spec_attr_2_old = "";
    var goods_spec_attr_3_old = "";
    var goods_spec_attr_4_old = "";
    var goods_spec_attr_5_old = "";

    var attrs_total = 0;


    //滑动选择插件
    var gcategorySelect = new MobileSelectArea();
    var expireSelect = new MobileSelectArea();
    var unitSelect = new MobileSelectArea();

    //商品属性数据
    var goods_attr_data = new Array();


    //模板
    var gcategory_attribute_text_tpl = '' +
            '<div class="specification">' +
            '<span class="font_3r color_34 specification_name">{attr_name}({unit})</span>' +
            ' <span class="font_24r fontWeight_5 color_34 fr">以上</span>' +
            ' <input class="color_9a  border_none font_24r fr" type="number" name="spec_attr_{attr_id}[{spec_id}]" empty_name="spec_attr_{attr_id}[]" class="spec_attr_input mobiselect_item" value="{default_value}" attr_id="{attr_id}" placeholder="请填写{attr_name}"/> </div>';
    var gcategory_attribute_select_tpl = '' +
            '<div class="specification">' +
            '<span class="font_3r color_34 specification_name">{attr_name}</span> ' +
            ' <input class="color_9a  border_none font_24r fr" type="text" name="spec_attr_{attr_id}_text" id="spec_attr_{attr_id}_text" value="{default_value}"/>' +
            '<input type="hidden" name="spec_attr_{attr_id}[{spec_id}]" empty_name="spec_attr_{attr_id}[]" class="spec_attr_input mobiselect_item" id="spec_attr_{attr_id}_val" attr_id="{attr_id}" value="{default_value}"/>' +
            '</div>';
    var goods_uploaded_img_tpl = '<li ectype="handle_pic" file_id="{file_id}" thumbnail="{thumbnail}"> <img src="/images//afd736a71c714714aa99f1297d56f12f.gif" alt="" /> <input type="hidden" name="goods_file_id[]" value="{file_id}" /> <span class="iconfont close-x del_img" onclick="drop_image({file_id})">&#xe66f;</span> </li>';

    var baseaddress_list_json = [{"baseaddress_id":"35870","name":"\u9ed8\u8ba4\u57fa\u5730","region_id":"350503008","region_name":"\u798f\u5efa \u6cc9\u5dde \u4e30\u6cfd \u5317\u5cf0\u8857\u9053 ","detail":"\u6e05\u6e90\u5c71\u82b1\u535a\u56ed\u4e00\u671f","user_id":"0","store_id":"90714","lon":"118.580475","lat":"24.937429","first_letter":"","pinyin":"","main_goods":"","squre":"","phone":"","contact_name":"","region":["\u798f\u5efa","\u6cc9\u5dde","\u4e30\u6cfd","\u5317\u5cf0\u8857\u9053"],"id":"35870"},{"baseaddress_id":"35871","name":"\u9ed8\u8ba4\u57fa\u5730","region_id":"350503008","region_name":"\u798f\u5efa \u6cc9\u5dde \u4e30\u6cfd \u5317\u5cf0\u8857\u9053 ","detail":"\u6e05\u6e90\u5c71\u82b1\u535a\u56ed\u4e00\u671f","user_id":"0","store_id":"90714","lon":"118.580475","lat":"24.937429","first_letter":"","pinyin":"","main_goods":"","squre":"","phone":"","contact_name":"","region":["\u798f\u5efa","\u6cc9\u5dde","\u4e30\u6cfd","\u5317\u5cf0\u8857\u9053"],"id":"35871"}];
    var EARTH_RADIUS = 6378137.0; //单位M
    var PI = Math.PI;

    var error_msg_showed = false;
    var error_msg = "";
    var submited = false;

    //表单验证
    $(function(){
        var validate_rules= {
            goods_name: {
                required: true
            },
            price: {
                number: true,
                required: function () {
                    return !($('input[name=price]').length > 0);
                },
                min: 0
            },
            stock: {
                digits: true
            },
            cate_id: {
                remote: {
                    url: 'index.php?app=my_goods&act=check_mgcate',
                    type: 'get',
                    data: {
                        cate_id: function () {
                            return $('#cate_id').val();
                        }
                    }
                }
            },
            is_uploaded: {
                required: true
            }
        };
        var validate_messages={
            goods_name: {
                required: '商品名称不能为空'
            },
            price: {
                number: '此项仅能为数字',
                required: '价格不能为空',
                min: '价格必须大于或等于零'
            },
            stock: {
                digits: '此项仅能为数字'
            },
            cate_id: {
                remote: '请选择商品分类（必须选到最后一级）'
            },
            is_uploaded: {
                required: '您需要至少上传一张图片'
            }
        };
                        $('#goods_form').validate({
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
                    success: function (element) {},
                    onkeyup : false,
                    onclick : false,
                    onfocusin : false,
                    onfocusout : false,
                    onblur  : false,
                    ignore: '',
                    rules: validate_rules,
                    messages: validate_messages,
                    submitHandler: function (form) {
                        //处理mobiselect插件的值
                        $(".mobiselect_item").each(function(){
                            var val_array = $(this).val().split(',');
                            $(this).val(val_array[0]);
                        });

                        if (!submited && check_number_value()   && check_main_spec('price') && check_main_spec('stock') && check_sys_spec() &&check_description()) {
                            submited = true;
                            form.submit();
                            $(this).attr('disabled', "true");
                        }
                        }
                        });

                        //基地相关 start
                        if(baseaddress_list_json.length==1){
                            //$("#baseaddress_block").hide();
                        }

                        //手机版，根据当前位置对基地列表按距离排序
                        //先获取地理位置信息
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(function (position) {
                                var lat = position.coords.latitude;
                                var lon = position.coords.longitude;
                                //根据地理位置谋算和基地的距离并对baseaddress_list_json重新排序
                                for (var i = 0; i < baseaddress_list_json.length; i++) {
                                    var baseaddress_list_a = baseaddress_list_json[i];
                                    var distance = get_great_circle_distance(lat, lon, baseaddress_list_a.lat, baseaddress_list_a.lon);
                                    baseaddress_list_json[i].distance = distance;
                                }
                                baseaddress_list_json.sort(array_resort_by_key('asc', 'distance'));
                                make_baseaddress_list_options(baseaddress_list_json);
                            }, function (error) {
                                make_baseaddress_list_options(baseaddress_list_json);
                            }, {
                                enableHighAccuracy: true,
                                maximumAge: 30000,
                                timeout: 2000
                            });
                        } else {
                            make_baseaddress_list_options(baseaddress_list_json);
                        }
                        //基地相关 end
                    });

                function set_cover(file_id) {
                    if (typeof (file_id) == 'undefined') {
                        $('#big_goods_image').attr('src', 'http://img.huamu.com/data/system/default_goods_image.png?x-oss-process=image/resize,w_2000,/watermark,image_ZGF0YS91cGxvYWQvY29tbW9uL3dhdGVybWFyay93bV9jb2xvci5wbmc_eC1vc3MtcHJvY2Vzcz1pbWFnZS9yZXNpemUsUF8zMA==');
                        return;
                    }
                    var obj = $('*[file_id="' + file_id + '"]');
                    $('*[file_id="' + file_id + '"]').clone(true).prependTo('#goods_/images/');
                    $('*[ectype="handler"]').hide();
                    $('#big_goods_image').attr('src', obj.attr('thumbnail'));
                    obj.remove();
                }

                function check_number_value() {
                    var allNum = true;
                    $('input.attr_number:visible').each(function(){
                        if($(this).val()!='' && !isNum($(this))){
                            allNum = false;
                            layer.open({content:'请输入正确的数字',time:2});
                            $(this).focus();
                        }
                    });
                    $('input.attr_number_range:visible').each(function(){
                        if($(this).val()!='' && !isNumRange($(this))){
                            allNum = false;
                            layer.open({content:'请输入正确的数字',time:2});
                            $(this).focus();
                        }
                    });
                    return allNum;
                }

                function check_main_spec(spec_item) {
                    var valid_rows = 0;
                    var err_flag = false;
                    var err_elem = undefined;
                    var err_msg = '';
                    var result = true;
                    $('input[item=' + spec_item + ']').each(function () {
                        var spec_cols = $(this).parent().siblings('li').children('input.text:visible');
                        var has_others = false;
                        for (var i = 0; i < spec_cols.length; i++) {
                            if ($.trim(spec_cols[i].value) != '') {
                                has_others = true;
                                break;
                            }
                        }
                        if ($.trim($(this).val()) != '' && !is_number_fi($(this).val())) {
                            err_flag = true;
                            err_elem = this;
                            err_msg = '请输入正确的数字';
                            return false;
                        }

                        var spec_item_value = parseFloat($(this).val());

                        if (spec_item_value > 0) {
                            valid_rows = valid_rows + 1;
                        }
                        if (has_others && ($.trim($(this).val()) == '' || spec_item_value == 0)) {
                            err_flag = true;
                            err_elem = this;
                            if (spec_item == 'price') {
                                err_msg = '价格必须大于零';
                            } else {
                                err_msg = '库存必须大于零';
                            }
                            return false;
                        }
                    });
                    if (err_flag) {
                        //$('#spec_err_msg').text(err_msg);
                        layer.open({content:err_msg,time:2});
                        err_elem.focus();
                        result = false;
                    } else if (valid_rows == 0) {
                        layer.open({content:'至少填写一个价格、库存和起售数',time:2});
                        $('input[item=' + spec_item + ']:eq(0)').focus();
                        result = false;
                    } else {
                        //$('#spec_err_msg').text('');
                        //form.submit();
                    }
                    return result;
                }

    //检查详情是否为空//2017-7-19
    function check_description(){
        var des = $("#description").val();
        //des = des.replace(/(^s*)|(s*$)/g, "");
        //console.log("des0="+des);
        des = des.replace(/<\/?[^>]*>/g,'');
        des = des.replace(/(^s*)|(s*$)/g, "");
        //console.log("des1="+des);
        des = des.replace(/&nbsp;/ig,'');
        //console.log("des2="+des);
        des = des.replace(/' '/,'');
        //console.log("des-length="+des.length);
        if(des.length==0 || des == ''){
            alert("商品描述不能为空");
            return false;
        }else{
            /* console.log("错误+="+des);
             return false;*/
            return true;
        }
    }

                //检查固有属性
                function check_sys_spec(){
                    var is_ok = true;
                    var msg = "规格中商品的固有属性（如胸径、高度等）至少需要填一项";
                    var is_all_empty = true;
                    var is_at_least_one = false;
                    var has_sys_spec = false;
                    var is_int_input = true;
                    var selected_attrs = 0;
                    $("#spec_editor").children().each(function(){
                        var this_input = $(this).find('input,select');
                        var spec_value = this_input.val();
                        var attr_id = this_input.attr('attr_id');

                        if(!_.isUndefined(spec_value) && spec_value!= ''){
                            selected_attrs += 1;
                            has_sys_spec = true;
                            is_all_empty = false;
                            is_at_least_one =  true;
                            var placeholder = this_input.attr('placeholder');
                            if(!_.isUndefined(placeholder)){
                                if(! number_reg.test(spec_value)){
                                    is_int_input = false;
                                    msg = "所填规格项必须为数字";
                                    //this_input.focus();
                                }
                            }
                        }else{
                            $("input[name='spec_attr_items[]']").each(function(){
                                if($(this).val() ==  attr_id){
                                    $(this).remove();
                                }
                            });
                        }
                    });
                    if(selected_attrs == 0 && attrs_total > 0){
                        msg = "规格中商品的固有属性（如胸径、高度等）至少需要填一项";
                    }
                    if((has_sys_spec && (!is_at_least_one || ! is_int_input) && !is_all_empty) || (selected_attrs == 0 && attrs_total > 0)){
                        layer.open({content:msg,time:2});
                        is_ok = false;
                    }
                    return is_ok;
                }

                function is_number_fi(v) {
                    return /^[+-]?([0-9]*\.?[0-9]+|[0-9]+\.?[0-9]*)([eE][+-]?[0-9]+)?$/.test(v);
                }

                function isNum(elem){
                    var re = /^[0-9]+\.?[0-9]*$/;
                    if (!re.test(elem.val()))
                    {
                        elem.focus();
                        return false;
                    }else{
                        return true;
                    }
                }
                function isNumRange(elem){
                    var re_range = /^[0-9]+\.?[0-9]?[-]+[0-9]+\.?[0-9]*$/;
                    var re = /^[0-9]+\.?[0-9]*$/;
                    if (!re.test(elem.val()) && !re_range.test(elem.val()))
                    {
                        elem.focus();
                        return false;
                    }else{
                        return true;
                    }
                }

</script>
<script type="text/javascript" src="/js/my_goods.form.new.js?{{time()}}"></script>

</body>
</html>
