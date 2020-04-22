<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConneciton('52.176.58.43',5672,'APP', '1');
$channel = $connection->channel();


$data = implode('', array_slice($argv,1));

if (empty($data))
{

	$data = "Hello World!";
}

$msg = new AMQPMesssage($data);

$channel->basic_publish($msg, '', 'hello');

echo ' [x] Sent ', $data, "\n";

$channel->close();
$connection->close();

?>
