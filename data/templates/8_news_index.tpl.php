<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
<head>
<?php include qq3479015851_tpl('header'); ?>
<title>热点资讯 - <?=$SystemGlobalcfm_global['SiteName']?></title>
<link type="text/css" rel="stylesheet" href="template/css/global.css">
<link type="text/css" rel="stylesheet" href="template/css/style.css">
    <link type="text/css" rel="stylesheet" href="template/css/news.css">
    <script>window['current'] = '热点资讯';</script>
</head>

<body class="<?=$SystemGlobalcfm_global['cfg_tpl_dir']?>">
<div class="wrapper">

    
<?php include qq3479015851_tpl('header_search'); ?>
    <div class="clear"></div>
    <div class="news">
    
    <?php $focus = get_mobile_gg(2); ?>    <? if($focus) { ?>
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
    
    <div class="select_01" id="wrapper2">
        <ul class="tab-hd" id="scroller2">
            <li class="current item"><a href="index.php?mod=news">最新</a></li>
            <?php if(is_array($rootchannel)){foreach($rootchannel as $SystemGlobalcfm) { ?>            <li class="item"><a href="index.php?mod=news&catid=<?=$SystemGlobalcfm['catid']?>"><?=$SystemGlobalcfm['catname']?></a></li>
            <?php }} ?>
        </ul>
    </div>
<script type="text/javascript" src="template/js/iscroll-probe.js"></script>
    <script>
    (function($){
        var w_w = $(window).width();
        $('#scroller2').css('width',(90*$('#scroller2').find('li').length)+40+'px'); 
        window['myScroll2'] = new IScroll('#wrapper2', {
            scrollX: true,
            scrollY: false,
            click:true,
            keyBindings: true
        });
    })(jQuery);
    </script>

    <div class="clearfix"></div>
        
    <div class="mod_02" id="myPicsrc">
                <div class="bd tab-cont">
                    <ul class="list_normal list_news">
                        <?php if(is_array($news)){foreach($news as $SystemGlobalcfm) { ?>                        <li class="img">
                            <a href="<?=$SystemGlobalcfm['uri']?>" class="link">
                            <p class="img"><img src="<?=$SystemGlobalcfm['imgpath']?>" onerror="this.src='<?=$SystemGlobalcfm_global['SiteUrl']?>/images/nophoto.jpg'" /></p>
                            <p class="tit"<? if($SystemGlobalcfm['iscommend'] ==1) { ?>style="color:red"<?php } ?>><?=$SystemGlobalcfm['title']?></p>
                            <p class="txt"><? echo cutstr($SystemGlobalcfm['content'],60,'...'); ?></p>
                            <p class="hot po_ab"><? echo GetTime($SystemGlobalcfm['begintime'],'m-d'); ?></p>
                            </a>
                        </li>
                        <?php }} ?>
                    </ul>
                </div>
                
            </div>
    </div>
    <? if($news) { ?>
<div class="pager">
    <?=$pageview?>
</div>
<?php } ?>
    </div>
<?php include qq3479015851_tpl('footer'); ?>
<script src="template/js/slider.js"></script>
<script>
(function($){
var list = $('#content').find('.cell');
if(list.length > 0){
var txt = '';
$('#content').find('.cell').each(function(i){
if(i === 0){
txt += '<li class="active">1</li>';
}else{
txt += '<li>'+(i+1)+'</li>';
}
});
$('#indicator').html(txt);
var w_w = $(window).width();
setTimeout(function(){new C_Scroll({container:'slide',content:'content',ct:'indicator',size:w_w,intervalTime:5000,lazyIMG:!!0});},20);
setTimeout(function(){$('#slide').show();},20);
}
})(jQuery);
</script>
</body>
</html>