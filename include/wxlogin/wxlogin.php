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
 define('WXLOGIN', 1);
$actionkey = isset($_GET['actionkey']) ? trim(htmlspecialchars($_GET['actionkey'])) : '';
$data = '';
@include('../../data/caches/wxlogin.php');
$appid = $data['appid'];
$appsecret = $data['appsecret'];
$callback = $data['callback'] . '?actionkey=' . $actionkey;
$scope = 'snsapi_userinfo';
$state = 'qq3479015851';
wx_login($appid, $scope, $state, $callback);
function wx_login($zym_5, $zym_4, $zym_1, $zym_2){
    $zym_3 = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $zym_5 . '&redirect_uri=' . urlencode($zym_2) . '&response_type=code' . '&scope=' . $zym_4 . '&state=' . $zym_1 . '&connect_redirect=1#wechat_redirect';
    header("Location:$zym_3");
}
?>