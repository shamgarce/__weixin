<?php
/**
 * 微信公共接口测试
 */
include("../../wechat-php-sdk-master/wechat.class.php");


/*
* 接收反馈消息开始
*/

function logdebug($text){
	file_put_contents('../log.txt',$text."\n",FILE_APPEND);
};
$options = array(
	'token'=>'3351161315', //填写你设定的key
	'debug'=>true,
	'logcallback'=>'logdebug'
);
$weObj = new Wechat($options);
//-----------------------------------------------------

$weObj->valid();
$type = $weObj->getRev()->getRevType();

/*

    valid() 验证连接，被动接口处于加密模式时必须调用
    getRev() 获取微信服务器发来信息(不返回结果)，被动接口必须调用
    getRevData() 返回微信服务器发来的信息（数组）
    getRevFrom() 返回消息发送者的userid
    getRevTo() 返回消息接收者的id（即公众号id）
    getRevType() 返回接收消息的类型
    getRevID() 返回消息id
    getRevCtime() 返回消息发送时间
    getRevContent() 返回消息内容正文或语音识别结果（文本型）
    getRevPic() 返回图片信息（图片型信息） 返回数组{'mediaid'=>'','picurl'=>''}
    getRevLink() 接收消息链接（链接型信息） 返回数组{'url'=>'','title'=>'','description'=>''}
    getRevGeo() 返回地理位置（位置型信息） 返回数组{'x'=>'','y'=>'','scale'=>'','label'=>''}
    getRevEventGeo() 返回事件地理位置（事件型信息） 返回数组{'x'=>'','y'=>'','precision'=>''}
    getRevEvent() 返回事件类型（事件型信息） 返回数组{'event'=>'','key'=>''}
    getRevScanInfo() 获取自定义菜单的扫码推事件信息，事件类型为scancode_push或scancode_waitmsg 返回数组array ('ScanType'=>'qrcode','ScanResult'=>'123123')
    getRevSendPicsInfo() 获取自定义菜单的图片发送事件信息,事件类型为pic_sysphoto或pic_photo_or_album或pic_weixin 数组结构见php文件内方法说明
    getRevSendGeoInfo() 获取自定义菜单的地理位置选择器事件推送，事件类型为location_select 数组结构见php文件内方法说明
    getRevVoice() 返回语音信息（语音型信息） 返回数组{'mediaid'=>'','format'=>''}
    getRevVideo() 返回视频信息（视频型信息） 返回数组{'mediaid'=>'','thumbmediaid'=>''}
    getRevTicket() 返回接收TICKET（扫描带参数二维码,关注或SCAN事件） 返回二维码的ticket值
    getRevSceneId() 返回二维码的场景值（扫描带参数二维码的关注事件） 返回二维码的参数值
    getRevTplMsgID() 返回主动推送的消息ID（群发或模板消息事件） 返回MsgID值
    getRevStatus() 返回模板消息发送状态（模板消息事件） 返回文本：success(成功)|failed:user block(用户拒绝接收)|failed: system failed(发送失败（非用户拒绝）)
    getRevResult() 返回群发或模板消息发送结果（群发或模板消息事件） 返回数组，内容依事件类型而不同，参考开发文档中群发、模板消息推送事件
    getRevKFCreate() 返回多客服-接入会话的客服账号（多客服-接入会话事件） 返回文本型
    getRevKFClose() 返回多客服-处理会话的客服账号（多客服-接入会话事件） 返回文本型
    getRevKFSwitch() 返回多客服-转接会话信息（多客服-转接会话事件） 返回数组 {'FromKfAccount' => '','ToKfAccount' => ''}
    getRevCardPass() 返回卡券-审核通过的卡券ID（卡券-卡券审核事件） 返回文本型
    getRevCardGet() 返回卡券-用户领取卡券的相关信息（卡券-领取卡券事件） 返回数组{'CardId' => '','IsGiveByFriend' => '','UserCardCode' => ''}
    getRevCardDel() 返回卡券-用户删除卡券的相关信息（卡券-删除卡券事件） 返回数组{'CardId' => '','UserCardCode' => ''}
    text($text) 设置文本型消息，参数：文本内容
    image($mediaid) 设置图片型消息，参数：图片的media_id
    voice($mediaid) 设置语音型消息，参数：语音的media_id
    video($mediaid='',$title,$description) 设置视频型消息，参数：视频的media_id、标题、摘要
    music($title,$desc,$musicurl,$hgmusicurl='',$thumbmediaid='') 设置回复音乐，参数：音乐标题、音乐描述、音乐链接、高音质链接、缩略图的媒体id
    news($newsData) 设置图文型消息，参数：数组。数组结构见php文件内方法说明
    Message($msg = '',$append = false) 设置发送的消息（一般不需要调用这个方法）
    transfer_customer_service($customer_account = '') 转接多客服，如不指定客服可不提供参数，参数：指定客服的账号
    reply() 将以上已经设置好的消息，回复给微信服务器

 * */
switch($type) {
	case Wechat::MSGTYPE_TEXT:

		$weObj->text("hello, I'm wechat")->reply();

		exit;
		break;
	case Wechat::MSGTYPE_EVENT:

		break;
	case Wechat::MSGTYPE_IMAGE:

		break;
	default:

		$weObj->text("help info")->reply();

}



