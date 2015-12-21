<?php
include("../../wechat-php-sdk-master/qywechat.class.php");
function logg($text){
	file_put_contents('./log.txt',$text."\r\n\r\n",FILE_APPEND);
};

$options = array(
	'token'=>'3351161315',	//填写应用接口的Token
	'encodingaeskey'=>'d27a525edce19ea134652b76ef9de54e',//填写加密用的EncodingAESKey
	'appid'=>'wx1b69d3d01a93be52',	//填写高级调用功能的appid
	'debug'=>true,
	'logcallback'=>'logg'

);
logg("GET参数为：\n".var_export($_GET,true));
$weObj = new Wechat($options);
$ret=$weObj->valid();
$f = $weObj->getRev()->getRevFrom();
$t = $weObj->getRevType();

$weObj->text("hello, I'm wechat")->reply();
exit;


if (!$ret) {
	logg("验证失败！");
	var_dump($ret);
	exit;
}



exit;


$d = $weObj->getRevData();
$weObj->text("你好！来自星星的：".$f."\n你发送的".$t."类型信息：\n原始信息如下：\n".var_export($d,true))->reply();
logg("-----------------------------------------");
?>