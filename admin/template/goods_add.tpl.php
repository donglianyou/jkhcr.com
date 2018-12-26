<?php include qq3479015851_tpl('inc_head');?>
<script language="javascript" src="js/vbm.js"></script>
<script language="javascript">
function check_sub(){
	if (document.form1.goodsname.value=="") {
		alert('请填写商品名称');
		document.form1.goodsname.focus();
		return false;
	}
	if (document.form1.catid.value=="") {
		alert('请选择商品分类');
		document.form1.catid.focus();
		return false;
	}
	/*if (document.form1.userid.value=="") {
		alert('请填写发起商品的会员用户名');
		document.form1.userid.focus();
		return false;
	}*/
	/*if (document.form1.content.value=="") {
		alert('请填写商品详细介绍！');
		document.form1.content.focus();
		return false;
	}*/
	return true;
}
</script>
<style>
.vbm tr{ background:#ffffff}
.altbg1{ background-color:#f1f5f8}
</style>
<form name="form1" action="?part=add" method="post" enctype="multipart/form-data" onSubmit="return check_sub();">
<input name="userid" value="admin" type="hidden">
<div id="<?=SysGlbCfm_SOFTNAME?>">
<table width="100%" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr">
	<td colspan="2">基本信息</td>
</tr>

<tr>
    <td class="altbg1">商品名称:<font color="red">*</font></td>
    <td>
        <input type="text" name="goodsname" value="" class="text" />
    </td>
</tr>
<!--<tr>
    <td class="altbg1" width="15%">供货商家用户名:<font color="red">*</font></td>
    <td width="75%">
        <input type="text" name="userid" id="userid" value="<?=$edit['userid']?>" class="text" style="background-color:#eee"/> <font color=red>非必要，请勿修改</font>
    </td>
</tr>-->
<tr>
    <td class="altbg1">市场价格:</td>
    <td>
	<input name="oldprice" value="" type="text" class="text" style="width:50px"/> <?php echo $moneytype; ?>
    </td>
</tr>
<tr>
    <td class="altbg1">优惠价格:</td>
    <td>
	<input name="nowprice" value="" type="text" class="text" style="width:50px"/> <?php echo $moneytype; ?>
    </td>
</tr>
<tr>
    <td class="altbg1">商品分类:<font color="red">*</font></td>
    <td>
        <select name="catid">
	<option value="">==选择商品所属的分类==</option>
	<?=goods_cat_list(0,$edit['catid'])?>
	</select>
    </td>
</tr>

<tr>
    <td class="altbg1">商品图片:</td>
	<td>
        <div id="dropz" style="width: 200px;" class="dropzone"></div>
					<input name="picture" type="hidden" id="picture" value=""/>
					<script>
						$( "div#dropz" ).dropzone( {
							url: "/admin/goods_upload.php",
							maxFiles: 1, //最大上传数量
							maxFilesize: 100, //最大上传的文件大小，单位MB
							filesizeBase: 1024, //文件大小的标准规格，这里MB以1024kb为单位
							acceptedFiles: ".jpg,.png,.gif", //允许上传的文件类型
							init: function () {
								this.on( "success", function (file,data) {
									//上传成功触发的事件
									console.log('ok');
									$("#picture").val(data);
								} );
								this.on( "error", function (file,data) {
									//上传失败触发的事件
									console.log('fail');
								} );
							}
						} );
					</script>
    </td>
    <!--<td> 
    <input type="file" name="goods_image" size="30" id="litpic" onChange="SeePic(document.picview,document.form1.litpic);">
    </td>-->
</tr>
<!--<tr>
    <td class="altbg1">预览:</td>
    <td> 
    <img src="template/images/mpview.gif" width="150" id="picview" name="picview" />
    </td>
</tr>-->
<tr class="firstr">
	<td colspan="2">附加信息</td>
</tr>
<tr>
    <td class="altbg1">赠送礼品:</td>
    <td>
	<input name="gift" value="本商品没有赠送礼品" class="text">
    </td>
</tr>
<tr>
    <td class="altbg1">货源情况:</td>
    <td>
	<input name="huoyuan" type="radio" class="radio" value="1" checked>有货
	<input name="huoyuan" type="radio" class="radio" value="2">缺货
    </td>
</tr>
<tr>
    <td class="altbg1">商品属性:</td>
    <td>
		<input name="rushi" type="checkbox" class="radio" value="1" checked>如实描述
		<input name="tuihuan" type="checkbox" class="radio" value="1">七天退换
		<input name="jiayi" type="checkbox" class="radio" value="1">假一赔三
		<input name="weixiu" type="checkbox" class="radio" value="1">30天维修
		<input name="fahuo" type="checkbox" class="radio" value="1">闪电发货
		<input name="zhengpin" type="checkbox" class="radio" value="1">正品保障
    </td>
</tr>
<tr>
    <td class="altbg1">商品状态:</td>
    <td>
		<input name="onsale" type="checkbox" class="radio" value="1">上架
		<input name="tuijian" type="checkbox" class="radio" value="1">推荐
		<input name="remai" type="checkbox" class="radio" value="1">热卖
		<input name="cuxiao" type="checkbox" class="radio" value="1">促销
		<input name="baozhang" type="checkbox" class="radio" value="1" checked>加入消费者保障计划
    </td>
</tr>
</table>
<div style="margin-top:3px;"><?php echo $acontent; ?></div>
</div>
<div style="padding-left:18%; padding-top:10px; padding-bottom:10px;">
<input type="submit" name="goods_submit" value="提 交" class="qq3479015851 large" style="margin-right:15px"/>
<input type="button" onclick="history.back();" value="返回" class="qq3479015851 large" />
</div>
</form>
<?php qq3479015851_admin_tpl_global_foot();?>