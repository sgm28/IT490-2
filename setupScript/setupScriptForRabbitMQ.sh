#!/bin/bash
sudo apt-get install
sudo apt install rabbitmq-server
sudo systemctl rabbitmq.service
sudo systemctl status rabbitmq-server.service

#This adds a a new user name app and password 1
sudo rabbitmqctl add_user app 1

#This adds a new user name db and password 2
sudo rabbitmqctl add_user db 2

#This adds a user name api and password 3
sudo rabbitmqctl add_user api 3

#This sets permission for the app  user:
sudo rabbitmqctl set_permissions -p / app ".*" ".*" ".*"

#This sets permission for the db user
sudo rabbitmqctl set_permissions -p / db ".*" ".*" ".*"

#This sets permission for the api user
sudo rabbitmqctl set_permissions -p / api ".*" ".*" ".*"

#Show the list of users
sudo rabbitmqctl list_users

