<?php

require_once __DIR__ . '/../../backEnd/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


//52.176.58.43
$connection = new AMQPStreamConnection('52.176.58.43',5672,'db', '2');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);


$data = implode('', array_slice($argv,1));

if (empty($data))
{

	$data = "Hello World!";
}

$msg = new AMQPMessage($data);



$callback = function($msg)
{
	echo ' [x] Received ', $msg->body, "\n";
	sleep(substr_count($msg->body, '.'));
	echo " [x] Done\n";



};

$channel->basic_consume('hello', '', false, true, false, false, $callback);

while($channel->is_consuming())
{
	$channel->wait();

}



$channel->close();
$connection->close();

?>
