<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>产品图片-<?=$store['tname']?>-<?=$SystemGlobalcfm_global['SiteName']?></title> 
<link href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/spaces/store/css/<?=$store['template']?>.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php include qq3479015851_tpl('header'); ?>
<div class="content">
<?php include qq3479015851_tpl('sider'); ?>
<div class="cright">
<div class="box shop_infomain"> 
        	<div class="tit"><span>产品图片</span></div> 
            <div class="bd"><?php if(is_array($goods)){foreach($goods as $SystemGlobalcfm) { ?><li><a href="<?=$SystemGlobalcfm['uri']?>" title="<?=$SystemGlobalcfm['goodsname']?>" target="_blank"><img src="<?=$SystemGlobalcfm_global['SiteUrl']?><?=$SystemGlobalcfm['picture']?>" width="120" height="93" /></a><span><a href="<?=$SystemGlobalcfm['uri']?>" title="<?=$SystemGlobalcfm['goodsname']?>" target="_blank"><?=$SystemGlobalcfm['goodsname']?></a></span><em>&yen;<?=$SystemGlobalcfm['nowprice']?></em></li>
<?php }} else {{ ?>
<li>暂无商品！</li>
<?php }} ?>
            </div>
            <div class="clear"></div>
            <div class="pagination" style="margin-left:15px!important;"><?=$pageview?></div>
</div>
</div>
</div>
<div class="clear15"></div>
<?php include qq3479015851_tpl('footer'); ?>
</body>
</html>