<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/uaredirect.js" type="text/javascript"></script>
<script type="text/javascript">uaredirect("<?=$SystemGlobalcfm_global['SiteUrl']?>/m/index.php?mod=category&catid=<?=$catid?>&cityid=<?=$cityid?>");</script>
<title><?=$page_title?></title>
<meta name="keywords" content="<?=$cat['keywords']?>" />
<meta name="description" content="<?=$cat['description']?>" />
<link rel="shortcut icon" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/favicon.ico" />
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/style.css" />
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/category.css" />
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/pagination2.css" />
<script src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/jquery.min.js" type="text/javascript"></script>
</head>

<body class="<?=$SystemGlobalcfm_global['cfg_tpl_dir']?> full bodybg<?=$SystemGlobalcfm_global['cfg_tpl_dir']?><?=$SystemGlobalcfm_global['bodybg']?>"><script type="text/javascript">var current_domain="<?=$SystemGlobalcfm_global['SiteUrl']?>";var current_cityid="<?=$city['cityid']?>";var current_logfile="<?=$SystemGlobalcfm_global['cfg_member_logfile']?>";</script>
<div class="bartop">
<div class="barcenter">
<div class="barleft">
<ul class="barcity">欢迎来到<?=$SystemGlobalcfm_global['SiteName']?>！</ul> 
<ul class="line"><u></u></ul>
            <ul class="barcang"><a href="<?=$SystemGlobalcfm_global['SiteUrl']?>/desktop.php" target="_blank" title="点击右键，选择“目标另存为”，将此快捷方式保存到桌面即可">保存到桌面</a></ul>
<ul class="line"><u></u></ul>
<ul class="barpost"><a href="<?=$SystemGlobalcfm_global['SiteUrl']?>/<?=$SystemGlobalcfm_global['cfg_postfile']?>?cityid=<?=$cityid?>">快速发布信息</a></ul>
<ul class="line"><u></u></ul>
<ul class="bardel"><a href="<?=$SystemGlobalcfm_global['SiteUrl']?>/delinfo.php?cityid=<?=$cityid?>" rel="nofollow">修改/删除信息</a></ul>
<ul class="line"><u></u></ul>
<ul class="barwap"><a href="<?=$SystemGlobalcfm_global['SiteUrl']?>/mobile.php?cityid=<?=$cityid?>">手机浏览</a></ul>
</div>
<div class="barright" id="iflogin"><img src="<?=$SystemGlobalcfm_global['SiteUrl']?>/images/loading.gif" border="0" align="absmiddle"></div>
</div>
</div>
<div class="clear"></div>
<!--顶部横幅广告开始-->
<div id="ad_topbanner"></div>
<!--顶部横幅广告结束-->
<div class="clearfix"></div>
<div class="logosearchtel">
<div class="weblogo"><a href="<?=$city['domain']?>"><img src="<?=$SystemGlobalcfm_global['SiteUrl']?><?=$SystemGlobalcfm_global['SiteLogo']?>" title="<?=$SystemGlobalcfm_global['SiteName']?>" border="0"/></a></div>
    <!-- <div class="webcity">
    	<span><? if($city['cityname']) { echo cutstr($city['cityname'],8,'...'); ?><?php } else { ?>总站<?php } ?></span><br><a href="<?=$SystemGlobalcfm_global['SiteUrl']?>/changecity.php">切换分站</a>
    </div> -->
    <div class="webcity2" style="display:none;">
    	<div class="curcity"><? if($city['cityname']) { ?><?=$city['cityname']?><?php } else { ?>总站<?php } ?> <a href="<?=$SystemGlobalcfm_global['SiteUrl']?>/changecity.php">切换分站</a></div>
        <div class="clearfix"></div>
    	<ul>
        <?php if(!$hotcities) $hotcities=get_hot_cities(); ?>            <?php if(is_array($hotcities)){foreach($hotcities as $k) { ?>        	<a href="<?=$k['domain']?>"><?=$k['cityname']?></a>
            <?php }} ?>
        </ul>
    </div>
    <div class="postedit">
<a class="post" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/<?=$SystemGlobalcfm_global['cfg_postfile']?>?catid=<?=$catid?>&cityid=<?=$cityid?>">免费发布信息</a>
</div>
<div class="websearch">
    	<div class="s_ulA" id="searchType">
            <ul>
                <li name="s8" id="s8_information" onclick="show_tab('information');" class="current"><a href="javascript:void(0);">信息</a></li>
<li name="s8" id="s8_store" onclick="show_tab('store');" ><a href="javascript:void(0);">商家</a></li>
                <li name="s8" id="s8_news" onclick="show_tab('news');" ><a href="javascript:void(0);">资讯</a></li>
                <li name="s8" id="s8_goods" onclick="show_tab('goods');" ><a href="javascript:void(0);">商品</a></li>
            </ul>
        </div>
        <div class="clearfix"></div>
<div class="sch_t_frm">
<form method="get" action="<?=$SystemGlobalcfm_global['SiteUrl']?>/search.php?" id="searchForm" target="_blank">
            <input name="cityid" type="hidden" value="<?=$cityid?>">
            <input type="hidden" id="searchtype" name="mod" value="information"/>
<div class="sch_ct">
<input type="text" class="topsearchinput" value="请输入关键词或分类名" name="keywords" id="searchheader" onmouseover="if(this.value==='请输入关键词或分类名'){this.value='';}" x-webkit-speech lang="zh-CN"/>
</div>
<div>
<input type="submit" value="搜 索" class="btn-normal"/>
</div>
</form>
</div>
        <div class="clearfix"></div>
        <? if($navurl_head = qq3479015851_get_navurl('head',20)) { ?>
        <div class="s_ulC">
        <ul>
        <?php if(is_array($navurl_head)){foreach($navurl_head as $k => $SystemGlobalcfm) { ?>        <li><a href="<?=$SystemGlobalcfm['url']?>" style="color:<?=$SystemGlobalcfm['color']?>" target="<?=$SystemGlobalcfm['target']?>" title="<?=$SystemGlobalcfm['title']?>"><?=$SystemGlobalcfm['title']?><sup class="<?=$SystemGlobalcfm['ico']?>"></sup></a></li>
        <?php }} ?>
        </ul>
        </div>
        <?php } ?>
</div>
</div>
<div class="clear"></div>
<div class="brandad">
<? if($brand) { ?>
<ul><?php if(is_array($brand)){foreach($brand as $SystemGlobalcfm) { ?><li><a href="<?=$SystemGlobalcfm['url']?>" target="_blank" title="<?=$SystemGlobalcfm['webname']?>"><img src="<?=$SystemGlobalcfm_global['SiteUrl']?><?=$SystemGlobalcfm['weblogo']?>" alt="<?=$SystemGlobalcfm['webname']?>"></a></li>
<?php }} ?>
</ul>
<?php } ?>
</div><? if($SystemGlobalcfm_global['head_style'] == 'normal') { ?>
<div class="body1000">
<div class="daohang_con2">
    <div class="daohang2">
        <ul>
            <li><a href="<?=$city['domain']?>" id="index">首页</a></li>
            <?php $navurl_header = qq3479015851_get_navurl('header',15); ?>            <?php if(is_array($navurl_header)){foreach($navurl_header as $k => $SystemGlobalcfm) { ?>            <li><a <? if($SystemGlobalcfm['flag'] == $cat['catid'] || $SystemGlobalcfm['flag'] == $cat['parentid']) { ?>class="current"<?php } ?> target="<?=$SystemGlobalcfm['target']?>" id="<?=$SystemGlobalcfm['flag']?>" href="<? if($SystemGlobalcfm['flag'] != 'outlink') { ?><?=$city['domain']?><?php } ?><?=$SystemGlobalcfm['url']?>"><font color="<?=$SystemGlobalcfm['color']?>"><?=$SystemGlobalcfm['title']?></font><sup class="<?=$SystemGlobalcfm['ico']?>"></sup></a></li>
            <?php }} ?>
        </ul>
    </div>
</div>
<div class="clearfix"></div>
<div id="ad_header"></div>
<div class="clearfix"></div>
<?php } else { ?>
<div class="body1000">
<div class="daohang_con">
    <div class="categories">
        <dl id="infomenu">
        <dt class="titup"><b>信息分类</b></dt>
        <dd class="cont" style="display:none;">
        <ul>
        <?php $global_cat = get_categories_tree(0,'category'); ?>        <?php if(is_array($global_cat)){foreach($global_cat as $SystemGlobalcfm) { ?>        <li>
        <em><a href="<?=$city['domain']?><?=$SystemGlobalcfm['uri']?>" style="color:<?=$SystemGlobalcfm['color']?>" target="_blank" title="<?=$city['cityname']?><?=$SystemGlobalcfm['catname']?>"><?=$SystemGlobalcfm['catname']?></a></em>
        <dl>
        <dt><b></b></dt>
        <dd>
        <?php if(is_array($SystemGlobalcfm['children'])){foreach($SystemGlobalcfm['children'] as $w) { ?>        <a href="<?=$city['domain']?><?=$w['uri']?>" style="color:<?=$w['color']?>" target="_blank" title="<?=$city['cityname']?><?=$w['catname']?>"><?=$w['catname']?></a>
        <?php }} ?>
        </dd>
        </dl>
        </li>
        <?php }} ?>
        </ul>
        </dd>
        </dl>
    </div>
    <div class="daohang">
        <ul>
            <li><a href="<?=$city['domain']?>" id="index">首页</a></li>
            <?php $navurl_header = qq3479015851_get_navurl('header',15); ?>            <?php if(is_array($navurl_header)){foreach($navurl_header as $k => $SystemGlobalcfm) { ?>            <li><a <? if($SystemGlobalcfm['flag'] == $cat['catid'] || $SystemGlobalcfm['flag'] == $cat['parentid']) { ?>class="current"<?php } ?> target="<?=$SystemGlobalcfm['target']?>" id="<?=$SystemGlobalcfm['flag']?>" href="<? if($SystemGlobalcfm['flag'] != 'outlink') { ?><?=$city['domain']?><?php } ?><?=$SystemGlobalcfm['url']?>"><font color="<?=$SystemGlobalcfm['color']?>"><?=$SystemGlobalcfm['title']?></font><sup class="<?=$SystemGlobalcfm['ico']?>"></sup></a></li>
            <?php }} ?>
        </ul>
    </div>
</div>
<div class="clearfix"></div>
<div id="ad_header"></div>
<div class="clearfix"></div>
<script>loadDefault(['category','category_select'])</script>
<?php } ?><div class="bodybgcolor">
<div class="body1000">
<div class="clear"></div>
<div class="location">
<?=$location?>
</div>
<div class="clear"></div>
<!-- <div class="wrapper"><div id="select">
<? if($cat_list) { ?>
<dl class='fore' id='select-brand'>
<dt>栏目分类：</dt>
<dd>
<div class='content'>
    <?php if(is_array($cat_list)){foreach($cat_list as $SystemGlobalcfm) { ?><div><a href="<?=$city['domain']?><?=$SystemGlobalcfm['uri']?>" <? if($SystemGlobalcfm['catid'] == $cat['catid']) { ?>class="curr"<?php } ?> title="<?=$city['cityname']?><?=$SystemGlobalcfm['catname']?>">不限</a></div>
        <?php if(is_array($SystemGlobalcfm['children'])){foreach($SystemGlobalcfm['children'] as $w) { ?><div><a href="<?=$city['domain']?><?=$w['uri']?>" <? if($w['catid'] == $cat['catid']) { ?>class="curr"<?php } ?> title="<?=$city['cityname']?><?=$w['catname']?>"><?=$w['catname']?></a></div>
        <?php }} ?>
<?php }} ?>
</div>
</dd>
</dl>
    <?php } ?>
    <?php if(is_array($SystemGlobalcfm_extra_model)){foreach($SystemGlobalcfm_extra_model as $SystemGlobalcfm) { ?><dl>
<dt><?=$SystemGlobalcfm['title']?>：</dt>
<dd>
    <?php if(is_array($SystemGlobalcfm['list'])){foreach($SystemGlobalcfm['list'] as $w) { ?><div><a href="<?=$city['domain']?><?=$w['uri']?>" <? if($w['select'] == 1) { ?>class="curr"<?php } ?>><?=$w['name']?></a></div>
<?php }} ?>
    </dd>
</dl>
<?php }} ?>

    <? if($street_list) { ?>
<dl>
<dt></dt>
<dd>
        <?php if(is_array($street_list)){foreach($street_list as $SystemGlobalcfm) { ?><div><a href="<?=$city['domain']?><?=$SystemGlobalcfm['uri']?>" <? if($SystemGlobalcfm['select'] == 1) { ?>class="curr"<?php } ?>><?=$SystemGlobalcfm['streetname']?></a></div>
<?php }} ?>
</dd>
</dl>
<?php } ?>
<dl class="lastdl">
<form method="get" action="<?=$SystemGlobalcfm_global['SiteUrl']?>/search.php?" target="_blank">
<input name="mod" value="information" type="hidden">
<input name="catid" value="<?=$cat['catid']?>" type="hidden">
<input name="cityid" value="<?=$cityid?>" type="hidden">
        <input name="areaid" value="<?=$areaid?>" type="hidden">
<input name="streetid" value="<?=$streetid?>" type="hidden">
<input name="keywords" type="text" value="" class="searchinput" id="searchbody" onmouseover="hiddennotice('searchbody');"/>
<input type="submit" value="搜本类" class="new_searchsubmit" />
</form>
</dl>
</div></div> -->
<div class="clear"></div>
<div class="new_listhd">
<div class="listhdleft">
<div><a href="#" class="currentr"><span></span><?=$city['cityname']?><?=$page_title_extra?><?=$cat['catname']?>信息</a></div>
</div>
<div class="listhdcenter">
信息总数：<span><?=$rows_num?></span> ，置顶信息可使成交率提高5倍！
</div>
<div class="listhdright">
<a href="<?=$SystemGlobalcfm_global['SiteUrl']?>/<?=$SystemGlobalcfm_global['cfg_postfile']?>?catid=<?=$cat['catid']?>&cityid=<?=$cityid?>" target="_blank">免费发布<?=$city['cityname']?><?=$cat['catname']?>信息>></a>
</div>
</div>

<div class="clearfix"></div>
<div class="body1000">
<div id="ad_intercatdiv"></div>
<div class="infolists">
<div class='section'>
<ul class='sep'>
<div id="ad_interlistad_top"></div>
                <?php if(is_array($info_list)){foreach($info_list as $k => $SystemGlobalcfm) { ?><div class='hover media cfix <? if($SystemGlobalcfm['upgrade_type'] > 1) { ?>ding<?php } ?>'>
<a href='<?=$SystemGlobalcfm['uri']?>' target='_blank' class='media-cap'><img src='<? if(!$SystemGlobalcfm['img_path']) { ?><?=$SystemGlobalcfm_global['SiteUrl']?>/images/nophoto.gif<?php } else { ?><?=$SystemGlobalcfm_global['SiteUrl']?><?=$SystemGlobalcfm['img_path']?><?php } ?>' title='<?=$SystemGlobalcfm['title']?>'></a>
<div class='media-body'>
<div class='media-body-title'>
<small class='pull-right'><? echo get_format_time($SystemGlobalcfm['begintime']); ?></small>
<a href="<?=$SystemGlobalcfm['uri']?>" target="_blank" style="<? if($SystemGlobalcfm['ifred'] == 1) { ?>color:red;<?php } ?> <? if($SystemGlobalcfm['ifbold'] == 1) { ?>font-weight:bold;<?php } ?>"><?=$SystemGlobalcfm['title']?></a><? if($SystemGlobalcfm['img_count']) { ?><span class="img_count"><?=$SystemGlobalcfm['img_count']?>图</span><?php } if($SystemGlobalcfm['info_level'] == 2) { ?><span class="tuijian">推荐</span><?php } if($SystemGlobalcfm['certify'] == 1) { ?><span class="certify">认证</span><?php } ?>
</div>
<div class='typo-small'><? echo cutstr($SystemGlobalcfm['content'],100); ?></div>
<div class='typo-smalls'>
                <? if($SystemGlobalcfm['areaname']) { ?><font class="xx1"><?=$SystemGlobalcfm['areaname']?></font><?php } ?>
                <?php $i=2; ?>                <?php if(is_array($SystemGlobalcfm['extra'])){foreach($SystemGlobalcfm['extra'] as $w) { ?>                	<? if($w && $w != '<font class=mayi></font>') { ?><font class="xx<?=$i?>"><? if(in_array($w,array('0元','0元/月','0万元','0元/平米','0元/平米/天','0平米'))) { ?>面议<?php } else { echo str_replace('.00','',$w); ?><?php } ?></font><?php } ?>
                <?php $i++; ?>                <?php }} ?>
</div>
</div>
</div>
<?php }} ?>
</ul>
</div>
<div class="clear"></div>
<div class="pagination2">
<?=$pageview?>
</div>
<div class="clear"></div>
</div>
</div><div class="clear"></div>
<div class="colorfoot">
    <div class="cateintro">
        <div class="introleft"><?=$city['cityname']?><?=$cat['catname']?>频道</div>
        <div class="introright"><?=$city['cityname']?><?=$cat['catname']?>频道为您提供<?=$city['cityname']?><?=$cat['catname']?>信息，在此有大量<?=$city['cityname']?><?=$cat['catname']?>信息供您选择，您可以免费查看和发布<?=$city['cityname']?><?=$cat['catname']?>信息。</div>
    </div>
    <? if($area_list) { ?>
    <div class="clearfix"></div>
    <div class="cateintro relate">
    <div class="introleft"><?=$cat['catname']?>相关区域</div>
    <div class="introflink">
    <?php if(is_array($area_list)){foreach($area_list as $SystemGlobalcfm) { ?>    <? if($SystemGlobalcfm['areaid']) { ?><a href='<?=$city['domain']?><?=$SystemGlobalcfm['uri']?>' target="_blank"><?=$SystemGlobalcfm['areaname']?><?=$cat['catname']?></a><?php } ?>
    <?php }} ?>
    </div>
    </div>
    <?php } ?>
    <?php $nearbycities = get_nearby_cities($city['provinceid']); ?>    <? if($nearbycities) { ?>
    <div class="cateintro relate">
    <div class="introleft"><?=$cat['catname']?>附近分站</div>
    <div class="introflink">
    <?php if(is_array($nearbycities)){foreach($nearbycities as $SystemGlobalcfm) { ?>    <? if($SystemGlobalcfm['cityid'] != $city['cityid']) { ?>
    <a href='<?=$SystemGlobalcfm['domain']?><?=$cat['caturi']?>' target="_blank"><?=$SystemGlobalcfm['cityname']?><?=$cat['catname']?></a>
    <?php } ?>
    <?php }} ?>
    </div>
    </div>
    <?php } ?>
    <? if($hotcities) { ?>
    <div class="cateintro relate">
    <div class="introleft"><?=$cat['catname']?>热门分站</div>
    <div class="introflink">
    <?php if(is_array($hotcities)){foreach($hotcities as $SystemGlobalcfm) { ?>    <a href='<?=$SystemGlobalcfm['domain']?><?=$cat['caturi']?>' target="_blank"><?=$SystemGlobalcfm['cityname']?><?=$cat['catname']?></a>
    <?php }} ?>
    </div>
    </div>
    <?php } ?>

    <? if($friendlink) { ?>
    <div class="clearfix"></div>
    <div class="cateintro">
    <div class="introleft">频道友情链接</div>
    <div class="introflink">
    <?php if(is_array($friendlink)){foreach($friendlink as $SystemGlobalcfm) { ?>    <a href='<?=$SystemGlobalcfm['url']?>' target='_blank'><?=$SystemGlobalcfm['name']?></a>
    <?php }} ?>
    </div>
    </div>
    <?php } ?>
</div>
<script type="text/javascript" src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/hover_bg.js"></script><div id="ad_footerbanner"></div>
<? if($advertisement['type']['floatad'] || $advertisement['type']['couplead']) { ?>
<div align="left"  style="clear: both;">
<script src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/global/floatadv.js" type="text/javascript"></script>
<? if($advertisement['type']['couplead']) { ?>
<script type="text/javascript">
<?=$adveritems[$advertisement['type']['couplead']['0']]?>theFloaters.play();
</script>
<?php } if($advertisement['type']['floatad']) { ?>
<script type="text/javascript">
<?=$adveritems[$advertisement['type']['floatad']['0']]?>theFloaters.play();
</script>
<?php } ?>
</div>
<?php } ?>
<div style="display: none" id="ad_none">
<? if($advertisement['type']['headerbanner']) { ?>
<div class="header" id="ad_header_none"><?php $countheaderbanner = count($advertisement['type']['headerbanner']);$i=1; ?><?php if(is_array($advertisement['type']['headerbanner'])){foreach($advertisement['type']['headerbanner'] as $SystemGlobalcfm) { if($adveritems[$SystemGlobalcfm]) { ?><div class="headerbanner" <? if($countheaderbanner == $i) { ?>style="margin-right:0;"<?php } ?>><?=$adveritems[$SystemGlobalcfm]?></div><?php } ?><?php $i=$i+1; ?><?php }} ?>
</div>
<?php } ?><?php if(is_array($advertisement['type']['indexcatad'])){foreach($advertisement['type']['indexcatad'] as $k => $SystemGlobalcfm) { ?><div class="indexcatad" id="ad_indexcatad_<?=$k?>_none"><?=$adveritems[$SystemGlobalcfm['0']]?></div>
<?php }} if($advertisement['type']['interlistad']['top']) { ?>
<div id="ad_interlistad_top_none">
<ul class="interlistdiv"><?php if(is_array($advertisement['type']['interlistad']['top'])){foreach($advertisement['type']['interlistad']['top'] as $SystemGlobalcfm) { if($adveritems[$SystemGlobalcfm]) { ?><li class="hover"><?=$adveritems[$SystemGlobalcfm]?></li><?php } ?>
<?php }} ?>
</ul>
</div>
<?php } if($advertisement['type']['interlistad']['bottom']) { ?>
<div id="ad_interlistad_bottom_none">
<ul class="interlistdiv"><?php if(is_array($advertisement['type']['interlistad']['bottom'])){foreach($advertisement['type']['interlistad']['bottom'] as $SystemGlobalcfm) { if($adveritems[$SystemGlobalcfm]) { ?><li class="hover"><?=$adveritems[$SystemGlobalcfm]?></li><?php } ?>
<?php }} ?>
</ul>
</div>
<?php } if($advertisement['type']['intercatad']) { ?>
<div class="intercatdiv" id="ad_intercatdiv_none"><?php if(is_array($advertisement['type']['intercatad'])){foreach($advertisement['type']['intercatad'] as $SystemGlobalcfm) { ?><div class="intercatad"><?=$adveritems[$SystemGlobalcfm]?></div>
<?php }} ?>
</div>
<?php } if($advertisement['type']['topbanner']) { ?>
<div class="topbanner" id="ad_topbanner_none"><?php if(is_array($advertisement['type']['topbanner'])){foreach($advertisement['type']['topbanner'] as $SystemGlobalcfm) { ?><div class="topbannerad"><?=$adveritems[$SystemGlobalcfm]?></div>
<?php }} ?>
</div>
<?php } if($advertisement['type']['footerbanner']) { ?>
<div class="footerbanner" id="ad_footerbanner_none"><?php if(is_array($advertisement['type']['footerbanner'])){foreach($advertisement['type']['footerbanner'] as $SystemGlobalcfm) { ?><div class="footerbannerad"><?=$adveritems[$SystemGlobalcfm]?></div>
<?php }} ?>
</div>
<?php } ?>
</div>
<div class="footer_new">
    <div class="foot_new">
        <div class="foot_box">
        	<div class="hd">信息管理</div>
            <div class="bd">
            	<ul>
                	<li><a target="_blank" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/<?=$SystemGlobalcfm_global['cfg_postfile']?>?cityid=<?=$cityid?>">免费发布信息</a></li>
                    <li><a target="_blank" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/delinfo.php?cityid=<?=$cityid?>" rel="nofollow">修改/删除信息</a></li>
                    <li><a target="_blank" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/search.php?cityid=<?=$cityid?>" rel="nofollow">信息快速搜索</a></li>
                </ul>
            </div>
        </div>
        <div class="foot_box" id="sjfw" style="display:none;">
        	<div class="hd">商家服务</div>
            <div class="bd">
            	<ul>
                	<li><a target="_blank" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/<?=$SystemGlobalcfm_global['cfg_member_logfile']?>?mod=register&action=store&cityid=<?=$cityid?>">商家入驻</a></li>
                    <li><a target="_blank" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/<?=$SystemGlobalcfm_global['cfg_member_logfile']?>?cityid=<?=$cityid?>">商家登录</a></li>
                </ul>
            </div>
        </div>
        <div class="foot_box">
        	<div class="hd">关于我们</div>
            <div class="bd">
            	<ul>
                <?php $navurl_foot = qq3479015851_get_navurl('foot',30); ?>                    <?php if(is_array($navurl_foot)){foreach($navurl_foot as $k => $SystemGlobalcfm) { ?>                	<li><a href="<?=$SystemGlobalcfm['url']?>" style="color:<?=$SystemGlobalcfm['color']?>" target="<?=$SystemGlobalcfm['target']?>"><?=$SystemGlobalcfm['title']?><sup class="<?=$SystemGlobalcfm['ico']?>"></sup></a></li>
                    <?php }} ?>
                </ul>
            </div>
        </div>
        <div class="foot_wx">
        	<div class="hd">扫一扫，访问手机站</div>
            <div class="bd">
            	<ul>
                	<img alt="<?=$SystemGlobalcfm_global['SiteName']?>手机版" src="<?=$SystemGlobalcfm_global['SiteUrl']?>/qrcode.php?value=<?=$SystemGlobalcfm_global['SiteUrl']?>/m/index.php&size=4.7">
                </ul>
            </div>
        </div>
<div class="foot_wx" id="gzh">
        	<div class="hd">关注微信公众号</div>
            <div class="bd">
            	<ul>
                	<img alt="<?=$mymps_global['SiteName']?>微信公众号" src="<?=$mymps_global['SiteUrl']?>/erweima.gif">
                </ul>
            </div>
        </div>
        <div class="foot_mobile">
        	<ul>
            <? if($SystemGlobalcfm_global['SiteTel']) { ?><div class="h1"><font><?=$SystemGlobalcfm_global['SiteTel']?></font></div><?php } ?>
            <? if($SystemGlobalcfm_global['SiteEmail']) { ?><div class="h3">邮箱：<font><?=$SystemGlobalcfm_global['SiteEmail']?></font></div><?php } ?>
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="foot_powered">
    	Copyright &copy; <?=$SystemGlobalcfm_global['SiteName']?>版权所有 <a href="http://www.miibeian.gov.cn"><?=$SystemGlobalcfm_global['SiteBeian']?></a>
    </div>
</div>
<p id="back-to-top"><a href="#top"><span></span></a></p>
<script type="text/javascript">loadDefault(["addiv","iflogin","show_tab","scrolltop","changecity"]);</script></div>
</div>
</body>
</html>