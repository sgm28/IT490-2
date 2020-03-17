# IT490-2
Insomina Cookies

<br>Summary</br>:
  A website were the user can view Facebook, Twitter, and Instagram all on one page.

<br>How it works:</br>
  The frontEnd folder is downloaded to /var/www/html/ directory on the application virtual machine.
  The backEnd folder is downloaded to database virtual machine.
  The RabbitMQ Virtual machine is started and running RabbitMQSever.
  The RabbitMQSereverSample.php is execute (php RabbitMQServerSample.php).
  Appache webserver is started.
  The user types the ip address of the apache webserver follow by /Register.html .
  Ex: 192.168.1.4/Register.html .
  The user fills out the require information and submits the application.
  The following takes place:

  Register.html -> Register.php -> send data to RabbitMQServer -> RabbitMQServer send data to -> RabbitMQServerSample.php -> sends data to
  MySQL database.

  MySQL database response back with fail or success -> RabbitMQServerSample.php -> sends fail or success data back to RabbitMQServer -> 
  RabbitMQServer sends data back to ->Register.php -> Displays the results.

  The user then go the login page:
  Ex: 192.168.1.4/Login.html.
  The user fills out the require information and submits the application.

  The following takes place:
  Login.html -> Login.php -> sends data to RabbitMQServer -> RabbitMQServer sends data to -> RabbitMQServerSample.php -> 
  sends data to MYSQL database. MySQL database response back with fail or success -> RabbitMQServerSample.php -> sends fail or success
  data back to RabbitMQServer -> RabbitMQServer sends data back to -> Register.php -> Displays the results.

<br>What it's supposed to do</br>
  Display users Facebook, Twitter, Instagram on one page.
 
 
Last Modify: 3/17/2020





