<?php
include("../../wechat-php-sdk-master/qywechat.class.php");
function logg($text){
	file_put_contents('./log.txt',$text."\r\n\r\n",FILE_APPEND);
};

$options = array(
	'token'=>'3351161315',	//��дӦ�ýӿڵ�Token
	'encodingaeskey'=>'d27a525edce19ea134652b76ef9de54e',//��д�����õ�EncodingAESKey
	'appid'=>'wx1b69d3d01a93be52',	//��д�߼����ù��ܵ�appid
	'debug'=>true,
	'logcallback'=>'logg'

);
logg("GET����Ϊ��\n".var_export($_GET,true));
$weObj = new Wechat($options);
$ret=$weObj->valid();
$f = $weObj->getRev()->getRevFrom();
$t = $weObj->getRevType();

$weObj->text("hello, I'm wechat")->reply();
exit;


if (!$ret) {
	logg("��֤ʧ�ܣ�");
	var_dump($ret);
	exit;
}



exit;


$d = $weObj->getRevData();
$weObj->text("��ã��������ǵģ�".$f."\n�㷢�͵�".$t."������Ϣ��\nԭʼ��Ϣ���£�\n".var_export($d,true))->reply();
logg("-----------------------------------------");
?>