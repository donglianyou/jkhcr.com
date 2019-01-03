<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?><?php $navigation = get_mobile_nav(); if($navigation) { ?>
<div class="select_01" id="wrapper2">
    <ul class="tab-hd" id="scroller2">
        <?php if(is_array($navigation)){foreach($navigation as $SystemGlobalcfm) { ?>        <li class="item <? if($SystemGlobalcfm['flag'] == 'index') { ?>current<?php } ?>"><a style="color:<?=$SystemGlobalcfm['color']?>;" target="<?=$SystemGlobalcfm['target']?>" href="<?=$SystemGlobalcfm['url']?>"><?=$SystemGlobalcfm['title']?></a></li>
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
<?php } ?>
<div class="clearfix"></div>