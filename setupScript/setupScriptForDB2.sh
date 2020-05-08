#!/usr/bin/env bash
#https://www.vic-l.com/automate-mysql-secure-installation-using-bash/
sudo apt-get update -y && sudo apt-get upgrade -y && sudo apt-get -y  install mysql-server

sudo mysql -e "SET PASSWORD FOR root@localhost = PASSWORD('something');FLUSH PRIVILEGES;"

sudo mysql -e "DELETE FROM mysql.user WHERE User='';"

sudo mysql -e "DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');"

sudo mysql -e "DROP DATABASE test;DELETE FROM mysql.db WHERE Db='test' OR Db='test_%';"

sudo mysql -u root -p -e "CREATE USER 'it490'@'localhost' IDENTIFIED BY 'teamWork';GRANT ALL PRIVILEGES ON *.* TO 'it490'@'localhost';FLUSH PRIVILEGES;"

sudo mysql -u root -p -e "CREATE DATABASE members"

sudo mysql -u root -p -e "GRANT ALL PRIVILEGES ON *.* TO 'it490'@'localhost'";
