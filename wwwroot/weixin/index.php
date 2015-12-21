<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/21 0021
 * Time: 20:14
*/
include("../../vendor/autoload.php");
include("../../Lib/Wechat/Wechat.php");             //
//---------------------------------------------------

$weObj = new Wechat([
    'token'=>'3351161315', //填写你设定的key
    'debug'=>true,
    'logcallback'=>function ($text){
        file_put_contents('../log.txt',$text."\n",FILE_APPEND);
    }
]);

//-----------------------------------------------------
$weObj->valid();
$type = $weObj->getRev()->getRevType();



switch($type) {
    case Wechat::MSGTYPE_TEXT:
        //接收文字信息,并且进行反馈
        /**
        'token'=>'3351161315',	//填写应用接口的Token
        'encodingaeskey'=>'d27a525edce19ea134652b76ef9de54e',//填写加密用的EncodingAESKey
        'appid'=>'wx1b69d3d01a93be52',	//填写高级调用功能的appid
        */
        $vs = $weObj->getRevContent();
        $weObj->text($vs)->reply();
        exit;
        //返回
        //$weObj->text("hello, I'm wechat")->reply();
        exit;
        break;
    case Wechat::MSGTYPE_EVENT:

        break;
    case Wechat::MSGTYPE_IMAGE:

        break;
    default:

        $weObj->text("help info")->reply();

}



