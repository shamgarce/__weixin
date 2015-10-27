<?php

include("../vendor/autoload.php");


$req = Sham\Request::getInstance();

//foreach($env as $value){
//      var_dump($value);
//}
//


//
var_dump($req->headers);
var_dump($req->cookies);


$req->getMethod();
$req->isGet();
$req->isPost();
$req->isPut();
$req->isPatch();
$req->isDelete();
$req->isHead();
$req->isOptions();
$req->isAjax();
$req->isXhr();
$req->params();
$req->get();
$req->post();
$req->put();
$req->patch();
$req->delete();
$req->cookies();
$req->isFormdata();
$req->headers();
$req->getBody();
$req->getContentType();
$req->getMediaType();
$req->getMediaTypeParams();
$req->getContentCharset();
$req->getContentLength();
$req->getHost();
$req->getHostWithPort();
$req->getPort();
$req->getScheme();
$req->getScriptName();
$req->getRootUri();
$req->getPath();
$req->getPathInfo();
$req->getResourceUri();
$req->getUrl();
$req->getIp();
$req->getReferrer();
$req->getReferer();
$req->getUserAgent();












exit;
$req = new Sham\Request();





var_dump($req);

//$req->get;
//$req->post;
//$req->cookies;
//$req->session;
//$req->file;


$req->run();
