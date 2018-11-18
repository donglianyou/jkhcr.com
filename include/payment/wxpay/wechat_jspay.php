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
!(defined('QQ3479015851')) && exit('ACCESS DENIED!');
class wechat_jspay
{
	protected $attach;
	protected $body;
	protected $nonce_str;
	protected $out_trade_no;
	protected $total_fee;
	protected $trade_type;
	protected $notify_url;

	public function __construct($config = NULL)
	{
		$this->attach = $this->getRand(10) . time();
		$this->body = $config['title'];
		$this->nonce_str = $this->getRand(32);
		$this->out_trade_no = $config['code'];
		$this->total_fee = $config['money'];
		$this->trade_type = 'JSAPI';
		$this->notify_url = $config['NotifyUrl'];
		$this->openid = $config['openid'];
		$this->appid = $config['appid'];
		$this->appsecret = $config['appsecret'];
		$this->payuser = $config['payuser'];
		$this->paykey = $config['paykey'];
	}

	public function getRand($length = 4)
	{
		$length = ($length < 1 ? 1 : $length);
		$source = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$arr = str_split($source);
		$rand_str = '';
		$rand_count = count($arr) - 1;

		for ($i = 0; $i < $length; $i++) {
			$rand_str .= $arr[rand(0, $rand_count)];
		}

		return strtoupper($rand_str);
	}

	public function sendPay()
	{
		require_once 'wechat_jspay_unifiedorder.php';
		$conf['appid'] = $this->appid;
		$conf['payuser'] = $this->payuser;
		$conf['paykey'] = $this->paykey;
		$unifiedorder = new wechat_jspay_unifiedorder($conf);
		$data = $unifiedorder->requestOrder($this->attach, $this->body, $this->nonce_str, $this->out_trade_no, $this->total_fee, $this->trade_type, $this->notify_url, $this->openid);
		$xml = simplexml_load_string($data);
		if (($xml->return_code == 'SUCCESS') && ($xml->result_code == 'SUCCESS')) {
			$appId = $this->appid;
			$timestamp = time();
			$noncestr = $this->nonce_str;
			$package = 'prepay_id=' . $xml->prepay_id;
			$signType = 'MD5';
			$params = array('appId' => $appId, 'timeStamp' => $timestamp, 'nonceStr' => $noncestr, 'package' => $package, 'signType' => $signType);
			$params['paySign'] = $this->getPaySign(array('appId' => $params['appId'], 'timeStamp' => $params['timeStamp'], 'nonceStr' => $params['nonceStr'], 'package' => $params['package'], 'signType' => $params['signType']));
			return $params;
		}
		else {
			return false;
		}
	}

	protected function getJsapiTicket()
	{
		$url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=' . getBaseAccessToken($this->appid, $this->appsecret) . '&type=jsapi';
		$data = json_decode(get_url_contents($url), true);
		if (isset($data['errcode']) && (intval($data['errcode']) === 0)) {
			return $data['ticket'];
		}
		else {
			return false;
		}
	}

	protected function getPaySign($params)
	{
		$string = $this->getSignString($params);
		return md5($string . '&key=' . $this->paykey);
	}

	protected function getSignString($params)
	{
		ksort($params);
		$new_params = array();

		foreach ($params as $key => $val ) {
			array_push($new_params, $key . '=' . $val);
		}

		return implode('&', $new_params);
	}
}


?>
