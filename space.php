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
define('IN_SMT',true);
define('QQ3479015851', true);
define('CURSCRIPT','space');

require_once dirname(__FILE__)."/include/global.php";
require_once dirname(__FILE__)."/data/config.php";
require_once QQ3479015851_DATA."/config.db.php";
require_once QQ3479015851_INC."/db.class.php";

$user   = isset($user) 	 ? checkhtml($user) : '';
$id 	= isset($id) 	 ? intval($id) 		: '';
ifsiteopen();

$where  = "WHERE a.userid = '$user'";

$space	= $db -> getRow("SELECT a.* FROM `{$db_qq3479015851}member` AS a LEFT JOIN `{$db_qq3479015851}area` AS b ON a.areaid = b.areaid $where");
if(!$space || empty($user)) write_msg("您所指定的会员不存在，或者尚未通过审核");

$space['if_corp'] = $qq3479015851_global['cfg_if_corp'] != 1 ? 0 : $space['if_corp'];
$space['storeuri'] = $space['if_corp'] == 1 ? Rewrite('store',array('uid'=>$space['id'])) : '';	

$space['uri'] 	 = Rewrite('space',array('user'=>$user,'part'=>'index'));
$space['prelogo'] = $space['prelogo'] ? $space['prelogo'] : $qq3479015851_global[SiteUrl].'/images/noavatar_small.gif';

/*当前位置*/
$loc 		= get_location('space','',$user);
$location 	= $loc['location'];
$page_title = $loc['page_title'];

globalassign();
include qq3479015851_tpl('index');
is_object($db) && $db->Close();
?>