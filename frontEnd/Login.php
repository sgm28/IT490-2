<?php 
#Sakar Michel
require_once('/home/app-s/IT490/path.inc'); 
require_once('/home/app-s/IT490/get_host_info.inc'); 
require_once('/home/app-s/IT490/rabbitMQLib.inc'); 
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('error_log', 'var/log/php.log'); 
ini_set('display_errors',1);
 $client = new RabbitMQClient('testRabbitMQ.ini', 'testServer');
 if(isset($argv[1])){
	$msg = $argv[1];
}
else{
	
	//Gathering the input from the html page
	//$flag = false;
	$UserName = $_POST["Username"];
	$Password = $_POST["Password"];
	
	
	//$DOB =$_GET("DOB", $flag); <- Do not understand why this is not working
	//Creating the object
	$user = new stdClass();
	$user->userName = $UserName;
	//$user->lastName = $LastName;
	//$user->Email = $Email;
	$user->Password = $Password;
	//$user->DOB = $DOB;
	$myJSON = json_encode($user);
       //$msg = array("message"=>"test message", "type"=>"echo");
	$msg = array("message"=>$myJSON,"type"=>"login");
	error_log(print_r($msg,true));		
}
//$flag = false; //if!$flag){ //	exit("<br> Failed: empty input field."); //	echo ("Hello"); //} //else //{
	echo ($UserName);
	//echo ($LastName);
	//echo ($Email);
	echo ($Password);
	//echo ($DOB); //}
 $response = $client->send_request($msg);
 echo "client received response: " . PHP_EOL; print_r($response); echo "\n\n"; 
if(isset($argv[0])) echo $argv[0] . " END".PHP_EOL;

?>

