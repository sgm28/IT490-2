<?php
<?php

//Summary: Buliding a logger



require_once __DIR__ . '/../../backEnd/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;



//Exhange type fanouts sends messages to all queues it knows.
$channel->exchange_declare('logs', 'fanout', false, false,false);

/*Publish message to exhanges name log

//Creates a queue when connect to rabbitMQ. The name of the queue is randomly created by rabbitmq

//The queue_declare method returns a random queue which will be store in $queue_name

//When the connection close(Ctrl-C or program terminates), the queue will be deleted because the queue is declare as exclusive
*/
list($queue_name, ,) = $channel->queue_declare("");

/*Bindings
At this point the exchange received the message from the producer(the person/computer that send the message)

It is time to tell the exchange to send the message to queue.
That is called binding
*/
$channel->queue_bind($queue_name, 'logs');

echo "[*] Waiting for logs. To exit press CTRL+C\n";

$callback = function ($msg)
{

	echo ' [x] ', $msg->body, "\n";
};

$channel->basic_consume($queue_name,'',false,true,false,false, $callback);

while ($channel->is_consuming())
{

	$channel->wait();
}

$channel->close();
$connection->close();

?>

