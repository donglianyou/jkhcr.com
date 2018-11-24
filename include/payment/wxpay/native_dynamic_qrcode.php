<?php

	include_once("WxPayPubHelper/WxPayPubHelper.php");

	$unifiedOrder = new UnifiedOrder_pub();
	
	$unifiedOrder->setParameter("body","金币充值");//商品描述
	//自定义订单号，此处仅作举例
	$timeStamp = time();

	$out_trade_no = 'wxpaycode'.$timeStamp;
	
	$total_fee = $_GET['wxtotal_fee'];
	
	
	
	if($total_fee != intval($total_fee))
	{
		echo "	<script>
				alert('充值金额必须为整数');
				window.location.href = '../../../member/index.php?m=pay';
				</script>";
		die();		
	}

	$unifiedOrder->setParameter("out_trade_no","$out_trade_no");//商户订单号 
	$unifiedOrder->setParameter("total_fee",$total_fee*100);//总金额
	$unifiedOrder->setParameter("notify_url",WxPayConf_pub::NOTIFY_URL);//通知地址 
	$unifiedOrder->setParameter("trade_type","NATIVE");//交易类型

	
	//获取统一支付接口结果
	$unifiedOrderResult = $unifiedOrder->getResult();

	$s_uid="";
	$uid=0;
	$s_uid = mgetcookie('s_uid');
	$s_uid = (isset($s_uid) ? addslashes($s_uid) : '');
	if($s_uid){
		
		$sql="select id from `{$db_qq3479015851}member` where userid='{$s_uid}'";
		$uid=$db->getOne($sql);
		unset($sql);
		
	}

	if($uid>0){
		@header("Content-Type: text/html; charset=utf-8");
		$ip=GetIP();
		$money=$total_fee*$SystemGlobalcfm_global['cfg_coin_fee'];//实际充值的金币数量比例
		$db->query("
		INSERT INTO {$db_qq3479015851}payrecord(uid,userid,orderid,money,paybz,type,payip,posttime,ifadd) 
		VALUES('$uid','$s_uid','$out_trade_no','$money','等待支付','wxcode','{$ip}',UNIX_TIMESTAMP(),'0')");
	}else{
		write_msg('没有检测到充值会员的信息,无法充值.');
	}
	
	
	
	
	
	
	
	//商户根据实际情况设置相应的处理流程
	if ($unifiedOrderResult["return_code"] == "FAIL") 
	{
		//商户自行增加处理流程
		echo "通信出错：".$unifiedOrderResult['return_msg']."<br>";
	}
	elseif($unifiedOrderResult["result_code"] == "FAIL")
	{
		//商户自行增加处理流程
		echo "错误代码：".$unifiedOrderResult['err_code']."<br>";
		echo "错误代码描述：".$unifiedOrderResult['err_code_des']."<br>";
	}
	elseif($unifiedOrderResult["code_url"] != NULL)
	{
		//从统一支付接口获取到code_url
		$code_url = $unifiedOrderResult["code_url"];
		//商户自行增加处理流程
		//......

		echo "	<script src='./native_checkresult.js' charset='GBK'></script>
				<script>
					var tempint=self.setInterval('check(\"".$out_trade_no."\")',1000)
				</script>";

	}

?>


<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>微信安全支付</title>
	<style>
	.t1{margin-left:100px;font-size: 18px;color:gray;}
	.w{padding-top: 15px;  padding-bottom: 15px;width: 990px; margin: 0 auto;}
	.w P{font-size: 15px;font-weight: 600;margin-top:5px;}
	</style>
</head>

<body style="background:none;background-color:#F1F2F7;">

	
	<div style="background-color: #fff;">
		<div class="w">
			<div id="logo">
				<img src="/logo.gif">
				<span class="t1">微信支付</span>
			</div>
		</div>
	</div>
	
	<div class="w">
		<div align="center" class="w" style="margin-bottom: 20px">
			<span style="font-weight: 700;  font-size: 16px;  float: left;margin-left:50px;">
				金币充值
			</span>
			<span style="font-size: 12px;float: left;margin-left:30px;">
				订单号：<?php echo $out_trade_no; ?>
			</span>
	        <div style="font-size: 14px;float: right;margin-right:80px;">
	        	应付金额<strong style="color:red;"><?php echo number_format($total_fee,2);?></strong>元
	        </div>
		</div>
		
		<div align="center" style="background-color: #fff;border-top: 3px solid green;padding-top:50px;">
			
			<div align="center" id="qrcode" style="margin-left:120px;float: left;">
			</div>

			<img style="margin-left:50px;margin-top:-50px;" src="/images/phone-bg.png">
		</div>
	</div>



	 
</body>
	<script src="./qrcode.js"></script>
	<script>
		if(<?php echo $unifiedOrderResult["code_url"] != NULL; ?>)
		{
			var url = "<?php echo $code_url;?>";
			//参数1表示图像大小，取值范围1-10；参数2表示质量，取值范围'L','M','Q','H'
			var qr = qrcode(10, 'M');
			qr.addData(url);
			qr.make();

			var code=document.createElement('DIV');
			code.style.border="1px solid gray";
			var img=qr.createImgTag();
			img=img.replace('130','300');
			img=img.replace('130','300');
			code.innerHTML = img;
			var element=document.getElementById("qrcode");
			element.appendChild(code);
			
			var wording=document.createElement('p');
			wording.innerHTML = "请使用微信扫一扫";
			element.appendChild(wording);
			
			var wording1=document.createElement('p');
			wording1.innerHTML = "扫描二维码支付";
			element.appendChild(wording1);
		}
	</script>
		
</html>