<?php

$a = '/../frontEnd/IT490/vendor/autoload.php';
echo "the path is: ".$a."\n";
require_once __DIR__ . "$a";

//~/IT490-2/frontEnd/IT490/vendor/autoload.php

//require_once('~/IT490-2/frontEnd/IT490/vendor/autoload.php'); 
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('52.176.58.43',5672,'app', '1');
$channel = $connection->channel();


$data = implode('', array_slice($argv,1));

if (empty($data))
{

	$data = "Hello World!";
}

$msg = new AMQPMessage($data);

$channel->basic_publish($msg, '', 'hello');

echo ' [x] Sent ', $data, "\n";

$channel->close();
$connection->close();

?>
