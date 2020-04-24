<?php

$a = '/../../frontEnd/IT490/vendor/autoload.php';
echo "the path is: ".$a."\n";
require_once __DIR__ . "$a";

//~/IT490-2/frontEnd/IT490/vendor/autoload.php

//require_once('~/IT490-2/frontEnd/IT490/vendor/autoload.php'); 
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('52.176.58.43',5672,'app', '1');
$channel = $connection->channel();
//Third Paramter makes the message survive if raabitmq restarts
$channel->queue_declare('task_queue', false, true, false, false);





//Reading from command line
$data = implode('', array_slice($argv,1));

if (empty($data))
{

	$data = "Hello World!";
}

//$msg = new AMQPMessage($data);
//Persistent is make sure the message doesn't get lost even if rabbitmq crashes
//or restarts
$msg = new AMQPMessage(
    $data,
    array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
);

$channel->basic_publish($msg,'','task_queue');
echo ' [x] Sent ', $data, "\n";

$channel->close();
$connection->close();

?>
