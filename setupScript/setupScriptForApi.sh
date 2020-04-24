#!/bin/bash

sudo apt-get update

sudo apt-get upgrade

sudo apt install php

sudo apt install php-mbstring

cd ~/IT490-2/apiBackEnd/

git clone  https://github.com/MattToegel/IT490.git

sudo apt install php php-mbstring php-bcmath -y

sudo apt install composer

composer install

composer require php-amqplib/php-amqplib

sudo apt install php-mysqli

sudo rm -r '/etc/php/7.2/cli/php.ini
