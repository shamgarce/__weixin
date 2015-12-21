<?php
/**
 * ΢�Ź����ӿڲ���
 */
include("../../wechat-php-sdk-master/wechat.class.php");


/*
* ���շ�����Ϣ��ʼ
*/

function logdebug($text){
	file_put_contents('../log.txt',$text."\n",FILE_APPEND);
};
$options = array(
	'token'=>'3351161315', //��д���趨��key
	'debug'=>true,
	'logcallback'=>'logdebug'
);
$weObj = new Wechat($options);
//-----------------------------------------------------

$weObj->valid();
$type = $weObj->getRev()->getRevType();

/*

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



