<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
<?php include qq3479015851_tpl('header'); ?>
<title><?=$corp['corpname']?> - 商家店铺 - <?=$SystemGlobalcfm_global['SiteName']?></title>
<link type="text/css" rel="stylesheet" href="template/css/global.css">
<link type="text/css" rel="stylesheet" href="template/css/style.css">
    <link type="text/css" rel="stylesheet" href="template/css/corplist.css">
    <link type="text/css" rel="stylesheet" href="template/css/filter.css">
    <script>window['current'] = '<?=$corp['corpname']?>';</script>
<script src="template/js/jq_min.211.js"></script>
    <script src="template/js/common.js"></script>
    <script src="template/js/iscroll.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded',function(){
        window['myScroll_parent'] = null;
        window['myScroll_inner'] = null;
        showFilter({ibox:'filter2',content1:'parent_container',content2:'inner_container',fullbg:'fullbg'});
    },false);
    </script>
</head>

<body class="<?=$SystemGlobalcfm_global['cfg_tpl_dir']?>">
<div class="body_div">

    
<?php include qq3479015851_tpl('header_search'); ?>
    <div id="mask" onclick="maskHide();"></div>

<div class="dl_nav" style="display:none;">
<span><a href="index.php">首页</a><font class="raquo"></font><a href="index.php?mod=corp">商家机构</a>
        <?php if(is_array($parentcats)){foreach($parentcats as $SystemGlobalcfm) { ?>        <font class="raquo"></font><a href="index.php?mod=corp&cityid=<?=$cityid?>&catid=<?=$SystemGlobalcfm['corpid']?>"><?=$SystemGlobalcfm['corpname']?></a>
        <?php }} ?>
        </span>
</div>

    <div class="filter2" id="filter2">
    
        <ul class="tab cfix">
            <li class="item"><a href="javascript:void(0);"><span id="str_a_node">分类</span><em></em></a></li>
            <li class="item"><a href="javascript:void(0);"><span id="str_b_node">区域</span><em></em></a></li>
            <?php if(is_array($SystemGlobalcfm_extra_model)){foreach($SystemGlobalcfm_extra_model as $SystemGlobalcfm) { ?>            <li class="item"><a href="javascript:void(0);"><span id="str_<?=$SystemGlobalcfm['identifier']?>_node"><? echo cutstr($SystemGlobalcfm['title'],8); ?></span><em></em></a></li>
            <?php }} ?>
        </ul>
        
        <div class="inner" style="display:none;">
            <?php if(is_array($ypcategory)){foreach($ypcategory as $k => $SystemGlobalcfm) { ?>            <ul>
                <a class="<? echo $SystemGlobalcfm['corpid'] == $catid ? 'selected' : '';; ?>" href="index.php?mod=corp&catid=<?=$SystemGlobalcfm['corpid']?>" class="t">不限</a></li>
                <?php if(is_array($SystemGlobalcfm['children'])){foreach($SystemGlobalcfm['children'] as $u => $w) { ?>                <a class="<? echo $w['corpid'] == $catid ? 'selected' : '';; ?>" href="index.php?mod=corp&catid=<?=$w['corpid']?>"><?=$w['corpname']?></a>
                <?php }} ?>
            </ul>
            <?php }} ?> 
        </div>
        
        <? if($cityid > 0) { ?>
        <div class="inner" style="display:none;">
            <ul>
                <a class="<? echo empty($areaid) ? 'selected' : '';; ?>" href="index.php?mod=corp&catid=<?=$catid?>" class="t">不限</a></li>
                <?php if(is_array($city['area'])){foreach($city['area'] as $fcat) { ?>                <li class="item" id="cat_<?=$fcat['areaid']?>">
                    <a href="javascript:void(0);" class="rights <? if($areaid == $fcat['areaid']) { ?>selected<?php } ?>" onclick="showHide(this,'items<?=$fcat['areaid']?>');"><? echo cutstr($fcat['areaname'],20); ?></a>
                    <? if($fcat['street']) { ?>
                    <ul id="items<?=$fcat['areaid']?>">
                        <li><a href="index.php?mod=corp&cityid=<?=$cityid?>&catid=<?=$catid?>&areaid=<?=$fcat['areaid']?>" <? if(!$streetid) { ?>class='selected'<?php } ?>>不限</a></li>
                        <?php if(is_array($fcat['street'])){foreach($fcat['street'] as $scat) { ?>                        <li><a href='index.php?mod=corp&catid=<?=$catid?>&cityid=<?=$cityid?>&areaid=<?=$fcat['areaid']?>&streetid=<?=$scat['streetid']?>' data-id='<?=$scat['streetid']?>'  id='s_b_<?=$scat['streetid']?>' <? if($streetid == $scat['streetid']) { ?>class='selected'<?php } ?>><?=$scat['streetname']?></a></li>
                        <?php }} ?>
                    </ul>
                    <?php } ?>
                </li>
                <?php }} ?>
            </ul>
        </div>
        <?php } else { ?>
        <div class="inner" style="display:none;">
            <ul>
            <?php $hotcities = get_hot_cities(); ?>            <?php if(is_array($hotcities)){foreach($hotcities as $k => $SystemGlobalcfm) { ?>            <a href="index.php?mod=corp&catid=<?=$catid?>&cityid=<?=$SystemGlobalcfm['cityid']?>"><?=$SystemGlobalcfm['cityname']?></a>
            <?php }} ?> 
            </ul>
        </div>
        <?php } ?>
        
        <div class="inner_parent" id="parent_container" style="display:none;"><div class="innercontent"></div></div>
        <div class="inner_child" id="inner_container" style="display:none;"><div class="innercontent"></div></div>
    </div>
<div class="fullbg" id="fullbg" style="display:none;"><i class="pull2"></i></div>
<!--<div class="filtate-outter">

    <div class="list-filtrate">
        <section class="filtrate-nav">
            <ul>
                <li class="filter_li" id="filter_catid"> <a href="javascript:filterShow('catid');">分类<i class="filt-arrow"></i></a> </li>
                <li class="filter_li" id="filter_areaid"> <a href="javascript:filterShow('areaid');">区域<i class="filt-arrow"></i></a> </li>
            </ul>
        </section>
       
        <div class="filt-container">
        
            <?php if(is_array($ypcategory)){foreach($ypcategory as $k => $SystemGlobalcfm) { ?>            <div class="filt-open" id="filter-catid">
                <div class="warpper box-flex1 bg-white" data-key="district" style="height: 286px;">
                    <ul class="">
                    	<li <? echo $SystemGlobalcfm['corpid'] == $catid ? 'class="active"' : '';; ?>><a href="index.php?mod=corp&catid=<?=$SystemGlobalcfm['corpid']?>">不限</a></li>
                        <?php if(is_array($SystemGlobalcfm['children'])){foreach($SystemGlobalcfm['children'] as $u => $w) { ?>                        <li <? echo $w['corpid'] == $catid ? 'class="active"' : '';; ?>><a href="index.php?mod=corp&catid=<?=$w['corpid']?>"><?=$w['corpname']?></a></li>
                        <?php }} ?>
                    </ul>
                </div>
            </div>
            <?php }} ?>
            <div class="filt-open" id="filter-areaid">
                <div class="warpper box-flex1 bg-white" data-key="district" style="height: 400px; overflow-style:marquee-block">
                    <ul class="">
                    	<li class="<? echo $areaid == 0 ? 'active' : '';; ?>"><a href="index.php?mod=corp&catid=<?=$catid?>">不限</a></li>
                    <?php if(is_array($area_list)){foreach($area_list as $k => $SystemGlobalcfm) { ?>                        <li class="zone <? echo $SystemGlobalcfm['areaid'] == $areaid ? 'active' : '';; ?>" id="zone_<?=$SystemGlobalcfm['areaid']?>"><a href="index.php?mod=corp&catid=<?=$catid?>&areaid=<?=$SystemGlobalcfm['areaid']?>"><?=$SystemGlobalcfm['areaname']?></a></li>
                        <?php }} ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>-->

    <ul class="search-list J_list">
    <?php if(is_array($member)){foreach($member as $SystemGlobalcfm) { ?>    <li>
        <a class="item Fix" href="index.php?mod=store&id=<?=$SystemGlobalcfm['id']?>">
            <div class="pic">
                <img src="<?=$SystemGlobalcfm_global['SiteUrl']?><?=$SystemGlobalcfm['prelogo']?>">
            </div>
            <div class="content">
                <div class="name">
                    <h3 class="shopname"><? echo cutstr($SystemGlobalcfm['tname'],24); ?>                    </h3>
                </div>
                <div class="comment">
                        <span><?=$SystemGlobalcfm['tel']?></span>

                </div>
                <div class="intro Fix">
                    <span class="type"><? echo cutstr($SystemGlobalcfm['address'],30); ?></span>
                    
                </div>
            </div>
        </a>
    </li>
    <?php }} else {{ ?>
    <li style="padding:50px 0; text-align:center;">没有找到相关机构店铺！<a href="javascript:history.back(-1);">返回</a></li>
    <?php }} ?>
    <? if($member) { ?>
<div class="pager" style="border-top:none;border-bottom:1px #ddd solid;">
    <?=$pageview?>
</div>
<?php } ?>
</ul>
<?php include qq3479015851_tpl('footer'); ?>
</div>
</body>
</html>