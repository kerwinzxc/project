<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<link href="/public/simpleboot/themes/<?php echo C('SP_ADMIN_STYLE');?>/theme.min.css" rel="stylesheet">
    <link href="/public/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="/public/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		.length_3{width: 180px;}
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
	<![endif]-->
<script type="text/javascript">
//全局变量
var GV = {
		DIMAUB : "/",
		JS_ROOT : "public/js/",
    TOKEN: ""
};
</script>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/public/js/jquery.js"></script>
    <script src="/public/js/wind.js"></script>
    <script src="/public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
<script src="/public/select2/js/select2.min.js"></script>
<link href="/public/select2/css/select2.min.css" rel="stylesheet"
	type="text/css">
<script>
	$(document).ready(function() {
		$(".select_2").select2();
	});
</script>
<?php if(APP_DEBUG): ?><style>
		#think_page_trace_open{
			z-index:9999;
		}
	</style><?php endif; ?>
<style type="text/css">
.pic-list li {
	margin-bottom: 5px;
}
</style>
</head>
<body>
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<li><a href="<?php echo U('Newapp/Game/index');?>">游戏列表</a></li>
			<li><a href="<?php echo U('Newapp/Game/add');?>" target="_self">添加游戏</a></li>
			<li class="active"><a href="#">编辑游戏</a></li>
		</ul>
		<form action="<?php echo U('Newapp/Game/edit_post');?>" method="post"
			class="form-horizontal js-ajax-forms" enctype="multipart/form-data">
			<div class="row-fluid">
				<div class="span9">
					<table class="table table-bordered">
						<tr>
							<th>游戏ID</th>
							<td><span class="form-required"><?php echo ($game["id"]); ?></span></td>
						</tr>
						<tr>
							<th>游戏名称</th>
							<input type="hidden" name="gameid" value="<?php echo ($game["id"]); ?>">
							<td><input type="text" style="width: 400px;" name="gamename"
								id="gamename" required value="<?php echo ($game["name"]); ?>"
								placeholder="请输入游戏名称"> <span class="form-required">*</span></td>
						</tr>
						<tr>
							<th width="80">游戏标签</th>
							<td><?php if(is_array($gtypes)): foreach($gtypes as $k=>$v): ?><label
									class="checkbox inline"> <?php $type_id_checked=in_array($k,$type_ids)?"checked":""; ?>
									<input value="<?php echo ($k); ?>" type="checkbox" name="gtype[]"<?php echo ($type_id_checked); ?>><?php echo ($v); ?>
								</label><?php endforeach; endif; ?></td>
						</tr>
						<tr>
							<th>一句话描述</th>
							<td><input type="text" name="oneword" id="oneword"
								value="<?php echo ($gameinfo["publicity"]); ?>" style="width: 400px"
								placeholder="请输入关键字"> 70字以内</td>
						</tr>
						<tr>
							<th>游戏描述</th>
							<td><textarea name="description" id="description"
									style="width: 98%; height: 50px;" placeholder="请填写游戏描述"><?php echo ($gameinfo["description"]); ?></textarea>
							</td>
						</tr>
						<tr>
							<th>ANDROID下载地址</th>
							<td><textarea name="androidurl" id="androidurl"
									style="width: 98%; height: 50px;" placeholder="请填写下载地址"><?php echo ($gameinfo["androidurl"]); ?></textarea>
							</td>
						</tr>
						<tr>
							<th>适用系统</th>
							<td><input type="text" name="adxt" id="adxt"
								value="<?php echo ($gameinfo["adxt"]); ?>" style="width: 400px"
								placeholder="app适用环境">*最低适用版本</td>
						</tr>
						<tr>
							<th>游戏大小</th>
							<td><input type="text" name="size" id="size"
								value="<?php echo ($gameinfo["size"]); ?>" style="width: 400px"
								placeholder="请输入游戏版本">*例如: 100M</td>
						</tr>
						<tr>
							<th>游戏版本</th>
							<input type="hidden" name="verid" value="<?php echo ($verdata["id"]); ?>">
							<td><input type="text" name="version" id="version"
							onkeyup="this.value=this.value.replace(/[^\d.]/g,'')" onafterpaste="this.value=this.value.replace(/[^\d.]/g,'')"
								value="<?php echo ($verdata["version"]); ?>" style="width: 400px"
								placeholder="请输入游戏版本">*数字与小数点组合</td>
						</tr>
						<tr>
							<th>游戏语言</th>
							<td><input type="text" name="lang" id="lang"
								value="<?php echo ($gameinfo["lang"]); ?>" style="width: 400px"
								placeholder="请输入游戏语言">*默认为中文</td>
						</tr>
						<tr>
							<th>游戏截图</th>
							<td>
								<fieldset>
									<legend>图片列表 (地址 图片名称)</legend>
									<ul id="photos" class="pic-list unstyled">
										<?php if(is_array($smeta)): foreach($smeta as $key=>$vo): $img_url=sp_get_asset_upload_path($vo['url']); ?>
										<li id="savedimage<?php echo ($key); ?>"><input type="text"
											name="photos_url[]" value="<?php echo ($img_url); ?>" title="双击查看"
											style="width: 310px; height: 48px;"
											ondblclick="image_priview(this.value);"
											class="input image-url-input"> <input type="text"
											name="photos_alt[]" value="<?php echo ($vo["alt"]); ?>"
											style="width: 160px; height: 48px;"
											class="input image-alt-input"
											onfocus="if(this.value == this.defaultValue) this.value = ''"
											onblur="if(this.value.replace(' ','') == '') this.value = this.defaultValue;">
											<a class="img_a"
											href="javascript:onClick=image_priview('<?php echo ($img_url); ?>')"><img
												class="img_prew"
												src="<?php echo sp_get_asset_upload_path($vo['url']);?>"
												style="height: 50px;"></img></a> <a
											href="javascript:flashupload('replace_albums_images', '图片替换','savedimage<?php echo ($key); ?>',replace_image,'10,gif|jpg|jpeg|png|bmp,0','','','')">替换</a>
											<a href="javascript:remove_div('savedimage<?php echo ($key); ?>')">移除</a></li><?php endforeach; endif; ?>
									</ul>
								</fieldset> <a href="javascript:;"
								onclick="javascript:flashupload('albums_images', '图片上传','photos',change_images,'10,gif|jpg|jpeg|png|bmp,0','','','')"
								class="btn btn-small">选择图片</a>
							</td>
						</tr>
					</table>
				</div>
				<div class="span3">
					<table class="table table-bordered">
						<tr>
							<td><b>游戏ICON</b></td>
						</tr>
						<tr>
							<td>
								<div style="text-align: center;">

									<input type="hidden" name="logo" id="thumb" value="<?php echo sp_get_asset_upload_path($game[mobile_icon]);?>"> <a
										href="javascript:void(0);"
										onclick="flashupload('thumb_images', '附件上传','thumb',thumb_images,'1,jpg|jpeg|gif|png|bmp,1,,,1','','','');return false;">
										<?php if(empty($game[mobile_icon])): ?><img
											src="/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png"
											id="thumb_preview" width="135" style="cursor: hand" /> <?php else: ?>
										<img src="<?php echo sp_get_asset_upload_path($game[mobile_icon]);?>"
											id="thumb_preview" width="135" style="cursor: hand" /><?php endif; ?>
									</a> <input type="button" class="btn btn-small"
										onclick="$('#thumb_preview').attr('src','/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png');$('#thumb').val('');return false;"
										value="取消图片">
								</div>
							</td>
						</tr>
						<tr>
							<th><b>排序(数字,值越大,排序靠前)</b></th>
						</tr>
						<tr>
							<td><input type="text" name="listorder"
							onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9]/g,'')"
								value="<?php echo ((isset($game["listorder"]) && ($game["listorder"] !== ""))?($game["listorder"]):0); ?>" style="width: 160px;"></td>
						</tr>
						<tr>
							<th><b>下载次数</b></th>
						</tr>
						<tr>
							<td><input type="text" name="count"
							onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9]/g,'')"
							value="<?php echo ((isset($extdata["down_cnt"]) && ($extdata["down_cnt"] !== ""))?($extdata["down_cnt"]):0); ?>" style="width: 160px;"></td>
						</tr>
						<?php $single_yes=$game['category']==1?"checked":""; $single_no=$game['category']==2?"checked":""; $class_android=$game['classify']==1?"checked":""; $class_other=$game['classify']==4?"checked":""; $hot_yes=$game['is_hot']==1?"checked":""; $hot_no=$game['is_hot']==0?"checked":""; ?>
						<tr>
							<td><label class="radio"><input type="radio"
									name="gcategory" value="1"<?php echo ($single_yes); ?>>单机</label> <label
								class="radio"><input type="radio" name="gcategory"
									value="2"<?php echo ($single_no); ?>>网游</label></td>
						</tr>
						<!--<tr>
							<td><label class="radio"><input type="radio"
									name="gclassify" value="1"<?php echo ($class_android); ?>>正版</label> <label
								class="radio"><input type="radio" name="gclassify"
									value="4"<?php echo ($class_other); ?>>破解</label></td>
						</tr>-->
						<tr>
							<td><label class="radio"><input type="radio"
									name="hot" value="1"<?php echo ($hot_yes); ?>>热门</label> <label class="radio"><input
									type="radio" name="hot" value="0"<?php echo ($hot_no); ?>>不热门</label></td>
						</tr>
			<!-- 			<tr>
							<th><b>游戏接入状态</b></th>
						</tr>
						<tr>
							<td>
								<?php if(is_array($gamestatus)): foreach($gamestatus as $k=>$v): $gs_select=$k==$game['status'] ?"checked":""; ?>
									<label class="radio" for="active_true">
										<input type="radio" name="gstatus" value="<?php echo ($k); ?>" <?php echo ($gs_select); ?>  id="gstatus"><?php echo ($v); ?></input>
									</label><?php endforeach; endif; ?>
							</td>
						</tr> -->
					</table>
				</div>
			</div>
			<div class="form-actions">
				<button class="btn btn-primary js-ajax-submit" type="submit">提交</button>
				<a class="btn" href="<?php echo U('Newapp/Game/index');?>">返回</a>
			</div>
		</form>
	</div>
	<script type="text/javascript" src="/public/js/common.js"></script>
	<script type="text/javascript"
		src="/public/js/content_addtop.js?t=<?php echo time();?>"></script>
	<script type="text/javascript">
		//编辑器路径定义
		var editorURL = GV.DIMAUB;
	</script>
	<script type="text/javascript"
		src="/public/js/ueditor/ueditor.config.js"></script>
	<script type="text/javascript"
		src="/public/js/ueditor/ueditor.all.min.js"></script>
	<script type="text/javascript">
		$(function() {
			//setInterval(function(){public_lock_renewal();}, 10000);
			$(".js-ajax-close-btn").on('click', function(e) {
				e.preventDefault();
				Wind.use("artDialog", function() {
					art.dialog({
						id : "question",
						icon : "question",
						fixed : true,
						lock : true,
						background : "#CCCCCC",
						opacity : 0,
						content : "您确定需要关闭当前页面嘛？",
						ok : function() {
							setCookie("refersh_time", 1);
							window.close();
							return true;
						}
					});
				});
			});
			/////---------------------
			Wind
					.use(
							'validate',
							'ajaxForm',
							'artDialog',
							function() {
								//javascript

								//编辑器
								editorcontent = new baidu.editor.ui.Editor();
								editorcontent.render('content');
								try {
									editorcontent.sync();
								} catch (err) {
								}
								//增加编辑器验证规则
								jQuery.validator.addMethod('editorcontent',
										function() {
											try {
												editorcontent.sync();
											} catch (err) {
											}
											;
											return editorcontent.hasContents();
										});
								var form = $('form.js-ajax-forms');
								//ie处理placeholder提交问题
								if ($.browser.msie) {
									form.find('[placeholder]').each(
											function() {
												var input = $(this);
												if (input.val() == input
														.attr('placeholder')) {
													input.val('');
												}
											});
								}
								var formloading = false;
								//表单验证开始
								form
										.validate({
											//是否在获取焦点时验证
											onfocusout : false,
											//是否在敲击键盘时验证
											onkeyup : false,
											//当鼠标掉级时验证
											onclick : false,
											//验证错误
											showErrors : function(errorMap,
													errorArr) {
												//errorMap {'name':'错误信息'}
												//errorArr [{'message':'错误信息',element:({})}]
												try {
													$(errorArr[0].element)
															.focus();
													art
															.dialog({
																id : 'error',
																icon : 'error',
																lock : true,
																fixed : true,
																background : "#CCCCCC",
																opacity : 0,
																content : errorArr[0].message,
																cancelVal : '确定',
																cancel : function() {
																	$(
																			errorArr[0].element)
																			.focus();
																}
															});
												} catch (err) {
												}
											},
											//验证规则
											rules : {
												'name' : {
													required : 1
												}
											},
											//验证未通过提示消息
											messages : {
												'name' : {
													required : '请输入游戏名称'
												}
											},
											//给未通过验证的元素加效果,闪烁等
											highlight : false,
											//是否在获取焦点时验证
											onfocusout : false,
											//验证通过，提交表单
											submitHandler : function(forms) {
												if (formloading)
													return;
												$(forms)
														.ajaxSubmit(
																{
																	url : form
																			.attr('action'), //按钮上是否自定义提交地址(多按钮情况)
																	dataType : 'json',
																	beforeSubmit : function(
																			arr,
																			$form,
																			options) {
																		formloading = true;
																	},
																	success : function(
																			data,
																			statusText,
																			xhr,
																			$form) {
																		formloading = false;
																		if (data.status) {
																			setCookie(
																					"refersh_time",
																					1);
																			//添加成功
																			Wind
																					.use(
																							"artDialog",
																							function() {
																								art
																										.dialog({
																											id : "succeed",
																											icon : "succeed",
																											fixed : true,
																											lock : true,
																											background : "#CCCCCC",
																											opacity : 0,
																											content : data.info,
																											button : [
																													{
																														name : '继续编辑？',
																														callback : function() {
																															//reloadPage(window);
																															return true;
																														},
																														focus : true
																													},
																													{
																														name : '返回游戏列表',
																														callback : function() {
																															location = "<?php echo U('Newapp/Game/index');?>";
																															return true;
																														}
																													} ]
																										});
																							});
																		} else {
																			isalert(data.info);
																		}
																	}
																});
											}
										});
							});
			////-------------------------
		});
	</script>
</body>
</html>