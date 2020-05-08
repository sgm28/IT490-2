<?php
require_once("./config.php");
require_once('../IT490/path.inc');
require_once('../IT490/get_host_info.inc');
require_once('../IT490/rabbitMQLib.inc');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



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


//RabbitMQSection
$client = new RabbitMQClient('../IT490/testRabbitMQ.ini', 'testServer');


if (!isset($app_secret)) {
	  error_log("The app_secret variable is not set", 0);
	
}
if (!isset($app_id)) {
     error_log ("The app_id variable is not set",0);
}
if (!isset($accessToken)) {
     error_log("The accessToken variable is not set",0);
}
if (!isset($oAuth2Client)) {
     error_log("oAuth2Client is blank",0);
}


if(!$accessToken->isLongLived()){
	$accessToken = $oAuth2Client->getLongLivedAccesToken($accessToken);
}

	//echo var_export($accessToken, true);
	$a = (string) $accessToken;
	$msg = array("app_id"=>"$app_id", "app_secret"=>"$app_secret", "accessToken"=>$a, "authenication"=>$oAuth2Client, "type"=>"api");
	$response = $client->send_request($msg);
//	echo var_export($response,true);
	error_log(var_export($response, true));	
	
	//var_dump($response);
	//ob_flush();
	
		
	
	//echo "\n";
	//echo var_export($oAuth2Client,true); 
	//ob_flush();

    //$response = $FBObject->get("/me?fields=id, first_name, last_name, email, picture.type(large),link,feed", $accessToken);
    //$userData = $response->getGraphNode()->asArray();
    $userData = $response;
      
    $_SESSION['userData'] = $userData;
    $_SESSION['access_token'] = (string) $accessToken;
    header('Location: ./index.php');
    exit();


?>
