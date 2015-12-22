<?php
include("../../vendor/autoload.php");
include("../../Sham/Helper.php");
define('APPROOT','../../App/');

class wxauth {
    private $options;
    public $open_id;
    public $wxuser;

    public function __construct($options){
        $this->options = $options;
        $this->wxoauth();
        session_start();
    }

    public function wxoauth(){
        $scope = 'snsapi_base';
        $code = isset($_GET['code'])?$_GET['code']:'';
        $token_time = isset($_SESSION['token_time'])?$_SESSION['token_time']:0;
        if(!$code && isset($_SESSION['open_id']) && isset($_SESSION['user_token']) && $token_time>time()-3600)
        {
            if (!$this->wxuser) {
                $this->wxuser = $_SESSION['wxuser'];
            }
            $this->open_id = $_SESSION['open_id'];
            return $this->open_id;
        }
        else
        {
            $options = array(
                'token'=>$this->options["token"], //��д���趨��key
                'appid'=>$this->options["appid"], //��д�߼����ù��ܵ�app id
                'appsecret'=>$this->options["appsecret"] //��д�߼����ù��ܵ���Կ
            );
            $we_obj = new Wechat($options);
            if ($code) {
                $json = $we_obj->getOauthAccessToken();
                if (!$json) {
                    unset($_SESSION['wx_redirect']);
                    die('��ȡ�û���Ȩʧ�ܣ�������ȷ��');
                }
                $_SESSION['open_id'] = $this->open_id = $json["openid"];
                $access_token = $json['access_token'];
                $_SESSION['user_token'] = $access_token;
                $_SESSION['token_time'] = time();
                $userinfo = $we_obj->getUserInfo($this->open_id);
                if ($userinfo && !empty($userinfo['nickname'])) {
                    $this->wxuser = array(
                        'open_id'=>$this->open_id,
                        'nickname'=>$userinfo['nickname'],
                        'sex'=>intval($userinfo['sex']),
                        'location'=>$userinfo['province'].'-'.$userinfo['city'],
                        'avatar'=>$userinfo['headimgurl']
                    );
                } elseif (strstr($json['scope'],'snsapi_userinfo')!==false) {
                    $userinfo = $we_obj->getOauthUserinfo($access_token,$this->open_id);
                    if ($userinfo && !empty($userinfo['nickname'])) {
                        $this->wxuser = array(
                            'open_id'=>$this->open_id,
                            'nickname'=>$userinfo['nickname'],
                            'sex'=>intval($userinfo['sex']),
                            'location'=>$userinfo['province'].'-'.$userinfo['city'],
                            'avatar'=>$userinfo['headimgurl']
                        );
                    } else {
                        return $this->open_id;
                    }
                }
                if ($this->wxuser) {
                    $_SESSION['wxuser'] = $this->wxuser;
                    $_SESSION['open_id'] =  $json["openid"];
                    unset($_SESSION['wx_redirect']);
                    return $this->open_id;
                }
                $scope = 'snsapi_userinfo';
            }
            if ($scope=='snsapi_base') {
                $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                $_SESSION['wx_redirect'] = $url;
            } else {
                $url = $_SESSION['wx_redirect'];
            }
            if (!$url) {
                unset($_SESSION['wx_redirect']);
                die('��ȡ�û���Ȩʧ��');
            }
            $oauth_url = $we_obj->getOauthRedirect($url,"wxbase",$scope);
            header('Location: ' . $oauth_url);
        }
    }
}

$auth = new wxauth([
    'token'=>'3351161315', //��д���趨��key
    'appid'=>'wx1b69d3d01a93be52', //��д�߼����ù��ܵ�app id, ����΢�ſ���ģʽ��̨��ѯ
    'appsecret'=>'d27a525edce19ea134652b76ef9de54e ', //��д�߼����ù��ܵ���Կ
]);
var_dump($auth->wxuser);
