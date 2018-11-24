<?php if($box != 1){?>
<div class="footer">
    <div class="clearfix footer-inner">
        <p class="copyright">
            CopyRight &copy; <a href="<?php echo $SystemGlobalcfm_global['SiteUrl']; ?>"><?php echo $SystemGlobalcfm_global['SiteName']; ?></a> 合作热线:<?php echo $SystemGlobalcfm_global['SiteTel']; ?>
        </p>
        <p class="extrainfo">
            <?php echo $SystemGlobalcfm_global['SiteUrl']; ?> All Rights Reserved. <a rel="nofollow" href="http://www.miibeian.gov.cn/"><?php echo $SystemGlobalcfm_global['SiteBeian']?></a>
        </p>
        <p style="display:none;">
        	Powered by <a href="http://blog.csdn.net/qq_35921430" target="_blank">qq3479015851</a>
        </p>
    </div>
</div>
<?php
require_once MEMBERDIR.'/include/actionmessage.inc.php';
?>
<div style="display: none" id="msg_none">
	<div id="msg_success_none" class="successmsg"><?php echo $actionmessage['success'][$success]; ?></div>
    <div id="msg_error_none" class="errormsg"><?php echo $actionmessage['error'][$error]; ?></div>
	<div id="msg_alert_none" class="alertmsg"><?php echo $actionmessage['alert'][$alert]; ?></div>
</div>
<script type="text/javascript">
	function hiddendiv(){
		var box=$obj('msg_result');
		msg_success.style.display='none';
		msg_error.style.display='none';
		msg_alert.style.display='none';
	}
    var resultdivs  = $obj('msg_none').getElementsByTagName('div');
    var resultobj  = null;
	for(var i = 0; i < resultdivs.length; i++) {
        if(resultdivs[i].id.substr(0, 4) == 'msg_' && (resultobj = $obj(resultdivs[i].id.substr(0, resultdivs[i].id.length - 5))) && resultdivs[i].innerHTML) {
			resultobj.innerHTML = resultdivs[i].innerHTML;
			resultobj.className = resultdivs[i].className;
		}
	}
	setTimeout('hiddendiv()',10000);//3秒
</script>
<?php 
$actionmessage = $message = NULL;
?>
<?php }?>