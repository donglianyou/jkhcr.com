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
if (!defined('QQ3479015851')) {
	exit('Forbidden');
}

require_once QQ3479015851_INC . '/class.fun.php';

if (submit_check('shop_submit')) {
	$tname = (isset($_POST['tname']) ? trim(mhtmlspecialchars($_POST['tname'])) : '');
	$introduce = trim($_POST['introduce']);
	$introduce = maddslashes($introduce);
	$catid = $_POST['catid'];
	$cityid = (isset($_POST['cityid']) ? intval($_POST['cityid']) : '');
	$areaid = (isset($_POST['areaid']) ? intval($_POST['areaid']) : '');
	$streetid = (isset($_POST['streetid']) ? intval($_POST['streetid']) : '');
	$msn = trim(mhtmlspecialchars($_POST['msn']));
	$mappoint = trim(mhtmlspecialchars($_POST['mappoint']));
	$address = trim(mhtmlspecialchars($_POST['address']));
	$busway = trim(mhtmlspecialchars($_POST['busway']));
	$busway = textarea_post_change($busway);
	$template = trim(mhtmlspecialchars($_POST['template']));
	$web = trim(mhtmlspecialchars($_POST['web']));
	$banner = (isset($_POST['banner']) ? mhtmlspecialchars($_POST['banner']) : '');
	$oldbanner = (isset($_POST['oldbanner']) ? mhtmlspecialchars($_POST['oldbanner']) : '');
	$name_file = 'banner';
	$tel = trim(mhtmlspecialchars($_POST['tel']));
	$ac = ($ac ? $ac : 'base');
	if (is_array($catid) && ($if_corp == 1)) {
		qq3479015851_delete('member_category', 'WHERE userid = \'' . $s_uid . '\'');

		foreach ($catid as $kids => $vids ) {
			$db->query('INSERT `' . $db_qq3479015851 . 'member_category` (userid,catid)VALUES(\'' . $s_uid . '\',\'' . $vids . '\')');
		}

		$catids = implode(',', $catid);
	}

	if ($if_corp == 1) {
		if ($ac == 'base') {
			if (empty($tname)) {
				write_msg('', '?m=shop&error=39');
			}

			$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET tname=\'' . $tname . '\',catid=\'' . $catids . '\',cityid=\'' . $cityid . '\',areaid=\'' . $areaid . '\',streetid=\'' . $streetid . '\',introduce=\'' . $introduce . '\',tel=\'' . $tel . '\',address=\'' . $address . '\',busway=\'' . $busway . '\',mappoint=\'' . $mappoint . '\',msn=\'' . $msn . '\',web=\'' . $web . '\' ' . $where . ' AND if_corp = \'1\'');
			write_msg('', '?m=shop&success=13');
		}
		else if ($ac == 'template') {
			if ($_FILES[$name_file]['name']) {
				require_once QQ3479015851_INC . '/upfile.fun.php';
				check_upimage($name_file);
				$destination = '/banner/' . date('Ym') . '/';
				$qq3479015851_image = start_upload($name_file, $destination, 0, '', '', $oldbanner, '');
				$picture = $qq3479015851_image;
				unset($qq3479015851_image);
				unset($_FILES);
			}
			else {
				$picture = ($oldbanner ? $oldbanner : '');
			}

			$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET template=\'' . $template . '\',banner=\'' . $picture . '\' ' . $where . ' AND if_corp = \'1\'');
			write_msg('', '?m=shop&success=8&ac=template');
		}
	}
	else {
		if (empty($tname)) {
			write_msg('', '?m=shop&error=39');
		}

		if (empty($cityid)) {
			write_msg('', '?m=shop&error=40');
		}

		if (empty($address)) {
			write_msg('', '?m=shop&error=45');
		}

		if (empty($introduce)) {
			write_msg('', '?m=shop&error=46');
		}

		if (is_array($catid)) {
			$db->query('DELETE FROM `' . $db_qq3479015851 . 'member_category` WHERE userid = \'' . $s_uid . '\'');

			foreach ($catid as $kids => $vids ) {
				$db->query('INSERT INTO `' . $db_qq3479015851 . 'member_category` (userid,catid)VALUES(\'s_uid\',\'' . $vids . '\')');
			}

			$catids = implode(',', $catid);
		}

		$db->query('UPDATE `' . $db_qq3479015851 . 'member` SET tname=\'' . $tname . '\',levelid=\'1\',catid=\'' . $catids . '\',cityid=\'' . $cityid . '\',areaid=\'' . $areaid . '\',streetid=\'' . $streetid . '\',introduce=\'' . $introduce . '\',address=\'' . $address . '\',tel=\'' . $tel . '\',busway=\'' . $busway . '\',mappoint=\'' . $mappoint . '\',msn=\'' . $msn . '\',template=\'' . $template . '\',template=\'' . $template . '\',web=\'' . $web . '\',if_corp=\'1\' ' . $where);
		write_msg('', '?m=shop&success=14');
	}
}
else {
	$ac = ($ac ? trim($ac) : 'base');

	if ($ac == 'base') {
		$r = $db->getRow('SELECT citypy,mappoint FROM `' . $db_qq3479015851 . 'city` WHERE cityid = \'' . $cityid . '\'');
		$row['citypy'] = $r['citypy'];
		$mappoint = ($row['mappoint'] ? $row['mappoint'] : $r['mappoint']);
		$acontent = get_editor('introduce', 'Member', $row['introduce'], '100%', '300px');
		$get_member_cat = get_member_cat(explode(',', $row['catid']));
		$row['busway'] = de_textarea_post_change($row['busway']);
		$city = ($row['cityid'] ? get_city_caches($row['cityid']) : '');

		if (is_array($city)) {
			$cityname = $city['directory'];
			unset($city);
		}

		$location = location('corp');
		include qq3479015851_tpl('shop');
	}
	else {
		chk_member_purview('purview_banner');
		require_once QQ3479015851_DATA . '/config.inc.php';
		$location = location('corp');
		include qq3479015851_tpl('shop_template');
	}
}

?>
