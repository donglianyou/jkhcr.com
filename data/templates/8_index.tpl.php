<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
<?php include qq3479015851_tpl('header'); ?>
<meta name="keywords" content="<?=$SystemGlobalcfm_global['SiteName']?>"/>
<meta name="description" content="<?=$SystemGlobalcfm_global['SiteName']?>手机版"/>
<title><?=$SystemGlobalcfm_global['SiteName']?>-手机版</title>
<link type="text/css" rel="stylesheet" href="template/css/global.css">
<link type="text/css" rel="stylesheet" href="template/css/style.css">
<link type="text/css" rel="stylesheet" href="template/css/index.css">
<? if(!$cityid && !$lat) { ?>
<script>
if (navigator.geolocation)
{
navigator.geolocation.getCurrentPosition(showPosition);
}

function showPosition(position)
{
var lat = position.coords.latitude;
var lng = position.coords.longitude;
var replaceuri = '<?=$SystemGlobalcfm_global['SiteUrl']?>/m/index.php?lat='+lat+'&lng='+lng;window.location.replace(replaceuri);
}
</script>
<?php } ?>
</head>

<body class="<?=$SystemGlobalcfm_global['cfg_tpl_dir']?>">
<div class="wrapper">
    
<?php include qq3479015851_tpl('header_search'); ?>
    
<?php include qq3479015851_tpl('navigation'); ?>
    <div class="clear"></div>
    <?php $focus = get_mobile_gg(1); ?>    <? if($focus) { ?>
    <section>
    <div id="slide" style="display:none;">
        <div id="content">
            <?php if(is_array($focus)){foreach($focus as $SystemGlobalcfm) { ?>            <div class="cell">
            <a href="<?=$SystemGlobalcfm['url']?>"><img src="<?=$SystemGlobalcfm_global['SiteUrl']?><?=$SystemGlobalcfm['image']?>" alt="<?=$SystemGlobalcfm['words']?>"></a>
            </div>
            <?php }} ?>
            </div>
        <ul id="indicator"></ul>
    </div>
    <span class="prev" id="slide_prev" style="display:none">上一张</span><span class="next" id="slide_next" style="display:none">下一张</span>
    </section>
    <div class="clear"></div>
    <?php } ?>
        
    <div class="mod_02" id="myPicsrc">
                <div class="bd tab-cont">
                    <ul class="list_normal list_news">
                        <?php if(is_array($news)){foreach($news as $SystemGlobalcfm) { ?>                        <li class="img">
                            <a href="<?=$SystemGlobalcfm['uri']?>" class="link">
                            <p class="img"><img src="<?=$SystemGlobalcfm['imgpath']?>" onerror="this.src='<?=$SystemGlobalcfm_global['SiteUrl']?>/images/nophoto.jpg'" /></p>
                            <p class="tit"<? if($SystemGlobalcfm['iscommend'] ==1) { ?>style="color:red"<?php } ?>><?=$SystemGlobalcfm['title']?></p>
                            <p class="txt"><? echo cutstr($SystemGlobalcfm['title'],20); ?></p>
                            <p class="hot po_ab"><? echo GetTime($SystemGlobalcfm['begintime'],'m-d'); ?></p>
                            </a>
                        </li>
                        <?php }} ?>
                    </ul>
                </div>
                
            </div>
    <script src="template/js/slider.js"></script>
<script>(function($){var list=$('#content').find('.cell');if(list.length>0){var txt='';$('#content').find('.cell').each(function(i){if(i===0){txt+='<li class="active">1</li>'}else{txt+='<li>'+(i+1)+'</li>'}});$('#indicator').html(txt);var w_w=$(window).width();setTimeout(function(){new C_Scroll({container:'slide',content:'content',ct:'indicator',size:w_w,intervalTime:5000,lazyIMG:!!0})},20);setTimeout(function(){$('#slide').show()},20)}})(jQuery);</script>
    <div class="index-category">
        <div class="index_slider">
            <div class="index_slider-wrap">
                <div class="page">
                <?php $navigation = get_mobile_nav(2); ?>    <?php if(is_array($navigation)){foreach($navigation as $SystemGlobalcfm) { ?>                <a href="<?=$SystemGlobalcfm['url']?>" class="item food"><? if($SystemGlobalcfm['ico']) { ?><div class="icon"><img src="<?=$SystemGlobalcfm_global['SiteUrl']?><?=$SystemGlobalcfm['ico']?>"></div><?php } echo cutstr($SystemGlobalcfm['title'],8); ?></a>
                <?php }} ?>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div id="tab_01" class="newsct">
        <div class="select_03 select_03_<?=$SystemGlobalcfm_global['cfg_tpl_dir']?> tab-hd">
            <ul>
                <li class="item current current1"><a href="javascript:void(0);">首页置顶</a></li>
                <?php $ifnews = ifplugin('news'); ?>                <? if($ifnews) { ?><li class="item current2"><a href="javascript:void(0);">热点资讯</a></li><?php } else { ?><li class="item current2"><a href="javascript:void(0);">最新发布</a></li><?php } ?>
                <? if($SystemGlobalcfm_global['cfg_if_corp'] == 1) { ?><li class="item current3"><a href="javascript:void(0);">推荐商家</a></li><?php } ?>
                
            </ul>
        </div>
        <div>
            <ul class="list_normal first_bold tab-cont">
            <?php $index_topinfo = qq3479015851_get_infos(10,NULL,3,NULL,NULL,NULL,NULL,NULL,$cityid); ?>            <?php if(is_array($index_topinfo)){foreach($index_topinfo as $k => $SystemGlobalcfm) { ?>            <li style="<? if($SystemGlobalcfm['ifbold'] == 1) { ?>font-weight:bold;<?php } if($SystemGlobalcfm['ifred'] == 1) { ?>color:red;<?php } ?>">
            <a href="index.php?mod=category&catid=<?=$SystemGlobalcfm['catid']?>" class="cat">[<?=$SystemGlobalcfm['catname']?>]</a> 
            <a href="index.php?mod=information&id=<?=$SystemGlobalcfm['id']?>"><? echo cutstr($SystemGlobalcfm['title'],30); ?></a>
            <span class="jian"></span>
            </li>
            <?php }} ?>
            <div class="inner_html"><a href="index.php?mod=category&cityid=<?=$city['cityid']?>" class="comn-submit gray btn_block">进入分类信息频道</a></div>
            </ul>
            <? if($ifnews) { ?>
            <ul class="list_normal first_bold tab-cont" style="display:none;">
            <?php $news = qq3479015851_get_news(7,NULL,NULL,NULL,NULL,NULL,$cityid); ?>            <?php if(is_array($news)){foreach($news as $k => $SystemGlobalcfm) { ?>            <li style="<? if($SystemGlobalcfm['is_commend'] == 1) { ?>color:red;<?php } ?>">
            <font class="time">[<? echo GetTime($SystemGlobalcfm['begintime'],'m-d'); ?>]</font> 
            <a href="index.php?mod=news&id=<?=$SystemGlobalcfm['id']?>"><?=$SystemGlobalcfm['title']?></a><span class="jian"></span>
            </li>
            <?php }} ?>
            <div class="inner_html"><a href="index.php?mod=news&cityid=<?=$city['cityid']?>" class="comn-submit gray btn_block">进入热点资讯频道</a></div>
            </ul>
            <?php } else { ?>
            <ul class="list_normal first_bold tab-cont" style="display:none;">
            <?php $newinfo = qq3479015851_get_infos(6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,$city['cityid']); ?>            <?php if(is_array($newinfo)){foreach($newinfo as $k => $SystemGlobalcfm) { ?>            <li style="<? if($SystemGlobalcfm['ifred'] == 1) { ?>color:red;<?php } if($SystemGlobalcfm['ifbold'] == 1) { ?>font-weight:bold;<?php } ?>">
            <font class="time">[<? echo GetTime($SystemGlobalcfm['begintime'],'m-d'); ?>]</font> 
            <a href="index.php?mod=information&id=<?=$SystemGlobalcfm['id']?>"><?=$SystemGlobalcfm['title']?></a><span class="jian"></span>
            </li>
            <?php }} ?>
            <div class="inner_html"><a href="index.php?mod=category&cityid=<?=$city['cityid']?>" class="comn-submit gray btn_block">进入分类信息频道</a></div>
            </ul>
            <?php } ?>
            <? if($SystemGlobalcfm_global['cfg_if_corp'] == 1) { ?>
            <?php $members = qq3479015851_get_members(10,NULL,NULL,NULL,2,NULL,NULL,$cityid); ?>            <ul class="list_normal first_bold tab-cont" style="display:none;">
            <?php if(is_array($members)){foreach($members as $k => $SystemGlobalcfm) { ?>            <li><img src="<?=$SystemGlobalcfm['prelogo']?>" class="img"> <a href="index.php?mod=store&id=<?=$SystemGlobalcfm['id']?>"><?=$SystemGlobalcfm['tname']?></a><span class="jian"></span></li>
            <?php }} ?>
            <div class="inner_html"><a href="index.php?mod=corp&cityid=<?=$city['cityid']?>" class="comn-submit gray btn_block">进入商家店铺频道</a></div>
            </ul>
            <?php } ?>
        </div>
        
    </div>
</div>
<?php include qq3479015851_tpl('footer'); ?>
<script src="template/js/index.js"></script>
<script>(function($){var list=$('#content').find('.cell');if(list.length>0){var txt='';$('#content').find('.cell').each(function(i){if(i===0){txt+='<li class="active">1</li>'}else{txt+='<li>'+(i+1)+'</li>'}});$('#indicator').html(txt);var w_w=$(window).width();setTimeout(function(){new C_Scroll({container:'slide',content:'content',ct:'indicator',size:w_w,intervalTime:5000,lazyIMG:!!0})},20);setTimeout(function(){$('#slide').show()},20)}IDC.tabADS($('#tab_01'))})(jQuery);</script>
</body>
</html>