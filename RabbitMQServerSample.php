<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('./FacebookLogin/Facebook/autoload.php');
//require_once('FacebookFunction.php'); 
function login($user,$pass){
	//TODO validate user credentials
	return true;
}

function getToken($link)
{
  	
        $client_id = $link["app_id"];
	$client_secret = $link["app_secret"];

	$accessToken = $link["accessToken"];
	$FBObject = new \Facebook\Facebook
	([
        	'app_id' => $client_id,
        	'app_secret' => $client_secret,
        	'default_graph_version' => 'v2.10'
	]);
	
//$handler = $FBObject -> getRedirectLoginHelper();





	//$authenicationToken = serialize($link["accessToken"]);
	//$ch = curl_init("https://graph.facebook.com/$client_id?fields=id,name&access_token=$authenicationToken");
	
	//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	//$respone = json_decode(curl_exec($ch));
	//curl_close($ch);
	//print_r($respone);
	//$response = $FBObject->get("/me?fields=id, first_name, last_name, email, picture.type(large),link,feed", $accessToken);
	$response = $FBObject->get("/me?fields=id, first_name, last_name, email, picture.type(large),link", $accessToken);
	
	$userData = $response->getGraphNode()->asArray();
	//print_r($userData);
	return $userData;

	
	





}




function request_processor($req){
	echo "Received Request".PHP_EOL;
	echo "<pre>" . var_dump($req) . "</pre>";
	if(!isset($req['type'])){
		return "Error: unsupported message type";
	}
	//Handle message type
	$type = $req['type'];
	switch($type){
		case "login":
			return login($req['username'], $req['password']);
		case "validate_session":
			return validate($req['session_id']);
		case "echo":
			return array("return_code"=>'0', "message"=>"Echo: " .$req["message"]);
				
		case "api":
			//var_dump($req);
			$link = $req;

			// $msg = array("app_id"=>$req["app_id"],"app_secret"=>$req["app_secret"],"accessToken"=>$req["accessToken"], "authenication"=>$req["authenication"], "type"=>"api");
			//echo $link["app_id"];
			//echo $link["app_secret"];
			//echo $link["accessToken"];
			//echo $link["authenication"];

			$a =  getToken($link);
			//var_export($a);
			//$output = shell_exec("php FacebookFunction.php $link");
			//echo "<pre>$output</pre>";
			//return array("return_code"=>'0', "message"=>"Echo: " .$a);
			return array("return_code" => '0', "message" =>"returning data from api", "userData"=>$a);		
	
//			return array("return_code" => '0',"message" => "Server received request and processed it from api");
	}
	return array("return_code" => '0',
		"message" => "Server received request and processed it");
}

$server = new rabbitMQServer("testRabbitMQ.ini", "sampleServer");

echo "Rabbit MQ Server Start" . PHP_EOL;
$server->process_requests('request_processor');
echo "Rabbit MQ Server Stop" . PHP_EOL;
exit();
?>
