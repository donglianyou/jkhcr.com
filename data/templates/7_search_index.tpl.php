<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<?php include qq3479015851_tpl('search_header'); ?>
<div class="c mt10"></div>
<div class="s_logo" style="text-align:center;">
    <div class="logo" style="float:none;margin:70px auto 60px auto;"><a href="<?=$SystemGlobalcfm_global['SiteUrl']?>"><img src="<?=$SystemGlobalcfm_global['SiteLogo']?>" alt="<?=$SystemGlobalcfm_global['SiteName']?>"></a></div>
<div class="c"></div>
    <div style="float:none;margin:0 auto 200px auto; width:596px;">
    <form action="search.php?" method="get" />
        <div class="s_ulA" id="searchType">
            <ul>
                 <li name="s8" id="s8_information" onclick="show_tab('information');" <? if($mod == 'information') { ?>class="current"<?php } ?>><a href="#">信息</a></li>
<? if($SystemGlobalcfm_global['cfg_if_corp'] == 1) { ?><li name="s8" id="s8_store" onclick="show_tab('store');" <? if($mod == 'store') { ?>class="current"<?php } ?>><a href="#">商家</a></li><?php } ?><?php if(is_array($allowplugin)){foreach($allowplugin as $plugin) { ?>                <li name="s8" id="s8_<?=$plugin['flag']?>" onclick="show_tab('<?=$plugin['flag']?>');" <? if($mod == $plugin['flag']) { ?>class="current"<?php } ?>><a href="#"><?=$plugin['name']?></a></li>
<?php }} ?>
            </ul>
        </div>
        <div class="s_enter cc">
        	<input type="hidden" id="searchtype" name="mod" value="<?=$mod?>"/>
            <input placeholder="请输入关键词或分类名" value="<?=$search['keywords']?>" class="s_input" type="text" name="keywords" >
            <button class="s_btn" type="submit">搜 索</button>
        </div>
        </form>
    </div>
</div> 
<div class="c mt10"></div>
<div class="footer-wrap">
<?php include qq3479015851_tpl('search_foot'); ?>
</div>
</div>
</body>
</html>