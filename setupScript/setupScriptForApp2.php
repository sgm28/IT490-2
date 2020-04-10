
<?php 
  
//This file creates a testRabbitMQ.ini  that will replace the one the professor has in 
//in the  IT490 folder.
 
//This line ask the user for the ip address and store the results in a
$a = readline('Enter the ip address of  RabbitMQ on the cloud platform: '); 




// For output 
//How the results of the variable read
echo $a."\n";


//Create the testRabbitMQ.ini files
$myfile = fopen("testRabbitMQ.ini", "w") or die("Unable to open file!");

//Create the text data that will be written to the testRabbitMQ.ini files
$txt = "BROKER_HOST={$a}\nBROKER_PORT=5672\nUSER=app\nPASSWORD=1\nVHOST=testHost\nEXCHANGE=testExchange\nQUEUE=testQueue\nAUTO_DELETE=true";
fwrite($myfile,$txt);



//Close the file
fclose($myfile);






?>
