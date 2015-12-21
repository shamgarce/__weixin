<?php
/**
 * ΢�Ź����ӿڲ���
 */
include("../../wechat-php-sdk-master/wechat.class.php");

$weObj = new Wechat([
    'token'=>'3351161315', //��д���趨��key
    'debug'=>true,
    'logcallback'=>function ($text){
        file_put_contents('../log.txt',$text."\n",FILE_APPEND);
    }
]);
//-----------------------------------------------------
$weObj->valid();
$type = $weObj->getRev()->getRevType();

/*
����
    valid() ��֤���ӣ������ӿڴ��ڼ���ģʽʱ�������
    getRev() ��ȡ΢�ŷ�����������Ϣ(�����ؽ��)�������ӿڱ������
    getRevData() ����΢�ŷ�������������Ϣ�����飩
    getRevFrom() ������Ϣ�����ߵ�userid
    getRevTo() ������Ϣ�����ߵ�id�������ں�id��
    getRevType() ���ؽ�����Ϣ������
    getRevID() ������Ϣid
    getRevCtime() ������Ϣ����ʱ��
    getRevContent() ������Ϣ�������Ļ�����ʶ�������ı��ͣ�
    getRevPic() ����ͼƬ��Ϣ��ͼƬ����Ϣ�� ��������{'mediaid'=>'','picurl'=>''}
    getRevLink() ������Ϣ���ӣ���������Ϣ�� ��������{'url'=>'','title'=>'','description'=>''}
    getRevGeo() ���ص���λ�ã�λ������Ϣ�� ��������{'x'=>'','y'=>'','scale'=>'','label'=>''}
    getRevEventGeo() �����¼�����λ�ã��¼�����Ϣ�� ��������{'x'=>'','y'=>'','precision'=>''}
    getRevEvent() �����¼����ͣ��¼�����Ϣ�� ��������{'event'=>'','key'=>''}
    getRevScanInfo() ��ȡ�Զ���˵���ɨ�����¼���Ϣ���¼�����Ϊscancode_push��scancode_waitmsg ��������array ('ScanType'=>'qrcode','ScanResult'=>'123123')
    getRevSendPicsInfo() ��ȡ�Զ���˵���ͼƬ�����¼���Ϣ,�¼�����Ϊpic_sysphoto��pic_photo_or_album��pic_weixin ����ṹ��php�ļ��ڷ���˵��
    getRevSendGeoInfo() ��ȡ�Զ���˵��ĵ���λ��ѡ�����¼����ͣ��¼�����Ϊlocation_select ����ṹ��php�ļ��ڷ���˵��
    getRevVoice() ����������Ϣ����������Ϣ�� ��������{'mediaid'=>'','format'=>''}
    getRevVideo() ������Ƶ��Ϣ����Ƶ����Ϣ�� ��������{'mediaid'=>'','thumbmediaid'=>''}
    getRevTicket() ���ؽ���TICKET��ɨ���������ά��,��ע��SCAN�¼��� ���ض�ά���ticketֵ
    getRevSceneId() ���ض�ά��ĳ���ֵ��ɨ���������ά��Ĺ�ע�¼��� ���ض�ά��Ĳ���ֵ
    getRevTplMsgID() �����������͵���ϢID��Ⱥ����ģ����Ϣ�¼��� ����MsgIDֵ
    getRevStatus() ����ģ����Ϣ����״̬��ģ����Ϣ�¼��� �����ı���success(�ɹ�)|failed:user block(�û��ܾ�����)|failed: system failed(����ʧ�ܣ����û��ܾ���)
    getRevResult() ����Ⱥ����ģ����Ϣ���ͽ����Ⱥ����ģ����Ϣ�¼��� �������飬�������¼����Ͷ���ͬ���ο������ĵ���Ⱥ����ģ����Ϣ�����¼�
    getRevKFCreate() ���ض�ͷ�-����Ự�Ŀͷ��˺ţ���ͷ�-����Ự�¼��� �����ı���
    getRevKFClose() ���ض�ͷ�-����Ự�Ŀͷ��˺ţ���ͷ�-����Ự�¼��� �����ı���
    getRevKFSwitch() ���ض�ͷ�-ת�ӻỰ��Ϣ����ͷ�-ת�ӻỰ�¼��� �������� {'FromKfAccount' => '','ToKfAccount' => ''}
    getRevCardPass() ���ؿ�ȯ-���ͨ���Ŀ�ȯID����ȯ-��ȯ����¼��� �����ı���
    getRevCardGet() ���ؿ�ȯ-�û���ȡ��ȯ�������Ϣ����ȯ-��ȡ��ȯ�¼��� ��������{'CardId' => '','IsGiveByFriend' => '','UserCardCode' => ''}
    getRevCardDel() ���ؿ�ȯ-�û�ɾ����ȯ�������Ϣ����ȯ-ɾ����ȯ�¼��� ��������{'CardId' => '','UserCardCode' => ''}
    text($text) �����ı�����Ϣ���������ı�����
    image($mediaid) ����ͼƬ����Ϣ��������ͼƬ��media_id
    voice($mediaid) ������������Ϣ��������������media_id
    video($mediaid='',$title,$description) ������Ƶ����Ϣ����������Ƶ��media_id�����⡢ժҪ
    music($title,$desc,$musicurl,$hgmusicurl='',$thumbmediaid='') ���ûظ����֣����������ֱ��⡢�����������������ӡ����������ӡ�����ͼ��ý��id
    news($newsData) ����ͼ������Ϣ�����������顣����ṹ��php�ļ��ڷ���˵��
    Message($msg = '',$append = false) ���÷��͵���Ϣ��һ�㲻��Ҫ�������������
    transfer_customer_service($customer_account = '') ת�Ӷ�ͷ����粻ָ���ͷ��ɲ��ṩ������������ָ���ͷ����˺�
    reply() �������Ѿ����úõ���Ϣ���ظ���΢�ŷ�����

����
    checkAuth($appid,$appsecret,$token) �˴����빫�ں�̨�߼��ӿ��ṩ��appid��appsecret, �����ֶ�ָ��$tokenΪaccess_token������������access_token��������
    resetAuth($appid='') ɾ����֤����
    resetJsTicket($appid='') ɾ��JSAPI��ȨTICKET
    getJsTicket($appid='',$jsapi_ticket='') ��ȡJSAPI��ȨTICKET
    getJsSign($url, $timestamp=0, $noncestr='', $appid='') ��ȡJsApiʹ��ǩ����Ϣ���飬��ֻ�ṩurl��ַ
    createMenu($data) �����˵� $data�˵��ṹ��� �Զ���˵������ӿ�
    getServerIp() ��ȡ΢�ŷ�����IP��ַ�б� ��������array('127.0.0.1','127.0.0.1')
    getMenu() ��ȡ�˵�
    deleteMenu() ɾ���˵�
    uploadMedia($data, $type) �ϴ���ʱ�زģ���Ч��Ϊ3��(ע���ϴ����ļ�ʱ������Ҫ�ȵ��� set_time_limit(0) ���ⳬʱ)
    getMedia($media_id,$is_video=false) ��ȡ��ʱ�زģ������յ�����Ƶ����Ƶý���ļ���
    uploadForeverMedia($data, $type,$is_video=false,$video_info=array()) �ϴ������زģ������ڹ���ƽ̨�����زĹ���ģ���п���
    uploadForeverArticles($data) �ϴ�����ͼ���ز�
    updateForeverArticles($media_id,$data,$index=0) �޸�����ͼ���ز�(��֤��Ķ��ĺſ���)
    getForeverMedia($media_id,$is_video=false) ��ȡ�����ز�
    delForeverMedia($media_id) ɾ�������ز�
    getForeverList($type,$offset,$count) ��ȡ�����ز��б�(��֤��Ķ��ĺſ���)
    getForeverCount() ��ȡ�����ز�����
    uploadMpVideo($data) �ϴ���Ƶ�زģ�����ҪȺ����Ƶʱ������ʹ�ô˷����õ���MediaID�������޷���ʾ
    uploadArticles($data) �ϴ�ͼ����Ϣ�ز�
    sendMassMessage($data) �߼�Ⱥ����Ϣ
    sendGroupMassMessage($data) �߼�Ⱥ����Ϣ��ȫ������Ⱥ����
    deleteMassMessage($msg_id) ɾ��Ⱥ��ͼ����Ϣ
    previewMassMessage($data) Ԥ��Ⱥ����Ϣ
    queryMassMessage($msg_id) ��ѯȺ����Ϣ����״̬
    getQRCode($scene_id,$type=0,$expire=1800) ��ȡ�ƹ��ά��ticket�ִ�
    getQRUrl($ticket) ��ȡ��ά��ͼƬ��ַ
    getShortUrl($long_url) ������ת�����ӽӿ�
    getUserList($next_openid) ������ȡ��ע�û��б�
    getUserInfo($openid) ��ȡ��ע����ϸ��Ϣ
    updateUserRemark($openid,$remark) �����û���ע��
    getGroup() ��ȡ�û������б�
    getUserGroup($openid) ��ȡ�û����ڷ���
    createGroup($name) �����Զ�����
    updateGroup($groupid,$name) ���ķ�������
    updateGroupMembers($groupid,$openid) �ƶ��û�����
    batchUpdateGroupMembers($groupid,$openid_list) �����ƶ��û�����
    sendCustomMessage($data) ���Ϳͷ���Ϣ
    getOauthRedirect($callback,$state,$scope) ��ȡ��ҳ��ȨoAuth��ת��ַ
    getOauthAccessToken() ͨ���ص���code��ȡ��ҳ��Ȩaccess_token
    getOauthRefreshToken($refresh_token) ͨ��refresh_token��access_token����
    getOauthUserinfo($access_token,$openid) ͨ����ҳ��Ȩ��access_token��ȡ�û�����
    getOauthAuth($access_token,$openid) ������Ȩƾ֤access_token�Ƿ���Ч
    getSignature($arrdata,'sha1') ����ǩ���ִ�
    generateNonceStr($length=16) ��ȡ����ִ�
    setTMIndustry($id1,$id2='') ģ����Ϣ������������ҵ
    addTemplateMessage($tpl_id) ģ����Ϣ�������Ϣģ��
    sendTemplateMessage($data) ����ģ����Ϣ

    ��ͷ��ӿڣ�
    getCustomServiceMessage($data) ��ȡ��ͷ��Ự��¼
    transfer_customer_service($customer_account) ת����ͷ���Ϣ
    getCustomServiceKFlist() ��ȡ��ͷ��ͷ�������Ϣ
    getCustomServiceOnlineKFlist() ��ȡ��ͷ����߿ͷ��Ӵ���Ϣ
    createKFSession($openid,$kf_account,$text='') ����ָ����ͷ��Ự
    closeKFSession($openid,$kf_account,$text='') �ر�ָ����ͷ��Ự
    getKFSession($openid) ��ȡ�û��Ự״̬
    getKFSessionlist($kf_account) ��ȡָ���ͷ��ĻỰ�б�
    getKFSessionWait() ��ȡδ����Ự�б�
    addKFAccount($account,$nickname,$password) ��ӿͷ��˺�
    updateKFAccount($account,$nickname,$password) �޸Ŀͷ��˺���Ϣ
    deleteKFAccount($account) ɾ���ͷ��˺�
    setKFHeadImg($account,$imgfile) �ϴ��ͷ�ͷ��
    querySemantic($uid,$query,$category,$latitude=0,$longitude=0,$city="",$region="") �������ӿ� �������弰���ص�json������鿴 ΢���������ӿ�
    getDatacube($type,$subtype,$begin_date,$end_date='') ��ȡͳ������ ������ע��$type��$subtype�Ķ���

        ��ȡͳ�����ݷ��� ��������
        ���ݷ��� 	$typeֵ(�ַ���) 	�����ӷ��� 	$subtypeֵ(�ַ���) 	ʱ����(��)
        �û����� 	'user' 	��ȡ�û��������� 	'summary' 	7
        �û����� 	'user' 	��ȡ�ۼ��û����� 	'cumulate' 	7
        ͼ�ķ��� 	'article' 	��ȡͼ��Ⱥ��ÿ������ 	'summary' 	1
        ͼ�ķ��� 	'article' 	��ȡͼ��Ⱥ�������� 	'total' 	1
        ͼ�ķ��� 	'article' 	��ȡͼ��ͳ������ 	'read' 	3
        ͼ�ķ��� 	'article' 	��ȡͼ��ͳ�Ʒ�ʱ���� 	'readhour' 	1
        ͼ�ķ��� 	'article' 	��ȡͼ�ķ���ת������ 	'share' 	7
        ͼ�ķ��� 	'article' 	��ȡͼ�ķ���ת����ʱ���� 	'sharehour' 	1
        ��Ϣ���� 	'upstreammsg' 	��ȡ��Ϣ���͸ſ����� 	'summary' 	7
        ��Ϣ���� 	'upstreammsg' 	��ȡ��Ϣ���ͷ�ʱ���� 	'hour' 	1
        ��Ϣ���� 	'upstreammsg' 	��ȡ��Ϣ���������� 	'week' 	30
        ��Ϣ���� 	'upstreammsg' 	��ȡ��Ϣ���������� 	'month' 	30
        ��Ϣ���� 	'upstreammsg' 	��ȡ��Ϣ���ͷֲ����� 	'dist' 	15
        ��Ϣ���� 	'upstreammsg' 	��ȡ��Ϣ���ͷֲ������� 	'distweek' 	30
        ��Ϣ���� 	'upstreammsg' 	��ȡ��Ϣ���ͷֲ������� 	'distmonth' 	30
        �ӿڷ��� 	'interface' 	��ȡ�ӿڷ������� 	'summary' 	30
        �ӿڷ��� 	'interface' 	��ȡ�ӿڷ�����ʱ���� 	'summaryhour' 	1

        ��Ҫע�� begin_date��end_date�Ĳ�ֵ��С�ڡ����ʱ���ȡ����������ʱ����Ϊ1ʱ��begin_date��end_date�Ĳ�ֵֻ��Ϊ0������С��1��

    ��ȯ�ӿڣ�
    createCard($data) ������ȯ
    updateCard($data) �޸Ŀ�ȯ
    delCard($card_id) ɾ����ȯ
    getCardInfo($card_id) ��ѯ��ȯ����
    getCardColors() ��ȡ��ɫ�б�
    getCardLocations() ��ȡ�ŵ��б�
    addCardLocations($data) ���������ŵ���Ϣ
    createCardQrcode($card_id) ���ɿ�ȯ��ά��
    consumeCardCode($code) ���� code
    decryptCardCode($encrypt_code) code ����
    checkCardCode($code) ��ȡ code ����Ч��
    getCardIdList($data) ������ѯ���б�
    updateCardCode($code,$card_id,$new_code) ���� code
    unavailableCardCode($code,$card_id='') ���ÿ�ȯʧЧ(������)
    modifyCardStock($data) ����޸�
    activateMemberCard($data) ����/�󶨻�Ա���������ṹ��ο���ȯ�����ĵ�(6.1.1 ����/�󶨻�Ա��)�½�
    updateMemberCard($data) ��Ա�����ף������ṹ��ο���ȯ�����ĵ�(6.1.2 ��Ա������)�½�
    updateLuckyMoney($code,$balance,$card_id='') ���º�����
    setCardTestWhiteList($openid=array(),$user=array()) ���ÿ�ȯ���԰�����

    ҡһҡ�ܱ߽ӿڣ�
    applyShakeAroundDevice($data) �����豸ID
    updateShakeAroundDevice($data) �༭�豸�ı�ע��Ϣ
    searchShakeAroundDevice($data) ��ѯ�豸�б�
    bindLocationShakeAroundDevice($device_id,$poi_id,$uuid='',$major=0,$minor=0) �����豸���ŵ�Ĺ�����ϵ
    bindPageShakeAroundDevice($device_id,$page_ids=array(),$bind=1,$append=1,$uuid='',$major=0,$minor=0) �����豸��ҳ��Ĺ�����ϵ
    uploadShakeAroundMedia($data) �ϴ���ҡһҡҳ��չʾ��ͼƬ�ز�
    addShakeAroundPage($title,$description,$icon_url,$page_url,$comment='') ����ҡһҡ������ҳ����Ϣ
    updateShakeAroundPage($page_id,$title,$description,$icon_url,$page_url,$comment='') �༭ҡһҡ������ҳ����Ϣ
    searchShakeAroundPage($page_ids=array(),$begin=0,$count=1) ��ѯҡһҡ���е�ҳ��
    deleteShakeAroundPage($page_ids=array()) ɾ��ҡһҡ���е�ҳ�棬������δ���豸������ҳ��
    getShakeInfoShakeAroundUser($ticket) ��ȡҡ�ܱߵ��豸���û���Ϣ
    deviceShakeAroundStatistics($device_id,$begin_date,$end_date,$uuid='',$major=0,$minor=0) ���豸Ϊά�ȵ�����ͳ�ƽӿ�
    pageShakeAroundStatistics($page_id,$begin_date,$end_date) ��ҳ��Ϊά�ȵ�����ͳ�ƽӿ�

 * */


switch($type) {
	case Wechat::MSGTYPE_TEXT:

        /**
         * ����ʲô,����ʲô
         * 	'token'=>'3351161315',	//��дӦ�ýӿڵ�Token
        'encodingaeskey'=>'d27a525edce19ea134652b76ef9de54e',//��д�����õ�EncodingAESKey
        'appid'=>'wx1b69d3d01a93be52',	//��д�߼����ù��ܵ�appid
        */
//        $appid      = 'wx1b69d3d01a93be52';
//        $appsecret  = 'd27a525edce19ea134652b76ef9de54e';
//        $token      = '3351161315';
        //$vs = $weObj->getRevContent();
        $vs = $weObj->getForeverCount();
        //$vs = $weObj->checkAuth($appid,$appsecret,$token);        ��������Ϊ 3351161315



        $weObj->text($vs)->reply();
        exit;
        //����
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



