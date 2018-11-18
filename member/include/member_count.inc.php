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
$element = array(
	'信息'    => array('style' => 'info', 'url' => 'info.php?part=all', 'table' => 'information', 'type' => ''),
	'点评'    => array('style' => 'com', 'url' => 'comment.php', 'table' => 'member_comment', 'type' => '', 'where' => ' AND commentlevel = 1'),
	'短消息' => array('style' => 'pm', 'url' => 'pm.php', 'table' => 'member_pm', 'type' => '', 'where' => ' AND if_read = 0'),
	'账户'    => array('style' => 'incomes', 'url' => 'bank.php', 'table' => 'member', 'type' => 'money')
	);

if ($if_corp != 1) {
	unset($element['留言']);
	unset($element['点评']);
}
function member_get_count()
{
	global $element;
	global $s_uid;
	global $money_own;
	global $pm_total;

	foreach ($element as $k => $value ) {
		if (empty($value[type])) {
			$and = ($value[where] ? $value[where] : '');

			if ($value[style] == 'pm') {
				$qq3479015851_member_count .= '<li class="' . $value[style] . '"><a href="' . $value[url] . '">' . $k . '(' . $pm_total . ')</a></li>';
			}
			else {
				$qq3479015851_member_count .= '<li class="' . $value[style] . '"><a href="' . $value[url] . '">' . $k . '(' . qq3479015851_count($value[table], 'WHERE userid = \'' . $s_uid . '\'' . $and) . ')</a></li>';
			}
		}
		else {
			$qq3479015851_member_count .= '<li class="' . $value[style] . '"><a href="' . $value[url] . '">' . $k . '(' . $money_own . ')</a></li>';
		}
	}

	return $qq3479015851_member_count;
}


?>
