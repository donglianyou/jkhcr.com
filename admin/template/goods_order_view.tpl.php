<?php include qq3479015851_tpl('inc_head');?>
<div id="<?=SysGlbCfm_SOFTNAME?>">
<table border="0" cellspacing="0" cellpadding="0" class="vbm">
      <tr class="firstr">
      <td colspan="2">
       基本资料
      </td>
      </tr>
	<tr bgcolor="#f5fbff">
        <td>订单号</td>
        <td bgcolor="white">
        <?php echo $view['oid']; ?>
        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td>订购的商品</td>
        <td bgcolor="white">
        <a href="../goods.php?id=<?php echo $view['goodsid']; ?>" target="_blank"><?php echo $view['goodsname']; ?></a>
        </td>
      </tr>
	  <tr bgcolor="#f5fbff">
        <td>真实姓名</td>
        <td bgcolor="white">
        <?php echo $view['oname']; ?>
        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td>座机电话</td>
        <td bgcolor="white">
        <?php echo $view['tel']; ?>
        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td>联系地址</td>
        <td bgcolor="white">
        <?php echo $view['address']; ?>
        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td>手机号码</td>
        <td bgcolor="white">
        <?php echo $view['mobile']; ?>
        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td>QQ</td>
        <td bgcolor="white">
        <?php echo $view['qq']; ?>
        </td>
      </tr>
		<tr bgcolor="#f5fbff">
        <td>价格</td>
        <td bgcolor="white">
        <?php echo $view['nowprice']; ?>￥
        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td>购买数量</td>
        <td bgcolor="white">
        <?php echo $view['ordernum']; ?>
        </td>
      </tr>
	<tr bgcolor="#f5fbff">
        <td>总价</td>
        <td bgcolor="white">
        <?php echo $view['nowprice'] * $view['ordernum']; ?>
        </td>
      </tr>
	<tr bgcolor="#f5fbff">
        <td>状态</td>
        <td bgcolor="white">
        <?php echo $view['status']; ?>
        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td>简短附言</td>
        <td bgcolor="white">
        <?php echo $view['msg']; ?>
        </td>
      </tr>
      <tr class="firstr">
      	<td colspan="2">附加资料</td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td>下单时间</td>
        <td bgcolor="white">
        <?php echo GetTime($view['dateline']); ?>
        </td>
      </tr>
      <tr bgcolor="#f5fbff">
        <td>下单IP</td>
        <td bgcolor="white">
        <?php echo $view['ip']; ?>
        </td>
      </tr>
</table>
</div>
<center><input type="submit" class="qq3479015851 large" value="返 回" onClick="history.back();"></center>
<?php qq3479015851_admin_tpl_global_foot();?>