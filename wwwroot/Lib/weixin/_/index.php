<?php
/**
 * 微信公共接口测试
 */
include("../../wechat-php-sdk-master/wechat.class.php");

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

/*
被动
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

主动
    checkAuth($appid,$appsecret,$token) 此处传入公众后台高级接口提供的appid和appsecret, 或者手动指定$token为access_token。函数将返回access_token操作令牌
    resetAuth($appid='') 删除验证数据
    resetJsTicket($appid='') 删除JSAPI授权TICKET
    getJsTicket($appid='',$jsapi_ticket='') 获取JSAPI授权TICKET
    getJsSign($url, $timestamp=0, $noncestr='', $appid='') 获取JsApi使用签名信息数组，可只提供url地址
    createMenu($data) 创建菜单 $data菜单结构详见 自定义菜单创建接口
    getServerIp() 获取微信服务器IP地址列表 返回数组array('127.0.0.1','127.0.0.1')
    getMenu() 获取菜单
    deleteMenu() 删除菜单
    uploadMedia($data, $type) 上传临时素材，有效期为3天(注意上传大文件时可能需要先调用 set_time_limit(0) 避免超时)
    getMedia($media_id,$is_video=false) 获取临时素材（含接收到的音频、视频媒体文件）
    uploadForeverMedia($data, $type,$is_video=false,$video_info=array()) 上传永久素材，可以在公众平台官网素材管理模块中看到
    uploadForeverArticles($data) 上传永久图文素材
    updateForeverArticles($media_id,$data,$index=0) 修改永久图文素材(认证后的订阅号可用)
    getForeverMedia($media_id,$is_video=false) 获取永久素材
    delForeverMedia($media_id) 删除永久素材
    getForeverList($type,$offset,$count) 获取永久素材列表(认证后的订阅号可用)
    getForeverCount() 获取永久素材总数
    uploadMpVideo($data) 上传视频素材，当需要群发视频时，必须使用此方法得到的MediaID，否则无法显示
    uploadArticles($data) 上传图文消息素材
    sendMassMessage($data) 高级群发消息
    sendGroupMassMessage($data) 高级群发消息（全体或分组群发）
    deleteMassMessage($msg_id) 删除群发图文消息
    previewMassMessage($data) 预览群发消息
    queryMassMessage($msg_id) 查询群发消息发送状态
    getQRCode($scene_id,$type=0,$expire=1800) 获取推广二维码ticket字串
    getQRUrl($ticket) 获取二维码图片地址
    getShortUrl($long_url) 长链接转短链接接口
    getUserList($next_openid) 批量获取关注用户列表
    getUserInfo($openid) 获取关注者详细信息
    updateUserRemark($openid,$remark) 设置用户备注名
    getGroup() 获取用户分组列表
    getUserGroup($openid) 获取用户所在分组
    createGroup($name) 新增自定分组
    updateGroup($groupid,$name) 更改分组名称
    updateGroupMembers($groupid,$openid) 移动用户分组
    batchUpdateGroupMembers($groupid,$openid_list) 批量移动用户分组
    sendCustomMessage($data) 发送客服消息
    getOauthRedirect($callback,$state,$scope) 获取网页授权oAuth跳转地址
    getOauthAccessToken() 通过回调的code获取网页授权access_token
    getOauthRefreshToken($refresh_token) 通过refresh_token对access_token续期
    getOauthUserinfo($access_token,$openid) 通过网页授权的access_token获取用户资料
    getOauthAuth($access_token,$openid) 检验授权凭证access_token是否有效
    getSignature($arrdata,'sha1') 生成签名字串
    generateNonceStr($length=16) 获取随机字串
    setTMIndustry($id1,$id2='') 模板消息，设置所属行业
    addTemplateMessage($tpl_id) 模板消息，添加消息模板
    sendTemplateMessage($data) 发送模板消息

    多客服接口：
    getCustomServiceMessage($data) 获取多客服会话记录
    transfer_customer_service($customer_account) 转发多客服消息
    getCustomServiceKFlist() 获取多客服客服基本信息
    getCustomServiceOnlineKFlist() 获取多客服在线客服接待信息
    createKFSession($openid,$kf_account,$text='') 创建指定多客服会话
    closeKFSession($openid,$kf_account,$text='') 关闭指定多客服会话
    getKFSession($openid) 获取用户会话状态
    getKFSessionlist($kf_account) 获取指定客服的会话列表
    getKFSessionWait() 获取未接入会话列表
    addKFAccount($account,$nickname,$password) 添加客服账号
    updateKFAccount($account,$nickname,$password) 修改客服账号信息
    deleteKFAccount($account) 删除客服账号
    setKFHeadImg($account,$imgfile) 上传客服头像
    querySemantic($uid,$query,$category,$latitude=0,$longitude=0,$city="",$region="") 语义理解接口 参数含义及返回的json内容请查看 微信语义理解接口
    getDatacube($type,$subtype,$begin_date,$end_date='') 获取统计数据 参数需注意$type与$subtype的定义

        获取统计数据方法 参数定义
        数据分类 	$type值(字符串) 	数据子分类 	$subtype值(字符串) 	时间跨度(天)
        用户分析 	'user' 	获取用户增减数据 	'summary' 	7
        用户分析 	'user' 	获取累计用户数据 	'cumulate' 	7
        图文分析 	'article' 	获取图文群发每日数据 	'summary' 	1
        图文分析 	'article' 	获取图文群发总数据 	'total' 	1
        图文分析 	'article' 	获取图文统计数据 	'read' 	3
        图文分析 	'article' 	获取图文统计分时数据 	'readhour' 	1
        图文分析 	'article' 	获取图文分享转发数据 	'share' 	7
        图文分析 	'article' 	获取图文分享转发分时数据 	'sharehour' 	1
        消息分析 	'upstreammsg' 	获取消息发送概况数据 	'summary' 	7
        消息分析 	'upstreammsg' 	获取消息分送分时数据 	'hour' 	1
        消息分析 	'upstreammsg' 	获取消息发送周数据 	'week' 	30
        消息分析 	'upstreammsg' 	获取消息发送月数据 	'month' 	30
        消息分析 	'upstreammsg' 	获取消息发送分布数据 	'dist' 	15
        消息分析 	'upstreammsg' 	获取消息发送分布周数据 	'distweek' 	30
        消息分析 	'upstreammsg' 	获取消息发送分布月数据 	'distmonth' 	30
        接口分析 	'interface' 	获取接口分析数据 	'summary' 	30
        接口分析 	'interface' 	获取接口分析分时数据 	'summaryhour' 	1

        需要注意 begin_date和end_date的差值需小于“最大时间跨度”（比如最大时间跨度为1时，begin_date和end_date的差值只能为0，才能小于1）

    卡券接口：
    createCard($data) 创建卡券
    updateCard($data) 修改卡券
    delCard($card_id) 删除卡券
    getCardInfo($card_id) 查询卡券详情
    getCardColors() 获取颜色列表
    getCardLocations() 拉取门店列表
    addCardLocations($data) 批量导入门店信息
    createCardQrcode($card_id) 生成卡券二维码
    consumeCardCode($code) 消耗 code
    decryptCardCode($encrypt_code) code 解码
    checkCardCode($code) 获取 code 的有效性
    getCardIdList($data) 批量查询卡列表
    updateCardCode($code,$card_id,$new_code) 更改 code
    unavailableCardCode($code,$card_id='') 设置卡券失效(不可逆)
    modifyCardStock($data) 库存修改
    activateMemberCard($data) 激活/绑定会员卡，参数结构请参看卡券开发文档(6.1.1 激活/绑定会员卡)章节
    updateMemberCard($data) 会员卡交易，参数结构请参看卡券开发文档(6.1.2 会员卡交易)章节
    updateLuckyMoney($code,$balance,$card_id='') 更新红包金额
    setCardTestWhiteList($openid=array(),$user=array()) 设置卡券测试白名单

    摇一摇周边接口：
    applyShakeAroundDevice($data) 申请设备ID
    updateShakeAroundDevice($data) 编辑设备的备注信息
    searchShakeAroundDevice($data) 查询设备列表
    bindLocationShakeAroundDevice($device_id,$poi_id,$uuid='',$major=0,$minor=0) 配置设备与门店的关联关系
    bindPageShakeAroundDevice($device_id,$page_ids=array(),$bind=1,$append=1,$uuid='',$major=0,$minor=0) 配置设备与页面的关联关系
    uploadShakeAroundMedia($data) 上传在摇一摇页面展示的图片素材
    addShakeAroundPage($title,$description,$icon_url,$page_url,$comment='') 新增摇一摇出来的页面信息
    updateShakeAroundPage($page_id,$title,$description,$icon_url,$page_url,$comment='') 编辑摇一摇出来的页面信息
    searchShakeAroundPage($page_ids=array(),$begin=0,$count=1) 查询摇一摇已有的页面
    deleteShakeAroundPage($page_ids=array()) 删除摇一摇已有的页面，必须是未与设备关联的页面
    getShakeInfoShakeAroundUser($ticket) 获取摇周边的设备及用户信息
    deviceShakeAroundStatistics($device_id,$begin_date,$end_date,$uuid='',$major=0,$minor=0) 以设备为维度的数据统计接口
    pageShakeAroundStatistics($page_id,$begin_date,$end_date) 以页面为维度的数据统计接口

 * */


switch($type) {
	case Wechat::MSGTYPE_TEXT:

        /**
         * 接收什么,返回什么
         * 	'token'=>'3351161315',	//填写应用接口的Token
        'encodingaeskey'=>'d27a525edce19ea134652b76ef9de54e',//填写加密用的EncodingAESKey
        'appid'=>'wx1b69d3d01a93be52',	//填写高级调用功能的appid
        */
//        $appid      = 'wx1b69d3d01a93be52';
//        $appsecret  = 'd27a525edce19ea134652b76ef9de54e';
//        $token      = '3351161315';
        //$vs = $weObj->getRevContent();
        $vs = $weObj->getForeverCount();
        //$vs = $weObj->checkAuth($appid,$appsecret,$token);        返回数据为 3351161315



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



