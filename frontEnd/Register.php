<?php


error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);

//Use for sending messages
require_once('/home/app-s/IT490/path.inc');
require_once('/home/app-s/IT490/get_host_info.inc');
require_once('/home/app-s/IT490/rabbitMQLib.inc');
//login to database
//include ("account.php") ;

//$db = mysqli_connect($hostname,$username, $password ,$project);
//if (mysqli_connect_errno())
 // {	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
//	  exit();
 // }

print "Hello There<br>" ;
print "<br>Successfully coonected to MYSQL.<br>" ;
//mysqli_select_db( $db, $project );

//including the Register function file
include ("RegisterFunction.php");

$flag = false;

$FirstName = GET ("FirstName", $flag);
$LastName = GET ("LastName", $flag);
$Email = GET ("Email", $flag);
$Password = GET ("Password", $flag);
$DOB = GET ("DOB", $flag);
$socialMedia = GET("socialMedia", $flag);
echo "<br>";


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
error_log(print_r($msg,true));
$response = $client->send_request($msg);
echo "client received response: ". PHP_EOL;
print_r($response);
echo "\n\n";

if(isset($argv[0])) echo $argv[0] . " END".PHP_EOL;  


//$twitter = GET("tb", $flag);
//$instagram = GET("ib", $flag);




//echo("<br> Success");

//call function to create account

//CreateAccount ($FirstName, $LastName, $Email, $Password, $DOB, $db); 
//echo ("Congratulations Account has been created");


//Sending message


?>
















