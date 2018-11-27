<?php include qq3479015851_tpl('inc_head');?>
<div id="<?=SysGlbCfm_SOFTNAME?>" style=" padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
                <li><a href="brand.php?part=list" <?php if($part=='list'){?>class="current"<?php }?>>所有品牌</a></li>
                <li><a href="brand.php?part=add" <?php if($part=='add'){?>class="current"<?php }?>>添加品牌</a></li>
                <?php if(!$admin_cityid){?><li><a href="brand.php?do=type" <?php if($do=='type'){?>class="current"<?php }?>>品牌类型管理</a></li><?php }?>
            </ul>
			<ul style="float:right; text-align:right">
            <?php if(!$admin_cityid){?>
            <select name="cityid" onChange="location.href='?page=<?=$page?>&do=link&cityid='+(this.options[this.selectedIndex].value)">
            <option value="0">总站</option>
            <?php echo get_cityoptions($cityid); ?>
            </select>
            <?}?>
            </ul>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="small-section">
	<a href="brand.php?cityid=" class="current">全部</a>
		<a href="brand.php?typeid=1&amp;cityid=" class="current">燕窝及高端滋补品</a>
		<a href="brand.php?typeid=2&amp;cityid=" class="current">酵素</a>
		<a href="brand.php?typeid=4&amp;cityid=" class="current">功能食品</a>
	
</div>
<div class="clearfix"></div>
<form method='post' action='?part=doall'>
<div id="<?=SysGlbCfm_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr class="firstr">
      <td width="30">选择</td>
      <td width="40">状态</td>
	  <td width="80">顺序</td>
      <td width="140">品牌名称</td>
      <td>品牌地址</td>
      <td>品牌类型</td>
	  <?php if(!$catid){?>
      <td>网站logo</td>
	  <?php }?>
      <td>添加时间</td>
      <td width="100">管理</td>
    </tr>
    <?php foreach($links AS $row){?>
    <tr align="center" bgcolor="white">
      <td><input type='checkbox' name='ids[]' value='<?=$row[id]?>' class="checkbox" id="<?=$row[id]?>"></td>
	  <td><? if ($row[ischeck]=="1") echo"<font color=red>待审</font>";elseif($row[ischeck]=="2") echo"<font color=green>正常</font>";?></td>
      <td><input name="ordernumber[<?=$row[id]?>]" value="<?=$row[ordernumber]?>" class="txt"/></td>
      <td><?=$row[webname]?></td>
      <td align="left"><a href="<?=$row[url]?>" target="_blank" style="text-decoration:underline;"><?=$row[url]?></a></td>
      <td align="left"><?=webtypename($row[typeid])?></td>
	  <?php if(!$catid){?>
      <td><?if (!empty($row[weblogo])){?><a href="<?=$row[weblogo]?>"><img src="<?=$row[weblogo]?>" width="125" style="max-height:110px" border="0" alt="点击查看图片完整大小"/></a><?}else{?>无<?}?></td>
	  <?php }?>
      <td><em><?=GetTime($row[createtime])?></em></td>
      <td><a href='brand.php?id=<?=$row['id']?>&part=edit'>更改</a> / <a href='brand.php?id=<?=$row[id]?>&part=delete' onClick="return confirm('您确定要删除该链接吗，如不确定请点取消')">删除</a> </td>
    </tr>
    <?}?>
<tr bgcolor="#ffffff" height="28">
    <td style="border-right:1px #fff solid;"><input name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)" class="checkbox"/></td>
    <td colspan="10">
	<b>选择-></b>
	<!--<label for="index"><input name="do_action" class="radio" id="index" value="index" type="radio">首页显示</label> 
	<label for="inside"><input name="do_action" class="radio" id="inside" value="inside" type="radio">取消首页显示</label>-->
	<label for="check2"><input name="do_action" class="radio" id="check2" value="check2" type="radio">正常</label>
	<label for="check1"><input name="do_action" class="radio" id="check1" value="check1" type="radio">待审</label>
	<hr style="height:1px; border:1px #c5d8e8 solid;"/>
	<b>删除-></b> 
	<label for="del"><input name="do_action" class="radio" id="del" value="del" type="radio">删除</label> 
    </td>
</tr>
</table>
</div>
<center style='margin:10px'><input type="submit" value="提 交"  class="qq3479015851 large"/> </center>
</form>
<div class="pagination"><?php echo page2()?></div>  
<?php qq3479015851_admin_tpl_global_foot();?>