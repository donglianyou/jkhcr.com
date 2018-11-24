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
$html_type = array();
$html_type[1] = '按栏目ID';
$html_type[2] = '按栏目拼音';
$html_type[3] = '按栏目拼音首字母';
$html_type[4] = '自定义目录名';
function GetHtmlType($dir_type = '', $formname = 'dir_type', $form_type = 'edit', $mydirval = '')
{
	global $html_type;

	if ($form_type == 'edit') {
		$GetHtmlTypeForm = '<select name=\'' . $formname . '\' id=\'' . $formname . '\' onchange=\'if(this.options[this.selectedIndex].value == 4){document.getElementById("mydir").style.display = "block"}else{document.getElementById("mydir").style.display = "none"}\'>';

		foreach ($html_type as $k => $v ) {
			if ($k == $dir_type) {
				$GetHtmlTypeForm .= '<option value=\'' . $k . '\' selected style=\'background-color:#6EB00C;color:white\'>' . $v . '</option>' . "\r\n";
			}
			else {
				$GetHtmlTypeForm .= '<option value=\'' . $k . '\'>' . $v . '</option>' . "\r\n";
			}
		}

		$GetHtmlTypeForm .= '</select>' . "\r\n";
		$GetHtmlTypeForm .= '<div><br /><input name="mydir" type="text" class="text" id="mydir" ';
		$GetHtmlTypeForm .= ' value=' . $mydirval . '></div>';
	}
	else if ($form_type == 'add') {
		$GetHtmlTypeForm = '<select name=\'' . $formname . '\' id=\'' . $formname . '\'>';

		foreach ($html_type as $k => $v ) {
			if ($k != '4') {
				if ($k == $dir_type) {
					$GetHtmlTypeForm .= '<option value=\'' . $k . '\' selected style=\'background-color:#6EB00C;color:white\'>' . $v . '</option>' . "\r\n";
				}
				else {
					$GetHtmlTypeForm .= '<option value=\'' . $k . '\'>' . $v . '</option>' . "\r\n";
				}
			}
		}

		$GetHtmlTypeForm .= '</select>' . "\r\n";
	}

	return $GetHtmlTypeForm;
}


?>
