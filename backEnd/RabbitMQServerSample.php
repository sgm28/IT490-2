<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
ini_set('error_log', 'var/log/php.log');
ini_set('display_errors',1);
function login($user,$pass){
	//TODO validate user credentials
	
$servername = "localhost";
$username = "it490";
$password = "teamWork";

try {
    
    $conn = new PDO("mysql:host=$servername;dbname=members", $username, $password);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";





$stmt = $conn->prepare("SELECT FirstName, LastName, Email, Password  FROM `Users`  WHERE FirstName= :FirstName");
$params = array('FirstName' => $user);
$stmt->execute($params);
$count = $stmt->rowCount();
if($count > 0)
{

	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$userpassword = $result['Password'];
	if(password_verify($pass, $userpassword))
	{
	
		//echo "password is correct";
		$msg = "password is correct";
		$message = new stdClass();
		$message->Message =$msg;
		$myJSON = json_encode($message);
		$message = array("message"=>$myJSON, "type"=>"login responses");
		error_log(print_r($msg,true));

		return true;


	//	"return_code" => '0',
          //      "message" => "Server received request and processed it");
		// return array("return_code" => '0',
            //    "message" => "Server received request and processed it");		
	}
	else
	{
		
         	$msg = "password is wrong";
                $message = new stdClass();
                $message->Message =$msg;
                $myJSON = json_encode($message);
                $message = array("message"=>$myJSON, "type"=>"login responses");
                error_log(print_r($msg,true));

                return $message;



	}
}
else
{
	 $msg = "Username or Password is wrong";
                $message = new stdClass();
                $message->Message =$msg;
                $myJSON = json_encode($message);
                $message = array("message"=>$myJSON, "type"=>"login responses");
                error_log(print_r($msg,true));

                return $message;


}
}
catch(PDOException $e)
{
	echo "Connection failed " . $e->getMessage();
}

//$sql = "SELECT FirstName, LastName, Email FROM Users WHERE Password='$password'";
//$result = $conn->query($sql);

	return true;
}

function Register($FirstName,$LastName,$Email,$Password, $DOB){
        //TODO validate user credentials

$servername = "localhost";
$username = "it490";
$password = "teamWork";

try {





//$stmt = $conn->prepare("SELECT FirstName, LastName, Email, Password  FROM `Users`  WHERE FirstName= :FirstName");
//$params = array('FirstName' => $user);
//$stmt->execute($params);
//$count = $stmt->rowCount();

    $conn = new PDO("mysql:host=$servername;dbname=members", $username, $password);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    echo "\n";
  



//Check if the username exits first







$stmt = $conn->prepare("SELECT FirstName, LastName, Email, Password  FROM `Users`  WHERE FirstName= :FirstName");
$params = array('FirstName' => $FirstName);
$stmt->execute($params);
$count = $stmt->rowCount();
if($count > 0)
{

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $userName = $result['FirstName'];
       if ($FirstName == $userName)
	{

		//echo  "Username already exits";
		echo "\n";


	        $msg = "Username already exits";
                $message = new stdClass();
                $message->Message =$msg;
                $myJSON = json_encode($message);
                $message = array("message"=>$myJSON, "type"=>"Register responses");
                error_log(print_r($msg,true));

                return $message;
  


		return  "Duplicate entry";
	}
       

}
else
{
$hashPassword =  password_hash($Password, PASSWORD_BCRYPT);
$query = "INSERT INTO `Users` (FirstName, LastName, Email, Password, DOB) VALUES (:FirstName,:LastName,:Email, :Password, :DOB)";
$stmt = $conn->prepare($query);
$params = array('FirstName' => $FirstName, 'LastName'=>$LastName, 'Email'=>$Email,'Password'=>$hashPassword,'DOB' => $DOB);
$stmt->execute($params);
$count = $stmt->rowCount();
if($count > 0)
	{

       	//echo "Successful add row to database";	
	
	 $msg = "Successful add row to database";
                $message = new stdClass();
                $message->Message =$msg;
                $myJSON = json_encode($message);
                $message = array("message"=>$myJSON, "type"=>"login responses");
                error_log(print_r($msg,true));

                return $msg;



	return "Successful";
	
 		              
        }

else
{
        echo "Username already exists";
	return "Not Successful";
}
}
}
catch(PDOException $e)
{
        echo "Connection failed " . $e->getMessage();
}




        return true;
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
			
			$req = json_decode($req['message'],true);
			//$firstname = $req['firstname'];
			//echo $firstname; 
			//$lastname = $req['lastname']; 
			//$email = $req['email'];
			//$password = $req['password']		

			
			return login($req['userName'], $req['Password']);
		case "validate_session":
			return validate($req['session_id']);
		case "echo":
			return array("return_code"=>'0', "message"=>"Echo: " .$req["message"]);

		case "Register":
			$req = json_decode($req['message'],true);
			return Register($req['firstName'],$req['lastName'],$req['email'], $req['password'], $req['dob']);
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
