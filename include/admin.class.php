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
!defined('SysGlbCfm') && exit('FORBIDDEN');
class qq3479015851_admin_log
{
	var $db_mixcode;

    function __construct($db_mixcode)
    {
		$this->db_mixcode=$db_mixcode;
    }

    function qq3479015851_member_log($db_mixcode)
    {
		$this->__construct($db_mixcode);
    }
	
	function PutLogin($admin_id,$admin_name,$admin_cityid='')
	{
		session_start();
		$_SESSION['admin_id']  = $admin_id;
		$_SESSION['admin_name'] = $admin_name;
		$_SESSION['admin_cityid'] = $admin_cityid;
	}
	
	/*admin_login*/
	function qq3479015851_admin_login($admin_id,$admin_name,$admin_cityid)
	{
		global $admin_id,$admin_name,$admin_cityid;
		if(!empty($admin_id)&&!empty($admin_name)){
			$this->PutLogin($admin_id,$admin_name,$admin_cityid);
		}
	}
	
	/*admin_out*/
	function qq3479015851_admin_logout()
	{

		session_start();
		session_unset();
		session_destroy();

	}
	
	/*chk admin login and get the info of admin*/
	function qq3479015851_admin_chk_getinfo()
	{
		session_start();
		global $admin_id,$admin_name,$admin_cityid,$url;

		if(empty($_SESSION['admin_name'])||empty($_SESSION['admin_id']))
		{
			$this -> qq3479015851_admin_logout();
			return false;
		}
		else
		{
			$admin_id 	= $_SESSION['admin_id'];
			$admin_name = $_SESSION['admin_name'];
			$admin_cityid = $_SESSION['admin_cityid'];
			return true;
		}
	}
}

$SystemGlobalcfm_admin = new qq3479015851_admin_log($db_mixcode);
?>