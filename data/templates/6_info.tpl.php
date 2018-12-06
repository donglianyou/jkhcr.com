<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>供求信息-<?=$store['tname']?>-<?=$SystemGlobalcfm_global['SiteName']?></title>
<link href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/spaces/store/css/<?=$store['template']?>.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php include qq3479015851_tpl('header'); ?>
<div class="content">
<?php include qq3479015851_tpl('sider'); ?>
<div class="cright">
    	<div class="box"> 
<div class="tit"><span>供求信息</span></div> 
<div class="con cont_01 cfix"> 
<table class="mrw_list"> 
   <tr> 
   <th width="70%" class="list_left">信息标题</th>
   <th class="list_left">所在栏目</th>
                       <th class="list_left">发布时间</th>
   </tr> 
                       <?php if(is_array($info)){foreach($info as $SystemGlobalcfm) { ?>   <tr> 
   <td><a href="<?=$SystemGlobalcfm['uri']?>" target="_blank"><?=$SystemGlobalcfm['title']?></a></td> 
   <td align="left"><?=$SystemGlobalcfm['catname']?></td> 
                       <td><? echo GetTime($SystemGlobalcfm['begintime'],'m-d'); ?></td> 
   </tr>
                       <?php }} else {{ ?>
                       <tr> 
                       <td colspan="5">暂无相关记录！</td> 
                       </tr> 
                       <?php }} ?>
                       
   </table>
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