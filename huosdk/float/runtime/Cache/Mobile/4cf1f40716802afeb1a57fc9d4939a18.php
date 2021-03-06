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
    <link rel="stylesheet" href="/public/mobile/css/consumption_detail.css"/>
	
<nav>
    <ul>
<!--         <li <?php if($status == 1): ?>class="active"<?php endif; ?>><a href="<?php echo U('User/Float/ptbrecharge_detail',array('status'=>1));?>">未支付</a></li>
        <li <?php if($status == 2): ?>class="active"<?php endif; ?>><a href="<?php echo U('User/Float/ptbrecharge_detail',array('status'=>2));?>">支付成功</a></li>
        <li <?php if($status == 3): ?>class="active"<?php endif; ?>><a href="<?php echo U('User/Float/ptbrecharge_detail',array('status'=>-1));?>">支付失败</a></li> -->
     
        <li <?php if($payflag == 'pay'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Mobile/Wallet/pay_detail',array('status'=>2));?>"><?php echo ($gamepaytitle); ?></a></li>
        <li <?php if($payflag == 'wallet'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Mobile/Wallet/wallet_detail',array('status'=>2));?>"><?php echo ($ptbpaytitle); ?></a></li>
    </ul>
</nav>
<section>
    <div id="ptb_data"  class="list_text">
    	<?php if(is_array($pay_detail)): $i = 0; $__LIST__ = $pay_detail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul class="item">
<!-- 	            <li><b>消费：</b><span><i><?php echo ($vo["money"]); ?></i>元</span></li>
	            <li><b>消费情况：</b><span><i><?php echo ($vo["status"]); ?></i></span></li>
	            <li><b>订单号：</b><span><?php echo ($vo["order_id"]); ?></span></li>
	            <li><b>消费时间：</b><span><?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?></span></li> -->
	            
	        	<li><b>消费金额：</b><span><i><?php echo ($vo["amount"]); ?></i>元</span></li>
	            <li><b>消费情况：</b><span><i><?php echo ($vo[status]); ?></i></span></li>
	            <li><b>游戏：</b><span><i><?php echo ($vo["gamename"]); ?></i></span></li>
	            <li><b>订单号：</b><span><?php echo ($vo["orderid"]); ?></span></li>
	            <li><b>消费时间：</b><span><?php echo ($vo["createtime"]); ?></span></li>
	        </ul><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
	<div id="ajax_idx_more" rel="1" class="list_text">加载更多</div>
	<input id="ajaxurl" name="ajaxurl" type="hidden"value="<?php echo U('Mobile/Wallet/wallet_detail_more');?>" /> 
	<input id="status" name="status" type="hidden" value="<?php echo ($status); ?>" /> 
	<input id="currency" name="currency" type="hidden" value="<?php echo C('CURRENCY_NAME');?>" />
	<input id="page" name="page" type="hidden" value="<?php echo ($page); ?>" />
</section>

<div class="loading_more">
    <div class="btn_top">
        <img src="/public/mobile/images/btn_top.png" alt=""/>
    </div>
</div>

<div class="main_model_box"></div>
</body>
<script src="/public/mobile/js/jquery.js"></script>
<script src="/public/mobile/js/public.js"></script>
<script src="/public/mobile/js/huosdk_base.js"></script>
<script src="/public/mobile/js/pay_detail.js"></script>
</html>