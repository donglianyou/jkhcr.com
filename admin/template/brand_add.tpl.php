<?php include qq3479015851_tpl('inc_head');?>
<script language='javascript'>
	function CheckSubmit() {
		if ( document.form1.url.value == "http://" || document.form1.url.value == "" ) {
			document.form1.url.focus();
			alert( "网址不能为空！" );
			return false;
		}
		if ( document.form1.webname.value == "" ) {
			document.form1.webname.focus();
			alert( "网站名称不能为空！" );
			return false;
		}
		return true;
	}
</script>
<div id="<?=SysGlbCfm_SOFTNAME?>" style=" padding-bottom:0">
	<div class="mpstopic-category">
		<div class="panel-tab">
			<ul class="clearfix tab-list">
				<li><a href="brand.php?part=list" <?php if($part=='list' ){?>class="current"<?php }?>>所有品牌</a>
				</li>
				<li><a href="brand.php?part=add" <?php if($part=='add' ){?>class="current"<?php }?>>添加品牌</a>
				</li>
				<?php if(!$admin_cityid){?>
				<li><a href="brand.php?do=type" <?php if($do=='type' ){?>class="current"<?php }?>>品牌类型管理</a>
				</li>
				<?php }?>
			</ul>
		</div>
	</div>
</div>
<form action="?part=insert" method="post" enctype="multipart/form-data" name="form1" onSubmit="return CheckSubmit();" ;>
	<div id="<?=SysGlbCfm_SOFTNAME?>">
		<table border="0" cellspacing="0" cellpadding="0" class="vbm">
			<input type="hidden" name="createtime" value="<?=date(" Y-m-d H:i:s ", time())?>">
			<tr class="firstr">
				<td colspan="2">网站概况</td>
			</tr>
			<?php if(!$admin_cityid){?>
			<tr bgcolor="#f5fbff">
				<td>隶属分站：</td>
				<td>
					<select name="cityid">
						<option value="0">总站</option>
						<?php echo get_cityoptions(); ?>
					</select>
				</td>
			</tr>
			<?}else{?>
			<input name="cityid" type="hidden" value="<?php echo $admin_cityid; ?>">
			<?php }?>
			<tr bgcolor="#f5fbff">
				<td width="19%" height="25">网址：</td>
				<td width="81%">
					<input name="url" type=text class=text id="url" value="http://" size="30"/>
				</td>
			</tr>
			<tr bgcolor="#f5fbff">
				<td height="25">品牌名称：</td>
				<td>
					<input name="webname" type=text class=text id="webname" size="30"/>
				</td>
			</tr>
			<tr bgcolor="#f5fbff">
				<td height="25">品牌LOGO：</td>
				<td>
					<div id="dropz" style="width: 200px;" class="dropzone"></div>
					<input name="weblogo" type="hidden" id="weblogo"/>
					<script>
						$( "div#dropz" ).dropzone( {
							url: "/admin/upload.php",
							maxFiles: 1, //最大上传数量
							maxFilesize: 100, //最大上传的文件大小，单位MB
							filesizeBase: 1024, //文件大小的标准规格，这里MB以1024kb为单位
							acceptedFiles: ".jpg,.png,.gif", //允许上传的文件类型
							init: function () {
								this.on( "success", function (file,data) {
									//上传成功触发的事件
									console.log('ok');
									$("#weblogo").val(data);
								} );
								this.on( "error", function (file,data) {
									//上传失败触发的事件
									console.log('fail');
								} );
							}
						} );
					</script>
				</td>
			</tr>
			<!--<tr class="firstr">
				<td colspan="2">显示位置</td>
			</tr>
			<tr bgcolor="#f5fbff">
				<td height="25">显示在网站首页？</td>
				<td>
					<select name="ifindex" id="ifindex">
						<option value="2">是</option>
						<option value="1">否</option>
					</select>
				</td>
			</tr>
			<tr bgcolor="#f5fbff">
				<td height="25">显示在该分类下：</td>
				<td>
					<select name="catid">
						<option value="0">不在分类显示</option>
						<?=cat_list('category',0,0,true,1)?>
					</select>
				</td>
			</tr>-->
			<tr class="firstr">
				<td colspan="2">链接类型</td>
			</tr>
			<tr bgcolor="#f5fbff">
				<td height="25">品牌类型：</td>
				<td>
					<select name="typeid" id="typeid">
						<?php 
foreach($links AS $row){
?>
						<option value="<?=$row[id]?>">
							<?=$row[typename]?>
						</option>
						<?php
						}
						?>
					</select>
				</td>
			</tr>
			<tr bgcolor="#f5fbff">
				<td width="19%" height="25">排列位置：</td>
				<td width="81%">
					<input name="ordernumber" type=text class=txt id="order" size="10"/> (数值越小，排列越靠前)
				</td>
			</tr>
			<tr bgcolor="#f5fbff">
				<td height="25">链接状态：</td>
				<td>
					<label for="1"><input type='radio' name='ischeck' value="1" id="1" class="radio"/> 待审</label>
					<label for="2"><input type='radio' name='ischeck' value="2" checked id="2" class="radio"/> 正常</label>
				</td>
			</tr>
		</table>
	</div>
	<center><input type="submit" name="submit" value="提 交" class="qq3479015851 large"/>
	</center>
</form>
<?php qq3479015851_admin_tpl_global_foot();?>