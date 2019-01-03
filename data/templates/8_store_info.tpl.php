<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
<?php include qq3479015851_tpl('header'); ?>
<title>分类信息 - <?=$store['tname']?> - <?=$SystemGlobalcfm_global['SiteName']?></title>
<link type="text/css" rel="stylesheet" href="template/css/global.css">
<link type="text/css" rel="stylesheet" href="template/css/style.css">
    <link type="text/css" rel="stylesheet" href="template/css/store.css">
    <script>window['current'] = '<?=$navi[$action]?>';</script>
</head>

<body class="<?=$SystemGlobalcfm_global['cfg_tpl_dir']?>">
<div class="wrapper">

    
<?php include qq3479015851_tpl('header_search'); ?>
    
    
<?php include qq3479015851_tpl('store_header'); ?>
    <div class="clearfix"></div>
    
    <div class="mbox fw" style="margin-bottom:0;">
       <p class="mbox_t" pageTitle="全部信息">
          <a href="javascript:void(0)">
             <b>发表的信息</b>
           </a>
       </p>
       
       <ul class="infolst">
       <?php if(is_array($info_list)){foreach($info_list as $SystemGlobalcfm) { ?>        <li class="linkdetail" onclick="javascript:window.location.href='index.php?mod=information&id=<?=$SystemGlobalcfm['id']?>'" pageTitle="详情">
                <dd class="tit" style=""><?=$SystemGlobalcfm['title']?></dd>
                <dd class="tm"> <? echo GetTime($SystemGlobalcfm['begintime'],'m-d'); ?></dd>
        </li>
       <?php }} else {{ ?>
        <li class="linkdetail">没有找到相关的信息！</li>
       <?php }} ?>
        </ul>
    </div>
    
    <? if($info_list) { ?>
<div class="pager" style="border-top:none; border-bottom:1px #ddd solid;">
    <?=$pageview?>
</div>
<?php } ?>
</div>
<?php include qq3479015851_tpl('footer'); ?>
</body>
</html>