<?php

//Summary: Buliding a logger

require_once __DIR__ . '/../../backEnd/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$a = '/../../frontEnd/IT490/vendor/autoload.php';
//echo "the path is: ".$a."\n";
require_once __DIR__ . "$a";

//Exhange type fanouts sends messages to all queues it knows.
$channel->exchange_declare('logs', 'fanout', false, false,false);


//Reading from command line
$data = implode('', array_slice($argv,1));

if (empty($data))
{

        $data = "info: Hello World!";
}

$msg = new AMQPMessage($data);



//Publish message to exhanges name logs
$channel->basic_publish($msg, 'logs');

echo ' [x] Sent ', $data, "\n";



$channel->close();
$connection->close();

?>

