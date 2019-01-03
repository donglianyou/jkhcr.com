<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
<?php include qq3479015851_tpl('header'); ?>
<title><?=$store['tname']?> - <?=$SystemGlobalcfm_global['SiteName']?></title>
<link type="text/css" rel="stylesheet" href="template/css/global.css">
<link type="text/css" rel="stylesheet" href="template/css/style.css">
    <link type="text/css" rel="stylesheet" href="template/css/store.css">
    <script>window['current'] = '商家店铺';</script>
</head>

<body class="<?=$SystemGlobalcfm_global['cfg_tpl_dir']?>">
<div class="wrapper">

    
<?php include qq3479015851_tpl('header_search'); ?>
    
    
<?php include qq3479015851_tpl('store_header'); ?>
    <div class="clearfix"></div>
    
    <div class="mbox userintro">
    <p class="mbox_t" onclick="javascript:window.location.href='index.php?mod=store&id=<?=$store['id']?>&action=aboutus'" pagetitle="机构简介"> <a href="javascript:void(0)"> <b>商家介绍</b> <i class="icon arr1"></i> </a> </p>
    <div class="intro" style="overflow:hidden;text-overflow:ellipsis;height:74px">
    <?=$store['introduce']?>
    </div>
    </div>

 	
<div class="mbox fw">
   <p class="mbox_t" onclick="javascript:window.location.href='index.php?mod=store&action=info&id=<?=$store['id']?>'" pageTitle="全部信息">
      <a href="javascript:void(0)">
         <b>发表的信息</b><i class="icon arr1"></i>
       </a>
   </p>
   
   <ul class="infolst">
   <?php if(is_array($info_list)){foreach($info_list as $SystemGlobalcfm) { ?>   	<li class="linkdetail" onclick="javascript:window.location.href='index.php?mod=information&id=<?=$SystemGlobalcfm['id']?>'">
            <dd class="tit" style=""><?=$SystemGlobalcfm['title']?></dd>
            <dd class="tm"> <? echo GetTime($SystemGlobalcfm['begintime'],'m-d'); ?></dd>
    </li>
   <?php }} else {{ ?>
   <li class="linkdetail">暂无数据...</li>
   <?php }} ?>
    </ul>
</div>

<div class="mbox fw">
   <p class="mbox_t" onclick="javascript:window.location.href='index.php?mod=store&action=docu&id=<?=$store['id']?>'" pageTitle="最新动态">
      <a href="javascript:void(0)">
         <b>最新动态</b><i class="icon arr1"></i>
       </a>
   </p>
   
   <ul class="infolst">
   <?php if(is_array($docu_list)){foreach($docu_list as $SystemGlobalcfm) { ?>   	<li class="linkdetail" onclick="javascript:window.location.href='index.php?mod=store&action=docu&id=<?=$SystemGlobalcfm['uid']?>&docuid=<?=$SystemGlobalcfm['id']?>'">
            <dd class="tit" style=""><?=$SystemGlobalcfm['title']?></dd>
            <dd class="tm"> <? echo GetTime($SystemGlobalcfm['pubtime'],'m-d'); ?></dd>
    </li>
   <?php }} else {{ ?>
   <li class="linkdetail">暂无数据...</li>
   <?php }} ?>
    </ul>
</div>
 

<div class="mbox useralbum" style="margin-bottom: 0px">
<p class="mbox_t" onclick="javascript:window.location.href='index.php?mod=store&id=<?=$store['id']?>&action=album'" pagetitle="商家相册"> 
<a href="javascript:void(0)"> <b>机构相册</b> <i class="icon arr1"></i> </a> </p>
    <div class="image_area_w">
        <div class="image_area">
            <ul>
            <?php if(is_array($album)){foreach($album as $SystemGlobalcfm) { ?>            <li><a href="index.php?mod=store&id=<?=$store['id']?>&action=album"><img src="<?=$SystemGlobalcfm_global['SiteUrl']?>/<?=$SystemGlobalcfm['prepath']?>" ref="<?=$SystemGlobalcfm_global['SiteUrl']?>/images/nophoto.gif"></a></li>
            <?php }} ?>
            </ul>
        </div>
    </div>
</div>
</div>
<?php include qq3479015851_tpl('footer'); ?>
</body>
</html>