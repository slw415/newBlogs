<!DOCTYPE html>
<html>
<head>
    <title>没有权限</title>
    <style>
        html, body{
            height:100%;
        }
        body{
            margin:0;
            padding:0;
            width:100%;
            color:#B0BEC5;
            display:table;
            font-weight:100;
            font-family:'Lato', sans-serif;
        }
        .container{
            text-align:center;
            display:table-cell;
            vertical-align:middle;
        }
        .content{
            text-align:center;
            display:inline-block;
        }
        .title{
            font-size:42px;
            margin-bottom:40px;
        }
        .title a{
            background:#B0BEC5; text-decoration:none; color:#222; text-align:center;
            height:30px; line-height:30px; font-size:22px; padding:12px 30px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">对不起，您没有权限操作这个页面！</div>
        <div class="title"><a href="javascript:history.go(-1)">返回</a></div>
    </div>
</div>
</body>
</html>
