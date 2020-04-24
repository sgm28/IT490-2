

<?php



//Summary: Subscribe only to a subset of the messages (Listening for certain messages)

require_once __DIR__ . '/../../frontEnd/IT490/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


$a = '/../../frontEnd/IT490/vendor/autoload.php';
//echo "the path is: ".$a."\n";
require_once __DIR__ . "$a";



$connection = new AMQPStreamConnection('52.176.58.43',5672,'app', '1');
$channel = $connection->channel();


//Exhange type topic sends messages to queue who binding key
//matches the routing key (the binding key are words sperate by . i.e brown.fox)
$channel->exchange_declare('topic_logs', 'topic', false, false,false);

/*
	Values for topic key:		↓		 ↓	
	* -> exactly one word  i.e  *.orange.*
	brown.orange.fox will match
	orange.brown.fox will not match
												   ↓ ↓
	# -> can substitute for zero or more words i.e *.*.rabbit
	quick.brown.rabbit will match
	slow.smart.turtle will not match
*/	



//Check if the comment argument was past and the value was not empty.
//If it is empty, assigned the value of info
//The values for serverity are info, warning, error
$routing_key = isset($argv[1]) && !empty($argv[1]) ? $argv[1] : 'anonymous.info';



//Reading from command line
$data = implode('', array_slice($argv,2));

if (empty($data))
{

        $data = "Hello World!";
}

$msg = new AMQPMessage($data);



//Publish message to exhanges name logs
//$severity is the routing key.
//It use my the exchange to send it to the correct queue by compairing
//bind key from php receive_logs_directForDB.php
$channel->basic_publish($msg, 'topic_logs', $routing_key);

echo ' [x] Sent ', $data, "\n";



$channel->close();
$connection->close();

?>
