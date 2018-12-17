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
define('IN_SMT',true);
define('SysGlbCfm',true);
require_once dirname(__FILE__)."/include/global.php";
require_once dirname(__FILE__)."/data/config.php";
require_once SysGlbCfm_DATA."/config.db.php";
require_once SysGlbCfm_INC."/db.class.php";
require_once SysGlbCfm_INC."/member.class.php";
$iflogin 	= $member_log -> chk_in();

$action  = isset($action)	? trim($action) 	: '';
$part 	 = isset($part)		? trim($part) 		: '';
$id   	 = isset($id) 		? intval($id) 		: '';
$inajax  = isset($inajax) 	? intval($inajax) 	: '';

if(empty($id)) exit('Access Denied!');
if(!in_array($part,array('information','news','xiehui','zhanui','store'))) write_msg('您提交的评论所属模块不能为空!');
$dotphpurlarray = array('information'=>'information.php','news'=>'news.php','xiehui'=>'xiehui.php','zhanhui'=>'zhanhui.php','coupon'=>'coupon.php','group'=>'group.php');

$commentsettings = get_commentsettings();
if(!$commentsettings[$part]){
	exit();
}

if($action == 'insert'){
	mgetcookie('comment'.$part.$id) == 1 && write_msg('您的语速太快了，请休息一下再发表评论...');
	if(!$iflogin && !$randcode = qq3479015851_chk_randcode($checkcode)){
		write_msg('验证码输入错误，请返回重新输入');
		exit;
	}
	empty($content) && write_msg("提交失败!评论内容不能为空!");
	strlen($content)>255 && write_msg("请不要填写超过127个汉字!");
	
	if(!$iflogin){
	
		switch($commentsettings[$part]){
			case 1:
				$userid = '';
			break;
			case 2:
				$loginuser	= $loginuser ? mhtmlspecialchars($loginuser) : '';
				$loginpwd	= $loginpwd	 ? mhtmlspecialchars($loginpwd)	 : '';
				if(empty($loginuser)) write_msg('请填写你的用户帐号!');
				if(empty($loginpwd)) write_msg('请填写你的用户密码！');
				$loginpwd = md5($loginpwd);
				if(!$res = $db -> getOne("SELECT id FROM `{$db_qq3479015851}member` WHERE userid = '$loginuser' AND userpwd = '$loginpwd'")){
					unset($res);
					write_msg('你的帐号或密码输入错误，或不存在该用户！');
				} else {
					$userid		= $loginuser;
					$member_log -> in($loginuser,$loginpwd,'','noredirect');
				}
			break;
		}
		
	} else {
		$userid = $s_uid;
	}
	
	
	$result 		= verify_badwords_filter($SystemGlobalcfm_global['cfg_if_comment_verify'],'',$content);
	$content 		= textarea_post_change($result['content']);
	$comment_level  = $result['level'];
	$db->query("INSERT INTO `{$db_qq3479015851}comment` (typeid,content,pubtime,ip,comment_level,userid,type)VALUES('$id','$content','$timestamp','".GetIP()."','$comment_level','".$userid."','$part')");
	
	msetcookie('comment'.$part.$id,1,30);
	
	if($comment_level == 1){
		write_msg("",$dotphpurlarray[$part]."?id=".$id.'#comment_write');
	}else{
		define('IN_AJAX',true);
		write_msg("您提交的留言可能含有违禁词语，审核通过后显示！",$dotphpurlarray[$part]."?id=".$id);
	}
	unset($loginuser,$loginpwd,$comment_level,$id);
}

$res = $db->getAll("SELECT content,userid,pubtime,ip FROM `{$db_qq3479015851}comment` WHERE typeid = '$id' AND comment_level = '1' AND type = '$part' ORDER BY pubtime ASC LIMIT 0,10");
foreach($res as $k => $row){
	$arr['content']    = $row['content'];
	$arr['pubtime']    = get_format_time($row['pubtime']);
	$arr['userid']     = $row['userid'];
	$arr['ip']     = $row['ip'];
	$comment_all[]     = $arr;
}
	
$ajax_content ='
<script type="text/javascript" src="'.$SystemGlobalcfm_global[SiteUrl].'/template/default/js/comment.js"></script>
<div class="box specialpostcontainer">';
if(is_array($comment_all)){
	$i = 0;
	foreach($comment_all as $key => $val){
	$i++;
	$ajax_content.='
		<div class="specialpost">
		<div class="postinfo">
		<h2>';
	$ajax_content.= $val['userid'] ? '<a class="dropmenu" style="font-weight: normal;" href="'.Rewrite("space",array("user"=>$val["userid"])).'" target="_blank" >'.$val["userid"].'</a>' : '<a class="dropmenu" style="font-weight: normal;">'.part_ip($val['ip']).'</a>';
	$ajax_content.='
		'.$val["pubtime"].' </h2>
		<strong>'.$i.'<sup>楼</sup></strong>
		</div>
		<div class="postmessage">
		<div class="t_msgfont">'.$val["content"].'
		</div>
		</div>
		</div>';
	}
} else {
	
	$ajax_content.='
	<div class="specialpost"></div>
	<div class="clear"></div>';
	
}

$ajax_content.=' 
	<div id="postleave">
		<a name="comment_write"></a>
		<form action="'.$SystemGlobalcfm_global["SiteUrl"].'/comment.php?part='.$part.'&amp;action=insert" method="post" id="CommentForm" name="CommentForm" onsubmit="return CommentCheckForm();">
		<input name="id" value="'.$id.'" type="hidden">
		<dl><dt>评论内容：</dt><dd><textarea name="content" class="commenttextarea"></textarea></dd></dl>
		';
		
		
if($iflogin){
	$ajax_content .= '<div class=clearfix></div><dl><dt>&nbsp;</dt><dd><div style="margin-top:5px">'.$s_uid.' &nbsp;<a href="'.$SystemGlobalcfm_global[SiteUrl].'/'.$SystemGlobalcfm_global[cfg_member_logfile].'?part=out&url='.urlencode($SystemGlobalcfm_global["SiteUrl"].'/'.$dotphpurlarray[$part].'?id='.$id).'">退出</a></div></dd></dl>';
} else {

	if($commentsettings[$part] == 2){
		$ajax_content .= '
			<div class="clearfix"></div>
			<dl>
			<dt>登录帐号：</dt>
			<dd>
			<input name="loginuser" class="commenttxt" style="width:100px;">
			&nbsp;&nbsp;&nbsp;&nbsp; 
			密码：<input name="loginpwd" type="password" class="commenttxt" style="width:100px;">&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$SystemGlobalcfm_global[SiteUrl].'/'.$SystemGlobalcfm_global[cfg_member_logfile].'?mod=register" target="_blank">注册帐号 &raquo;</a>
			</dd>
			</dl>
		';
	}
	
	$ajax_content .='<div class="clearfix"></div>';
	
	$ajax_content .= '<dl><dt>验 证 码：</dt><dd><input name="checkcode" class="commenttxt" type="text" style="width:74px"/></dd></dl>';
	
	$ajax_content .='<div class="clearfix"></div>';
	
	$ajax_content .= '<dl><dt>&nbsp;</dt><dd><img src="'.$SystemGlobalcfm_global["SiteUrl"].'/'.$SystemGlobalcfm_global[cfg_authcodefile].'" alt="看不清，请点击刷新" class="authcode" align="absmiddle" onClick="this.src=this.src+\'?\'"/></dd></dl>';
}
		
$ajax_content .= '
		<div class="clearfix"></div>
		<dl><dt>&nbsp;</dt><dd><input type="submit" class="commentsubmit" value="提交评论" style="line-height:18px" name="qq3479015851"></dd></dl>
		</form> 
	</div>
</div>
';
echo html2js($ajax_content);
is_object($db) && $db -> Close();
unset($ajax_concotent,$iflogin,$SystemGlobalcfm_global,$member_log,$comment_all,$rows_num,$param,$page,$userid,$content,$inajax,$id,$part,$action,$userid,$s_uid,$db,$timestamp,$dotphpurlarray,$commentsettings);
?>