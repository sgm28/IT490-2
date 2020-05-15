<?php
require_once("./config.php");
require_once('../IT490/path.inc');
require_once('../IT490/get_host_info.inc');
require_once('../IT490/rabbitMQLib.inc');

try {
    $accessToken = $handler->getAccessToken();
}catch(\Facebook\Exceptions\FacebookResponseException $e){
    echo "Response Exception: " . $e->getMessage();
    exit();
}catch(\Facebook\Exceptions\FacebookSDKException $e){
    echo "SDK Exception: " . $e->getMessage();
    exit();
}

if(!$accessToken){
    header('Location: login.php');
    exit();
}

$oAuth2Client = $FBObject->getOAuth2Client();
if(!$accessToken->isLongLived())
    $accessToken = $oAuth2Client->getLongLivedAccesToken($accessToken);
    
    //RabbitMQ
    $accessTokens= (string) $accessToken;
    $msg = array("app_id"=>"$app_id", "app_secret"=>"$app_secret", "accessToken"=>$accessTokens, "type"=>"api");
    
    
   // ob_start();
    $client = new rabbitMQClient("testRabbitMQ.ini", "api");
    $response = $client->send_request($msg);
    $response = json_decode($response);
    var_dump($response);
    //$s = ob_get_contents();
    //$s = json_decode($s);
    //ob_end_clean();
  //  var_export($response, true);
   //	flush();	
    //$response = $FBObject->get("/me?fields=id, first_name, last_name, email, picture.type(large),link,feed", $accessToken);
    //$userData = $response->getGraphNode()->asArray();
//    $_SESSION['userData'] = $userData;
//    $_SESSION['access_token'] = (string) $accessToken;
    
    $_SESSION['userData'] = $response;
    $_SESSION['access_token'] = (string) $accessToken;
    header('Location: ./index.php');
    exit();
?>
