<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="textml; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui" />
<title><?php echo ($title); ?></title>
<link rel="stylesheet" type="text/css" href="/public/float/css/float.css" />
</head>
<body>
<!--
<div class="modular">
    <ul>
        <li class="back"><a onclick="history.go(-1);"><img src="/public/float/images/goback.png"><span class="main_title"><?php echo ($title); ?></span></a></li>
        <li><a onclick="window.mgw_web_back.goToGame()">回到游戏</a></li> 
    </ul>
</div>-->

<div class="form4">
        <form   name="codeform" id="codeform"  action="<?php echo U('Forgetpwd/uppwd');?>" method="post">
            <div class="user_num_1">
            	<span>帐号:</span><b><?php echo (session('username')); ?></b>
            <br>
            <br>
            	<span>手机号:</span><b><?php echo ($userdata["mobile"]); ?></b>
            </div>
             <div class="yzm">
                    <div><img src="/public/float/images/14.png"></div>
                    <input  name="code" id="code" type="text" placeholder="请输入短信的验证码"/>
                    <div class="getcode">获取验证码</div>
              </div>
		        <div id="msg_box">
		        </div>
              <input type="button" value="确定" class="form1">
        </form>
</div>

</body>
<script src="/public/float/js/main.js"></script>
<script src="/public/float/js/jquery.js"></script>
<script src="/public/float/js/float.js"></script>
<script>
	$(function  () {
		var url ="<?php echo U('Forgetpwd/verify_mmsend');?>";
		var mobile;
	  	$(".getcode").click (
				function f2(){
					mobile = $('#mobile').val();
					var form_data = {
			  	  		};
					_getCode(url,form_data,this,120,f2,1000)
		})
	})
	
	var btn1=document.querySelector(".form1");
	var vurl ="<?php echo U('Forgetpwd/verifycode');?>";
	var vmobile;
	var vcode;
	btn1.onclick=function(){
		vcode = $('#code').val();
		$("#msg_box").css("display","none");
		
		if('' == vcode){
			showmsg("请输入验证码");
			return;
		}
			
		var form_data = {
			code: vcode,
		};
		sendDate(vurl,form_data,succ,err,"POST","JSON");
	}

</script>
 </html>