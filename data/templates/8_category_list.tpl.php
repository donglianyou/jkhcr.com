<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
<?php include qq3479015851_tpl('header'); ?>
<title><?=$cat['catname']?> - <?=$SystemGlobalcfm_global['SiteName']?></title>
<link type="text/css" rel="stylesheet" href="template/css/global.css">
<link type="text/css" rel="stylesheet" href="template/css/style.css">
    <link type="text/css" rel="stylesheet" href="template/css/list.css">
    <link type="text/css" rel="stylesheet" href="template/css/filter.css">
    <script>window['current'] = '<?=$city['cityname']?><?=$cat['catname']?>';</script>
</head>

<body class="<?=$SystemGlobalcfm_global['cfg_tpl_dir']?>">
<div class="wrapper">

    
<?php include qq3479015851_tpl('header_search'); ?>
<div class="dl_nav" style="display:none">
<span><a href="index.php">首页</a><font class="raquo"></font><a href="index.php?mod=category">信息分类</a>
        <?php if(is_array($parentcats)){foreach($parentcats as $SystemGlobalcfm) { ?>        <font class="raquo"></font><a href="index.php?mod=category&cityid=<?=$cityid?>&catid=<?=$SystemGlobalcfm['catid']?>"><?=$SystemGlobalcfm['catname']?></a>
        <?php }} ?>
        </span>
</div>

<div class="filter2" id="filter2">
    
        <!--<ul class="tab cfix">
            <? if($cat_list) { ?><li class="item"><a href="javascript:void(0);"><span id="str_a_node">分类</span><em></em></a></li><?php } ?>
            <li class="item"><a href="javascript:void(0);"><span id="str_b_node">区域</span><em></em></a></li>
            <?php if(is_array($SystemGlobalcfm_extra_model)){foreach($SystemGlobalcfm_extra_model as $SystemGlobalcfm) { ?>            <li class="item"><a href="javascript:void(0);"><span id="str_<?=$SystemGlobalcfm['identifier']?>_node"><? echo cutstr($SystemGlobalcfm['title'],8); ?></span><em></em></a></li>
            <?php }} ?>
        </ul>-->
        
        <div class="inner" style="display:none;">
            <?php if(is_array($cat_list)){foreach($cat_list as $k => $SystemGlobalcfm) { ?>            <ul>
                <a class="<? echo $SystemGlobalcfm['catid'] == $catid ? 'selected' : '';; ?>" href="index.php?mod=category&catid=<?=$SystemGlobalcfm['catid']?>" class="t">不限</a></li>
                <?php if(is_array($SystemGlobalcfm['children'])){foreach($SystemGlobalcfm['children'] as $u => $w) { ?>                <a class="<? echo $w['catid'] == $catid ? 'selected' : '';; ?>" href="index.php?mod=category&catid=<?=$w['catid']?>"><?=$w['catname']?></a>
                <?php }} ?>
            </ul>
            <?php }} ?> 
        </div>
        
        <? if($city['cityid']) { ?>
        <div class="inner" style="display:none;">
            <ul>
        	<li><a href="index.php?mod=category&cityid=<?=$cityid?>&catid=<?=$catid?>" <? if(!$areaid) { ?>class='selected'<?php } ?>>不限</a></li>
        <?php if(is_array($city['area'])){foreach($city['area'] as $fcat) { ?>            <li class="item" id="cat_<?=$fcat['areaid']?>">
            	<a href="javascript:void(0);" class="rights <? if($areaid == $fcat['areaid']) { ?>selected<?php } ?>" onclick="showHide(this,'items<?=$fcat['areaid']?>');"><? echo cutstr($fcat['areaname'],20); ?></a>
                
                <ul id="items<?=$fcat['areaid']?>">
                	<li><a href="index.php?mod=category&cityid=<?=$cityid?>&catid=<?=$catid?>&areaid=<?=$fcat['areaid']?>" <? if(!$streetid) { ?>class='selected'<?php } ?>>不限</a></li>
<? if($fcat['street']) { ?><?php if(is_array($fcat['street'])){foreach($fcat['street'] as $scat) { ?><li><a href='index.php?mod=category&catid=<?=$catid?>&cityid=<?=$cityid?>&areaid=<?=$fcat['areaid']?>&streetid=<?=$scat['streetid']?>' data-id='<?=$scat['streetid']?>'  id='s_b_<?=$scat['streetid']?>' <? if($streetid == $scat['streetid']) { ?>class='selected'<?php } ?>><?=$scat['streetname']?></a></li>
<?php }} ?>
<?php } ?>
                </ul>
                
            </li>
            <?php }} ?>
        </ul>
        </div>
        <?php } else { ?>
        <div class="inner" style="display:none;">
            <ul>
            <?php if(is_array($hotcities)){foreach($hotcities as $k => $SystemGlobalcfm) { ?>            <a href="index.php?mod=category&catid=<?=$catid?>&cityid=<?=$SystemGlobalcfm['cityid']?>"><?=$SystemGlobalcfm['cityname']?></a>
            <?php }} ?> 
            </ul>
        </div>
        <?php } ?>
        
        <?php if(is_array($SystemGlobalcfm_extra_model)){foreach($SystemGlobalcfm_extra_model as $SystemGlobalcfm) { ?>        <div class="inner" style="display:none;">
            <ul>
            <?php if(is_array($SystemGlobalcfm['list'])){foreach($SystemGlobalcfm['list'] as $c) { ?>            <a class="<? echo $c['select'] == 1 ? 'selected' : '';; ?>" href="<?=$c['uri']?>"><?=$c['name']?></a>
            <?php }} ?>
            </ul>
        </div>
        <?php }} ?>
        <div class="inner_parent" id="parent_container" style="display:none;"><div class="innercontent"></div></div>
        <div class="inner_child" id="inner_container" style="display:none;"><div class="innercontent"></div></div>
    </div>
<div class="fullbg" id="fullbg" style="display:none;"><i class="pull2"></i></div>

    <? if(!$distance) { ?>
    <li class="nearbyinfo" onclick="nearby(0.5,'','')">
        <span style=" margin-right: 4px"><img src="template/images/icon_location.png" height="20" style="vertical-align:middle;"></span>
        <span id="nearby">查看附近的信息</span>
    </li>
    <?php } else { ?>
    <ul class="distance-filter" <? if(!$distance) { ?>style="display: none;"<?php } ?>>
        <li><a data-distance="500" <? if($distance == '0.5') { ?>class="current"<?php } ?> href="javascript:" onclick="nearby(0.5,'','')">500米</a></li>
        <li><a data-distance="1000" <? if($distance == '1') { ?>class="current"<?php } ?> href="javascript:" onclick="nearby(1,'','')">1000米</a></li>
        <li><a data-distance="3000" <? if($distance == '3') { ?>class="current"<?php } ?>href="javascript:" onclick="nearby(3,'','')">3000米</a></li>
        <li><a data-distance="5000" <? if($distance == '5') { ?>class="current"<?php } ?> href="javascript:" onclick="nearby(5,'','')">5000米</a></li>
    </ul>
    <?php } ?>
    <input type="hidden" id="distanceInput" value="">

<div class="infolst_w">
<ul class="list-info">
        <?php if(is_array($info_list)){foreach($info_list as $SystemGlobalcfm) { ?>    		<li class="<? echo $SystemGlobalcfm['upgrade_type'] > 1 ? 'dingbg' : '';; ?>">
                <a href="index.php?mod=information&id=<?=$SystemGlobalcfm['id']?>">
                <? if($SystemGlobalcfm['img_path']) { ?>
<img class="thumbnail" src="<?=$SystemGlobalcfm_global['SiteUrl']?><?=$SystemGlobalcfm['img_path']?>" alt="<?=$SystemGlobalcfm['title']?></strong>">
<?php } else { ?>
<img class="thumbnail" src="template/images/noimg.gif" alt="nopic">
<?php } ?>
<dl>
<dt class="tit" style="<? echo $SystemGlobalcfm['ifred'] == 1 ? 'color:red;' : ''; echo $SystemGlobalcfm['ifbold'] == 1 ? 'font-weight:bold;' : ''; ?>"><?=$SystemGlobalcfm['title']?>&nbsp;<? if($SystemGlobalcfm['img_path']) { ?><span style="background:#339966; color:#FFFFFF; font-size:14px; padding:0 2px;text-align:center;"><?=$SystemGlobalcfm['img_count']?>图</span><?php } echo $SystemGlobalcfm['upgrade_type'] > 1 ? '<span class="ico ding"></span>' : '';; ?></dt>
<dd class="attr"><span><? echo cutstr(clear_html($SystemGlobalcfm['content']),50); ?></span></dd>
<dd class="attr pr5">
                    <?php if(is_array($SystemGlobalcfm['extra'])){foreach($SystemGlobalcfm['extra'] as $w) { ?>                    <? if(strexists($w,'元')) { ?>
                    <span class="price">
                    <? echo substr($w,0,1) === '0' ? ' 面议 ' : str_replace('.00','',$w); ?>                    </span>
                    <?php } ?>
                    <?php }} ?>
                    <span class="lvzi"><? echo get_format_time($SystemGlobalcfm['begintime']); ?></span>
                    <span>阅<?=$SystemGlobalcfm['hit']?></span>
</dd>
</dl>
                </a>
    		</li>
        <?php }} else {{ ?>
        <div style="padding:50px 0; text-align:center;color:#999; background-color:#ffffff;">没有找到<?=$cat['catname']?>相关信息记录！ <a href="javascript:history.back(-1);">返回</a></div>
<?php }} ?>
</ul>  
</div>

    <? if($info_list) { ?>
<div class="pager">
    <?=$pageview?>
</div>
<?php } ?>
</div>
<?php include qq3479015851_tpl('footer'); ?>
<script src="template/js/iscroll.js"></script>
<script>
document.addEventListener('DOMContentLoaded',function(){
window['myScroll_parent'] = null;
window['myScroll_inner'] = null;
showFilter({ibox:'filter2',content1:'parent_container',content2:'inner_container',fullbg:'fullbg'});
},false);
</script>
</body>
</html>