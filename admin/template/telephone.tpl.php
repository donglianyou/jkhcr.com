<?php include qq3479015851_tpl('inc_head');?>
<div id="<?=QQ3479015851_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
  <tr class="firstr">
  	<td colspan="2">相关说明</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td id="menu_tip">
 <li>生活百宝箱显示在首页底部，显示12个便民电话号码</li>
    </td>
  </tr>
</table>
</div>
<form action="?" method="post">
<input name="forward_url" value="<?=GetUrl()?>" type="hidden"/>
<div id="<?=QQ3479015851_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
    <tr style="font-weight:bold; background-color:#dff6ff">
      <td><input class="checkbox" name="checkall" type="checkbox" id="checkall" onClick="CheckAll(this.form)"/> 删?</td>
      <td>电话所属商家或行业</td>
      <td>电话号码</td>
      <td>颜色</td>
      <td>是否加粗</td>
      <td>显示顺序</td>
      <td>启用状态</td>
    </tr>
    <?php foreach($telephone as $k =>$value){?>
        <tr bgcolor="white">
          <td><input class="checkbox" type='checkbox' name='delids[]' value='<?=$value[id]?>' id="<?=$value[id]?>"></td>
          <td><input class="text" name="edit[<?=$value[id]?>][telname]" value="<?=$value[telname]?>" /></td>
          <td><input class="text" value="<?=$value[telnumber]?>" name="edit[<?=$value[id]?>][telnumber]"/></td>
          <td>

		  <select name="edit[<?=$value[id]?>][color]">
                <option value="">默认颜色</option>
                <?foreach ($color as $kk=>$k){?>
                <option value="<?=$kk?>" <?php if($kk == $value[color]) echo 'selected';?> style="background-color:<?=$kk?>;"><?=$k?></option>
                <?}?>
      		  </select>
          </td>
          <td><select name="edit[<?=$value[id]?>][if_bold]">
              <option value="0" <?php if($value['if_bold'] != 1){echo 'selected="selected"; style="background-color:#6EB00C;color:white"';}?>>不加粗</option>
              <option value="1" <?php if($value['if_bold'] == 1){echo 'selected="selected"; style="background-color:#6EB00C;color:white"';}?>>加粗</option>
      		  </select>
          </td>
          <td><input name="edit[<?=$value[id]?>][displayorder]" value="<?=$value[displayorder]?>" type="text" class="txt"/></td>
          <td><select name="edit[<?=$value[id]?>][if_view]"><?=get_ifview_options($value[if_view])?></select></td>
        </tr>
    <?}?>
    <tr bgcolor="#f5fbff">
      <td align="center"><b>新增</b></td>
      <td><input name="add[telname]" value="" type="text" class="text"/></td>
      <td><input name="add[telnumber]" value="" type="text" class="text"/></td>
      <td><select name="add[color]" style="float:left">
              <option value="">默认颜色</option>
               <?php echo get_color_options(); ?>
      		  </select></td>
      <td><select name="add[if_bold]">
              <option value="0">不加粗</option>
              <option value="1">加粗</option>
      		  </select></td>
      <td><input name="add[displayorder]" value="0" type="text" class="txt"/></td>
      <td><select name="add[if_view]">
      <?=get_ifview_options(2)?>
      </select></td>
    </tr>
</table>
</div>
<center>
<input class="qq3479015851 large" value="提 交" name="<?php echo CURSCRIPT; ?>_submit" type="submit"> &nbsp;
</center>
</form>
<div class="pagination"><?php echo page2()?></div>  
<?php qq3479015851_admin_tpl_global_foot();?>