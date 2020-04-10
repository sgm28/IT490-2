#!/bin/bash
#System level
sudo apt-get update

sudo apt-get upgrade

sudo apt install php-mysqli


 #Gets the user that is login through ssh when running script	
 user=$(w -shf)
 #Tell what the string seprator is.
 IFS=' '

 read -a details <<< "$user"
 #Array call details create an array based on sperator
 #1 user #2pts (session) 
 sshuser=${details[0]}
 
echo "Found user: $sshuser"


cd ~/IT490-2/frontEnd

git clone  https://github.com/MattToegel/IT490.git

cd  /IT490-2/frontEnd/IT490/

#sudo chown $sshuser:$sshuser ~/IT490-2/ frontEnd/IT490/ --recursive


sudo chown $sshuser:$sshuser ~/IT490-2/ --recursive

sudo apt install php-mbstring php-bcmath -y

#install package
sudo apt install composer

#-c for command, install things from the json file as the login user
#su -c "composer install" - $sshuser

#sudo composer install
composer install

#Wait for composer to be install before copying
#sleep 5


composer require php-amqplib/php-amqplib

#sudo cp -r ~/IT490-2/frontEnd/vendor/ ~/IT490-2/frontEnd/IT490/


sudo apt-get install apache2

sudo cp -r  ~/IT490-2/ /var/www/html/
