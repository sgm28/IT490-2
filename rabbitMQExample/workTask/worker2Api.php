<?php

require_once __DIR__ . '/../../apiBackEnd/IT490/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


//52.176.58.43
$connection = new AMQPStreamConnection('52.176.58.43',5672,'db', '2');
$channel = $connection->channel();


//The Third parmeter makes the message persistant
//That means if rabbitmq restarts or crashes the message will still be there.
////You also have to change the message type to persistnet for full effect
//
$channel->queue_declare('task_queue',false,true,false,false);


$callback = function($msg)
{
	echo ' [x] Received ', $msg->body, "\n";
	sleep(substr_count($msg->body, '.'));
	echo " [x] Done\n";
	 $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);


};

//Don't send me message when I am busy
$channel->basic_qos(null, 1, null);

//The fourth paramter sends acknowlege to rabbitmq that the messages was received.
$channel->basic_consume('task_queue', '', false, false, false, false, $callback);
while($channel->is_consuming())
{
	$channel->wait();

}



$channel->close();
$connection->close();

?>
