<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>upload</title>

    </head>
    <body>
        <hr>
        <form class="" action="/uploadfile" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            文件上传:<input type="file" name="avatar" >
            <br>
            <input type="submit" name="" value="提交">
        </form>
    </body>
</html>
