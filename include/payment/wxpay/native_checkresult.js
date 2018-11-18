var XMLHttpReq;  
function createXMLHttpRequest() {  
    try {  
        XMLHttpReq = new ActiveXObject("Msxml2.XMLHTTP");//IE高版本创建XMLHTTP  
    }  
    catch(E) {  
        try {  
            XMLHttpReq = new ActiveXObject("Microsoft.XMLHTTP");//IE低版本创建XMLHTTP  
        }  
        catch(E) {  
            XMLHttpReq = new XMLHttpRequest();//兼容非IE浏览器，直接创建XMLHTTP对象  
        }  
    }  
  
}  
function sendAjaxRequest(url) {  
    createXMLHttpRequest();                                //创建XMLHttpRequest对象  
    XMLHttpReq.open("post", url, true);  
    XMLHttpReq.onreadystatechange = processResponse; //指定响应函数  
    XMLHttpReq.send(null);  
}  
//回调函数  
function processResponse() {  
    if (XMLHttpReq.readyState == 4) {  
        if (XMLHttpReq.status == 200) {  
            var text = XMLHttpReq.responseText; 
            if(text == 'true' )
            {
            	tempint=window.clearInterval(tempint);
            	alert("您已成功充值金币。");
				window.location.href = "../../../member/index.php?m=pay&ac=record";
            }
        }  
    }  
} 

function check(out_trade_no)
{
	//console.log("../../../include/payment/wxpay/native_checkresult.php?out_trade_no="+out_trade_no);
	sendAjaxRequest("../../../include/payment/wxpay/native_checkresult.php?out_trade_no="+out_trade_no);		
}

