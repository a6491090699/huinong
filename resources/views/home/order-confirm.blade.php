<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>确认收货人资料和送货方式 - 中国花木在线交易专业平台</title>
<meta name="keywords" content="竞苗平台,花木网,花木,中国苗木网,花木交易,花木求购,花木资讯,花木论坛,花木销售,绿化苗木" />
<meta name="description" content="竞苗平台，中国苗木网，中国花木在线交易专业平台，致力于为花木行业从业者提供更真实的花木在线交易平台，让您没有买不到的，没有卖不掉的。" />
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
<body class="bg-f8">
<script type="text/javascript">
    // var shippings = {"29653":{"shipping_id":"29653","store_id":"7239","shipping_name":"\u7269\u6d41","shipping_desc":"\u56e0\u975e\u6807\u51c6\u89c4\u683c\u5546\u54c1\uff0c\u914d\u9001\u8d39\u7528\u9ed8\u8ba4\u5230\u4ed8\uff0c\u5982\u9700\u8981\u5356\u5bb6\u652f\u4ed8\uff0c\u8bf7\u5148\u8054\u7cfb\u5356\u5bb6\u4fee\u6539\u8fd0\u8d39\u540e\u518d\u5b8c\u6210\u4ed8\u6b3e","first_price":"0.00","step_price":"0.00","cod_regions":null,"enabled":"1","sort_order":"4"},"29654":{"shipping_id":"29654","store_id":"7239","shipping_name":"\u5305\u8f66","shipping_desc":"\u56e0\u975e\u6807\u51c6\u89c4\u683c\u5546\u54c1\uff0c\u914d\u9001\u8d39\u7528\u9ed8\u8ba4\u5230\u4ed8\uff0c\u5982\u9700\u8981\u5356\u5bb6\u652f\u4ed8\uff0c\u8bf7\u5148\u8054\u7cfb\u5356\u5bb6\u4fee\u6539\u8fd0\u8d39\u540e\u518d\u5b8c\u6210\u4ed8\u6b3e","first_price":"0.00","step_price":"0.00","cod_regions":null,"enabled":"1","sort_order":"3"}};
    // // var addresses = {"4717":{"addr_id":"4717","user_id":"90714","consignee":"\u65b9\u680b","region_id":"130425203","region_name":"\u6cb3\u5317\t\u90af\u90f8\t\u5927\u540d\t\u9ec4\u91d1\u5824\u4e61","address":"\u5927\u6728\u82d7\u6728","zipcode":"","phone_tel":null,"phone_mob":"13505055427","is_default":"1"}};
    // var addresses = {!!$address_json!!};
    // var goods_amount = {{$buy_num}};
    // var goods_quantity = {{$item->number}};
    // var shipping_methods_json = [{"id":"29653","name":"\u7269\u6d41"},{"id":"29654","name":"\u5305\u8f66"}];
    // var payments_json = [{"id":"7261","name":"\u62c5\u4fdd\u652f\u4ed8","code":"assure"}];
    // $(function(){
    //     $('#order_form').validate({
    //         invalidHandler:function(e, validator){
    //             var err_count = validator.numberOfInvalids();
    //             var msg_tpl = '很抱歉，您填写的订单信息中有&nbsp;<strong>{0}</strong>&nbsp;个错误(如红色斜体部分所示)，请检查并修正后再提交！:)';
    //             var d = DialogManager.create('show_error');
    //             d.setWidth(400);
    //             d.setTitle(lang.error);
    //             d.setContents('message', {type:'warning', text:$.format(msg_tpl, err_count)});
    //             d.show('center');
    //         },
    //         errorPlacement: function(error, element){
    //             var _message_box = $(element).parent().find('.field_message');
    //             _message_box.find('.field_notice').hide();
    //             _message_box.append(error);
    //         },
    //         success       : function(label){
    //             label.addClass('validate_right').text('OK!');
    //         },
    //         rules : {
    //             consignee : {
    //                 required : true
    //             },
    //             region_id : {
    //                 required : true,
    //                 min   : 1
    //             },
    //             address   : {
    //                 required : true
    //             },
    //             phone_tel : {
    //                 required : check_phone,
    //                 minlength:6,
    //                 is_tel : true
    //             },
    //             phone_mob : {
    //                 required : check_phone,
    //                 minlength:6,
    //                 digits : true
    //             }
    //         },
    //         messages : {
    //             consignee : {
    //                 required : '请如实填写您的收货人姓名'
    //             },
    //             region_id : {
    //                 required : '请选择所在地区',
    //                 min  : '请选择所在地区'
    //             },
    //             address   : {
    //                 required : '请如实填写收货人详细地址'
    //             },
    //             phone_tel : {
    //                 required : '固定电话和手机号码至少填一个',
    //                 minlength: '电话号码由数字、加号、减号、空格、括号组成,并不能少于6位',
    //                 is_tel : '电话号码由数字、加号、减号、空格、括号组成,并不能少于6位'
    //             },
    //             phone_mob : {
    //                 required : '固定电话和手机号码至少填一个',
    //                 minlength: '错误的手机号码,只能是数字,并且不能少于11位',
    //                 digits : '错误的手机号码,只能是数字,并且不能少于11位'
    //             }
    //         },
    //         groups:{
    //             phone:'phone_tel phone_mob'
    //         },
    //     });
    //
    // });
    // function set_order_amount(shipping_id){
    //     var _shipping_fee = get_shipping_fee(shipping_id);
    //     var _amount  = goods_amount + _shipping_fee;
    //     $('#order_amount').html(price_format(_amount));
    // }
    // function get_shipping_fee(shipping_id){
    //     var shipping_data = shippings[shipping_id];
    //     var first_price   = Number(shipping_data['first_price']);
    //     var step_price   = Number(shipping_data['step_price']);
    //     return first_price + (goods_quantity - 1) * step_price;
    // }
    // function check_phone(){
    //     return ($('#phone_tel').val() == '' && $('#phone_mob').val() == '');
    // }
    //
    // //滑动选择插件
    // var shipping_select = new MobileSelectArea();
    // // var payment_select = new MobileSelectArea();
    //
    // $(function(){
    //     $('.address_item').click(function(){
    //         $(this).find("input[name='address_options']").attr('checked', true);
    //         $('.address_item').removeClass('selected_address');
    //         $(this).addClass('selected_address');
    //         set_address();
    //     });
    //     //init
    //     set_address();
    //
    //     $('#shipping_id_text').val(shipping_methods_json[0].name);
    //     $('#shipping_id').val(shipping_methods_json[0].id);
    //
    //     $('#payment_id_text').val(payments_json[0].name);
    //     $('#payment_id').val(payments_json[0].id)
    //
    //     shipping_select.init({trigger:$('#shipping_id_text'),value:$('#shipping_id').val(),data:shipping_methods_json,position:"bottom",level:1,callback:shipping_id_changed});
    //     shipping_id_changed();
    //
    //     // payment_select.init({trigger:$('#payment_id_text'),value:$('#payment_id').val(),data:payments_json,position:"bottom",level:1,callback:payment_id_changed});
    //     // payment_id_changed();
    // });
    //
    // function shipping_id_changed(){
    //     var value = shipping_select.value;
    //     var text = shipping_select.text;
    //     var shipping_id = value[0];
    //     $("#shipping_id").val(shipping_id);
    //     $("#shipping_id_text").val(text[0]);
    //
    //     var _shipping_fee = get_shipping_fee(shipping_id);
    //     $("#shipping_fee_span").html(price_format(_shipping_fee));
    //     set_order_amount(shipping_id);
    // }
    //
    // function payment_id_changed(){
    //     var value = payment_select.value;
    //     var text = payment_select.text;
    //     var payment_id = value[0];
    //     $("#payment_id").val(payment_id);
    //     $("#payment_id_text").val(text[0]);
    // }
    //
    // function set_address(){
    //     var addr_id = $("input[name='address_options']:checked").val();
    //     if(addr_id == 0)
    //     {
    //         $('#consignee').val("");
    //         $('#region_name').val("");
    //         $('#region_id').val("");
    //         $('#region select').show();
    //         $("#edit_region_button").hide();
    //         $('#region_name_span').hide();
    //
    //         $('#address').val("");
    //         $('#zipcode').val("");
    //         $('#phone_tel').val("");
    //         $('#phone_mob').val("");
    //
    //         $('#address_form').show();
    //     }
    //     else
    //     {
    //         $('#address_form').hide();
    //         fill_address_form(addr_id);
    //     }
    // }
    // function fill_address_form(addr_id){
    //     var addr_data = addresses[addr_id];
    //     for(k in addr_data){
    //         switch(k){
    //             case 'consignee':
    //             case 'address':
    //             case 'zipcode':
    //             case 'email':
    //             case 'phone_tel':
    //             case 'phone_mob':
    //             case 'region_id':
    //                 $("input[name='" + k + "']").val(addr_data[k]);
    //                 break;
    //             case 'region_name':
    //                 $("input[name='" + k + "']").val(addr_data[k]);
    //                 $('#region select').hide();
    //                 $('#region_name_span').text(addr_data[k]).show();
    //                 $("#edit_region_button").show();
    //                 break;
    //         }
    //     }
    // }
    // $(function(){
    //     $(".icon-select").click(function(){
    //         var custom_target=$(this).attr('custom_target');
    //         $("div[custom_target='"+custom_target+"']").each(function(){
    //             $(this).removeClass('the-selecct');
    //         });
    //         $(this).addClass('the-selecct');
    //         if(custom_target=="address_options"){
    //             var selected_id=$(this).next('div').attr('address_options');
    //             $("input[type='radio'][name='address_options']").each(function(){
    //                 $(this).attr('checked',false);
    //                 if($(this).val()==selected_id){
    //                     $(this).attr('checked',true);
    //                 }
    //             });
    //             fill_address_form(selected_id);
    //             $("input[type='radio'][name='address_options']").val(selected_id);
    //         }else{
    //             var selected_id=$(this).next('ul').attr('shipping_id');
    //             $("input[type='radio'][name='shipping_id']").each(function(){
    //                 $(this).attr('checked',false);
    //                 if($(this).val()==selected_id){
    //                     $(this).attr('checked',true);
    //                 }
    //             });
    //             $("input[type='radio'][name='shipping_id']").val(selected_id);
    //         }
    //     });
    // });
</script>
<header class="user_center_header bd_bottom-ddd">
  <a class="go_back_btn" href="javascript:history.go(-1)">
    <span class="iconfont">&#xe698;</span>
  </a>
  <h1>确认订单</h1>
</header>


<form method="post" id="order_form" action="/wx/supply-order-create" >
    {{csrf_field()}}
      <a href="javascript:void(0)" onclick="$('.user_address_list').toggle()">
    <div class="padding_container bg-fff font_26r clearfix address_details_container" >
      <div class="icon-select the-selecct" custom_target="address_options">
        <span class="iconfont font_4r">&#xe6c0;</span>
      </div>
      <div class="fr" address_options="4717">
        <!-- <input  type="hidden" name="address_options" value="4717" /> -->
        <p><span class="default_addr_name">{{$default_addr->name}}</span><span class="fr default_addr_phone">{{$default_addr->phone}}</span></p>
        <p><span class="default_addr_full_address">{{$default_addr->full_address}}</span>&nbsp;&nbsp;<span class="default_addr_street">{{$default_addr->street}}</span></p>
      </div>
        <div class="right_icon_con" >
            <span class="iconfont font_3r">&#xe614;</span>
        </div>
    </div>
  </a>
  <div class="user_address_list" style="display:none;position:abosolute">
      <ul class="user_address-list" >
          @foreach($addr as $val)
          <li class="bg-fff bd_top_bottom-eee" id="box_4717">
              <input type="hidden" name="" class="addr_id" value="{{$val['id']}}">

              <div class="chose_address">
                  <p class="margin_bottom_5"><span class="addr_name">{{$val['name']}}</span><span class="fr class="addr_phone"">{{$val['phone']}}</span></p>
                  <p><span class="addr_full_address">{{$val['full_address']}}</span>&nbsp;&nbsp;<span class="addr_street">{{$val['street']}}</span></p>
              </div>
              <div class="address_operation">
                  <a class="input_radio">
                      <input type="radio" class="input-select" name="default_address" value="{{$val['id']}}"  @if($val['is_default'] == 1) checked @endif/>默认地址
                  </a>
              </div>
          </li>
          @endforeach

      </ul>
  </div>
  <input type="hidden" name="address_id" class="default_addr_id" value="{{$default_addr->id}}"/>
  <input type="hidden" name="price_one" value="{{$item->price}}"/>
  <input type="hidden" name="buy_num" value="{{$buy_num}}"/>
  <input type="hidden" name="supplys_id" value="{{$item->id}}"/>
  <input type="hidden" name="store_member_id" value="{{$item->storeinfo->member_id}}"/>
  <script type="text/javascript">
      $('.user_address-list li').click(function(){
          var name = $(this).find('.addr_name').html()
          var phone = $(this).find('.addr_phone').html()
          var street = $(this).find('.addr_street').html()
          var full_address = $(this).find('.addr_full_address').html()
          var id = $(this).find('.addr_id').val();

          $('.default_addr_name').html(name);
          $('.default_addr_phone').html(phone);
          $('.default_addr_full_address').html(full_address);
          $('.default_addr_street').html(street);
          $('.default_addr_id').val(id);

          $('.user_address_list').hide();
      })
  </script>
      <div class="user_store">
    <div class="bg-fff padding_container bd_top-eee">
      <p class="color_34 font_28r" onclick="location='http://13937464721.m.huamu.com/index.php?store_id=7239';">{{$item->storeinfo->store_name}}<b class="right_arrows">&#xe614;</b></p>
    </div>
        <div class="goods_details bg-fff">
      <dl class="clearfix bg-f8 padding_container bd_bottom-eee" style="width: 100%;">
        <dt class="fl"><img src="{{ getPic( explode(';',$item->imgs)[0] ) }}" style="width:99.5px;height:93.2px;object-fit:cover;"/></dt>
        <dd class="fl">
          <p class="font_28r color_34">{{$item->goods_name}}</p>

          <p class="font_24r color_9a">

              @foreach($item->supplyAttrs as $val)
              {{$val->attrs->attr_name}}:{{$val->attr_value}}{{$val->attrs->unit}}&nbsp;
              @endforeach
          </p>
          <span class="color_ff7414 font_24r">¥<b class="font_3r fontWeight_4">{{$item->price}}</b>
          <span class="font_26r color_67 fr">x {{$buy_num}}</span>
          </span>
        </dd>
      </dl>
      <div class="form_item text_right padding_flanks padding_bottom border_none">
        <span class="font_26r color_67">小计：<span class="color_ff7414">¥{{round($buy_num*$item->price,2)}}</span></span>
      </div>
    </div>
        <div class="padding_flanks bg-fff bd_top-eee">
      <!-- <div class="form_item">
        <span class="font_3r color_34 goods_name-title">配送方式</span>
        <input class="payment_id_text" id="shipping_id_text" value="请选择配送方式"/>
        <input type="hidden" name="shipping_id" id="shipping_id" value=""/>
        <b class="iconfont select_arrows-icon">&#xe614;</b>
      </div> -->
      <div class="form_item">
        <span class="font_3r color_34 goods_name-title">运费</span><span>(提交订单后 ,请联系卖家商量运费)</span>
        <span class="font_28r fr color_67" id="shipping_fee_span">0.00</span>
      </div>
      <div class="form_item">
          <span class="font_3r color_34 goods_name-title">买家留言:</span>
          <input class="color_67  border_none font_24r goods_name " type="text" name="postscript" id="postscript" placeholder="请输入您的留言" value=""/>
      </div>
      <!-- <div class="form_item">
        <span class="font_3r color_34 goods_name-title">买家留言:</span>
        <input type="text" id="postscript" name="postscript" class="buyer_message_box" placeholder="留言"/>
      </div> -->
    </div>

    <div class="user_store bg-fff" style="margin-top:0px;">
      <div class="form_item padding_flanks bd_top-eee">
        <a class="a_full" id="pay_mode">
          <span class="font_3r color_34 goods_name-title">支付方式</span>
          <!--<input class="payment_id_text" id="payment_id_text" value="请选择交易方式"/>-->
          <!--<input type="hidden" name="payment_id" id="payment_id" value=""/>-->
          <!--<b class="iconfont select_arrows-icon">&#xe614;</b>-->
        </a>
      </div>
        <div class="padding_flanks bg-fff pay_mode_container">
                    <div class="form_item">
            <a class="input_radio-right a_full web_payment">
              <span class="font_3r">微信支付</span>
              <input type="radio" class="input-select" name="payment_id" value="7261"  checked />
            </a>
          </div>
                  </div>
      <!--
      <div class="form_item">
        <a href="#" class="a_full" id="invoice_type">
          <span class="font_3r fontWeight_5 color_34 goods_name-title">发票类型</span>
          <span class="fr user_enterprise color_67">普通发票</span>
          <b class="iconfont select_arrows-icon">&#xe614;</b>
        </a>
      </div>
      -->
    </div>
  </div>



  <div class="mask_layer" id="mask_layer" style="display:none">

    <div class="bg-f8 pay_mode" style="display:none">
      <div class="padding_container">
        <p class="text_center font_28r">支付方式</p>

        <!--<div class="form_item user_store">-->
          <!--<a class="input_radio-right a_full">-->
            <!--<span class="font_3r">担保交易</span>-->
            <!--<input type="radio" class="input-select" name="" checked/>-->
          <!--</a>-->
        <!--</div>-->
        <!--<div class="form_item">-->
          <!--<a class="input_radio-right a_full">-->
            <!--<span class="font_3r">线下交易</span>-->
            <!--<input type="radio" class="input-select" name=""/>-->
          <!--</a>-->
        <!--</div>-->
      </div>

      <div class="invoice_footer">
        <a href="#" class="font_3r color_fff bg-ff863a abolish_select_btn">取消</a>
        <a href="#" class="font_3r color_fff bg-02c5a3">完成</a>
      </div>
    </div>

    <div class="bg-f8 invoice_type" style="display: none">
      <div class="padding_container">
        <p class="text_center font_28r">发票类型</p>

        <div class="form_item user_store">
          <a class="input_radio-right a_full">
            <span class="font_3r">普通发票</span>
            <input type="radio" class="input-select" name="" checked/>
          </a>
        </div>
        <div class="form_item">
          <a class="input_radio-right a_full">
            <span class="font_3r">增值税发票</span>
            <input type="radio" class="input-select" name=""/>
          </a>
        </div>
        <div class="form_item">
          <a class="input_radio-right a_full">
            <span class="font_3r">增值税发票</span>
            <input type="radio" class="input-select" name=""/>
          </a>
        </div>
      </div>

      <div class="invoice_footer">
        <a href="#" class="font_3r color_fff bg-ff863a abolish_select_btn">取消</a>
        <a href="#" class="font_3r color_fff bg-02c5a3">完成</a>
      </div>
    </div>
  </div>

</form>
<footer class="foot_border-top">
  <div class="strength_show_img padding_flanks text_right bg-f8">
    <a>
      <span class="font_3r">合计：<span class="color_ff7414" id="order_amount"></span></span>
    </a>
  </div>
  <script type="text/javascript">
      function formatCurrency(num) {
          num = num.toString().replace(/\$|\,/g,'');
          if(isNaN(num))
          num = "0";
          sign = (num == (num = Math.abs(num)));
          num = Math.floor(num*100+0.50000000001);
          cents = num%100;
          num = Math.floor(num/100).toString();
          if(cents<10)
          cents = "0" + cents;
          for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
          num = num.substring(0,num.length-(4*i+3))+','+
          num.substring(num.length-(4*i+3));
          return (((sign)?'':'-') + num + '.' + cents);
      }
      var number = $('input[name=buy_num]').val();
      var price = $('input[name=price_one]').val();
      var first = formatCurrency(number*price)
      // alert(first)
      $('#order_amount').html('¥'+first);
      var clicked = false;
  </script>
  <div class="add_img_complete"><a href="javascript:void(0)" onclick="tijiao()" class="font_3r">提交订单</a></div>
  <!-- <div class="add_img_complete"><a href="javascript:if(!clicked){ clicked = true;$('#order_form').trigger('submit')}" class="font_3r">提交订单</a></div> -->
  <script type="text/javascript">

        function tijiao(){
            if(!clicked){
                var url = $('#order_form').attr('action');
                 clicked = true;
                 $.ajax({
                     url: url,
                     type: 'post',
                     data:$('#order_form').serialize(),
                     success:function(d){
                         if(d.status == 'success'){
                             layer.open({content:d.msg, time:2});

                             setTimeout(function(){
                                 window.location.href='/buyorder/index';
                             },1000);
                         }else{
                             layer.open({content:'发生错误! 请重试!', time:2});

                         }

                     }
                 });
                 // $('#order_form').trigger('submit')
             }
        }
  </script>
</footer>
<script>

</script>
</body>
</html>
