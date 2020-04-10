#Replace the testRabbitMQ.ini file in the IT490 with the testRabbitMQ.ini file in this folder

myvariable=$(whoami)

cp testRabbitMQ.ini /home/"$myvariable"/IT490-2/frontEnd/IT490

mv testRabbitMQ.ini /var/www/html/IT490-2/frontEnd/IT490/
