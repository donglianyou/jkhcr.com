<? if(!defined('QQ3479015851')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$page_title?></title>
<link rel="shortcut icon" href="<?=$qq3479015851_global['SiteUrl']?>/favicon.ico" />
<link rel="stylesheet" href="<?=$qq3479015851_global['SiteUrl']?>/template/default/css/global.css" />
<link rel="stylesheet" href="<?=$qq3479015851_global['SiteUrl']?>/template/default/css/style.css" />
<link rel="stylesheet" href="<?=$qq3479015851_global['SiteUrl']?>/template/default/css/post.css" />
<script src="<?=$qq3479015851_global['SiteUrl']?>/template/global/noerr.js" type="text/javascript"></script>
<script src="<?=$qq3479015851_global['SiteUrl']?>/template/default/js/global.js" type="text/javascript"></script>
<script src="<?=$qq3479015851_global['SiteUrl']?>/template/default/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=$qq3479015851_global['SiteUrl']?>/template/default/js/jquery.autocomplete.min.js"></script> 
<link rel="stylesheet" href="<?=$qq3479015851_global['SiteUrl']?>/template/default/css/jquery.autocomplete.css" />
<script type="text/javascript">
var cates = [<?php $i=1; ?><?php if(is_array($categories)){foreach($categories as $qq3479015851) { if($i >1) { ?>,<?php } ?>
{ name1: "<?=$qq3479015851['dir_typename']?>",name: "<?=$qq3479015851['catid']?>", to: "<?=$qq3479015851['catname']?>" }<?php if(is_array($qq3479015851['children'])){foreach($qq3479015851['children'] as $w) { ?>,
{ name1: "<?=$w['dir_typename']?>",name: "<?=$w['catid']?>", to: "<?=$w['catname']?>" }
<?php }} ?><?php $i++; ?><?php }} ?><?php $i=NULL;unset($i); ?>]; 
$(function() {
$('#catname').autocomplete(cates, { 
max: 20, 
minChars: 0, 
width: 316, 
scrollHeight: 100,
matchContains: true, 
autoFill: false,
formatItem: function(row, i, max) { 
return row.to; 
}, 
formatMatch: function(row, i, max) { 
return row.name1 + row.name + row.to; 
}, 
formatResult: function(row) { 
return row.to; 
} 
}); 
}); 
</script>
</head>

<body class="<?=$qq3479015851_global['cfg_tpl_dir']?> bodybg<?=$qq3479015851_global['cfg_tpl_dir']?><?=$qq3479015851_global['bodybg']?>"><script type="text/javascript">var current_domain="<?=$qq3479015851_global['SiteUrl']?>";var current_cityid="<?=$city['cityid']?>";var current_logfile="<?=$qq3479015851_global['cfg_member_logfile']?>";</script>
<div class="bartop">
<div class="barcenter">
<div class="barleft">
<ul class="barcity"><span><? if($city['cityname']) { ?><?=$city['cityname']?><?php } else { ?>总站<?php } ?></span>[<a href="<?=$qq3479015851_global['SiteUrl']?>/changecity.php">切换分站</a>]</ul> 
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
<div class="clearfix"></div>
<div class="mhead">
<div class="logo"><a href="<? echo $city['domain']?$city['domain']:$qq3479015851_global['SiteUrl']; ?>" target="_blank"><img src="<?=$qq3479015851_global['SiteUrl']?><?=$qq3479015851_global['SiteLogo']?>" title="<?=$qq3479015851_global['SiteName']?>"/></a></div>
<div class="font">
<span>
        <? if(CURSCRIPT == 'posthistory') { ?>发帖记录<?php } elseif(CURSCRIPT == 'space') { ?>用户中心<?php } elseif(CURSCRIPT == 'mobile') { ?>手机版<?php } elseif(CURSCRIPT == 'login') { ?>帐号升级<?php } elseif(CURSCRIPT == 'delinfo') { ?>修改/删除信息<?php } elseif(CURSCRIPT == 'post') { ?>发布信息<?php } else { ?>切换分站<?php } ?>
</span>
</div>
</div>
<div class="cleafix"></div><div class="body1000">
<div class="clear15"></div>
<div id="main" class="wrapper">
<div class="step1">
<span class="cur"><font class="number">1</font> 选择信息分类</span>
<span><font class="number">2</font> 填写信息内容</span>
<span><font class="number">3</font> 发布成功</span>
</div>
<div id="fenlei2">
            <div class="minheight" id="ymenu-side"> 
               <ul class="ym-mainmnu">
               <?php if(is_array($categories)){foreach($categories as $k => $qq3479015851) { ?>                    <li class="ym-tab">
                        <a href="#" class="black"><?=$qq3479015851['catname']?></a>
                        <ul class="ym-submnu">
                            <?php if(is_array($qq3479015851['children'])){foreach($qq3479015851['children'] as $u => $w) { ?>                            <li><a href="?action=input&catid=<?=$w['catid']?>&cityid=<?=$cityid?>"><?=$w['catname']?></a></li>
                            <?php }} ?>
                        </ul> 
                    </li>
                    <?php }} ?>
                </ul>
                <? if($catid > 0) { ?>
                <div class="clear"></div>
                <div class="backall"><a href="?action=input&cityid=<?=$cityid?>">&laquo;重新选择大类</a></div>
                <?php } ?>
            </div>
            <form action="?" method="get">
        	<div class="psearch">
                <div class="pshead"><em>搜索栏</em><input type="text" id="catname" name="catname" placeholder="请输入关键字查找您要发布的分类" class="pstxt" value=""><input type="button" value="帮我推荐类别" onclick="if(this.form.catname.value==''){this.form.catname.focus();alert('请输入类别名称！');return false;};this.form.submit()" class="psbtn" id="btn_cateSearch">
                </div>
       		</div>
            </form>
</div> 
        
</div>
<div class="clear"></div><div class="footer">	&copy; <?=$qq3479015851_global['SiteName']?> <a href="http://www.miibeian.gov.cn" target="_blank"><?=$qq3479015851_global['SiteBeian']?></a> <?=$qq3479015851_global['SiteStat']?> <span class="none_<?=$qq3479015851_qq3479015851['debuginfo']?>"><? if($cachetime) { ?>This page is cached at <? echo GetTime($timestamp,'Y-m-d H:i:s'); ?><?php } ?></span><span class="my_mps"><strong><a href="<?=QQ3479015851_WWW?>" target="_blank"><?=QQ3479015851_SOFTNAME?></a></strong> <em><a href="<?=QQ3479015851_BBS?>" target="_blank"><?=QQ3479015851_VERSION?></a></em></span></div></div>
</body>
</html>
<script type="text/javascript">loadDefault(['iflogin','post_select'])</script>