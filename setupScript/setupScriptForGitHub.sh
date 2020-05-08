#!/bin/bash

#Create an ssh key for "sgm28@njit.edu" replace "sgm28@njit.edu" with your email.
#changed to home directory first
cd ..
ssh-keygen -t rsa -b 4096 -C "sgm28@njit.edu"

#Execute the script and press enter twice

sleep(5)

#copy the content of the text  file
vi ~/.ssh/id_rsa.pub

