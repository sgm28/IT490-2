#!/bin/bash

sudo apt-get update -y

sudo apt-get upgrade -y


sudo apt install php -y


sudo apt install php-mbstring -y


cd ~/IT490-2/apiBackEnd/

git clone  https://github.com/MattToegel/IT490.git

sudo apt install php php-mbstring php-bcmath -y

sudo apt install composer -y


composer install -y


composer require php-amqplib/php-amqplib -y


sudo apt install php-mysqli -y


sudo rm -r '/etc/php/7.2/cli/php.ini
