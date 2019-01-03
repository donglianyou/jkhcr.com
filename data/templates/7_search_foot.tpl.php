<? if(!defined('SysGlbCfm')) exit('Access Denied');
/*分类信息系统
联系QQ：3479015851*/?>
<div id="footer"><div id="copyright"><span><font id="fonts">  <?php $mtime = explode(' ', microtime());$totaltime = number_format(($mtime['1'] + $mtime['0'] - $mymps_starttime), 6); echo 'Processed in '.$totaltime.' second(s) , '.$db->query_num.' queries'; ?></span> <?=$mymps_global['SiteStat']?></div></div><script type="text/javascript">loadDefault(['search','show_tab']);</script>