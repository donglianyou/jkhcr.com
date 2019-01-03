<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<div class="footer">
<!--<p class="footer_01">
<a href="index.php?mod=index" class="footer_hover" rel="nofollow">手机版</a>
<a href="<?=$SystemGlobalcfm_global['SiteUrl']?>/index.php?view=pc" rel="nofollow">电脑版</a>
</p>-->
    <div class="clear"></div>
<p class="footer_02">&copy;copyright<?=$SystemGlobalcfm_global['SiteName']?><br /><?=$SystemGlobalcfm_global['SiteBeian']?>&nbsp;&nbsp;</p>
<p class="footer_02" style="display:none"><?=$SystemGlobalcfm_global['SiteStat']?></p>
</div>
<div class="windowIframe" id="windowIframe" style="display:none;">
<div class="header">
    	<a href="javascript:;" class="back left8 close">返回</a><span id="windowIframeTitle"></span>
    </div>
<div class="body" id="windowIframeBody"></div>
</div>
<script>var searchHtml='<div class="searchbar2">'+'<form id="myform" action="<?=$SystemGlobalcfm_global['SiteUrl']?>/m/index.php?" method="get">'+'<input name="mod" type="hidden" value="search">'+'<input type="text" name="keywords" id="keyword" class="s_ipt" value="" placeholder="输入关键字" />'+'<input type="submit" class="s_btn po_ab" value="搜索">'+'</form></div>';function newPageSearch(){$('#windowIframe .back').show();$('#myform').submit(function(){if($('#keyword').val()===''){MSGwindowShow('index','0','请输入搜索关键字','','')}})}</script>