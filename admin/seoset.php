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
define('CURSCRIPT', 'seoset');
require_once dirname(__FILE__) . '/global.php';
require_once QQ3479015851_INC . '/db.class.php';
$admdir = getcwdOL();
$admdir = ($admdir ? substr($admdir, 1) : 'admin');

if ($admin_cityid) {
	write_msg('您没有权限访问该页！');
}

if ($action == 'makeapacherewrite') {
	$seo = get_seoset();
	$allcities = get_allcities();
	$documentroots = '';
	$conf = '';

	if (is_array($allcities)) {
		$documentroots = str_replace('\\', '/', dirname(dirname(__FILE__)));

		foreach ($allcities as $k => $v ) {
			$ServerName = preg_replace('/^http:\\/\\/(.*)/is', '\\1', $v[domain]);
			$documentroot = $documentroots . $qq3479015851_global[cfg_citiesdir] . '/' . $v['directory'];

			if (substr($ServerName, -1) == '/') {
				$ServerName = substr($ServerName, 0, -1);
			}

			$conf .= '<VirtualHost *:80>' . "\r\n" . 'DocumentRoot "' . $documentroot . '"' . "\r\n" . 'ServerName ' . $ServerName . "\r\n" . 'DirectoryIndex index.php' . "\r\n" . '<Directory "' . $documentroot . '">' . "\r\n" . 'Options FollowSymLinks' . "\r\n" . 'AllowOverride All' . "\r\n" . 'Order allow,deny' . "\r\n" . 'Allow from all' . "\r\n" . '</Directory>' . "\r\n" . '<IfModule mod_rewrite.c>' . "\r\n" . 'RewriteEngine On';

			if ($seo['seo_force_category'] == 'rewrite_py') {
				$conf .= "\r\n" . 'RewriteRule ^(.+)/$ category\\.php\\?Catid=$1';
			}
			else if ($seo['seo_force_category'] == 'rewrite') {
				$conf .= "\r\n" . 'RewriteRule ^category-([^\\/]+)\\.html$ category\\.php\\?CAtid=$1';
			}

			if ($seo['seo_force_info'] == 'rewrite_py') {
				$conf .= "\r\n" . 'RewriteRule ^([^\\/]+)/([0-9]+)\\.html$ information\\.php\\?id=$2';
			}
			else if ($seo['seo_force_info'] == 'rewrite') {
				$conf .= "\r\n" . 'RewriteRule ^information-id-([0-9]+)\\.html$ information\\.php\\?id=$1';
			}

			$conf .= "\r\n" . 'RewriteRule ^news\\.html$ news\\.php' . "\r\n" . 'RewriteRule ^news-id-([0-9]+)\\.html$ news\\.php\\?id=$1' . "\r\n" . 'RewriteRule ^news-catid-([0-9]+)\\.html$ news\\.php\\?catid=$1' . "\r\n" . 'RewriteRule ^news-catid-([0-9]+)-page-([0-9]+)\\.html$ news\\.php\\?catid=$1&page=$2' . "\r\n" . 'RewriteRule ^goods\\.html$ goods\\.php' . "\r\n" . 'RewriteRule ^goods-id-([0-9]+)\\.html$ goods\\.php\\?id=$1' . "\r\n" . 'RewriteRule ^goods-([^\\/]+)\\.html$ goods\\.php\\?Catid=$1' . "\r\n" . 'RewriteRule ^corporation\\.html$ corporation\\.php' . "\r\n" . 'RewriteRule ^corporation-([^\\/]+)\\.html$ corporation\\.php\\?Catid=$1' . "\r\n" . 'RewriteRule ^sitemap\\.html$ about\\.php\\?part=sitemap' . "\r\n" . 'RewriteRule ^announce\\.html$ about\\.php\\?part=announce&id=$1' . "\r\n" . 'RewriteRule ^friendlink\\.html$ about\\.php\\?part=friendlink' . "\r\n" . '</IfModule>' . "\r\n" . '</VirtualHost>' . "\r\n";
		}
	}

	if (!createfile(QQ3479015851_ROOT . '/htaccess.txt', $conf)) {
		write_msg(QQ3479015851_ROOT . '/htaccess.txt 文件不可写，请检查根目录权限！');
	}
	else {
		write_msg('htaccess.txt文件更新成功！<br>Include ' . str_replace('\\', '/', QQ3479015851_ROOT) . '/htaccess.txt', 'olmsg');
	}

	unset($conf);
	unset($cities);
}

if (!submit_check(CURSCRIPT . '_submit')) {
	$here = QQ3479015851_SOFTNAME . 'SEO优化设置';
	chk_admin_purview('purview_SEO伪静态');
	$res = $db->query('SELECT description,value FROM ' . $db_qq3479015851 . 'config WHERE type=\'seo\'');

	while ($row = $db->fetchRow($res)) {
		$seo[$row['description']] = $row['value'];
	}

	include qq3479015851_tpl(CURSCRIPT);
}
else {
	$seo_setarr = array('seo_sitename', 'seo_keywords', 'seo_description', 'seo_htmldir', 'seo_htmlnewsdir', 'seo_htmlext', 'seo_force_about', 'seo_force_category', 'seo_force_info', 'seo_force_news', 'seo_force_goods', 'seo_force_yp', 'seo_force_space', 'seo_force_store', 'seo_html_make');
	qq3479015851_delete('config', 'WHERE type = \'seo\'');

	foreach ($seo_setarr as $key ) {
		if ($key == 'keywords') {
			$key = str_replace('，', ',', $key);
		}

		$db->query('INSERT ' . $db_qq3479015851 . 'config (description,value,type) VALUES (\'' . $key . '\',\'' . $$key . '\',\'seo\')');
	}

	foreach (array('category_tree', 'corp_tree', 'seoset') as $range ) {
		clear_cache_files($range);
	}

	updateadvertisement();

	if ($updatefile == 1) {
		$rules['iis'] .= '[ISAPI_Rewrite]' . "\r\n" . 'CacheClockRate 3600' . "\r\n" . 'RepeatLimit 32' . "\r\n";
		$rules['apache'] .= 'RewriteEngine On' . "\r\n";
		$rules['iis7'] .= '<?xml version="1.0" encoding="UTF-8"?>' . "\r\n" . '<configuration>' . "\r\n" . '<system.webServer>' . "\r\n" . '<rewrite>' . "\r\n" . '<rules>' . "\r\n";

		if ($seo_force_space == 'rewrite') {
			$rules['iis'] .= 'RewriteRule ^(.*)/space/([a-z0-9\\-\\_]+)/$ $1/space\\.php\\?user=$2' . "\r\n";
			$rules['apache'] .= 'RewriteRule ^(.*)space/([a-z0-9\\-\\_]+)\\/$ $1/space\\.php\\?user=$2' . "\r\n";
			$rules['iis7'] .= '<rule name="space">' . "\r\n" . '<match url="^space/([a-z0-9A-Z]+)/$" />' . "\r\n" . '<action type="Rewrite" url="space.php?user={R:1}" />' . "\r\n" . '</rule>' . "\r\n";
			$rules['nginx'] .= 'rewrite ^/space/(.+)\\/$ /space.php?user=$1    last;' . "\r\n";
		}

		if ($seo_force_store == 'rewrite') {
			$rules['iis'] .= 'RewriteRule ^(.*)/store-([0-9]+)/$ $1/store\\.php\\?uid=$2' . "\r\n" . 'RewriteRule ^(.*)/store-([0-9]+)/([^\\/]+).html$ $1/store\\.php\\?uid=$2&Uid=$3' . "\r\n";
			$rules['apache'] .= 'RewriteRule ^(.*)store-([0-9]+)\\/$ $1/store\\.php\\?uid=$2' . "\r\n" . 'RewriteRule ^(.*)store-([0-9]+)/([^\\/]+).html$ $1/store\\.php\\?uid=$2&Uid=$3' . "\r\n";
			$rules['iis7'] .= '<rule name="store">' . "\r\n" . '<match url="^store-([0-9]+)/$" />' . "\r\n" . '<action type="Rewrite" url="store.php?uid={R:1}" />' . "\r\n" . '</rule>' . "\r\n" . '<rule name="store2">' . "\r\n" . '<match url="^store-([0-9]+)/([^\\/]+).html$" />' . "\r\n" . '<action type="Rewrite" url="store.php?uid={R:1}&amp;Uid={R:2}" />' . "\r\n" . '</rule>' . "\r\n";
			$rules['nginx'] .= 'rewrite ^/store-([0-9]+)\\/$ /store.php?uid=$1    last;' . "\r\n" . 'rewrite ^/store-([0-9]+)\\/([^\\/]+).html$ /store.php?uid=$1&Uid=$2    last;' . "\r\n";
		}

		if ($seo_force_category == 'rewrite') {
			$rules['iis'] .= 'RewriteRule ^(.*)/category-([^\\/]+)\\.html$ $1/category\\.php\\?CAtid=$2' . "\r\n";
			$rules['apache'] .= 'RewriteRule ^(.*)category-([^\\/]+)\\.html$ $1/category\\.php\\?CAtid=$2' . "\r\n";
			$rules['iis7'] .= '<rule name="category">' . "\r\n" . '<match url="^category-([^\\/]+).html$" />' . "\r\n" . '<action type="Rewrite" url="category.php?CAtid={R:1}" />' . "\r\n" . '</rule>' . "\r\n";
			$rules['nginx'] .= 'rewrite ^/category-([^\\/]+)\\.html$ /category.php?CAtid=$1  last;' . "\r\n";
		}
		else if ($seo_force_category == 'rewrite_py') {
			$rules['iis'] .= 'RewriteRule ^(.*)/(?!\\m\\b|' . $admdir . ')([^\\/]+)/$ $1/category\\.php\\?Catid=$2' . "\r\n";
			$rules['apache'] .= 'RewriteRule ^(.*)(?!\\m\\b|' . $admdir . ')([^\\/]+)/$ $1/category\\.php\\?Catid=$2' . "\r\n";
			$rules['iis7'] .= '<rule name="category">' . "\r\n" . '<match url="^(?!\\m\\b|' . $admdir . ')([^\\/]+)/$" />' . "\r\n" . '<action type="Rewrite" url="category.php?Catid={R:1}" />' . "\r\n" . '</rule>' . "\r\n";
			$rules['nginx'] .= 'rewrite ^/(?!\\m\\b)([^\\/]+)/$ /category.php?Catid=$1  last;' . "\r\n";
		}

		if ($seo_force_info == 'rewrite') {
			$rules['iis'] .= 'RewriteRule ^(.*)/information-id-([0-9]+)\\.html$ $1/information\\.php\\?id=$2' . "\r\n";
			$rules['apache'] .= 'RewriteRule ^(.*)information-id-([0-9]+)\\.html$ $1/information\\.php\\?id=$2' . "\r\n";
			$rules['iis7'] .= '<rule name="information">' . "\r\n" . '<match url="^information-id-([0-9]+).html$" />' . "\r\n" . '<action type="Rewrite" url="information.php?id={R:1}" />' . "\r\n" . '</rule>' . "\r\n";
			$rules['nginx'] .= 'rewrite ^/information-id-([0-9]+)\\.html$ /information.php?id=$1  last;' . "\r\n";
		}
		else if ($seo_force_info == 'rewrite_py') {
			$rules['iis'] .= 'RewriteRule ^(.*)/([^\\/]+)/([0-9]+)\\.html$ $1/information\\.php\\?id=$3' . "\r\n";
			$rules['apache'] .= 'RewriteRule ^(.*)([^\\/]+)/([0-9]+)\\.html$ $1/information\\.php\\?id=$3' . "\r\n";
			$rules['iis7'] .= '<rule name="information">' . "\r\n" . '<match url="^([^\\/]+)/([0-9]+).html$" />' . "\r\n" . '<action type="Rewrite" url="information.php?id={R:2}" />' . "\r\n" . '</rule>' . "\r\n";
			$rules['nginx'] .= 'rewrite ^/([^\\/]+)/([0-9]+)\\.html$ /information.php?id=$2  last;' . "\r\n";
		}

		if ($seo_force_news == 'rewrite') {
			$rules['iis'] .= 'RewriteRule ^(.*)/news\\.html$ $1/news\\.php' . "\r\n" . 'RewriteRule ^(.*)/news-id-([0-9]+)\\.html$ $1/news\\.php\\?id=$2' . "\r\n" . 'RewriteRule ^(.*)/news-catid-([0-9]+)\\.html$ $1/news\\.php\\?catid=$2' . "\r\n" . 'RewriteRule ^(.*)/news-catid-([0-9]+)-page-([0-9]+)\\.html$ $1/news\\.php\\?catid=$2&page=$3' . "\r\n";
			$rules['apache'] .= 'RewriteRule ^news\\.html$ news\\.php' . "\r\n" . 'RewriteRule ^news-id-([0-9]+)\\.html$ news\\.php\\?id=$1' . "\r\n" . 'RewriteRule ^news-catid-([0-9]+)\\.html$ news\\.php\\?catid=$1' . "\r\n" . 'RewriteRule ^news-catid-([0-9]+)-page-([0-9]+)\\.html$ news\\.php\\?catid=$1&page=$2' . "\r\n";
			$rules['iis7'] .= '<rule name="news">' . "\r\n" . '<match url="^news.html$" />' . "\r\n" . '<action type="Rewrite" url="news.php" />' . "\r\n" . '</rule>' . "\r\n" . '<rule name="news2">' . "\r\n" . '<match url="^news-id-([0-9]+).html$" />' . "\r\n" . '<action type="Rewrite" url="news.php?id={R:1}" />' . "\r\n" . '</rule>' . "\r\n" . '<rule name="news3">' . "\r\n" . '<match url="^news-catid-([0-9]+).html$" />' . "\r\n" . '<action type="Rewrite" url="news.php?catid={R:1}" />' . "\r\n" . '</rule>' . "\r\n" . '<rule name="news4">' . "\r\n" . '<match url="^news-catid-([0-9]+)-page-([0-9]+).html$" />' . "\r\n" . '<action type="Rewrite" url="news.php?catid={R:1}&amp;page={R:2}" />' . "\r\n" . '</rule>' . "\r\n";
			$rules['nginx'] .= 'rewrite ^/news\\.html$ /news.php    last;' . "\r\n" . 'rewrite ^/news-id-([0-9]+)\\.html$ /news.php?id=$1    last;' . "\r\n" . 'rewrite ^/news-catid-([0-9]+)\\.html$ /news.php?catid=$1    last;' . "\r\n" . 'rewrite ^/news-catid-([0-9]+)-page-([0-9]+)\\.html$ /news.php?catid=$1&page=$2    last;' . "\r\n";
		}

		if ($seo_force_yp == 'rewrite') {
			$rules['iis'] .= 'RewriteRule ^(.*)/corporation\\.html$ $1/corporation\\.php' . "\r\n" . 'RewriteRule ^(.*)/corporation-([^\\/]+)\\.html$ $1/corporation\\.php\\?Catid=$2' . "\r\n";
			$rules['apache'] .= 'RewriteRule ^(.*)corporation\\.html$ $1/corporation\\.php' . "\r\n" . 'RewriteRule ^(.*)corporation-([^\\/]+)\\.html$ $1/corporation\\.php\\?Catid=$2' . "\r\n";
			$rules['iis7'] .= '<rule name="corporation">' . "\r\n" . '<match url="^corporation.html$" />' . "\r\n" . '<action type="Rewrite" url="corporation.php" />' . "\r\n" . '</rule>' . "\r\n" . '<rule name="corporation2">' . "\r\n" . '<match url="^corporation-([^\\/]+).html$" />' . "\r\n" . '<action type="Rewrite" url="corporation.php?Catid={R:1}" />' . "\r\n" . '</rule>' . "\r\n";
			$rules['nginx'] .= 'rewrite ^/corporation\\.html$ /corporation.php    last;' . "\r\n" . 'rewrite ^/corporation-([^\\/]+)\\.html$ /corporation.php?Catid=$1    last;' . "\r\n";
		}

		if ($seo_force_about == 'rewrite') {
			$rules['iis'] .= 'RewriteRule ^(.*)/sitemap\\.html$ $1/about\\.php\\?part=sitemap' . "\r\n" . 'RewriteRule ^(.*)/aboutus\\.html$ $1/about\\.php\\?part=aboutus' . "\r\n" . 'RewriteRule ^(.*)/aboutus-id-([0-9]+)\\.html$ $1/about\\.php\\?part=aboutus&id=$2' . "\r\n" . 'RewriteRule ^(.*)/announce\\.html$ $1/about\\.php\\?part=announce&id=$2' . "\r\n" . 'RewriteRule ^(.*)/faq\\.html$ $1/about\\.php\\?part=faq' . "\r\n" . 'RewriteRule ^(.*)/faq-id-([0-9]+)\\.html$ $1/about\\.php\\?part=faq&id=$2' . "\r\n" . 'RewriteRule ^(.*)/friendlink\\.html$ $1/about\\.php\\?part=friendlink' . "\r\n";
			$rules['apache'] .= 'RewriteRule ^(.*)aboutus\\.html$ $1/about\\.php\\?part=aboutus' . "\r\n" . 'RewriteRule ^(.*)sitemap\\.html$ $1/about\\.php\\?part=sitemap' . "\r\n" . 'RewriteRule ^(.*)aboutus-id-([0-9]+)\\.html$ $1/about\\.php\\?part=aboutus&id=$2' . "\r\n" . 'RewriteRule ^(.*)announce\\.html$ $1/about\\.php\\?part=announce&id=$2' . "\r\n" . 'RewriteRule ^(.*)faq\\.html$ $1/about\\.php\\?part=faq' . "\r\n" . 'RewriteRule ^(.*)faq-id-([0-9]+)\\.html$ $1/about\\.php\\?part=faq&id=$2' . "\r\n" . 'RewriteRule ^(.*)friendlink\\.html$ $1/about\\.php\\?part=friendlink' . "\r\n";
			$rules['iis7'] .= '<rule name="sitemap">' . "\r\n" . '<match url="^sitemap.html$" />' . "\r\n" . '<action type="Rewrite" url="about.php?part=sitemap" />' . "\r\n" . '</rule>' . "\r\n" . '<rule name="aboutus">' . "\r\n" . '<match url="^aboutus.html$" />' . "\r\n" . '<action type="Rewrite" url="about.php?part=aboutus" />' . "\r\n" . '</rule>' . "\r\n" . '<rule name="aboutusid">' . "\r\n" . '<match url="^aboutus-id-([0-9]+).html$" />' . "\r\n" . '<action type="Rewrite" url="about.php?part=aboutus&amp;id={R:1}" />' . "\r\n" . '</rule>' . "\r\n" . '<rule name="announce">' . "\r\n" . '<match url="^announce.html$" />' . "\r\n" . '<action type="Rewrite" url="about.php?part=announce" />' . "\r\n" . '</rule>' . "\r\n" . '<rule name="faq">' . "\r\n" . '<match url="^faq.html$" />' . "\r\n" . '<action type="Rewrite" url="about.php?part=faq" />' . "\r\n" . '</rule>' . "\r\n" . '<rule name="faqid">' . "\r\n" . '<match url="^faq-id-([0-9]+).html$" />' . "\r\n" . '<action type="Rewrite" url="about.php?part=faq&amp;id={R:1}" />' . "\r\n" . '</rule>' . "\r\n" . '<rule name="friendlink">' . "\r\n" . '<match url="^friendlink.html$" />' . "\r\n" . '<action type="Rewrite" url="about.php?part=friendlink" />' . "\r\n" . '</rule>' . "\r\n";
			$rules['nginx'] .= 'rewrite ^/sitemap\\.html$ /about.php?part=sitemap    last;' . "\r\n" . 'rewrite ^/aboutus\\.html$ /about.php?part=aboutus    last;' . "\r\n" . 'rewrite ^/aboutus-id-([0-9]+)\\.html$ /about.php?part=aboutus&id=$1    last;' . "\r\n" . 'rewrite ^/announce\\.html$ /about.php?part=announce&id=$1    last;' . "\r\n" . 'rewrite ^/faq\\.html$ /about.php?part=faq    last;' . "\r\n" . 'rewrite ^/faq-id-([0-9]+)\\.html$ /about.php?part=faq&id=$1    last;' . "\r\n" . 'rewrite ^/friendlink\\.html$ /about.php?part=friendlink    last;' . "\r\n";
		}

		$rules['iis7'] .= '</rules>' . "\r\n" . '</rewrite>' . "\r\n" . '</system.webServer>' . "\r\n" . '</configuration>' . "\r\n";

		if (!createfile(QQ3479015851_ROOT . '/rewrite/httpd.ini', $rules['iis'])) {
			$notice .= QQ3479015851_ROOT . '/rewrite/httpd.ini 请设置为777属性或者写入修改权限<br><br>';
		}

		if (!createfile(QQ3479015851_ROOT . '/rewrite/.htaccess', $rules['apache'])) {
			$notice .= QQ3479015851_ROOT . '/rewrite/.htaccess 请设置为777属性或者写入修改权限<br><br>';
		}

		if (!createfile(QQ3479015851_ROOT . '/rewrite/web.config', $rules['iis7'])) {
			$notice .= QQ3479015851_ROOT . '/rewrite/web.config 请设置为777属性或者写入修改权限<br><br>';
		}

		if (!createfile(QQ3479015851_ROOT . '/rewrite/nginx.conf', $rules['nginx'])) {
			$notice .= QQ3479015851_ROOT . '/rewrite/nginx.conf 请设置为777属性或者写入修改权限<br><br>';
		}
	}

	write_msg(($notice ? $notice : '') . '系统SEO设置更新成功！', 'seoset.php', 'WriteRecord');
}

is_object($db) && $db->Close();
$qq3479015851_global = $db = $db_qq3479015851 = $part = NULL;


function GetSeoType($seo_type = '', $formname = 'seo_type')
{
	global $qq3479015851_qq3479015851;
	$seo_arr = array('active' => '动态', 'rewrite' => '伪静态');
	if (in_array($formname, array('seo_force_category', 'seo_force_info')) && ($qq3479015851_qq3479015851['cfg_if_rewritepy'] == 1)) {
		$seo_arr = array('active' => '动态', 'rewrite' => '伪静态', 'rewrite_py' => '拼音伪静态');
	}

	$seo_type_form = '<select name=\'' . $formname . '\' id=\'' . $formname . '\'>';

	foreach ($seo_arr as $k => $v ) {
		if (($k == $seo_type) && ($k != '')) {
			$seo_type_form .= '<option value=\'' . $k . '\' selected style=\'background-color:#6EB00C;color:white\'>' . $v . '/' . $k . '</option>' . "\r\n";
		}
		else {
			$seo_type_form .= '<option value=\'' . $k . '\'>' . $v . '/' . $k . '</option>' . "\r\n";
		}
	}

	$seo_type_form .= '</select>' . "\r\n";
	return $seo_type_form;
}


?>
