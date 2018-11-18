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
function utf82gb($utfstr)
{
	if (function_exists('iconv')) {
		return iconv('utf-8', 'gbk', $utfstr);
	}

	global $UC2GBTABLE;
	$okstr = '';

	if (trim($utfstr) == '') {
		return $utfstr;
	}

	if (empty($UC2GBTABLE)) {
		$filename = QQ3479015851_DATA . '/gb2312-utf8.table';
		$fp = fopen($filename, 'r');

		while ($l = fgets($fp, 15)) {
			$UC2GBTABLE[hexdec(substr($l, 7, 6))] = hexdec(substr($l, 0, 6));
		}

		fclose($fp);
	}

	$okstr = '';
	$ulen = strlen($utfstr);

	for ($i = 0; $i < $ulen; $i++) {
		$c = $utfstr[$i];
		$cb = decbin(ord($utfstr[$i]));

		if (strlen($cb) == 8) {
			$csize = strpos(decbin(ord($cb)), '0');

			for ($j = 0; $j < $csize; $j++) {
				$i++;
				$c .= $utfstr[$i];
			}

			$c = utf82u($c);

			if (isset($UC2GBTABLE[$c])) {
				$c = dechex($UC2GBTABLE[$c] + 32896);
				$okstr .= chr(hexdec($c[0] . $c[1])) . chr(hexdec($c[2] . $c[3]));
			}
			else {
				$okstr .= '&#' . $c . ';';
			}
		}
		else {
			$okstr .= $c;
		}
	}

	$okstr = trim($okstr);
	return $okstr;
}

function GetPinyin($str, $ishead = 0, $isclose = 1)
{
	global $pinyins;
	global $db;
	global $db_qq3479015851;
	global $charset;
	$restr = '';
	$str = ($charset == 'gbk' ? trim($str) : utf82gb(trim($str)));
	$slen = strlen($str);

	if ($slen < 2) {
		return $str;
	}

	if (count($pinyins) == 0) {
		$fp = fopen(QQ3479015851_DATA . '/pinyin.db', 'r');

		while (!feof($fp)) {
			$line = trim(fgets($fp));
			$pinyins[$line[0] . $line[1]] = substr($line, 3, strlen($line) - 3);
		}

		fclose($fp);
	}

	for ($i = 0; $i < $slen; $i++) {
		if (128 < ord($str[$i])) {
			$c = $str[$i] . $str[$i + 1];
			$i++;

			if (isset($pinyins[$c])) {
				if ($ishead == 0) {
					$restr .= $pinyins[$c];
				}
				else {
					$restr .= $pinyins[$c][0];
				}
			}
			else {
				$restr .= '-';
			}
		}
		else if (@eregi('[a-z0-9]', $str[$i])) {
			$restr .= $str[$i];
		}
		else {
			$restr .= '-';
		}
	}

	if ($isclose == 0) {
		unset($pinyins);
	}

	return $restr;
}


?>
