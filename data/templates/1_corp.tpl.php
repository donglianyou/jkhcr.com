<? if(!defined('QQ3479015851')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="<?=$qq3479015851_global['SiteUrl']?>/template/default/js/uaredirect.js" type="text/javascript"></script>
<script type="text/javascript">uaredirect("<?=$qq3479015851_global['SiteUrl']?>/m/index.php?mod=corp&catid=<?=$catid?>&cityid=<?=$cityid?>");</script>
<title><?=$page_title?></title>
<link rel="shortcut icon" href="<?=$qq3479015851_global['SiteUrl']?>/favicon.ico" />
<link rel="stylesheet" href="<?=$qq3479015851_global['SiteUrl']?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$qq3479015851_global['SiteUrl']?>/template/default/css/style.css" />
<link rel="stylesheet" href="<?=$qq3479015851_global['SiteUrl']?>/template/default/css/corp.css" />
<link rel="stylesheet" href="<?=$qq3479015851_global['SiteUrl']?>/template/default/css/pagination2.css" />
<script src="<?=$qq3479015851_global['SiteUrl']?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$qq3479015851_global['SiteUrl']?>/template/default/js/jquery.min.js" type="text/javascript"></script>
</head>

<body class="<?=$qq3479015851_global['cfg_tpl_dir']?> full bodybg<?=$qq3479015851_global['cfg_tpl_dir']?><?=$qq3479015851_global['bodybg']?>"><script type="text/javascript">var current_domain="<?=$qq3479015851_global['SiteUrl']?>";var current_cityid="<?=$city['cityid']?>";var current_logfile="<?=$qq3479015851_global['cfg_member_logfile']?>";</script>
<div class="bartop">
<div class="barcenter">
<div class="barleft">
<ul class="barcity">欢迎来到<?=$qq3479015851_global['SiteName']?>！</ul> 
<ul class="line"><u></u></ul>
            <ul class="barcang"><a href="<?=$qq3479015851_global['SiteUrl']?>/desktop.php" target="_blank" title="点击右键，选择“目标另存为”，将此快捷方式保存到桌面即可">保存到桌面</a></ul>
<ul class="line"><u></u></ul>
<ul class="barpost"><a href="<?=$qq3479015851_global['SiteUrl']?>/<?=$qq3479015851_global['cfg_postfile']?>?cityid=<?=$cityid?>">快速发布信息</a></ul>
<ul class="line"><u></u></ul>
<ul class="bardel"><a href="<?=$qq3479015851_global['SiteUrl']?>/delinfo.php?cityid=<?=$cityid?>" rel="nofollow">修改/删除信息</a></ul>
<ul class="line"><u></u></ul>
<ul class="barwap"><a href="<?=$qq3479015851_global['SiteUrl']?>/mobile.php?cityid=<?=$cityid?>">手机浏览</a></ul>
</div>
<div class="barright" id="iflogin"><img src="<?=$qq3479015851_global['SiteUrl']?>/images/loading.gif" border="0" align="absmiddle"></div>
</div>
</div>
<div class="clear"></div>
<!--顶部横幅广告开始-->
<div id="ad_topbanner"></div>
<!--顶部横幅广告结束-->
<div class="clearfix"></div>
<div class="logosearchtel">
<div class="weblogo"><a href="<?=$city['domain']?>"><img src="<?=$qq3479015851_global['SiteUrl']?><?=$qq3479015851_global['SiteLogo']?>" title="<?=$qq3479015851_global['SiteName']?>" border="0"/></a></div>
    <!-- <div class="webcity">
    	<span><? if($city['cityname']) { echo cutstr($city['cityname'],8,'...'); ?><?php } else { ?>总站<?php } ?></span><br><a href="<?=$qq3479015851_global['SiteUrl']?>/changecity.php">切换分站</a>
    </div> -->
    <div class="webcity2" style="display:none;">
    	<div class="curcity"><? if($city['cityname']) { ?><?=$city['cityname']?><?php } else { ?>总站<?php } ?> <a href="<?=$qq3479015851_global['SiteUrl']?>/changecity.php">切换分站</a></div>
        <div class="clearfix"></div>
    	<ul>
        <?php if(!$hotcities) $hotcities=get_hot_cities(); ?>            <?php if(is_array($hotcities)){foreach($hotcities as $k) { ?>        	<a href="<?=$k['domain']?>"><?=$k['cityname']?></a>
            <?php }} ?>
        </ul>
    </div>
    <div class="postedit">
<a class="post" href="<?=$qq3479015851_global['SiteUrl']?>/<?=$qq3479015851_global['cfg_postfile']?>?catid=<?=$catid?>&cityid=<?=$cityid?>">免费发布信息</a>
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
<form method="get" action="<?=$qq3479015851_global['SiteUrl']?>/search.php?" id="searchForm" target="_blank">
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
        <?php if(is_array($navurl_head)){foreach($navurl_head as $k => $qq3479015851) { ?>        <li><a href="<?=$qq3479015851['url']?>" style="color:<?=$qq3479015851['color']?>" target="<?=$qq3479015851['target']?>" title="<?=$qq3479015851['title']?>"><?=$qq3479015851['title']?><sup class="<?=$qq3479015851['ico']?>"></sup></a></li>
        <?php }} ?>
        </ul>
        </div>
        <?php } ?>
</div>
</div>
<div class="clear"></div><? if($qq3479015851_global['head_style'] == 'normal') { ?>
<div class="body1000">
<div class="daohang_con2">
    <div class="daohang2">
        <ul>
            <li><a href="<?=$city['domain']?>" id="index">首页</a></li>
            <?php $navurl_header = qq3479015851_get_navurl('header',15); ?>            <?php if(is_array($navurl_header)){foreach($navurl_header as $k => $qq3479015851) { ?>            <li><a <? if($qq3479015851['flag'] == $cat['catid'] || $qq3479015851['flag'] == $cat['parentid']) { ?>class="current"<?php } ?> target="<?=$qq3479015851['target']?>" id="<?=$qq3479015851['flag']?>" href="<? if($qq3479015851['flag'] != 'outlink') { ?><?=$city['domain']?><?php } ?><?=$qq3479015851['url']?>"><font color="<?=$qq3479015851['color']?>"><?=$qq3479015851['title']?></font><sup class="<?=$qq3479015851['ico']?>"></sup></a></li>
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
        <?php $global_cat = get_categories_tree(0,'category'); ?>        <?php if(is_array($global_cat)){foreach($global_cat as $qq3479015851) { ?>        <li>
        <em><a href="<?=$city['domain']?><?=$qq3479015851['uri']?>" style="color:<?=$qq3479015851['color']?>" target="_blank" title="<?=$city['cityname']?><?=$qq3479015851['catname']?>"><?=$qq3479015851['catname']?></a></em>
        <dl>
        <dt><b></b></dt>
        <dd>
        <?php if(is_array($qq3479015851['children'])){foreach($qq3479015851['children'] as $w) { ?>        <a href="<?=$city['domain']?><?=$w['uri']?>" style="color:<?=$w['color']?>" target="_blank" title="<?=$city['cityname']?><?=$w['catname']?>"><?=$w['catname']?></a>
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
            <?php $navurl_header = qq3479015851_get_navurl('header',15); ?>            <?php if(is_array($navurl_header)){foreach($navurl_header as $k => $qq3479015851) { ?>            <li><a <? if($qq3479015851['flag'] == $cat['catid'] || $qq3479015851['flag'] == $cat['parentid']) { ?>class="current"<?php } ?> target="<?=$qq3479015851['target']?>" id="<?=$qq3479015851['flag']?>" href="<? if($qq3479015851['flag'] != 'outlink') { ?><?=$city['domain']?><?php } ?><?=$qq3479015851['url']?>"><font color="<?=$qq3479015851['color']?>"><?=$qq3479015851['title']?></font><sup class="<?=$qq3479015851['ico']?>"></sup></a></li>
            <?php }} ?>
        </ul>
    </div>
</div>
<div class="clearfix"></div>
<div id="ad_header"></div>
<div class="clearfix"></div>
<script>loadDefault(['category','category_select'])</script>
<?php } ?><div class="body1000">
<div class="clear"></div>
<div class="location"><?=$location?></div>
<div class="clear"></div>
<div class="corporation_content">
<div class="content_left">
<div class="cate_seller">
<div class="bd">
<ul>
            <?php $i=1; ?>                <?php if(is_array($ypcategory)){foreach($ypcategory as $qq3479015851) { ?><li class="item">
<a href="javascript:void(<?=$qq3479015851['corpid']?>);" class="rights" onclick="showHide(this,'items<?=$qq3479015851['corpid']?>');"><?=$qq3479015851['corpname']?></a>
<ul id="items<?=$qq3479015851['corpid']?>" style="display:<? if($catid > 0) { if($qq3479015851['corpid'] == $cur['parentid'] || $qq3479015851['corpid'] == $catid) { ?><?php } else { ?>none<?php } ?><?php } else { if($i==1) { ?><?php } else { ?>none<?php } ?><?php } ?>;">
<li><a href="<?=$qq3479015851['uri']?>">全部</a></li>
                <?php if(is_array($qq3479015851['children'])){foreach($qq3479015851['children'] as $w) { ?><li><a href="<?=$w['uri']?>" <? if($catid == $w['corpid']) { ?>class="current"<?php } ?>><?=$w['corpname']?></a></li>
<?php }} ?>
</ul>
</li>
                <?php $i++; ?>                <?php }} ?>
</ul>
</div>
</div>
<div class="clear"></div>
<div class="joinus">
<ul>
<a href="<?=$qq3479015851_global['SiteUrl']?>/<?=$qq3479015851_global['cfg_member_logfile']?>?mod=register&action=store" target="_blank" class="joinshop">即刻登记我的商铺</a>
<center>立刻拥有机构展示网站</center>
</ul>
</div>
</div>
<div class="content_right">
<div class="hot_corporations">
<div class="hd cfix"><span class="hdl">推荐商家店铺</span><span class="hdr">入驻热线：<?=$qq3479015851_global['SiteTel']?></span></div>
<div class="clearfix"></div>
<div class="bd cfix">
<ul>
                <?php $hotmember	= qq3479015851_get_members(10,NULL,NULL,NULL,NULL,2); ?>                <?php if(is_array($hotmember)){foreach($hotmember as $k => $qq3479015851) { ?><li><span class="imga"><a href="<?=$qq3479015851['uri']?>" class="f13" target="_blank" title="<?=$qq3479015851['tname']?>"><img src="<?=$qq3479015851_global['SiteUrl']?><?=$qq3479015851['prelogo']?>" alt="<?=$qq3479015851['tname']?>"></a></span><span class="txt"><a href="<?=$qq3479015851['uri']?>" target="_blank"><?=$qq3479015851['tname']?></a></span></li>
<?php }} ?>
</ul>
</div>
</div>
            <? if($area_list) { ?>
<div class="clear"></div>
<div class="area_select">
区域查找：
                <?php if(is_array($area_list)){foreach($area_list as $k => $qq3479015851) { ?><a href="<?=$qq3479015851['uri']?>" <? if($qq3479015851['select'] == 1) { ?>class="currenta"<?php } ?>><?=$qq3479015851['areaname']?></a>
<?php }} ?>
</div>
<?php } ?>
<div class="clearfix"></div>
<div class='section'>
<ul class='sep'>
                <?php if(is_array($member)){foreach($member as $k => $qq3479015851) { ?><li class='hover media cfix <? if($member['levelid'] == 3) { ?>vip<?php } ?>'>
<a href='<?=$qq3479015851['uri']?>' target='_blank' class='media-cap'><img src='<? if(!$qq3479015851['prelogo']) { ?><?=$qq3479015851_global['SiteUrl']?>/images/nophoto.gif<?php } else { ?><?=$qq3479015851_global['SiteUrl']?><?=$qq3479015851['prelogo']?><?php } ?>' alt=''></a>
<div class='media-body'>
<div class='media-body-title'>
<div class='pull-rights'>
<a class="see" href="<?=$qq3479015851['uri']?>" target="_blank">进入店铺</a> <a class="dianping" target="_blank" href="<?=$qq3479015851['uri_comment']?>">我要点评</a>
</div>
<a href='<?=$qq3479015851['uri']?>' target='_blank'><?=$qq3479015851['tname']?></a> &nbsp;&nbsp;<img src="<?=$qq3479015851_global['SiteUrl']?>/images/credit/<?=$qq3479015851['credits']?>.gif" align="absmiddle" alt="信用值：<?=$qq3479015851['credit']?>"> 
</div>
<div class='typo-small'><? if($qq3479015851['per_certify'] == 1) { ?><img src="<?=$qq3479015851_global['SiteUrl']?>/images/person1.gif" alt="已通过身份证认证" align="absmiddle"/><?php } else { ?><img src="<?=$qq3479015851_global['SiteUrl']?>/images/person0.gif" alt="未通过身份证认证" align="absmiddle"/><?php } ?> <? if($qq3479015851['com_certify'] == 1) { ?><img src="<?=$qq3479015851_global['SiteUrl']?>/images/company1.gif" alt="已通过营业执照认证" align="absmiddle"/><?php } else { ?><img src="<?=$qq3479015851_global['SiteUrl']?>/images/company0.gif" alt="未通过营业执照认证" align="absmiddle"/><?php } ?></div>
<div class='typo-smalls'>地址：<?=$qq3479015851['address']?> &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?=$qq3479015851['uri_contactus']?>" target="_blank">查看地图</a></div>
</div>
</li>
                <?php }} else {{ ?>
                <li class="media">没有找到相关的店铺！换个其它的分类看看吧 ^_^</li>
<?php }} ?>
<div class="clearfix"></div>				
</ul>
</div>
<div class="clear"></div>
<div class="pagination2"><?=$pageview?></div>
<div class="clear"></div>
</div>
</div>
<div class="clear"></div><div id="ad_footerbanner"></div>
<? if($advertisement['type']['floatad'] || $advertisement['type']['couplead']) { ?>
<div align="left"  style="clear: both;">
<script src="<?=$qq3479015851_global['SiteUrl']?>/template/global/floatadv.js" type="text/javascript"></script>
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
<div class="header" id="ad_header_none"><?php $countheaderbanner = count($advertisement['type']['headerbanner']);$i=1; ?><?php if(is_array($advertisement['type']['headerbanner'])){foreach($advertisement['type']['headerbanner'] as $qq3479015851) { if($adveritems[$qq3479015851]) { ?><div class="headerbanner" <? if($countheaderbanner == $i) { ?>style="margin-right:0;"<?php } ?>><?=$adveritems[$qq3479015851]?></div><?php } ?><?php $i=$i+1; ?><?php }} ?>
</div>
<?php } ?><?php if(is_array($advertisement['type']['indexcatad'])){foreach($advertisement['type']['indexcatad'] as $k => $qq3479015851) { ?><div class="indexcatad" id="ad_indexcatad_<?=$k?>_none"><?=$adveritems[$qq3479015851['0']]?></div>
<?php }} if($advertisement['type']['interlistad']['top']) { ?>
<div id="ad_interlistad_top_none">
<ul class="interlistdiv"><?php if(is_array($advertisement['type']['interlistad']['top'])){foreach($advertisement['type']['interlistad']['top'] as $qq3479015851) { if($adveritems[$qq3479015851]) { ?><li class="hover"><?=$adveritems[$qq3479015851]?></li><?php } ?>
<?php }} ?>
</ul>
</div>
<?php } if($advertisement['type']['interlistad']['bottom']) { ?>
<div id="ad_interlistad_bottom_none">
<ul class="interlistdiv"><?php if(is_array($advertisement['type']['interlistad']['bottom'])){foreach($advertisement['type']['interlistad']['bottom'] as $qq3479015851) { if($adveritems[$qq3479015851]) { ?><li class="hover"><?=$adveritems[$qq3479015851]?></li><?php } ?>
<?php }} ?>
</ul>
</div>
<?php } if($advertisement['type']['intercatad']) { ?>
<div class="intercatdiv" id="ad_intercatdiv_none"><?php if(is_array($advertisement['type']['intercatad'])){foreach($advertisement['type']['intercatad'] as $qq3479015851) { ?><div class="intercatad"><?=$adveritems[$qq3479015851]?></div>
<?php }} ?>
</div>
<?php } if($advertisement['type']['topbanner']) { ?>
<div class="topbanner" id="ad_topbanner_none"><?php if(is_array($advertisement['type']['topbanner'])){foreach($advertisement['type']['topbanner'] as $qq3479015851) { ?><div class="topbannerad"><?=$adveritems[$qq3479015851]?></div>
<?php }} ?>
</div>
<?php } if($advertisement['type']['footerbanner']) { ?>
<div class="footerbanner" id="ad_footerbanner_none"><?php if(is_array($advertisement['type']['footerbanner'])){foreach($advertisement['type']['footerbanner'] as $qq3479015851) { ?><div class="footerbannerad"><?=$adveritems[$qq3479015851]?></div>
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
                	<li><a target="_blank" href="<?=$qq3479015851_global['SiteUrl']?>/<?=$qq3479015851_global['cfg_postfile']?>?cityid=<?=$cityid?>">免费发布信息</a></li>
                    <li><a target="_blank" href="<?=$qq3479015851_global['SiteUrl']?>/delinfo.php?cityid=<?=$cityid?>" rel="nofollow">修改/删除信息</a></li>
                    <li><a target="_blank" href="<?=$qq3479015851_global['SiteUrl']?>/search.php?cityid=<?=$cityid?>" rel="nofollow">信息快速搜索</a></li>
                </ul>
            </div>
        </div>
        <div class="foot_box" id="sjfw" style="display:none;">
        	<div class="hd">商家服务</div>
            <div class="bd">
            	<ul>
                	<li><a target="_blank" href="<?=$qq3479015851_global['SiteUrl']?>/<?=$qq3479015851_global['cfg_member_logfile']?>?mod=register&action=store&cityid=<?=$cityid?>">商家入驻</a></li>
                    <li><a target="_blank" href="<?=$qq3479015851_global['SiteUrl']?>/<?=$qq3479015851_global['cfg_member_logfile']?>?cityid=<?=$cityid?>">商家登录</a></li>
                </ul>
            </div>
        </div>
        <div class="foot_box">
        	<div class="hd">关于我们</div>
            <div class="bd">
            	<ul>
                <?php $navurl_foot = qq3479015851_get_navurl('foot',30); ?>                    <?php if(is_array($navurl_foot)){foreach($navurl_foot as $k => $qq3479015851) { ?>                	<li><a href="<?=$qq3479015851['url']?>" style="color:<?=$qq3479015851['color']?>" target="<?=$qq3479015851['target']?>"><?=$qq3479015851['title']?><sup class="<?=$qq3479015851['ico']?>"></sup></a></li>
                    <?php }} ?>
                </ul>
            </div>
        </div>
        <div class="foot_wx">
        	<div class="hd">扫一扫，访问手机站</div>
            <div class="bd">
            	<ul>
                	<img alt="<?=$qq3479015851_global['SiteName']?>手机版" src="<?=$qq3479015851_global['SiteUrl']?>/qrcode.php?value=<?=$qq3479015851_global['SiteUrl']?>/m/index.php&size=4.7">
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
            <? if($qq3479015851_global['SiteTel']) { ?><div class="h1"><font><?=$qq3479015851_global['SiteTel']?></font></div><?php } ?>
            <? if($qq3479015851_global['SiteEmail']) { ?><div class="h3">邮箱：<font><?=$qq3479015851_global['SiteEmail']?></font></div><?php } ?>
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="foot_powered">
    	Copyright &copy; <?=$qq3479015851_global['SiteName']?>版权所有 <a href="http://www.miibeian.gov.cn"><?=$qq3479015851_global['SiteBeian']?></a>
    </div>
</div>
<p id="back-to-top"><a href="#top"><span></span></a></p>
<script type="text/javascript">loadDefault(["addiv","iflogin","show_tab","scrolltop","changecity"]);</script></div>
<script>loadDefault(['hover_bg','dropdown']);</script>
</body>
</html>