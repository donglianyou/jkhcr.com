<?php
/*
 * ============================================================================
 * 版权所有 114mps研发团队，保留所有权利。
 * 网站地址: http://my.roebx.com；
 * 博客教程：http://blog.csdn.net/qq_35921430；
 * ----------------------------------------------------------------------------
 * 这是一个自由软件！您可以对程序代码进行修改和使用。
 * ============================================================================
 * Powered By 中国健康养生网站
`*/
(CURSCRIPT != 'wap') && exit('FORBIDDEN');
$catid = (isset($catid) ? intval($catid) : '');
$areaid = (isset($areaid) ? intval($areaid) : '');
$streetid = isset( $areaid ) ? intval( $streetid ) : "";
require_once SysGlbCfm_DATA . '/info_lasttime.php';
$authcodesettings = read_static_cache('authcodesettings');

if ($action == 'post') {
	$content = (isset($content) ? textarea_post_change($content) : '');
	$result = verify_badwords_filter($SystemGlobalcfm_global['cfg_if_info_verify'], $title, $content);
	$title = $result['title'];
	$content = $result['content'];
	$content = preg_replace('/<a[^>]+>(.+?)<\\/a>/i', '', $content);
	$info_level = $result['level'];
	$mixcode = (isset($mixcode) ? trim($mixcode) : '');
	$manage_pwd = (isset($manage_pwd) ? trim($manage_pwd) : '');
	$begintime = $timestamp;
	$lat = (isset($lat) ? (double) $lat : '');
	$lng = (isset($lng) ? (double) $lng : '');
	$activetime = $endtime = intval($endtime);
	$endtime = ($endtime == 0 ? 0 : ($endtime * 3600 * 24) + $begintime);
	$d = $db->getRow('SELECT catname,dir_typename,modid,gid FROM `' . $db_qq3479015851 . 'category` WHERE catid = \'' . $catid . '\'');
	$catname = $d['catname'];
	$dir_typename = $d['dir_typename'];
	if (!($mixcode) || ($mixcode != md5($cookiepre))) {
		errormsg('系统判断您的来路不正确！');
	}

	$backurl = 'javascript:history.back();';

	if (empty($catid)) {
		redirectmsg('您选择发布的分类不存在!', 'index.php?mod=category');
	}

	if (!($areaid = $db->getOne('SELECT areaid FROM `' . $db_qq3479015851 . 'area` WHERE areaid = \'' . $areaid . '\''))) {
		redirectmsg('您选择发布的地区不存在!', 'index.php?mod=post&catid=' . $catid);
	}

	empty($areaid) && redirectmsg('请选择您要发布的地区!', 'index.php?mod=post&catid=' . $catid . '');
	empty($title) && redirectmsg('请输入信息标题!', $backurl);
	empty($content) && redirectmsg('您还没有输入信息描述!', $backurl);
	empty($contact_who) && redirectmsg('联系人不能为空!', $backurl);
	empty($tel) && redirectmsg('联系电话不能为空!', $backurl);

	if ($iflogin == 1) {
		if (($authcodesettings['memberpost'] == 1) && !($randcode = qq3479015851_chk_randcode($checkcode))) {
			redirectmsg('验证码输入错误，请返回重新输入', $backurl);
		}
	}
	else if ($iflogin == 0) {
		if (($authcodesettings['post'] == 1) && !($randcode = qq3479015851_chk_randcode($checkcode))) {
			redirectmsg('验证码输入错误，请返回重新输入', $backurl);
		}

		if (empty($manage_pwd)) {
			redirectmsg('管理密码不能为空，该密码用于修改/删除该信息，请谨记!', $backurl);
		}
	}

	require_once SysGlbCfm_INC . '/upfile.fun.php';
	require_once SysGlbCfm_DATA . '/config.inc.php';
	
	qq3479015851_check_upimage_wap('qq3479015851_img_');
	if (!(empty($SystemGlobalcfm_global['cfg_disallow_post_tel'])) && !(empty($tel))) {
		$disallow_tel = array();
		$disallow_tel = explode('=', $SystemGlobalcfm_global['cfg_disallow_post_tel']);
		$disallow_telarray = explode(',', $disallow_tel[0]);

		if ($disallow_tel[1] == -1) {
			in_array($tel, $disallow_telarray) && redirectmsg('您的电话号码<b style=\'color:red\'>' . $tel . '</b> 已被管理员加入黑名单!<br />如果您要继续操作，请联系客服。', 'index.php?mod=post&catid=' . $catid . '&areaid=' . $areaid);
		}
		else if ($disallow_tel[1] == 0) {
			in_array($tel, $disallow_telarray) && ($info_level = 0);
		}

		unset($disallow_tel,$disallow_telarray);
	}

	$ip = GetIP();
	//发布信息IP限制
	if (!(empty($SystemGlobalcfm_global['cfg_forbidden_post_ip']))) {
		foreach (explode(',', $SystemGlobalcfm_global['cfg_forbidden_post_ip']) as $ctrlip ) {
			if (preg_match('/^(' . preg_quote($ctrlip = trim($ctrlip), '/') . ')/', $ip)) {
				$ctrlip = $ctrlip . '%';
				redirectmsg('您当前的IP <b style=\'color:red\'>' . $ip . '</b> 已被管理员加入黑名单，不允许发布信息！<br />如果您要继续操作，请联系客服。', 'index.php?mod=post&catid=' . $catid . '&areaid=' . $areaid);
				exit();
			}
		}
	}

	$post_time = 1;

	if (!(empty($post_time))) {
		$count = qq3479015851_count('information', 'WHERE ip = \'' . $ip . '\' AND begintime > (' . $timestamp . ' - 60)');
		$count >= $post_time && redirectmsg("您的发布时间太快了，休息一会儿。","index.php?mod=member&action=mypost");
	}

	$img_count = upload_img_num('qq3479015851_img_');

	switch ($id) {
	case true:
			//修改信息
		if (!($db->getOne('SELECT COUNT(id) FROM `' . $db_qq3479015851 . 'information` WHERE id = \'' . $id . '\' AND userid = \'' . $s_uid . '\''))) {
			redirectmsg('您要修改的信息不存在或者不是您发布的！', 'javascript:history.back();');
			exit();
		}

		if (empty($iflogin)) {
			redirectmsg('您还没有登录，不能修改信息！', 'javascript:history.back();');
			exit();
		}

		if (is_array($_FILES)) {
			for ($i = 0; $i < count($_FILES); $i++) {
				$name_file = 'qq3479015851_img_' . $i;

				if ($_FILES[$name_file]['name']) {
					$destination = '/information/' . date('Ym') . '/';
					check_upimage($name_file);
					$SystemGlobalcfm_image = start_upload($name_file, $destination, $SystemGlobalcfm_global['cfg_upimg_watermark'], $SystemGlobalcfm_qq3479015851['cfg_information_limit']['width'], $SystemGlobalcfm_qq3479015851['cfg_information_limit']['height']);

					if ($row = $db->getRow('SELECT path,prepath FROM `' . $db_qq3479015851 . 'info_img` WHERE infoid = \'' . $id . '\' AND image_id = \'' . $i . '\'')) {
						@unlink(SysGlbCfm_ROOT . $row['path']);
						@unlink(SysGlbCfm_ROOT . $row['prepath']);
						$db->query('UPDATE `' . $db_qq3479015851 . 'info_img` SET image_id = \'' . $i . '\' , path = \'' . $SystemGlobalcfm_image[0] . '\' , prepath = \'' . $SystemGlobalcfm_image[1] . '\' , uptime = \'' . $timestamp . '\' WHERE image_id = \'' . $i . '\' AND infoid = \'' . $id . '\'');
					}
					else {
						$db->query('INSERT INTO `' . $db_qq3479015851 . 'info_img` (image_id,path,prepath,infoid,uptime) VALUES (\'' . $i . '\',\'' . $SystemGlobalcfm_image[0] . '\',\'' . $SystemGlobalcfm_image[1] . '\',\'' . $id . '\',\'' . $timestamp . '\')');
					}

					if ($i === 0) {
						$db->query('UPDATE `' . $db_qq3479015851 . 'information` SET img_path = \'' . $SystemGlobalcfm_image[1] . '\' WHERE id = \'' . $id . '\'');
					}
				}
			}
		}

		if (is_array($delinfoimg)) {
			$img_path = $db->getOne('SELECT img_path FROM `' . $db_qq3479015851 . 'information` WHERE id = \'' . $id . '\'');

			foreach ($delinfoimg as $key => $val ) {
				if ($val == 'on') {
					$infoimgrow = $db->getRow('SELECT id,path,prepath FROM `' . $db_qq3479015851 . 'info_img` WHERE image_id = \'' . $key . '\' AND infoid = \'' . $id . '\'');

					if ($infoimgrow) {
						@unlink(SysGlbCfm_ROOT . $infoimgrow['path']);
						@unlink(SysGlbCfm_ROOT . $infoimgrow['prepath']);
						qq3479015851_delete('info_img', 'WHERE id = \'' . $infoimgrow['id'] . '\'');

						if ($infoimgrow['prepath'] == $img_path) {
							$db->query('UPDATE `' . $db_qq3479015851 . 'information` SET img_path = \'\' WHERE id = \'' . $id . '\'');
						}
					}

					unset($infoimgrow);
				}
			}
		}

		$sql = $k = $v = NULL;
		if (is_array($extra) && (1 < $d['modid'])) {
			foreach ($extra as $k => $v ) {
				$sql .= (is_array($v) ? '`' . $k . '` = \'' . implode(',', $v) . '\',' : '`' . $k . '` = \'' . $v . '\',');
			}

			$sql = ($sql ? substr($sql, 0, -1) : NULL);

			if ($sql) {
				$db->query('UPDATE `' . $db_qq3479015851 . 'information_' . $d[modid] . '` SET ' . $sql . ' WHERE id = \'' . $id . '\'');
				unset($sql);
			}
		}

		$manage_pwd = (empty($manage_pwd) ? '' : 'manage_pwd=\'' . md5($manage_pwd) . '\',');
		$img_count = qq3479015851_count('info_img', 'WHERE infoid = \'' . $id . '\'');
		$img_path = ($SystemGlobalcfm_image[1] ? $SystemGlobalcfm_image[1] : '');
		$sql = 'UPDATE `' . $db_qq3479015851 . 'information` SET ' . $manage_pwd . ' title = \'' . $title . '\',content = \'' . $content . '\',catid = \'' . $catid . '\',cityid=\''.$cityid.'\',streetid=\''.$streetid.'\', areaid = \'' . $areaid . '\', activetime = \'' . $activetime . '\', endtime = \'' . $endtime . '\', ismember = \'' . $ismember . '\' , ip = \'' . $ip . '\' , ip2area = \'' . $ip2area . '\' , info_level = \'' . $info_level . '\' , qq = \'' . $qq . '\' , email = \'' . $email . '\' , tel = \'' . $tel . '\' , contact_who = \'' . $contact_who . '\' , img_count = \'' . $img_count . '\' , mappoint = \'' . $mappoint . '\',catname=\'' . $d['catname'] . '\',dir_typename=\'' . $d['dir_typename'] . '\' WHERE id = \'' . $id . '\'';
		$db->query($sql);
		redirectmsg('操作成功！您已经成功修改该信息！', 'index.php?mod=member&action=mypost');
		break;

	case false:
			//发布信息
			
		require_once SysGlbCfm_ROOT . '/member/include/common.func.php';	
			
			
		if ($iflogin == 1) {
			$db->getOne('SELECT id FROM `' . $db_qq3479015851 . 'information` WHERE title = \'' . $title . '\' AND userid = \'' . $s_uid . '\'') && redirectmsg('本信息标题已经存在，本站禁止发布重复信息！请更换标题。或者您已经发过同样信息想重复发布，可到帐号管理后台进行刷新操作即可。', $backurl);
//会员发布信息数量限制
			$row = $db->getRow('SELECT a.per_certify,a.com_certify,a.status,a.money_own,b.perday_maxpost FROM `' . $db_qq3479015851 . 'member` AS a LEFT JOIN `' . $db_qq3479015851 . 'member_level` AS b ON a.levelid = b.id WHERE a.userid = \'' . $s_uid . '\'');
			$perday_maxpost = $row['perday_maxpost'];

			if (empty($row['status'])) {
				redirectmsg('您账号当前为待审状态，暂不能发布信息！', 'javascipt:history.back();');
			}

			if (!(empty($perday_maxpost))) {
				$count = qq3479015851_count('information', 'WHERE userid LIKE \'' . $s_uid . '\' AND begintime > \'' . mktime(0, 0, 0) . '\'');
				($perday_maxpost <= $count) && redirectmsg('很抱歉！您当前的会员级别每天只能发布 <b style=\'color:red\'>' . $perday_maxpost . '</b> 条信息<br />如果您要继续操作，请联系客服。', 'javascipt:history.back();');
			}

				$userid = trim($s_uid);
				$perpost_money_cost = $SystemGlobalcfm_global['cfg_member_perpost_consume'] ? $SystemGlobalcfm_global['cfg_member_perpost_consume'] : 0 ;
		
		
			if (!(empty($perpost_money_cost))) {

				if ($row['money_own'] < $perpost_money_cost) {

					redirectmsg('您当前金币余额不足，发布一条信息需要支付' . $perpost_money_cost . '个金币！', 'index.php?mod=member&action=pay');
					exit();
				}

			}
		
		
				/*信息认证情况*/
				if($userid){
					if($row['per_certify'] == 1 || $row['com_certify'] == 1){
						$certify = 1;
					}else{
						$certify = 0;
					}
					unset($row);
				}
			
				$sql = "INSERT INTO `{$db_qq3479015851}information` (title,content,begintime,activetime,endtime,catid,gid,catname,dir_typename,cityid,areaid,streetid,userid,ismember,info_level,qq,email,tel,contact_who,img_count,certify,ip,ip2area,latitude,longitude) VALUES ('$title','$content','$begintime','$activetime','$endtime','$catid','$d[gid]','$catname','$dir_typename','$cityid','$areaid','$streetid','$userid','1','$info_level','$qq','$email','$tel','$contact_who','$img_count','$certify','$ip','wap','$lat','$lng')";	
				//金币变化
				if(!empty($perpost_money_cost)){
					$db->query("UPDATE `{$db_qq3479015851}member` SET money_own = money_own - '$perpost_money_cost' WHERE userid = '$userid'");
					write_money_use($userid."发布标题为[".$title."]的信息", '<font color=red>扣除金币 ' . $perpost_money_cost . ' </font>');
				}
		
			}else{
				$manage_pwd = md5($manage_pwd);
				//游客发布信息数量限制
				if($SystemGlobalcfm_global['cfg_if_nonmember_info'] == 1 && $SystemGlobalcfm_global['cfg_nonmember_perday_post'] > 0){
					$count = qq3479015851_count("information","WHERE ip = '$ip' AND begintime > '".mktime(0,0,0)."' AND ismember = '0'");
					$count >= $SystemGlobalcfm_global[cfg_nonmember_perday_post] && redirectmsg("很抱歉！游客每天只能发布 <b style='color:red'>".$SystemGlobalcfm_global[cfg_nonmember_perday_post]."</b> 条信息<br />如果您要继续操作，请联系客服。","index.php?mod=post&catid=".$catid."&areaid=".$areaid);
				}
				
				$sql = "INSERT INTO `{$db_qq3479015851}information` (title,content,begintime,activetime,endtime,catid,gid,catname,dir_typename,cityid,areaid,streetid,info_level,qq,email,tel,contact_who,img_count,certify,ip,ip2area,manage_pwd,latitude,longitude) VALUES ('$title','$content','$begintime','$activetime','$endtime','$catid','$d[gid]','$catname','$dir_typename','$cityid','$areaid','$streetid','$info_level','$qq','$email','$tel','$contact_who','$img_count','$certify','$ip','wap','$manage_pwd','$lat','$lng')";	
			}
			
			$db -> query($sql);
			$id = $db -> insert_id();
			
			$k = $v = NULL;
			if(is_array($extra) && $d['modid'] > 1){
				foreach($extra as $k =>$v){
					$v = is_array($v) ? implode(',',$v) : $v;
					$sql1 .= ",`".$k."`";
					$sql2 .= ",'$v'";
				}
				$sql = "(id.$sql1)VALUES('$id','','')";
				$db->query("INSERT INTO `{$db_qq3479015851}information_{$d[modid]}` (`id`{$sql1})VALUES('$id'{$sql2})");
				unset($sql1,$sql2);
			}
		
			//上传图片
			if($img_count > 0){
				for($i=0;$i<$img_count;$i++){
					$name_file = "qq3479015851_img_".$i;
					if($_FILES[$name_file]['name']){
						$destination="/information/".date('Ym')."/";
						check_upimage($name_file);
						$SystemGlobalcfm_image = start_upload($name_file,$destination,$SystemGlobalcfm_global['cfg_upimg_watermark'],$SystemGlobalcfm_qq3479015851['cfg_information_limit']['width'],$SystemGlobalcfm_qq3479015851['cfg_information_limit']['height']);
						$db -> query("INSERT INTO `{$db_qq3479015851}info_img` (image_id,path,prepath,infoid,uptime) VALUES ('$i','$SystemGlobalcfm_image[0]','$SystemGlobalcfm_image[1]','$id','$begintime')");
					}
				}
				$db -> query("UPDATE `{$db_qq3479015851}information` SET img_path = '$SystemGlobalcfm_image[1]' WHERE id = '$id'");
			}
			
			$msg = $info_level > 0 ? '成功发布一条信息!' : '您的信息审核通过后将显示在网站上!';
			redirectmsg($msg,'index.php?mod=category&catid='.$catid);
		break;
	}

} else {
	
	require_once SysGlbCfm_DATA.'/info.type.inc.php';
	
	if(!$catid && !$id){
		//分类选择页
		$categories = get_categories_tree(0,'category');
		include qq3479015851_tpl('post_cat');
		exit;
	}elseif(!$catid && $id && $s_uid){
		//修改信息页
		if(!$info=$db->getRow("SELECT * FROM `{$db_qq3479015851}information` WHERE id = '$id' AND userid = '$s_uid'")){
			errormsg('该信息不存在或者不是你发布的！');
			exit;
		}
		$cat = $db -> getRow("SELECT catid,catname,parentid,modid,if_upimg,gid FROM `{$db_qq3479015851}category` WHERE catid = '$info[catid]'");
		$show_mod_option = return_category_info_options($cat['modid'],$id);
		$mixcode = md5($cookiepre);
		
		if($iflogin==1){
			$info['imgcode']= $authcodesettings['memberpost'] == 1 ? 1 : '';
		}else{
			$info['imgcode']= $authcodesettings['post'] == 1 ? 1 : '';
		}
		$info['content'] = $SystemGlobalcfm_global['cfg_post_editor'] == 1 ? clear_html($info['content'],false) : $info['content'];
		$info['content'] = de_textarea_post_change($info['content']);
		//$info['content'] = str_replace(array("<br /><br />","<br />"),array("  ","&nbsp;"),$info['content']);
		$catid = $info['catid'];
		include qq3479015851_tpl("post");
		exit;
	}elseif($catid){
		//信息填写页
		$cat = $db -> getRow("SELECT catid,catname,parentid,modid,if_upimg,gid FROM `{$db_qq3479015851}category` WHERE catid = '$catid'");
		$cat['parentname'] = $db -> getOne("SELECT catname FROM `{$db_qq3479015851}category` WHERE catid = '$cat[parentid]'");
		if($cat['parentid'] == 0){
			//如果为根分类
			$categories = get_categories_tree($catid,'category');
			include qq3479015851_tpl('post_cat');
		} elseif($cat['parentid'] > 0){
			//如果不是根分类
			if($iflogin != 1){
				if($SystemGlobalcfm_global['cfg_if_nonmember_info'] != 1){
					//游客不能发布信息
					$returnurl = 'index.php?mod=post&catid='.$catid;
					$returnurl = urlencode($returnurl);
					redirectmsg("请登录后发布信息！","index.php?mod=login&returnurl=".$returnurl);	
				}
			}elseif($user = $db -> getRow("SELECT qq,email,mobile,cname FROM `{$db_qq3479015851}member` WHERE userid = '$s_uid'")){
				$info['tel'] = $user['mobile'];
				$info['contact_who'] = $user['cname'];
				$info['qq'] = $user['qq'];
			}
			
			//如果为三级分类
			if($child = $db ->getAll("SELECT catid,catname FROM `{$db_qq3479015851}category` WHERE parentid = '$catid'")){
				$info['catname'] = '<select name="catid" style="width:60%" onChange="location.href=\'index.php?mod=post&catid=\'+(this.options[this.selectedIndex].value)">';
				foreach($child as $k => $v){
					$info['catname'] .= '<option value="'.$v[catid].'">'.$v[catname].'</option>';
				}
				$info['catname'] .= '</select>';
			}else{
				$info['catname'] = $db ->getOne("SELECT catname FROM `{$db_qq3479015851}category` WHERE catid = '$catid'");
			}
			
			$return_url = 'index.php?mod=post&catid='.$catid;
			$show_mod_option = return_category_info_options($cat['modid']);
			$mixcode = md5($cookiepre);
				if ($iflogin == 1) {
					$info['imgcode'] = ($authcodesettings['memberpost'] == 1 ? 1 : '');
				}
				else {
					$info['imgcode'] = ($authcodesettings['post'] == 1 ? 1 : '');
				}
			include qq3479015851_tpl("post");
		}
		
	}

	
}

function check_upimage_wap($file="filename")
{
	global $SystemGlobalcfm_global;
	$size=$SystemGlobalcfm_global['cfg_upimg_size']*1024;
	$upimg_allow = explode(',',$SystemGlobalcfm_global['cfg_upimg_type']);
	if($_FILES[$file]['size']>$size){
		redirectmsg('上传文件应小于'.$SystemGlobalcfm_global['cfg_upimg_size'].'KB','javascript:history.back()');
	}
	
	if(!in_array(FileExt($_FILES[$file]['name']),$upimg_allow)){
		redirectmsg('系统只允许上传'.$SystemGlobalcfm_global['cfg_upimg_type'].'格式的图片！','javascript:history.back()');
	}
	
	if(!preg_match('/^image\//i',$_FILES[$file]['type'])){
		redirectmsg ('很抱歉，系统无法识别您上传的文件的格式，请换一张图片上传！','javascript:history.back()');
	}
	return true;
}

function qq3479015851_check_upimage_wap($file="filename")
{
	if(is_array($_FILES)){
		for($i=0;$i<count($_FILES);$i++){
			if($_FILES[$file.$i]['name']){
				check_upimage_wap($file.$i);
			}
		}
	}
}

function get_upload_image_view_wap($if_upimg = 1)
{
	global $SystemGlobalcfm_global,$db,$db_qq3479015851;
	if($if_upimg == 1){
		$cfg_upimg_number = $SystemGlobalcfm_global[cfg_upimg_number]?$SystemGlobalcfm_global[cfg_upimg_number]:'3';
		for($i=0;$i<$cfg_upimg_number;$i++){;
			$SystemGlobalcfm .= '<input class="input" style="width:210px;overflow: hidden;padding:5px 0;" type="file" name="qq3479015851_img_'.$i.'" datatype="filter" msg="图片文件格式不正确">';
		}
	}
	return $SystemGlobalcfm;
}
?>