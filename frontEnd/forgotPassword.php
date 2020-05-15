<?php

//Retrieving the username
$username = $_POST['username'];
echo $username;
	
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors' , 1);

//Use for sending messages





require_once("/var/www/insomnia.surfnet.ca/public_html/IT490-2/frontEnd/IT490/path.inc");
require_once("/var/www/insomnia.surfnet.ca/public_html/IT490-2/frontEnd/IT490/get_host_info.inc");
require_once("/var/www/insomnia.surfnet.ca/public_html/IT490-2/frontEnd/IT490/rabbitMQLib.inc");


//including the Register function file
//The RegisterFunction.php contains code that "cleans" the data and prevents
//cross site scripting
include ("RegisterFunction.php");

//Retrieving the user information from the Register.html
$flag = false;
$username = GET("username",$flag);

$client = new RabbitMQClient('testRabbitMQ.ini', 'testServer');

//Creating a JSON object to send over
//$newUser = new stdClass();
//$newUser->firstName = $FirstName;
//$newUser->lastName = $LastName;
//$newUser->email = $Email;
//$newUser->password = $Password;
//$newUser->dob = $DOB;
//$newUser->socialMedia = $socialMedia;

//$myJSON = json_encode($newUser);
$msg = array("message"=>$username, "type"=>"PasswordReset");

//Printing the message to the log.
error_log(print_r($msg,true));
echo "\n";
$response = $client->send_request($msg);
echo "client received response: ". PHP_EOL;

$result = (array) json_decode($response, true);

var_export($response);
var_dump($result);

//print_r($response['message']);
echo "\n\n";

$req = json_decode($response->message,true);
$types = $response->type;
switch($types)
{


        case "PasswordReset":

                if($req['message']== "Password reset successfully.")
                {
			echo "New Password is 1";
			echo "Redirecting back to Login index2.php";
			sleep(10);
			//echo "<script> window.location.href ='./index2.php';</script>";
                        //header('Location: ./index2.php');
			echo "<script> window.location.href='./index2.php'</script>";

                }
                else
                {

                        echo "Password reset not successful try again. Redirecting back to password reset page";
			sleep(10);
			echo "<script> window.location.href='./forgotPassword.html'</script>";
			
                        //header('Location: ./index2.php');
                }


}
?>
	



