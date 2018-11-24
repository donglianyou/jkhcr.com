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
 function getOrderNo(){
    global $timestamp;
    return rand(11, 99) . $timestamp . rand(11, 99);
}
function WechatReturnSuccess(){
    echo '<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
    exit();
}
function get_url_contents($zym_8){
    $zym_6 = curl_init();
    curl_setopt($zym_6, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($zym_6, CURLOPT_URL, $zym_8);
    curl_setopt($zym_6, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($zym_6, CURLOPT_SSL_VERIFYHOST, false);
    $zym_5 = curl_exec($zym_6);
    curl_close($zym_6);
    return $zym_5;
}
function getAccessTokenByCode($zym_1 = '', $zym_2 = '', $zym_3 = ''){
    $zym_8 = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $zym_2 . '&secret=' . $zym_3 . '&code=' . $zym_1 . '&grant_type=authorization_code';
    return json_decode(get_url_contents($zym_8), true);
}
function getBaseAccessToken($zym_2 = '', $zym_3 = ''){
    $zym_8 = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $zym_2 . '&secret=' . $zym_3;
    $zym_4 = json_decode(get_url_contents($zym_8), true);
    if (isset($zym_4['access_token']) && isset($zym_4['expires_in'])){
        return $zym_4['access_token'];
    }else{
        return false;
    }
}
?>