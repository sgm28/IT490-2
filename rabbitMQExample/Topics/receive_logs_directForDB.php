<?php

//Summary: Buliding a logger



require_once __DIR__ . '/../../backEnd/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('52.176.58.43',5672,'db', '2');
$channel = $connection->channel();


//Exhange type fanouts sends messages to all queues it knows.
$channel->exchange_declare('topic_logs', 'topic', false, false,false);

/*Publish message to exhanges name log

//Creates a queue when connect to rabbitMQ. The name of the queue is randomly created by rabbitmq

//The queue_declare method returns a random queue which will be store in $queue_name

//When the connection close(Ctrl-C or program terminates), the queue will be deleted because the queue is declare as exclusive
*/
list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);

/*Bindings
At this point the exchange received the message from the producer(the person/computer that send the message)

It is time to tell the exchange to send the message to queue.
That is called binding
*/

//severity can contain the value of info warning error or all three from the
//command line
$bindings_keys = array_slice($argv, 1);

//If severities is empty, spit out a warning and how to use the file
if(empty($bindings_keys))
{

        file_put_contents('php://stderr', "Usage: $argv[0] [info] [warning] [error]\n");
        exit(1);
}


foreach ($bindings_keys as $bindings_keys)
{
                                                        //severity is the binding key. It is like a key for a queue. It allows the consumer to send to specific queue using it's routing key
        $channel->queue_bind($queue_name, 'topic_logs', $bindings_keys);
}
echo "[*] Waiting for logs. To exit press CTRL+C\n";

$callback = function ($msg)
{

        echo ' [x] ', $msg->delivery_info['routing_key'],':', $msg->body, "\n";
};

$channel->basic_consume($queue_name,'',false,true,false,false, $callback);

while ($channel->is_consuming())
{

        $channel->wait();
}

$channel->close();
$connection->close();

?>

