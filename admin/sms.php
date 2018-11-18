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
 define('CURSCRIPT', 'sms');
require_once dirname(__FILE__) . '/global.php';
require_once QQ3479015851_INC . '/db.class.php';
(!in_array($part, array('setting', 'sendlist')) || !$part) && $part = 'setting';
if(!submit_check(CURSCRIPT . '_submit')){
    switch($part){
    case 'setting': chk_admin_purview('purview_短信接口');
        $here = '短信供应商设置';
        $res = $db -> query("SELECT description,value FROM {$db_qq3479015851}config WHERE type='sms'");
        while($row = $db -> fetchRow($res)){
            $sms_config[$row['description']] = $row['value'];
        }
        break;
    case 'sendlist': chk_admin_purview('purview_短信发送记录');
        $here = 'M_ymps短信发送记录';
        $sql = "SELECT * FROM `{$db_qq3479015851}sms_sendlist` ORDER BY id DESC";
        $rows_num = qq3479015851_count('sms_sendlist');
        $param = setParam(array('part'));
        $list = page1($sql);
        break;
    default: break;
    }
    include(qq3479015851_tpl(CURSCRIPT . '_' . $part));
}else{
    if($part == 'setting'){
        $des = array('sms_user', 'sms_pwd', 'sms_service', 'sms_regtpl', 'sms_pwdtpl');
        qq3479015851_delete('config', 'WHERE type = \'sms\'');
        foreach($des as $key){
            $db -> query("INSERT {$db_qq3479015851}config (description,value,type) VALUES ('$key','" . trim(${$key}) . '\',\'sms\')');
        }
        clear_cache_files('sms_config');
        write_msg('短信配置设置成功！', '?part=' . $part, 'WriteRecord');
    }elseif($part == 'sendlist'){
        $return_url = '?part=sendlist';
        if(is_array($delids)){
            foreach ($delids as $kids => $vids){
                qq3479015851_delete('sms_sendlist', 'WHERE id = ' . $vids);
            }
        }
        write_msg('成功删除短信发送记录！', $return_url, 'write_record');
    }elseif($part == 'template'){
    }
}
is_object($db) && $db -> Close();
$qq3479015851_global = $db = $db_qq3479015851 = $part = NULL;
?>