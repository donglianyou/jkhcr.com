<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<div class="clear"></div>
<div class="foot">
    <div class="footer">
        <ul>
            <div class="foot_nav"><a href="<?=$uri['index']?>" target="_blank">网站首页</a> - <a href="<?=$uri['about']?>" target="_blank">机构简介</a> - <a href="<?=$uri['info']?>" target="_blank">分类信息</a> - <a href="<?=$uri['album']?>" target="_blank">机构相册</a> - <a href="<?=$uri['comment']?>" target="_blank">留言点评</a> - <a href="<?=$uri['contactus']?>" target="_blank">联系我们</a> - <a href="<?=$SystemGlobalcfm_global['SiteUrl']?>/<?=$SystemGlobalcfm_global['cfg_member_logfile']?>" target="_blank">登录管理</a></div>
            <div class="foot_copyright">版权所有：<?=$store['tname']?> 联系电话：<?=$store['tel']?><br />联系地址：<?=$store['address']?> <?=$SystemGlobalcfm_global['SiteStat']?> <font class="none">powered by <a href="/">中国健康养生网</a></font></div>
        </ul>
    </div>
</div>
<div class="floater">
    <span class="htm">手机收藏，随时查看</span>
    <span class="ctm"><img src="<?=$SystemGlobalcfm_global['SiteUrl']?>/qrcode.php?size=2.2&value=<?=$uri['index']?>"></span>
    <span class="btm">手机微站</span>
</div>
<script type="text/javascript">
var url = '<?=$mymps_global['SiteUrl']?>/javascript.php?part=member&id=<?=$store['id']?>';$.get(url,function(data){$('#hit').html(data);});
</script>
