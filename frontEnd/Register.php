<?php

//Moustapha Sarr

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);

//Use for sending messages

require_once("/var/www/html/IT490-2/frontEnd/IT490/path.inc");
require_once("/var/www/html/IT490-2/frontEnd/IT490/get_host_info.inc");
require_once("/var/www/html/IT490-2/frontEnd/IT490/rabbitMQLib.inc");


//including the Register function file
//The RegisterFunction.php contains code that "cleans" the data and prevents
//cross site scripting 
include ("RegisterFunction.php");

//Retrieving the user information from the Register.html 
$flag = false;
$FirstName = GET ("FirstName", $flag);
$LastName = GET ("LastName", $flag);
$Email = GET ("Email", $flag);
$Password = GET ("Password", $flag);
$DOB = GET ("DOB", $flag);
$socialMedia = GET("socialMedia", $flag);


$client = new RabbitMQClient('testRabbitMQ.ini', 'testServer');

//Creating a JSON object to send over
$newUser = new stdClass();
$newUser->firstName = $FirstName;
$newUser->lastName = $LastName;
$newUser->email = $Email;
$newUser->password = $Password;
$newUser->dob = $DOB;
$newUser->socialMedia = $socialMedia;

$myJSON = json_encode($newUser);
$msg = array("message"=>$myJSON, "type"=>"Register");

//Printing the message to the log.
error_log(print_r($msg,true));

$response = $client->send_request($msg);
echo "client received response: ". PHP_EOL;
print_r($response);
echo "\n\n";

//if(isset($argv[0])) echo $argv[0] . " END".PHP_EOL;  


?>
















