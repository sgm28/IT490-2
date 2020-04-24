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


//Exhange type direct sends messages to queue who binding key
//matches the routing key
$channel->exchange_declare('direct_logs', 'direct', false, false,false);


//Check if the comment argument was past and the value was not empty.
//If it is empty, assigned the value of info
$severity = isset($argv[1]) && !empty($argv[1]) ? $argv[1] : 'info';



//Reading from command line
$data = implode('', array_slice($argv,2));

if (empty($data))
{

        $data = "Hello World!";
}

$msg = new AMQPMessage($data);



//Publish message to exhanges name logs
$channel->basic_publish($msg, 'direct_logs', $severity);

echo ' [x] Sent ', $data, "\n";



$channel->close();
$connection->close();

?>

