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
	exit('FORBIDDEN');
}

$qq3479015851_admin_info_type = array('number' => "\r\n\t\t" . '<tr>' . "\r\n\t\t" . '<td bgcolor="#f5fbff" width="45%" ><b>数值最大值（可选）:</b></td>' . "\r\n\t\t" . '<td bgcolor="#f5fbff"><input type="text" size="50" name="rules[number][maxnum]" value="' . $rules . '" >' . "\r\n\t\t" . '</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr>' . "\r\n\t\t" . '<td bgcolor="#f5fbff" width="45%" ><b>数值最小值（可选）:</b></td>' . "\r\n\t\t" . '<td bgcolor="#f5fbff"><input type="text" size="50" name="rules[number][minnum]" value="' . $rules . '" >' . "\r\n\t\t" . '</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t", 'text' => "\r\n\t\t" . '<tr>' . "\r\n\t\t" . '<td bgcolor="#f5fbff" width="45%" >' . "\r\n\t\t" . '<b>内容最大长度（可选）:</b>' . "\r\n\t\t" . '</td>' . "\r\n\t\t" . '<td bgcolor="#f5fbff">' . "\r\n\t\t" . '<input type="text" size="50" name="rules[text][maxlength]" value="' . $rules . '" >' . "\r\n\t\t" . '</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t", 'textarea' => "\r\n\t\t" . '<tr>' . "\r\n\t\t" . '<td bgcolor="#f5fbff" width="45%" >' . "\r\n\t\t" . '<b>内容最大长度（可选）:</b>' . "\r\n\t\t" . '</td>' . "\r\n\t\t" . '<td bgcolor="#f5fbff">' . "\r\n\t\t" . '<input type="text" size="50" name="rules[textarea][maxlength]" value="' . $rules . '" >' . "\r\n\t\t" . '</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t", 'select' => "\r\n\t\t" . '<tr>' . "\r\n\t\t" . '<td bgcolor="#f5fbff" width="25%">' . "\r\n\t\t" . '<b>选项内容:</b><br />只在项目为可选时有效，每行一个选项，等号前面为选项索引(建议用数字)，后面为内容，例如: <br /><i>1 = 光电鼠标<br />2 = 机械鼠标<br />3 = 没有鼠标</i><br /><br />注意: 选项确定后请勿修改索引和内容的对应关系，但仍可以新增选项。如需调换显示顺序，可以通过移动整行的上下位置来实现</td>' . "\r\n\t\t" . '<td bgcolor="#f5fbff">' . "\r\n\t" . '<textarea rows="8" name="rules[select][choices]" id="rules[select][choices]" cols="50">' . $rules . '</textarea>' . "\r\n\t\t" . '</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t", 'radio' => "\r\n\t\t" . '<tr>' . "\r\n\t\t" . '<td bgcolor="#f5fbff" width="45%">' . "\r\n\t\t" . '<b>选项内容:</b><br />只在项目为可选时有效，每行一个选项，等号前面为选项索引(建议用数字)，后面为内容，例如: <br /><i>1 = 光电鼠标<br />2 = 机械鼠标<br />3 = 没有鼠标</i><br />注意: 选项确定后请勿修改索引和内容的对应关系，但仍可以新增选项。如需调换显示顺序，可以通过移动整行的上下位置来实现' . "\r\n\t\t" . '</td>' . "\r\n\t\t" . '<td bgcolor="#f5fbff">' . "\r\n\t\t" . '<textarea  rows="8" name="rules[radio][choices]" id="rules[radio][choices]" cols="50">' . $rules . '</textarea>' . "\r\n\t\t" . '</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t", 'checkbox' => "\r\n\t\t" . '<tr>' . "\r\n\t\t" . '<td bgcolor="#f5fbff" width="45%">' . "\r\n\t\t" . '<b>选项内容:</b><br />只在项目为可选时有效，每行一个选项，等号前面为选项索引(建议用数字)，后面为内容，例如: <br /><i>1 = 光电鼠标<br />2 = 机械鼠标<br />3 = 没有鼠标</i><br />注意: 选项确定后请勿修改索引和内容的对应关系，但仍可以新增选项。如需调换显示顺序，可以通过移动整行的上下位置来实现</td>' . "\r\n\t\t" . '<td bgcolor="#f5fbff">' . "\r\n\t\t" . '<textarea  rows="8" name="rules[checkbox][choices]" id="rules[checkbox][choices]" cols="50">' . $rules . '</textarea>' . "\r\n\t\t" . '</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t", 'image' => "\r\n\t\t" . '<tr>' . "\r\n\t\t" . '<td bgcolor="#f5fbff" width="45%" ><b>图片最大宽度（可选）:</b></td>' . "\r\n\t\t" . '<td bgcolor="#f5fbff"><input type="text" size="50" name="rules[image][maxwidth]" value="' . $rules . '" >' . "\r\n\t\t" . '</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr>' . "\r\n\t\t" . '<td bgcolor="#f5fbff" width="45%" ><b>图片最大高度（可选）:</b></td>' . "\r\n\t\t" . '<td bgcolor="#f5fbff"><input type="text" size="50" name="rules[image][maxheight]" value="' . $rules . '" >' . "\r\n\t\t" . '</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t");
$var_type = array('text' => '字串', 'number' => '数字', 'textarea' => '文本', 'radio' => '单选', 'checkbox' => '多选', 'select' => '选择', 'age' => '年龄', 'email' => '电子邮件', 'image' => '图片', 'url' => '超级链接', 'calendar' => '日历');
function get_info_var_type($type, $name, $value)
{
	switch ($type) {
	case 'text':
		$str .= '<input name="' . $name . '" value="' . $value . '">';
		break;

	case 'textarea':
		$str .= '<textarea name="' . $name . '">' . $value . '</textarea>';
		break;

	case 'radio':
		$str .= '<input name="' . $name . '" type="radio">';
		break;

	case 'checkbox':
		$str .= '<input name="' . $name . '" type="checkbox">';
		break;

	case 'select':
		$str .= '<select name="' . $name . '">';
		$str .= '<option value="' . $value . '"></option>';
		$str .= '</select>';
		break;
	}

	return $str;
}


?>
