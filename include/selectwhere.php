<?php
/*
 * ============================================================================
 * 版权所有 114mps研发团队，保留所有权利。
 * 网站地址: http://my.roebx.com；
 * 博客教程：http://blog.csdn.net/qq_35921430；
 * ----------------------------------------------------------------------------
 * 这是一个自由软件！您可以对程序代码进行修改和使用。
 * ============================================================================
 * 程序交流QQ：3479015851
 * QQ群 ：625621054  [入群提供技术支持]
`*/
define('QQ3479015851',true);

require_once dirname(__FILE__).'/global.php';
require_once QQ3479015851_DATA.'/config.php';
require_once QQ3479015851_DATA.'/config.db.php';
require_once QQ3479015851_INC.'/db.class.php';

$action 	= isset($action) 	? trim($action)		: '';
$parentid 	= isset($parentid) 	? intval($parentid)	: '';
$currentid 	= isset($currentid) ? intval($currentid): '';
$delstreet 	= isset($delstreet) ? intval($delstreet): '';

$qq3479015851_global = NULL;

switch($action){
	case 'getarea':
		if($parentid){
			$view=select_where("area","'areaid' onChange=\"choose_where('getstreet',this.options[this.selectedIndex].value,'','')\"",$currentid,$parentid);
			$view=str_replace("\r","",$view);
			$view=str_replace("\n","",$view);
			$view=str_replace("'","\'",$view);
			echo "<script language=\"javascript\">
			<!--
			parent.document.getElementById(\"showarea\").innerHTML='$view';
			//-->
			</script>";
		}
		if($delstreet){
			echo "<script language=\"javascript\">
			<!--
			parent.document.getElementById(\"showstreet\").innerHTML='';
			//-->
			</script>";
			if(!$parentid){
				echo "<script language=\"javascript\">
				<!--
				parent.document.getElementById(\"showarea\").innerHTML='';
				//-->
				</script>";
			}
		}
	break;
	case 'getstreet':
		$view=select_where("street","'streetid'",$currentid,$parentid);
		$view=str_replace("\r","",$view);
		$view=str_replace("\n","",$view);
		$view=str_replace("'","\'",$view);
		echo "<script language=\"javascript\">
		<!--
		parent.document.getElementById(\"showstreet\").innerHTML='$view';
		//-->
		</script>";
	break;
}
is_object($db) && $db -> Close();
$db_qq3479015851 = $view = $parentid = $action = $currentid = $delstreet = $db = $db_qq3479015851 = NULL;
?>