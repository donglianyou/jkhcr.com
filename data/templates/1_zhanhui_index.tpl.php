<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/uaredirect.js" type="text/javascript"></script>
<script type="text/javascript">uaredirect("<?=$SystemGlobalcfm_global['SiteUrl']?>/m/index.php?mod=news&cityid=<?=$city['cityid']?>");</script>
<title><?=$page_title?></title>
<meta name="keywords" content="<?=$s['keywords']?>" />
<meta name="description" content="<?=$s['description']?>" />
<link rel="shortcut icon" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/favicon.ico" />
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/style.css" />
<link rel="stylesheet" href="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/css/newstyle.css" />
<script src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/jquery.flashSlider-1.0.min.js"></script>
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
<? if($brand1) { ?>
<ul><?php if(is_array($brand1)){foreach($brand1 as $SystemGlobalcfm) { ?><li><a href="<?=$SystemGlobalcfm['url']?>" target="_blank" title="<?=$SystemGlobalcfm['webname']?>"><img src="<?=$SystemGlobalcfm_global['SiteUrl']?><?=$SystemGlobalcfm['weblogo']?>" alt="<?=$SystemGlobalcfm['name']?>"></a></li>
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
<?php } ?><div class="clear"></div>
    <div class="body1000">
<div class="location"><?=$location?></div>
<div class="clear"></div>
<div class="column">
<div class="col3">
<div class="newsfocus">
<div id="slider">
<ul>
                    <?php $focus = qq3479015851_get_focus('news',3); ?>                    <?php if(is_array($focus)){foreach($focus as $SystemGlobalcfm) { ?><li><a href="<?=$SystemGlobalcfm['url']?>" title="<?=$SystemGlobalcfm['words']?>" target="_blank"><img src="<? echo strstr($SystemGlobalcfm['image'],'http') ? $SystemGlobalcfm['image'] : $SystemGlobalcfm_global['SiteUrl'].$SystemGlobalcfm['image']; ?>" alt="<?=$SystemGlobalcfm['words']?>" width="333" height="226" border="0" /></a></li>
<?php }} ?>
</ul>
</div>
<script type="text/javascript">$(document).ready(function() {$("#slider").flashSlider();});</script>
</div>
<div class="clear"></div>
<div class="newinfo">
<div class="hd">最新发布信息</div>
<div class="bd">
<div id="indextop">
<div id="indextop1">
                            
                            <?php $latest_info = qq3479015851_get_infos(10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,$city['cityid']); ?><?php if(is_array($latest_info)){foreach($latest_info as $SystemGlobalcfm) { ?><div class="li"><span class="tm">[<? echo GetTime($SystemGlobalcfm['begintime'],'y-m-d'); ?>]</span><span class="tt"><a href="<?=$SystemGlobalcfm['uri']?>" title="<?=$SystemGlobalcfm['title']?>" target="_blank" ><?=$SystemGlobalcfm['title']?></a></span></div>
<?php }} ?>
                            
</div>
<div id="indextop2"></div>
</div>
</div>
<div class="postinfo">
<input type="button" value="马上发布信息" class="footsearch_post" onclick="window.open('<?=$SystemGlobalcfm_global['SiteUrl']?>/<?=$SystemGlobalcfm_global['cfg_postfile']?>?cityid=<?=$city['cityid']?>')" style="margin-left:43px;">
<input type="button" value="修改/删除信息" class="footsearch_submit" onclick="window.open('<?=$SystemGlobalcfm_global['SiteUrl']?>/delinfo.php?cityid=<?=$city['cityid']?>')">
</div>
</div>
</div>
<div class="col4">
<div class="todaynews">
<ul>
                    <?php $i=1;$top_news	= qq3479015851_get_news(18,NULL,NULL,NULL,NULL,NULL,$cityid); ?>                        <?php if(is_array($top_news)){foreach($top_news as $SystemGlobalcfm) { ?>                        <? if($i ==1) { ?>
 <div class="head">
 <h1><a href="<?=$SystemGlobalcfm['uri']?>" target="_blank" ><?=$SystemGlobalcfm['title']?></a></h1>
 <p><? echo cutstr($SystemGlobalcfm['content'],254); ?><a href="<?=$SystemGlobalcfm['uri']?>" style="margin-left:20px" target="_blank">查看全文>></a></p>
</div>
<?php } else { ?>
<div class="li"><span class="date"><? echo GetTime($SystemGlobalcfm['begintime'],'y-m-d'); ?></span><a href="<?=$SystemGlobalcfm['caturi']?>" class="catname"><?=$SystemGlobalcfm['catname']?></a><a href="<?=$SystemGlobalcfm['uri']?>" title="<?=$SystemGlobalcfm['title']?>" target="_blank"><?=$SystemGlobalcfm['title']?></a></div>
<?php } ?>
                        <?php $i++; ?>                        <?php }} ?>
</ul>
</div>
</div>
<div class="col5">
<div class="top10">
<h3 class="top_tips">热门机构推荐榜</h3>
<ul>
                <?php $i=1; ?>                    <?php $hot_member = qq3479015851_get_members(12,3,NULL,NULL,NULL,NULL,NULL,$city['cityid']); ?>                    <?php if(is_array($hot_member)){foreach($hot_member as $SystemGlobalcfm) { ?><li class="stitle" id="s_tle_<?=$i?>" onmouseover="show_top10(<?=$i?>);" <? if($i==1) { ?>style="display:none;"<?php } ?>><span><?=$i?></span><a href="<?=$SystemGlobalcfm['uri']?>" target="_blank"><? echo cutstr($SystemGlobalcfm['tname'],28); ?></a></li>
<li class="ithumb" id="i_img_<?=$i?>" <? if($i >1) { ?>style="display:none;"<?php } ?>>
<div class="ithumb_c">
<p class="i_num"><?=$i?></p>
<p class="i_img"><a href="<?=$SystemGlobalcfm['uri']?>" target="_blank"><img src="<?=$SystemGlobalcfm_global['SiteUrl']?><?=$SystemGlobalcfm['prelogo']?>" width="78" height="58" alt="<?=$SystemGlobalcfm['tname']?>" border="0" /></a></p>
<p class="i_tle"><a href="<?=$SystemGlobalcfm['uri']?>" target="_blank"><?=$SystemGlobalcfm['tname']?></a></p>
</div>
</li>
                    <?php $i++; ?>                    <?php }} ?>
<script type="text/javascript" language="javascript" src="<?=$SystemGlobalcfm_global['SiteUrl']?>/template/default/js/news.js"></script>
</ul>
<p class="top_more"><a href="<?=$SystemGlobalcfm_global['SiteUrl']?>/<?=$SystemGlobalcfm_global['cfg_member_logfile']?>?mod=register&action=store" target="_blank">立即注册商家会员>></a></p>
</div>
</div>
</div>
<div class="clear"></div>
<div class="column2">
<div class="tuwen">
<div class="hd">精彩图文</div>
<div class="bd">
<ul>
                    <?php $image_news = qq3479015851_get_news(7,NULL,1,NULL,NULL,1,$city['cityid']); ?>                    <?php if(is_array($image_news)){foreach($image_news as $SystemGlobalcfm) { ?><li><a href="<?=$SystemGlobalcfm['uri']?>" target="_blank"><img src="<? echo strstr($SystemGlobalcfm['imgpath'],'http') ? $SystemGlobalcfm['imgpath'] : $SystemGlobalcfm_global['SiteUrl'].$SystemGlobalcfm['imgpath']; ?>" alt="<?=$SystemGlobalcfm['title']?>"/></a><span><a href="<?=$SystemGlobalcfm['uri']?>" title="<?=$SystemGlobalcfm['title']?>" <? if($SystemGlobalcfm['iscommend'] == 1) { ?>style="color:red"<?php } ?>><?=$SystemGlobalcfm['title']?></a></span></li>
<?php }} ?>
</ul>
</div>
</div>
</div>
<div class="clear"></div>
<div class="column3">
<div class="news_daohang">
<div class="bd">
<ul>
                    <?php $i=1; ?>                    <?php if(is_array($channel)){foreach($channel as $SystemGlobalcfm) { ?><div class="square <? if($i%2 != 0) { ?>fl<?php } else { ?>fr<?php } ?>">
<div class="hc">
<span class="cate"><?=$SystemGlobalcfm['catname']?></span>
<span class="more"><a href="<?=$SystemGlobalcfm['uri']?>" target="_blank">更多</a></span>
</div>
<div class="bc">
                            <?php if(is_array($SystemGlobalcfm['news'])){foreach($SystemGlobalcfm['news'] as $w) { ?><div class="li"><span class="title"><a href="<?=$w['uri']?>" title="<?=$w['title']?>" target="_blank" <? if($w['iscommend'] == 1) { ?>style="color:red"<?php } ?>><?=$w['title']?></a></span><span class="time"><? echo GetTime($w['begintime'],'y-m-d'); ?></span></div>
<?php }} ?>
</div>
</div>
                    <?php $i++; ?>                    <?php }} ?>

</ul>
</div>
</div>
<div class="read">
<div class="hd"><span>热门阅读排行</span></div>
<div class="bd">
<ul>
                    <?php $hot_news	= qq3479015851_get_news(20,NULL,NULL,NULL,1,1,$city['cityid']); ?>                    <?php if(is_array($hot_news)){foreach($hot_news as $SystemGlobalcfm) { ?><div class="li"><a target="_blank" href="<?=$SystemGlobalcfm['uri']?>" title="<?=$SystemGlobalcfm['title']?>" <? if($SystemGlobalcfm['iscommend'] == 1) { ?>style="color:red"<?php } ?>><? echo cutstr($SystemGlobalcfm['title'],28); ?></a></div>
<?php }} ?>
</ul>
</div>
</div>
</div>
<div class="clear"></div><div id="ad_footerbanner"></div>
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
</body>
</html>
<script type="text/javascript">loadDefault(['newsindex','ppRoll']);</script>
<script type="text/javascript">var indextop = new ppRoll({speed:60,demo:"indextop",demo1:"indextop1",demo2:"indextop2",objStr:"indextop",width:"310px",height:"217px",direction:"top"});</script>