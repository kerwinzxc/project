<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width,maximum-scale=1.0,initial-scale=1,user-scalable=no"/>
    <meta charset="UTF-8">
    <title><?php echo ($title); ?></title>
</head>
<body><!--
<header class="header">
    <ul class="main_layout">
        <li class="back_btn" onclick="history.go(-1);"><img src="/public/mobile/images/arrow_l.png" alt=""/></li>
        <li class="text"><?php echo ($title); ?></li>
        <li class="close_btn" click="window.android.goToGame()"><img src="/public/mobile/images/closebtn.png" alt=""/></li>
    </ul>
</header>-->

<link rel="stylesheet" href="/public/mobile/css/nobindPhone.css"/>
<div class="show_phone">
    <div class="phone">
        <img src="/public/mobile/images/icon_succ.png" alt=""/>
    </div>
    <p class="binded"><span><?php echo ($info); ?></span><i></i></p>
<!--     <div class="confim_change">
        <button>解绑手机号</button>
    </div> -->
</div>
<div class="main_model_box"></div>
</body>
<script src="/public/mobile/js/jquery.js"></script>
<script src="/public/mobile/js/public.js"></script>
</html>