<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta name="_token" content="{{ csrf_token() }}"/>

    <title>移动端图片压缩上传demo</title>
    <style>
* { margin: 0; padding: 0; }
li { list-style-type: none; }
a, input { outline: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); }
#choose { display: none; }
canvas { width: 100%; border: 1px solid #000000; }
#upload, #uploadimg ,#resetimg,#finished { display: block; margin: 10px; height: 60px; text-align: center; line-height: 60px; border: 1px solid; border-radius: 5px; cursor: pointer; font-size: 20px; }
.touch { background-color: #ddd; }
.img-list { overflow: hidden;margin: 0.2rem 0 }
.img-list li { box-sizing: border-box; position: relative; display: inline-block;margin: 0 0.1rem 0.2rem; width:2.3rem; height: 2.3rem; border: 1px solid rgb(100, 149, 198); background: #fff no-repeat center; background-size: cover; }
.progress { position: absolute; width: 100%; height: 20px; line-height: 20px; bottom: 0; left: 0; background-color: rgba(100, 149, 198, .5); }
.progress span { display: block; width: 0; height: 100%; background-color: rgb(100, 149, 198); text-align: center; color: #FFF; font-size: 13px; }
.size { position: absolute; width: 100%; height: 15px; line-height: 15px; bottom: -18px; text-align: center; font-size: 13px; color: #666; }
.tips { display: block; text-align: center; font-size: 13px; margin: 10px; color: #999; }
.showimg { margin: 10px auto 10px auto; text-align: center; }
.cover:before { content: ''; position: absolute; background: rgba(0, 0, 0, 0.4); left: 0; top: 0; right: 0; height: 100%; width: 100%; }
.i-delete { position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); -webkit-transform: translate(-50%, -50%); background: url(/images/delete.png) no-repeat; background-size: 27px 28px; width: 27px; height: 28px; }
    </style>
</head>

<body>
    <script>
    //动态设置字体
    (function setFontSize() {
        var doc = document;　　
        var winWidth = doc.body.clientWidth || doc.documentElement.clientWidth;　　
        var size = (winWidth / 750) * 100;　　
        doc.documentElement.style.fontSize = (winWidth <= 768 ? size : 50) + 'px';
    }());
    </script>
    <input type="file" id="choose" accept="image/*" multiple>
    <ul class="img-list"></ul>
    <a id="upload">选择图片</a>
    <a id="resetimg">重置</a>
    <span class="tips">只允许上传jpg、png等格式图片</span>
    <!-- <span class="tips">最多可上传九张图片</span> -->
    <span class="tips" style="color:red">点击缩略图进行删除图片!</span>
    <span class="tips" style="color:red">请全部选好图片再点击上传!</span>
    <a id="uploadimg">上传</a>
    <a id="finished" href="/store/index" style="border-color:black;text-decoration:none;color:black">完成编辑</a>
    <p class="showimg" id="showimg" style="width:100%">
        {!!showImgs($imgs)!!}
    </p>
    <script src="http://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
    <script>
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    var filechooser = document.getElementById("choose");
    //    用于压缩图片的canvas
    var canvas = document.createElement("canvas");
    var ctx = canvas.getContext('2d');
    //    瓦片canvas
    var tCanvas = document.createElement("canvas");
    var tctx = tCanvas.getContext("2d");
    var maxsize = 100 * 1024;
    // 控制删除开关，只绑定一次
    var del_btn = true;
    // 控制9张提示开关，循环里只提示一次
    var max_pic_num = true
    $('#resetimg').click(function(){
        $.post('/store/reset-imgs',{},function(data){
            if(data.status){
                alert('重置成功,请重新上传编辑!');
                location.reload();
            }
        })
    });
    $("#upload").on("click", function() {
            filechooser.click();
        })
        .on("touchstart", function() {
            $(this).addClass("touch")
        })
        .on("touchend", function() {
            $(this).removeClass("touch")
        });

    filechooser.onchange = function() {
        if (!this.files.length) return;
        var files = Array.prototype.slice.call(this.files);
        if (files.length > 9) {
            alert("最多同时只可上传9张图片");
            return;
        }



        files.forEach(function(file, i) {

            if (!/\/(?:jpeg|png|gif)/i.test(file.type)) {
                alert("请传入图片");
                return
            };
            var reader = new FileReader();
            var li = document.createElement("li");
            //          获取图片大小
            var size = file.size / 1024 > 1024 ? (~~(10 * file.size / 1024 / 1024)) / 10 + "MB" : ~~(file.size / 1024) + "KB";
            li.innerHTML = '<div class="size">' + size + '</div>';
            $(".img-list").append($(li));

            // 最多可上传九张图片
            if ($('.img-list li').length > 9) {
                if (max_pic_num) {
                    alert("最多可上传九张图片");
                    max_pic_num = false;
                }
                $('.img-list li:gt(8)').remove();
                return false
            }

            // 删除预览图片
            if (del_btn) {
                $('body').on('touchstart', '.img-list li', function() {

                    $(this).addClass('cover').append('<i class=i-delete></i>');
                    var that = this;
                    setTimeout(function() {
                        var flag = confirm("要删除这张照片嘛")
                        if (flag) {
                            $(that).remove()
                            return false
                        } else {
                            $(that).removeClass('cover')
                            $(that).find('.i-delete').remove()
                            return false
                        }
                    }, 300)
                })
                del_btn = false
            }



            //    var img_list_obj= document.querySelectorAll('.img-list li')
            // i=i+img_list_obj.length;
            // console.log(i)
            // img_list_obj[i].addEventListener('touchstart',function(){
            //   console.log(i)

            //     $(this).addClass('cover').append('<i class=i-delete></i>');
            //         var that=this;
            //         setTimeout(function(){var flag=confirm("要删除这张照片嘛")
            //         if(flag){
            //         $(that).remove()
            //         return false
            //       }else{
            //         $(that).removeClass('cover')
            //         $(that).find('.i-delete').remove()
            //         return false
            //       }
            //      },300)

            //      });






            // console.log( $('.img-list li').length)
            reader.onload = function() {
                var result = this.result;
                var img = new Image();
                img.src = result;
                $(li).css("background-image", "url(" + result + ")");
                //如果图片大小小于100kb，则直接上传
                if (result.length <= maxsize) {
                    img = null;
                    upload(result);
                    return;
                }
                //      图片加载完毕之后进行压缩，然后上传
                if (img.complete) {
                    callback();
                } else {
                    img.onload = callback;
                }

                function callback() {
                    var data = compress(img);
                    upload(data);
                    img = null;
                }
            };
            reader.readAsDataURL(file);
        })
    };


    // setInterval(function(){

    // $('.img-list li').one('touchstart',function(){
    //     $(this).addClass('cover').append('<i class=i-delete></i>');
    //         var that=this;
    //         setTimeout(function(){var flag=confirm("要删除这张照片嘛")
    //         if(flag){
    //         $(that).remove()
    //         return false
    //       }else{
    //         $(that).removeClass('cover')
    //         $(that).find('.i-delete').remove()
    //         return false
    //       }
    //      },300)
    // })


    // }, 2000)


    //    使用canvas对大图片进行压缩
    function compress(img) {
        var initSize = img.src.length;
        var width = img.width;
        var height = img.height;
        //如果图片大于四百万像素，计算压缩比并将大小压至400万以下
        var ratio;
        if ((ratio = width * height / 4000000) > 1) {
            ratio = Math.sqrt(ratio);
            width /= ratio;
            height /= ratio;
        } else {
            ratio = 1;
        }
        canvas.width = width;
        canvas.height = height;
        //        铺底色
        ctx.fillStyle = "#fff";
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        //如果图片像素大于100万则使用瓦片绘制
        var count;
        if ((count = width * height / 1000000) > 1) {
            count = ~~(Math.sqrt(count) + 1); //计算要分成多少块瓦片
            //            计算每块瓦片的宽和高
            var nw = ~~(width / count);
            var nh = ~~(height / count);
            tCanvas.width = nw;
            tCanvas.height = nh;
            for (var i = 0; i < count; i++) {
                for (var j = 0; j < count; j++) {
                    tctx.drawImage(img, i * nw * ratio, j * nh * ratio, nw * ratio, nh * ratio, 0, 0, nw, nh);
                    ctx.drawImage(tCanvas, i * nw, j * nh, nw, nh);
                }
            }
        } else {
            ctx.drawImage(img, 0, 0, width, height);
        }
        //进行最小压缩
        var ndata = canvas.toDataURL('image/jpeg', 0.3);
        console.log('压缩前：' + initSize);
        console.log('压缩后：' + ndata.length);
        console.log('压缩率：' + ~~(100 * (initSize - ndata.length) / initSize) + "%");
        tCanvas.width = tCanvas.height = canvas.width = canvas.height = 0;
        return ndata;
    }
    //    图片上传，将base64图片上传
    function upload(basestr) {
        $("#uploadimg").bind("touchstart", function() {
            $.post("/store/upload-imgs", {
            // $.post("server.php", {
                img: basestr
            }, function(ret) {
                if (ret.img != '') {
                    console.log('upload success');
                    console.log(ret)
                        // $('#showimg').html('<img src="' + ret.img + '">');
                    $('#showimg').append('<img src="' + ret.img + '" style="width:100%">');

                } else {
                    alert('upload fail');
                }
            }, 'json');
        })
    }
    </script>
</body>

</html>
