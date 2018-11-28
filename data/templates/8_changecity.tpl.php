<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
<?php include qq3479015851_tpl('header'); ?>
<title>切换分站-<?=$SystemGlobalcfm_global['SiteName']?></title>
<link type="text/css" rel="stylesheet" href="template/css/global.css">
<link type="text/css" rel="stylesheet" href="template/css/style.css">
<link type="text/css" rel="stylesheet" href="template/css/changecity.css">
    <script>window['current'] = '切换分站';</script>
</head>

<body class="<?=$SystemGlobalcfm_global['cfg_tpl_dir']?>">
<div class="wrapper">
<?php include qq3479015851_tpl('header_search'); ?>
<div class="city_box">
    <h3>热门分站<span class="local-city"><? if($city['cityname']) { ?>目前定位分站：<?=$city['cityname']?><?php } else { ?>请选择您当前所在分站<?php } ?></span></h3>
    <ul class="city_lst hot">
    <?php $hotcities = get_hot_cities(); ?>    <?php if(is_array($hotcities)){foreach($hotcities as $SystemGlobalcfm) { ?>    <li><a href="index.php?mod=index&cityid=<?=$SystemGlobalcfm['cityid']?>"><?=$SystemGlobalcfm['cityname']?></a></li>
    <?php }} ?>
    </ul>
    <h3>按<? echo $SystemGlobalcfm_global['cfg_cityshowtype'] == 'province' ? '所在省份' : '首字母';; ?>查找</h3>
    <ul class="letters_lst">
    <?php $cities = $SystemGlobalcfm_global['cfg_cityshowtype'] == 'province' ? get_changeprovince_cities() : get_changecity_cities(); ?>    <?php if(is_array($cities)){foreach($cities as $k => $SystemGlobalcfm) { ?>    <li><a href="#<?=$k?>"><?=$k?></a></li>
    <?php }} ?>
    </ul>
    <?php if(is_array($cities)){foreach($cities as $k => $SystemGlobalcfm) { ?>    <a name="<?=$k?>"></a>
    <h4><p><span><?=$k?></span><? if($SystemGlobalcfm_global['cfg_cityshowtype'] != 'province') { ?>(以<?=$k?>为开头的城市名)<?php } ?></p></h4>
    <ul class="city_lst">
    <?php if(is_array($SystemGlobalcfm)){foreach($SystemGlobalcfm as $u => $w) { ?>    <li> <a href="index.php?mod=index&cityid=<?=$w['cityid']?>" <? if($w['ifhot'] == 1) { ?>style="color:red;text-decoration:underline;"<?php } ?>><?=$w['cityname']?></a></li>
    <?php }} ?>
    </ul>
    <?php }} ?>  
</div>
<?php include qq3479015851_tpl('footer'); ?>
</body>
</html>