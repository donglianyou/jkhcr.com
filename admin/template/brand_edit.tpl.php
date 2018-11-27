<?php include qq3479015851_tpl('inc_head');?>
<div id="<?=SysGlbCfm_SOFTNAME?>" style=" padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
                <li><a href="brand.php?part=list">所有品牌</a></li>
                <li><a href="brand.php?part=add">添加品牌</a></li>
                <?php if(!$admin_cityid){?><li><a href="brand.php?do=type" <?php if($do=='type'){?>class="current"<?php }?>>品牌类型管理</a></li><?php }?>
				<li><a href="brand.php?part=edit&id=<?=$id?>" class="current">编辑链接</a></li>
            </ul>
        </div>
    </div>
</div>
<form action="brand.php?part=update&id=<?=$link[id]?>" method="post" enctype="multipart/form-data" name="form1" onSubmit="return CheckSubmit();";>
    <input type="hidden" name="createtime" value="<?=date("Y-m-d H:i:s", time()) 
?>">
<div id="<?=SysGlbCfm_SOFTNAME?>">
<table width="100%" cellspacing="0" cellpadding="0" class="vbm">
      <tr class="firstr">
        <td colspan="5">
        <div class="left"><a href="javascript:collapse_change('1')">网站概况</a></div>
        <div class="right"><a href="javascript:collapse_change('1')"><img id="menuimg_1" src="template/images/menu_reduce.gif"/></a></div>
        </td>
      </tr>
      <tbody id="menu_1">
	  <?php if(!$admin_cityid){?>
        <tr bgcolor="#f5fbff">
            <td>隶属分站：</td>
            <td>
            <select name="cityid">
            <option value="0">总站</option>
            <?php echo get_cityoptions($link[cityid]); ?>
           </select>
            </td>
        </tr>
        <?}else{?>
        <input name="cityid" type="hidden" value="<?php echo $admin_cityid; ?>">
        <?php }?> 
	  <tr bgcolor="#f5fbff">
        <td width="19%" height="25">网址：</td>
        <td>
        	<input name="url" type=text class=text id="url" value="<?=$link[url]?>" size="30" />        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td height="25">品牌名称：</td>
        <td>
        	<input name="webname" type=text class=text id="webname" size="30" value="<?=$link[webname]?>"/>        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td height="25">品牌LOGO：</td>
        <td>
        <div id="dropz" style="width: 200px;" class="dropzone"></div>
					<input name="weblogo" type="hidden" id="weblogo" value="<?=$link[weblogo]?>"/>
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
      <!--<tr bgcolor="#f5fbff">
        <td width="19%" height="25">PR值</td>
        <td>
		<?=apply_flink_pr($link[pr]);?>	
        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td width="19%" height="25">日IP</td>
        <td>
        <?=apply_flink_dayip($link[dayip]);?>	    
		</td>
      </tr>-->
      <tr bgcolor="#f5fbff">
        <td height="25">品牌简介：</td>
        <td><textarea name="msg" cols="50" rows="5" id="msg"><?=de_textarea_post_change($link[msg])?></textarea></td>
      </tr>
      </tbody>
      </table>
</div>
<div id="<?=SysGlbCfm_SOFTNAME?>">
<table width="100%" cellspacing="0" cellpadding="0" class="vbm">
     <tr class="firstr">
        <td colspan="3">
         <div class="left"><a href="javascript:collapse_change('3')">其他属性</a></div>
         <div class="right"><a href="javascript:collapse_change('3')"><img id="menuimg_3" src="template/images/menu_reduce.gif"/></a></div>
        </td>
      </tr>
      <tbody id="menu_3">
      <tr bgcolor="#f5fbff">
        <td height="25">品牌类型：</td>
        <td>
        <select name="typeid" id="typeid">
		<?php echo webtype_option($link[typeid]) ; ?>
        </select>
        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td height="25">链接状态：</td>
        <td>
        <label><input class="radio" type='radio' name='ischeck' value="1" <?php if ($link[ischeck]=="1") echo"checked='checked'";?>> 待审</label>
        <label><input type='radio' class="radio" name='ischeck' value="2" <? if ($link[ischeck]=="2") echo"checked='checked'";?>> 正常</label>
                </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td width="19%" height="25">排列序号：</td>
        <td>
<input name="ordernumber" type=text class=txt id="order" value="<?=$link[ordernumber]?>"/>        
(由小到大排列)        
		</td>
      </tr>
</tbody>
    </table>
</div>
<!--<div id="<?=SysGlbCfm_SOFTNAME?>">
<table width="100%" cellspacing="0" cellpadding="0" class="vbm">
<tr class="firstr"><td colspan="2">显示位置</td></tr>
  <tr bgcolor="#f5fbff">
    <td width="19%" height="25">显示在网站首页？</td>
    <td>
    <select name="ifindex" id="ifindex">
    <option value="2" <?php if($link[ifindex] == 2) echo 'selected';?>>是</option>
	<option value="1" <?php if($link[ifindex] == 1) echo 'selected';?>>否</option>
    </select>
    </td>
  </tr>
<tr bgcolor="#f5fbff">
    <td height="25">显示在该分类下：</td>
    <td>
	<select name="catid">
	<option value="0" <?php if($link[catid] == 0) echo 'selected';?>>不在分类显示</option>
	<?=cat_list('category',0,$link['catid'],true,1)?>
  </select>
    </td>
  </tr>
      </tbody>
    </table>
</div>-->
<center><input type="submit" name="submit" value="提 交" class="qq3479015851 large" /></center>
</form>
<?php qq3479015851_admin_tpl_global_foot();?>