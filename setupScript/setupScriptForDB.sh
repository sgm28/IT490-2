#!/bin/bash

sudo apt-get update

sudo apt-get upgrade

sudo apt install php

sudo apt install php-mbstring

cd ~/IT490-2/backEnd

git clone  https://github.com/MattToegel/IT490.git

sudo apt install php-mbstring

sudo apt install composer

composer require php-amqplib/php-amqplib

sudo apt install php-mysqli;

sudo rm -r '/etc/php/7.2/cli/php.ini'

sudo cp -r php.ini /etc/php/7.2/cli/

#sudo apt-get install apache2
