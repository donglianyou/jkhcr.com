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
define('QQ3479015851', true);
define('IN_MANAGE', true);
require_once dirname(__FILE__) . '/../include/global.php';
require_once QQ3479015851_DATA . '/config.php';
require_once QQ3479015851_DATA . '/config.inc.php';
require_once QQ3479015851_DATA . '/config.db.php';
require_once QQ3479015851_INC . '/admin.class.php';
if ($admin_cityid && in_array(CURSCRIPT, array('advertisement', 'faq', 'area', 'category', 'channel', 'config', 'advertisement', 'database', 'filemanage', 'info_type', 'jswizard', 'mail', 'member_tpl', 'passport', 'payapi', 'payrecord', 'plugin', 'seoset', 'site_about', 'record', 'city'))) {
	exit('分站管理员无该栏目的操作权限...');
} 
if (!$qq3479015851_admin -> qq3479015851_admin_chk_getinfo()) {
	write_msg("", 'index.php?do=login&url=' . urlencode(GetUrl()));
} else {
	define('IN_ADMIN' , true);
} 


function get_member_level_label()
{
	global $db;
	global $db_qq3479015851;
	$member_level = $db->getAll('SELECT id,levelname FROM `' . $db_qq3479015851 . 'member_level`');

	foreach ($member_level as $k => $value ) {
		$qq3479015851 .= '<label for=' . $value[id] . '><input name=do_action value=' . $value[id] . ' type=radio class=radio id=' . $value[id] . '';
		$qq3479015851 .= ($id == $value[id] ? ' checked' : '');
		$qq3479015851 .= '>' . $value[levelname] . '</label>';
	}

	return $qq3479015851;
}

function get_member_level($id = '', $name = 'levelid')
{
	global $db;
	global $db_qq3479015851;
	$member_level = $db->getAll('SELECT id,levelname FROM `' . $db_qq3479015851 . 'member_level`');
	$qq3479015851 .= '<select name="' . $name . '">';
	$qq3479015851 .= '<option value=\'\'>>不限组别</option>';

	foreach ($member_level as $k => $value ) {
		$qq3479015851 .= '<option value=' . $value[id] . '';
		$qq3479015851 .= ($id == $value[id] ? ' selected style="background-color:#6EB00C;color:white"' : '');
		$qq3479015851 .= '>' . $value[levelname] . '</option>';
	}

	$qq3479015851 .= '</select>';
	return $qq3479015851;
}

function show_message($nav_path = '', $message = '', $after_action = '')
{
	global $here;
	write_admin_record($message);
	$here = QQ3479015851_SOFTNAME . '操作提示窗口';
	include qq3479015851_tpl('showmessage');
}



function admin_get_gid($zym_44 = '', $zym_43 = ''){
     global $db, $db_qq3479015851, $qq3479015851_global;
     if($zym_43 > 0){
         $zym_42 = $db -> getRow("SELECT catid,parentid FROM `{$db_qq3479015851}category` WHERE catid = '$zym_43'");
         if($zym_42['parentid'] > 0){
             $zym_45 = $zym_42['parentid'];
             }else{
             $zym_45 = $zym_42['catid'];
             }
         }else{
         $zym_45 = !$zym_44?$zym_43:$zym_44;
         }
     return $zym_45;
    }
	
	
	
	
function sizeunit($filesize)
{
	if (1073741824 <= $filesize) {
		$filesize = (round(($filesize / 1073741824) * 100) / 100) . ' GB';
	}
	else if (1048576 <= $filesize) {
		$filesize = (round(($filesize / 1048576) * 100) / 100) . ' MB';
	}
	else if (1024 <= $filesize) {
		$filesize = (round(($filesize / 1024) * 100) / 100) . ' KB';
	}
	else {
		$filesize = $filesize . ' bytes';
	}

	return $filesize;
}


function write_file($sql, $backup_dir, $filename)
{
	$re = true;

	if (!@$fp = fopen($backup_dir . $filename, 'w+')) {
		$re = false;
		echo '打开文件失败';
	}

	if (!@fwrite($fp, $sql)) {
		$re = false;
		echo '写文件失败';
	}

	if (!@fclose($fp)) {
		$re = false;
		echo '关闭文件失败';
	}

	return $re;
}




function bb() {

} 


function myget($zym_72){
     if (isset($_SERVER[$zym_72])){
         return $_SERVER[$zym_72];
         }
     if (isset($_ENV[$zym_72])){
         return $_ENV[$zym_72];
         }
     if (getenv($zym_72)){
         return getenv($zym_72);
         }
     if (function_exists('apache_getenv') && apache_getenv($zym_72, true)){
         return apache_getenv($zym_72, true);
         }
     return '';
    }
	
	
	
	
function getRd($zym_71){
     $zym_70 = array('wang', 'ae', 'af', 'ag', 'ai', 'al', 'am', 'an', 'ao', 'aq', 'ar', 'as', 'at', 'au', 'aw', 'az', 'ba', 'bb', 'bd', 'be', 'bf', 'bg', 'bh', 'bi', 'bj', 'bm', 'bn', 'bo', 'br', 'bs', 'bt', 'bv', 'bw', 'by', 'bz', 'ca', 'cc', 'cf', 'cg', 'ch', 'ci', 'ck', 'cl', 'cm', 'cn', 'co', 'cq', 'cr', 'cu', 'cv', 'cx', 'cy', 'cz', 'de', 'dj', 'dk', 'dm', 'do', 'dz', 'ec', 'ee', 'eg', 'eh', 'es', 'et', 'ev', 'fi', 'fj', 'fk', 'fm', 'fo', 'fr', 'ga', 'gb', 'gd', 'ge', 'gf', 'gg', 'gh', 'gi', 'gl', 'gm', 'gn', 'gp', 'gr', 'gt', 'gu', 'gw', 'gy', 'hk', 'hm', 'hn', 'hr', 'ht', 'hu', 'id', 'ie', 'il', 'in', 'io', 'iq', 'ir', 'is', 'it', 'jm', 'jo', 'jp', 'ke', 'kg', 'kh', 'ki', 'km', 'kn', 'kp', 'kr', 'kw', 'ky', 'kz', 'la', 'lb', 'lc', 'li', 'lk', 'lr', 'ls', 'lt', 'lu', 'lv', 'ly', 'ma', 'mc', 'md', 'mg', 'mh', 'ml', 'mm', 'mn', 'mo', 'mp', 'mq', 'mr', 'ms', 'mt', 'mv', 'mw', 'mx', 'my', 'mz', 'na', 'nc', 'ne', 'nf', 'ng', 'ni', 'nl', 'no', 'np', 'nr', 'nt', 'nu', 'nz', 'om', 'qa', 'pa', 'pe', 'pf', 'pg', 'ph', 'pk', 'pl', 'pm', 'pn', 'pr', 'pt', 'pw', 'py', 're', 'ro', 'ru', 'rw', 'sa', 'sb', 'sc', 'sd', 'se', 'sg', 'sh', 'si', 'sj', 'sk', 'sl', 'sm', 'sn', 'so', 'sr', 'st', 'su', 'sy', 'sz', 'tc', 'td', 'tf', 'tg', 'th', 'tj', 'tk', 'tm', 'tn', 'to', 'tp', 'tr', 'tt', 'tv', 'tw', 'tz', 'ua', 'ug', 'uk', 'us', 'uy', 'va', 'vc', 've', 'vg', 'vn', 'vu', 'wf', 'ws', 'ye', 'yu', 'za', 'zm', 'zr', 'zw', 'com', 'edu', 'gov', 'int', 'mil', 'net', 'org');
     $zym_74 = explode('.', $zym_71);
     $zym_77 = count($zym_74);
     $zym_76 = 0;
     for($zym_75 = 0;$zym_75 < $zym_77;$zym_75++){
         if(in_array($zym_74[$zym_75], $zym_70)){
             $zym_76 = $zym_75;
             break;
             }
         }
     $zym_73 = '';
     for($zym_75 = $zym_76;$zym_75 < $zym_77;$zym_75++){
         $zym_73 .= '.' . $zym_74[$zym_75];
         }
     return $zym_74[$zym_76-1] . $zym_73;
    }
	
	
	
	
	
	
function down_file($sql, $filename)
{
	ob_end_clean();
	header('Content-Encoding: none');
	header('Content-Type: ' . (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') ? 'application/octetstream' : 'application/octet-stream'));
	header('Content-Disposition: ' . (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') ? 'inline; ' : 'attachment; ') . 'filename=' . $filename);
	header('Content-Length: ' . strlen($sql));
	header('Pragma: no-cache');
	header('Expires: 0');
	echo $sql;
	$e = ob_get_contents();
	ob_end_clean();
}


function writeable($dir)
{
	if (!is_dir($dir)) {
		@mkdir($dir, 511);
	}

	if (is_dir($dir)) {
		if (is_writable($dir)) {
			$writeable = 1;
		}
		else {
			$writeable = 0;
		}
	}

	return $writeable;
}



function make_header($table)
{
	global $d;
	$sql = 'DROP TABLE IF EXISTS ' . $table . "\n";
	$d->query('show create table ' . $table);
	$d->nextrecord();
	$tmp = preg_replace('/' . "\n" . '/', '', $d->f('Create Table'));
	$sql .= $tmp . "\n";
	return $sql;
}



function make_record($table, $num_fields)
{
	global $d;
	$comma = '';
	$sql .= 'INSERT INTO ' . $table . ' VALUES(';

	for ($i = 0; $i < $num_fields; $i++) {
		$sql .= $comma . '\'' . mysql_escape_string($d->record[$i]) . '\'';
		$comma = ',';
	}

	$sql .= ')' . "\n";
	return $sql;
}


function import($fname)
{
	global $d;
	$sqls = file($fname);

	foreach ($sqls as $sql ) {
		str_replace("\r", '', $sql);
		str_replace("\n", '', $sql);
		$d->query(trim($sql));
	}

	return true;
}

function chk_admin_purview($purview)
{
	global $admin_uname;

	if (!$GLOBALS['admin_id']) {
		write_msg('您还没有登录，请登录后再进行后续操作！');
	}

	$data = read_static_cache('admin');

	if ($data === false) {
		$query = $GLOBALS['db']->query('SELECT a.*,b.purviews,b.typename,b.ifsystem FROM `' . $GLOBALS['db_qq3479015851'] . 'admin` AS a LEFT JOIN `' . $GLOBALS['db_qq3479015851'] . 'admin_type` AS b ON a.typeid = b.id');

		while ($row = $GLOBALS['db']->fetchRow($query)) {
			$res[$row['userid']]['typename'] = $row['typename'];
			$res[$row['userid']]['ifsystem'] = $row['ifsystem'];
			$res[$row['userid']]['purviews'] = $row['purviews'];
			$res[$row['userid']]['uname'] = $row['uname'];
		}

		write_static_cache('admin', $res);
		$data = $res;
	}

	$admin_uname = $data[$GLOBALS['admin_id']]['uname'];
	!in_array($purview, explode(',', $data[$GLOBALS['admin_id']]['purviews'])) && write_msg('很抱歉，您所在会员组没有 <strong><font color=red>' . str_replace('purview_', '', $purview) . '</font></strong> 的操作权限！');
}



function get_admin_type()
{
	if (!$GLOBALS['admin_id']) {
		write_msg('未知管理员帐号！');
	}

	$data = read_static_cache('admin');
	return $data[$GLOBALS['admin_id']]['typename'];
}


function get_admin_info( )
{
	global $admin_id;
	if ( !$admin_id )
	{
		write_msg( "您还没有登录，请登录后再进行后续操作！" );
	}
	$data = read_static_cache( "admin" );
	if ( $data === false )
	{
		$res = write_admin_cache( );
	}
	else
	{
		$res = $data;
	}
	return $res[$admin_id];
}



function qq3479015851_admin_tpl_global_head($go = '')
{
	global $here;
	global $charset;
	include qq3479015851_tpl('inc_head');
}


function qq3479015851_admin_tpl_global_foot()
{
	global $qq3479015851_starttime;
	global $mtime;
	global $db;
	$mtime = explode(' ', microtime());
	$totaltime = number_format(($mtime[1] + $mtime[0]) - $qq3479015851_starttime, 6);
	$sitedebug = 'Processed in ' . $totaltime . ' second(s) , ' . $db->query_num . ' queries';
	echo '<div class="clear" style="height:10px"></div><div class="copyright">Powered by <a href="http://junchang.taobao.com/" target="_blank"><b style="color:#0070af">cxkeji</b></a> <a href="http://junchang.taobao.com/" target="_blank"><b style="color:#FF6600">' . QQ3479015851_VERSION . '</b></a> &copy; , ' . $sitedebug . ' <a href="javascript:scroll(0,0)" style="margin-left:10px;">至顶端↑</a></div></div></div></body></html>';
}


function FileImage($file)
{
	$ext = FileExt($file);
	if (($ext == 'html') || ($ext == 'htm')) {
		$images = 'template/images/file_html.gif';
	}
	else {
		if (($ext == 'gif') || ($ext == 'png')) {
			$images = 'template/images/file_gif.gif';
		}
		else if ($ext == 'bmp') {
			$images = 'template/images/file_bmp.gif';
		}
		else {
			if (($ext == 'jpg') || ($ext == 'jpeg')) {
				$images = 'template/images/file_jpg.gif';
			}
			else if ($ext == 'swf') {
				$images = 'template/images/file_swf.gif';
			}
			else if ($ext == 'js') {
				$images = 'template/images/file_script.gif';
			}
			else if ($ext == 'css') {
				$images = 'template/images/file_css.gif';
			}
			else if ($ext == 'txt') {
				$images = 'template/images/file_txt.gif';
			}
			else {
				$images = 'template/images/file_unknow.gif';
			}
		}
	}

	return $images;
}







function is_pic($file)
{
	$ext = FileExt($file);
	if (($ext == 'gif') || ($ext == 'jpg') || ($ext == 'jpeg') || ($ext == 'png') || ($ext == 'bmp')) {
		return 'yes';
		exit();
	}

	return 'no';
}


function getSize($fs)
{
	if ($fs < 1024) {
		return $fs . 'Byte';
	}
	else {
		if ((1024 <= $fs) && ($fs < (1024 * 1024))) {
			return @number_format($fs / 1024, 3) . ' KB';
		}
		else {
			if (((1024 * 1024) <= $fs) && ($fs < (1024 * 1024 * 1024))) {
				return @number_format(($fs / 1024) * 1024, 3) . ' M';
			}
			else if ((1024 * 1024 * 1024) <= $fs) {
				return @number_format(($fs / 1024) * 1024 * 1024, 3) . ' G';
			}
		}
	}
}



function qq3479015851_admin_menu($place = 'top', $default = 'siteabout')
{
	global $admin_menu;
	$i = -1;

	foreach ($admin_menu as $q => $w ) {
		if ($place == 'top') {
			$i = $i + 1;
			$uri = (!$w[url] ? '#' : $w[url]);
			$onc = (!$w[url] ? 'onclick=sethighlight(\'' . $i . '\');togglemenu(\'' . $q . '\');return false;' : '$w[url]');
			$tar = ($w[target] ? $w[target] : '');
			$qq3479015851_admin_menu .= '<li class="' . $w['style'] . '"><a href="' . $uri . '"' . $onc . ' target=' . $tar . '>' . $w[name] . '</a></li>';
		}
		else if ($place == 'left') {
			if (is_array($w[group])) {
				foreach ($w[group] as $e => $r ) {
					$estyle = ($q != $default ? 'style="display:none"' : '');
					$qq3479015851_admin_menu .= '<dl id="' . $q . '" ' . $estyle . '>';
					$qq3479015851_admin_menu .= '<span class="wname">' . $w[name] . '</span>';

					foreach ($w[group][$e] as $r => $t ) {
						if (is_array($t)) {
							$qq3479015851_admin_menu .= '<div><span>' . $r . '</span>';

							foreach ($w[group][$e][$r] as $y => $u ) {
								$i = $i + 1;
								$qq3479015851_admin_menu .= '<a  ' . "\r\n\t\t\t\t\t\t\t\t\t" . 'href="javascript:void(0);" onClick="sethighlight(\'' . $i . '\');parent.framRight.location=\'' . $u . '\';"  >' . $y . '</a>';
							}

							$qq3479015851_admin_menu .= '</div>';
						}
					}

					$qq3479015851_admin_menu .= '</dl>';
				}
			}
		}
	}

	$i = NULL;
	return $qq3479015851_admin_menu;
}


function qq3479015851_admin_purview($purview = '')
{
	global $admin_menu;

	foreach ($admin_menu as $k => $v ) {
		if ($k != 'logout') {
			$qq3479015851_admin_purview .= '<tr style="font-weight:bold; background-color:#dff6ff"><td colspan="2">' . $v[name] . '</td></tr>';

			foreach ($v[group][element] as $a => $e ) {
				if ($a != '系统帮助') {
					$qq3479015851_admin_purview .= '<tr bgcolor="#f5fbff"><td>' . $a . '</td><td>';

					foreach ($e as $w => $y ) {
						$qq3479015851_admin_purview .= '<label for="purview_' . $w . '" style="width:110px"><input type="checkbox" class="checkbox" name="purview[]" id="purview_' . $w . '" value="purview_' . $w . '"';
						$qq3479015851_admin_purview .= ((is_array($purview) && in_array('purview_' . $w, $purview)) || empty($purview) ? 'checked' : '');
						$qq3479015851_admin_purview .= '>' . $w . '</label> ';
					}
				}
			}

			$qq3479015851_admin_purview .= '</td></tr>';
		}
	}

	return $qq3479015851_admin_purview;
}


function get_qq3479015851_config_menu()
{
	global $admin_global_class;
	$i = 0;

	foreach ($admin_global_class as $k => $value ) {
		$qq3479015851 .= '<li><a id="i' . $i . '" href="javascript:noneblock(\'h' . $i . '\',\'i' . $i . '\')"';
		$qq3479015851 .= ($i == 0 ? 'class="current"' : '');
		$qq3479015851 .= '>';
		$qq3479015851 .= $value;
		$qq3479015851 .= '</a></li>';
		$i++;
	}

	return $qq3479015851;
}




function get_waterimg_position($value = '')
{
	$qq3479015851 .= '<input type="radio" class="radio" name = "cfg_upimg_watermark_position"  value="0" ';
	$qq3479015851 .= ($value == 0 ? 'checked' : '');
	$qq3479015851 .= '>' . "\r\n" . '          随机位置' . "\r\n\t" . '<table width="300" border="1" cellspacing="0" cellpadding="0">' . "\r\n" . '      <tr>' . "\r\n" . '        <td width="33%"><input type="radio" class="radio" name = "cfg_upimg_watermark_position"  value="1"';
	$qq3479015851 .= ($value == 1 ? 'checked' : '');
	$qq3479015851 .= '>' . "\r\n" . '          顶部居左</td>' . "\r\n" . '        <td width="33%"><input type="radio" class="radio" name = "cfg_upimg_watermark_position"  value="4"';
	$qq3479015851 .= ($value == 4 ? 'checked' : '');
	$qq3479015851 .= '>' . "\r\n" . '          顶部居中</td>' . "\r\n" . '        <td><input type="radio" class="radio" name = "cfg_upimg_watermark_position"  value="7"';
	$qq3479015851 .= ($value == 7 ? 'checked' : '');
	$qq3479015851 .= '>' . "\r\n" . '          顶部居右</td>' . "\r\n" . '      </tr>' . "\r\n" . '      <tr>' . "\r\n" . '        <td><input type="radio" class="radio" name = "cfg_upimg_watermark_position"  value="2"';
	$qq3479015851 .= ($value == 2 ? 'checked' : '');
	$qq3479015851 .= '>' . "\r\n" . '          左边居中</td>' . "\r\n" . '        <td><input type="radio" class="radio" name = "cfg_upimg_watermark_position"  value="5"';
	$qq3479015851 .= ($value == 5 ? 'checked' : '');
	$qq3479015851 .= '>' . "\r\n" . '          图片中心</td>' . "\r\n" . '        <td><input type="radio" class="radio" name = "cfg_upimg_watermark_position"  value="8"';
	$qq3479015851 .= ($value == 8 ? 'checked' : '');
	$qq3479015851 .= '>' . "\r\n" . '          右边居中</td>' . "\r\n" . '      </tr>' . "\r\n" . '      <tr>' . "\r\n" . '        <td><input type="radio" class="radio" name = "cfg_upimg_watermark_position"  value="3"';
	$qq3479015851 .= ($value == 3 ? 'checked' : '');
	$qq3479015851 .= '>' . "\r\n" . '          底部居左</td>' . "\r\n" . '        <td><input type="radio" class="radio" name = "cfg_upimg_watermark_position"  value="6"';
	$qq3479015851 .= ($value == 6 ? 'checked' : '');
	$qq3479015851 .= '>' . "\r\n" . '          底部居中</td>' . "\r\n" . '        <td><input name = "cfg_upimg_watermark_position" type="radio" class="radio"   value="9"';
	$qq3479015851 .= ($value == 9 ? 'checked' : '');
	$qq3479015851 .= '>' . "\r\n" . '          底部居右</td>' . "\r\n" . '      </tr>' . "\r\n" . '    </table>';
	return $qq3479015851;
}

function get_qq3479015851_config_input()
{
	global $admin_global;
	global $admin_global_class;
	global $config_global;
	$i = 0;

	foreach ($admin_global_class as $k => $qq3479015851_v ) {
		$qq3479015851 .= '<div id="h' . $i . '" class="mytable"';
		$qq3479015851 .= ($i == 0 ? ' ' : ' style=\'display:none\'');
		$qq3479015851 .= '><table border="0" cellspacing="0" cellpadding="0" class="vbm"><tr class="firstr"><td colspan="5"><div class="left"><a href="javascript:collapse_change(\'' . $i . '\')">' . $qq3479015851_v . '</a></div><div class="right"><a href="javascript:collapse_change(\'' . $i . '\')"><img id="menuimg_' . $i . '" src="template/images/menu_reduce.gif"/></a></div></td></tr><tbody id="menu_' . $i . '" style="display:"><tr style="font-weight:bold; height:24px; background-color:#f1f5f8"><td>相关说明</td><td>值</td><td>模板调用代码</td></tr>';

		foreach ($admin_global as $k => $a ) {
			if ($a['class'] == $qq3479015851_v) {
				$qq3479015851 .= '<tr bgcolor="#ffffff"><td style="width:35%; line-height:22px">' . $a['des'] . '</td><td>';

				if (in_array($k, array('SiteDescription', 'SiteStat', 'cfg_forbidden_post_ip', 'cfg_forbidden_reg_ip', 'cfg_member_regplace', 'cfg_member_reg_content', 'cfg_site_open_reason', 'cfg_disallow_post_tel', 'cfg_allow_post_area'))) {
					$qq3479015851 .= '<textarea name="' . $k . '" style="height:100px; width:205px">' . $config_global[$k] . '</textarea>';
				}
				else if ($k == 'cfg_mappoint') {
					$qq3479015851 .= '<input name="' . $k . '" value="' . $config_global[$k] . '" class="text" id="mappoint"/>';
					$qq3479015851 .= '<input type="button" class="gray mini" value="我要标注" onclick="javascript:setbg(\'地图标注\',500,250,\'../map.php?action=markpoint&width=500&height=250&title=default_map_point&p=' . $qq3479015851_global['cfg_mappoint'] . '\')"/>';
				}
				else if ($k == 'SiteLogo') {
					$qq3479015851 .= '<img src="' . $config_global[$k] . '" class="noborder"/><br /><br />';
					$qq3479015851 .= '<input name="' . $k . '" value="' . $config_global[$k] . '" class="text"/>';
				}
				else if ($k == 'cfg_upimg_watermark_img') {
					$qq3479015851 .= '<img src="' . $config_global[$k] . '" class="noborder"/><br /><br />';
					$qq3479015851 .= '<input name="' . $k . '" value="' . $config_global[$k] . '" class="text" id="imgsrc"/>';
					$qq3479015851 .= '<label><input type="radio" class="radio" onclick=\'document.getElementById("f' . $k . '").style.display = "none";\' name="ifout" value="no" checked="checked" class="radio"/>远程图片</label>' . "\r\n" . '<label><input type="radio" class="radio" onclick=\'document.getElementById("f' . $k . '").style.display = "block";\' name="ifout" value="yes" class="radio"/>本地上传</label>' . "\r\n" . '<iframe src="include/upfile.php?watermark=0" width="450" frameborder="0" scrolling="no" onload="this.height=iFrame1.document.body.scrollHeight" id="f' . $k . '" style="display:none; margin-top:10px"></iframe>';
				}
				else if ($k == 'cfg_member_verify') {
					$qq3479015851 .= '<label for=\'verify1\'><input ';
					$qq3479015851 .= ($config_global['cfg_member_verify'] == '1' ? ' checked ' : '');
					$qq3479015851 .= ' id=\'verify1\' type="radio" class="radio" value="1" name="cfg_member_verify">不审核</label>&nbsp;&nbsp;';
					$qq3479015851 .= '<label for=\'verify2\'><input ';
					$qq3479015851 .= ($config_global['cfg_member_verify'] == '2' ? ' checked ' : '');
					$qq3479015851 .= ' id=\'verify2\' type="radio" class="radio" value="2" name="cfg_member_verify">人工审核</label>&nbsp;&nbsp;';
					$qq3479015851 .= '<label for=\'verify3\'><input ';
					$qq3479015851 .= ($config_global['cfg_member_verify'] == '3' ? ' checked ' : '');
					$qq3479015851 .= ' id=\'verify3\' type="radio" class="radio" value="3" name="cfg_member_verify">邮件审核</label>';
					$qq3479015851 .= '<label for=\'verify4\'><input ';
					$qq3479015851 .= ($config_global['cfg_member_verify'] == '4' ? ' checked ' : '');
					$qq3479015851 .= ' id=\'verify4\' type="radio" class="radio" value="4" name="cfg_member_verify">手机验证</label>';
				}else if ($k == 'cfg_upload_type') {
					$qq3479015851 .= '<label for=\'verify1\'><input ';
					$qq3479015851 .= ($config_global['cfg_upload_type'] == '1' ? ' checked ' : '');
					$qq3479015851 .= ' id=\'verify1\' type="radio" class="radio" value="1" name="cfg_upload_type">系统默认</label>&nbsp;&nbsp;';
					$qq3479015851 .= '<label for=\'verify2\'><input ';
					$qq3479015851 .= ($config_global['cfg_upload_type'] == '2' ? ' checked ' : '');
					$qq3479015851 .= ' id=\'verify2\' type="radio" class="radio" value="2" name="cfg_upload_type">多图上传</label>&nbsp;&nbsp;';
					//$qq3479015851 .= '<label for=\'verify3\'><input ';
					//$qq3479015851 .= ($config_global['cfg_upload_type'] == '3' ? ' checked ' : '');
					//$qq3479015851 .= ' id=\'verify3\' type="radio" class="radio" value="3" name="cfg_upload_type">多图上传千牛插件</label>';
				}
				else if ($k == 'cfg_if_info_verify') {
					$qq3479015851 .= '<label for=\'verifyy1\'><input ';
					$qq3479015851 .= ($config_global['cfg_if_info_verify'] == '0' ? ' checked ' : '');
					$qq3479015851 .= ' id=\'verifyy1\' type="radio" class="radio" value="0" name="cfg_if_info_verify">不审核</label>&nbsp;&nbsp;';
					$qq3479015851 .= '<label for=\'verifyy2\'><input ';
					$qq3479015851 .= ($config_global['cfg_if_info_verify'] == '1' ? ' checked ' : '');
					$qq3479015851 .= ' id=\'verifyy2\' type="radio" class="radio" value="1" name="cfg_if_info_verify">人工审核</label>';
				}
				else if ($k == 'cfg_upimg_watermark_position') {
					$qq3479015851 .= get_waterimg_position($config_global[$k]);
				}
				else if ($a['type'] == '布尔型') {
					$qq3479015851 .= '<select name="' . $k . '"/>';
					$qq3479015851 .= '<option value="1"';
					$qq3479015851 .= ($config_global[$k] == 1 ? ' selected=\'selected\' style=\'background-color:#6eb00c; color:white!important;\'' : '');
					$qq3479015851 .= '>是/开启</option>';
					$qq3479015851 .= '<option value="0"';
					$qq3479015851 .= ($config_global[$k] == 0 ? ' selected=\'selected\' style=\'background-color:#6eb00c; color:white!important;\'' : '');
					$qq3479015851 .= '>否/关闭</option>';
					$qq3479015851 .= '</select>';
				}
				else {
					$qq3479015851 .= '<input name="' . $k . '" value="' . $config_global[$k] . '" class="text"/>';
				}

				$qq3479015851 .= ($a['type'] == '布尔型' ? '</td><td width=30%>&nbsp;</td></tr>' : '</td><td width=30%>{$qq3479015851_global[' . $k . ']}</td></tr>');
			}
		}

		$qq3479015851 .= '</tbody></table></div>';
		$i = $i + 1;
	}

	return $qq3479015851;
}



function iszero($str)
{
	return $str == 0 ? 1 : $str;
}



function getcwdOL()
{
	$total = $_SERVER[PHP_SELF];
	$file = explode('/', $total);
	$file = $file[sizeof($file) - 1];
	return substr($total, 0, strlen($total) - strlen($file) - 1);
}



function fetchtablelist($db_qq3479015851 = '')
{
	global $db;
	$arr = explode('.', $db_qq3479015851);
	$dbname = ($arr[1] ? $arr[0] : '');
	$db_qq3479015851 = str_replace('_', '\\_', $db_qq3479015851);
	$sqladd = ($dbname ? ' FROM ' . $dbname . ' LIKE \'' . $arr[1] . '%\'' : 'LIKE \'' . $db_qq3479015851 . '%\'');
	$tables = $table = array();
	$query = $db->query('SHOW TABLE STATUS ' . $sqladd);

	while ($table = $db->fetch_array($query)) {
		$table['Name'] = ($dbname ? $dbname . '.' : '') . $table['Name'];
		$tables[] = $table;
	}

	return $tables;
}

function get_timezone_select($name = 'cfg_timezone', $value = '')
{
	$timezoneoptions = array(-12 => '(GMT -12:00) 埃尼威托克岛, 夸贾林环..', -11 => '(GMT -11:00) 中途岛, 萨摩亚群岛', -10 => '(GMT -10:00) 夏威夷', -9 => '(GMT -09:00) 阿拉斯加', -8 => '(GMT -08:00) 太平洋时间(美国和加拿..', -7 => '(GMT -07:00) 山区时间(美国和加拿大..', -6 => '(GMT -06:00) 中部时间(美国和加拿大..', -5 => '(GMT -05:00) 东部时间(美国和加拿大..', -4 => '(GMT -04:00) 大西洋时间(加拿大), 加..', '-3.5' => '(GMT -03:30) 纽芬兰', -3 => '(GMT -03:00) 巴西利亚, 布宜诺斯艾利..', -2 => '(GMT -02:00) 中大西洋, 阿森松群岛,..', -1 => '(GMT -01:00) 亚速群岛, 佛得角群岛 ..', 0 => '(GMT) 卡萨布兰卡, 都柏林, 爱丁堡, ..', 1 => '(GMT +01:00) 柏林, 布鲁塞尔, 哥本哈..', 2 => '(GMT +02:00) 赫尔辛基, 加里宁格勒,..', 3 => '(GMT +03:00) 巴格达, 利雅得, 莫斯科..', '3.5' => '(GMT +03:30) 德黑兰', 4 => '(GMT +04:00) 阿布扎比, 巴库, 马斯喀..', '4.5' => '(GMT +04:30) 坎布尔', 5 => '(GMT +05:00) 叶卡特琳堡, 伊斯兰堡,..', '5.5' => '(GMT +05:30) 孟买, 加尔各答, 马德拉..', '5.75' => '(GMT +05:45) 加德满都', 6 => '(GMT +06:00) 阿拉木图, 科伦坡, 达卡..', '6.5' => '(GMT +06:30) 仰光', 7 => '(GMT +07:00) 曼谷, 河内, 雅加达', 8 => '(GMT +08:00) 北京, 香港, 帕斯, 新加..', 9 => '(GMT +09:00) 大阪, 札幌, 首尔, 东京..', '9.5' => '(GMT +09:30) 阿德莱德, 达尔文', 10 => '(GMT +10:00) 堪培拉, 关岛, 墨尔本,..', 11 => '(GMT +11:00) 马加丹, 新喀里多尼亚,..', 12 => '(GMT +12:00) 奥克兰, 惠灵顿, 斐济,..');
	$value = (empty($value) ? '8' : $value);
	$m .= '<select name=' . $name . '>';

	foreach ($timezoneoptions as $key => $val ) {
		$m .= '<option value=' . $key . ' ' . ($value == $key ? 'selected' : '') . '>';
		$m .= $val;
		$m .= '</option>';
	}

	$m .= '</select>';
	return $m;
}
?>
