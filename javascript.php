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
error_reporting( E_ALL ^ E_NOTICE );
@header( "Content-Type: text/html; charset=utf-8" );
if ( __FILE__ == "" )
{
    exit( "Fatal error code: 0" );
}
define('QQ3479015851', true);
define( "MAGIC_QUOTES_GPC", get_magic_quotes_gpc( ) );
define( "QQ3479015851_ROOT", dirname( __FILE__ ) );
define( "QQ3479015851_DATA", QQ3479015851_ROOT."/data" );
define( "QQ3479015851_INC", QQ3479015851_ROOT."/include" );
define( "CURSCRIPT", "javascript" );
if ( function_exists( "date_default_timezone_set" ) )
{
    date_default_timezone_set( "Hongkong" );
}
@set_magic_quotes_runtime( 0 );
if ( !defined( "DEBUG_MODE" ) )
{
    define( "DEBUG_MODE", 0 );
}
if ( PHP_VERSION < "4.1.0" )
{
    $_GET =& $HTTP_GET_VARS;
    $_SERVER =& $HTTP_SERVER_VARS;
    unset( $HTTP_GET_VARS );
    unset( $HTTP_SERVER_VARS );
}
if ( isset( $_REQUEST['GLOBALS'] ) || isset( $_FILES['GLOBALS'] ) )
{
    exit( "Request tainting attempted." );
}
require_once( QQ3479015851_DATA."/config.php" );
require_once( QQ3479015851_ROOT."/include/common.fun.php" );
require_once( QQ3479015851_ROOT."/include/class.fun.php" );
require_once( QQ3479015851_ROOT."/include/custom.fun.php" );
$part = isset( $_GET['part'] ) ? mhtmlspecialchars( $_GET['part'] ) : "jswizard";
$flag = isset( $_GET['flag'] ) ? mhtmlspecialchars( $_GET['flag'] ) : "";
$id = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : "";
$inajax = isset( $_GET['inajax'] ) ? intval( $_GET['inajax'] ) : "";
$getvalue = isset( $_GET['value'] ) ? mhtmlspecialchars( $_GET['value'] ) : "";
$timestamp = time( );
$cityid = isset( $_GET['cityid'] ) ? intval( $_GET['cityid'] ) : "";
$customtype = isset( $customtype ) ? mhtmlspecialchars( $_GET['customtype'] ) : "info";
$url = isset( $_GET['url'] ) ? urlencode( mhtmlspecialchars( $_GET['url'] ) ) : "";
if ( empty( $part ) || !in_array( $part, array( "advertisement", "information", "news", "member", "jswizard", "iflogin", "chk_remember", "chk_remobile", "chk_authcode", "chk_smsauthcode", "chk_answer", "chk_remail", "chk_wxlogin" ) ) )
{
    $part = "advertisement";
}
if ( $part == "chk_answer" )
{
    $data = NULL;
    @require_once( QQ3479015851_ROOT."/include/cache.fun.php" );
    $result = read_static_cache( "checkanswer" );
    if ( is_array( $result ) )
    {
        if ( empty( $getvalue ) || empty( $id ) )
        {
            exit( "请输入验证问题！" );
        }
        if ( $result[$id]['answer'] != $getvalue )
        {
            exit( "验证答案不正确！" );
        }
        exit( "success" );
    }
    $result = $getvalue = $whenpost = $data = NULL;
}
else
{
    if ( $part == "chk_authcode" )
    {
        @session_save_path( QQ3479015851_ROOT."/data/sessions" );
        if ( qq3479015851_chk_randcode( $getvalue ) )
        {
            exit( "success" );
        }
        exit( "验证码错误，请重新输入" );
    }
    if ( $part == "chk_smsauthcode" )
    {
        @session_save_path( QQ3479015851_ROOT."/data/sessions" );
        if ( qq3479015851_chk_smsrandcode( $getvalue ) )
        {
            exit( "success" );
        }
        exit( "手机验证码输入不正确" );
    }
    if ( $part == "chk_remember" )
    {
        require_once( QQ3479015851_DATA."/config.db.php" );
        @header( "Content-type: text/html; charset=".$charset );
        require_once( QQ3479015851_INC."/db.class.php" );
        if ( empty( $getvalue ) )
        {
            echo "用户名不符合规范！";
        }
        else
        {
            if ( PASSPORT_TYPE == "phpwind" )
            {
                include( QQ3479015851_ROOT."/pw_client/uc_client.php" );
                if ( uc_user_get( $getvalue ) )
                {
                    exit( "很遗憾！该用户名已被注册！" );
                }
                exit( "success" );
            }
            if ( PASSPORT_TYPE == "ucenter" )
            {
                include( QQ3479015851_ROOT."/uc_client/client.php" );
                if ( uc_get_user( $getvalue ) )
                {
                    exit( "很遗憾！该用户名已被注册！" );
                }
                exit( "success" );
            }
            $check = checkuserid( $getvalue, "用户名" );
            if ( strstr( $getvalue, "admin" ) || strstr( $getvalue, "管理员" ) )
            {
                exit( "该用户名已被保护，请换一个用户名！" );
            }
            if ( strlen( $getvalue ) < 4 || 20 < strlen( $getvalue ) )
            {
                exit( "可填写字母、数字、下划线_，不得少于4个字符" );
            }
            if ( $check == "ok" )
            {
                if ( !( $re = $db->getOne( "SELECT * FROM ".$db_qq3479015851."member WHERE userid LIKE '{$getvalue}'" ) ) )
                {
                    exit( "success" );
                }
                exit( "很抱歉！该用户名已经被注册！" );
            }
            exit( $check );
        }
        $getvalue = NULL;
    }
    else if ( $part == "chk_remail" )
    {
        $mod = isset( $_GET['mod'] ) ? intval( $_GET['mod'] ) : 0;
        require_once( QQ3479015851_DATA."/config.db.php" );
        @header( "Content-type: text/html; charset=".$charset );
        require_once( QQ3479015851_INC."/db.class.php" );
        if ( $db->getOne( "SELECT id FROM ".$db_qq3479015851."member WHERE email = '{$getvalue}'" ) )
        {
            echo empty( $mod ) ? "很抱歉！该电子邮箱地址已经被注册！" : "success";
        }
        else
        {
            echo $mod == 1 ? "该电子邮箱帐号不存在，无法发送邮件！" : "success";
        }
    }
    else if ( $part == "chk_wxlogin" )
    {
        $actionkey = isset( $_GET['actionkey'] ) ? mhtmlspecialchars( $_GET['actionkey'] ) : "";
        require_once( QQ3479015851_DATA."/config.db.php" );
        require_once( QQ3479015851_INC."/db.class.php" );
        require_once( QQ3479015851_INC."/member.class.php" );
        if ( $row = $db->getRow( "SELECT * FROM `".$db_qq3479015851."member_wx` WHERE actionkey='{$actionkey}'" ) )
        {
            $db->query( "DELETE FROM `".$db_qq3479015851."member_wx` WHERE actionkey = '{$actionkey}'" );
            $member_log->in( $row['userid'], $row['userpwd'], "on", "noredirect" );
            echo 1;
        }
        else
        {
            echo 0;
        }
    }
    else if ( $part == "chk_remobile" )
    {
        $mod = isset( $_GET['mod'] ) ? intval( $_GET['mod'] ) : 0;
        require_once( QQ3479015851_DATA."/config.db.php" );
        @header( "Content-type: text/html; charset=".$charset );
        require_once( QQ3479015851_INC."/db.class.php" );
        if ( $db->getOne( "SELECT id FROM ".$db_qq3479015851."member WHERE mobile = '{$getvalue}'" ) )
        {
            echo empty( $mod ) ? "很抱歉！该手机号码已经被注册！" : "success";
        }
        else
        {
            echo $mod == 1 ? "该手机号码未注册会员，无法发送验证码！" : "success";
        }
    }
    else if ( $part == "advertisement" )
    {
        if ( empty( $id ) )
        {
            exit( html2js( "Invalid Id" ) );
        }
        require_once( QQ3479015851_ROOT."/data/config.db.php" );
        require_once( QQ3479015851_ROOT."/include/db.class.php" );
        if ( $code = $db->getOne( "SELECT code FROM `".$db_qq3479015851."advertisement` WHERE available > '0' AND starttime<='".$timestamp.( "' AND type = 'normalad' AND advid = '".$id."'" ) ) )
        {
            echo html2js( $code );
        }
    }
    else if ( $part == "iflogin" )
    {
        require_once( QQ3479015851_DATA."/config.db.php" );
        require_once( QQ3479015851_INC."/db.class.php" );
        require_once( QQ3479015851_INC."/member.class.php" );
        require_once( QQ3479015851_INC."/cache.fun.php" );
        $qqlogin = read_static_cache( "qqlogin" );
        $wxlogin = read_static_cache( "wxlogin" );
        $return = array( );
        if ( $qqlogin['open'] == 1 )
        {
            $return['qqlogin'] = "success";
        }
        else
        {
            $return['qqlogin'] = "error";
        }
        if ( $wxlogin['open'] == 1 )
        {
            $return['wxlogin'] = "success";
        }
        else
        {
            $return['wxlogin'] = "error";
        }
        if ( $member_log->chk_in( ) )
        {
            $return['login'] = "success";
            $return['s_uid'] = $s_uid;
        }
        else
        {
            $return['login'] = "error";
        }
        $callback = mhtmlspecialchars( $_GET['callback'] );
        echo $callback."(".json_encode( $return ).")";
        exit( );
    }
    else if ( in_array( $part, array( "information", "news", "member" ) ) )
    {
        if ( empty( $id ) )
        {
            exit( html2js( "Invalid Id" ) );
        }
        require_once( QQ3479015851_ROOT."/data/config.db.php" );
        require_once( QQ3479015851_ROOT."/include/db.class.php" );
        $db->query( "UPDATE `".$db_qq3479015851.$part.( "` SET hit = hit+1 WHERE id = '".$id."'" ) );
        $hit = $db->getOne( "SELECT hit FROM `".$db_qq3479015851.$part.( "` WHERE id = '".$id."'" ) );
        $callback = mhtmlspecialchars( $_GET['callback'] );
        echo $callback."(".json_encode( $hit ).")";
        exit( );
    }
    else if ( $part == "jswizard" )
    {
        require_once( QQ3479015851_ROOT."/data/config.db.php" );
        require_once( QQ3479015851_ROOT."/include/db.class.php" );
        echo custom( $flag, "js" );
    }
    else
    {
        exit( html2js( "Access Denied!" ) );
    }
}
unset( $part );
unset( $flag );
unset( $cachefile );
unset( $nocache );
unset( $jsrefdomains );
unset( $allowflag );
unset( $jswizard_lists );
unset( $datalist );
unset( $writedata );
unset( $inajax );
unset( $timestamp );
?>
