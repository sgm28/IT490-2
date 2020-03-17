# IT490-2
The OG Insomnia Cookies

<br>Summary:</br>
  A website where the user can view Facebook, Twitter, and Instagram all on one page.

<br>How it works:</br>
  <ol>
    <li>The frontEnd folder is downloaded to /var/www/html/ directory on the application virtual machine.</li>
    <li>The backEnd folder is downloaded to database virtual machine.</li>
    <li>The RabbitMQ Virtual machine is started and running RabbitMQSever.</li>
    <li>The RabbitMQServerSample.php is executed (php RabbitMQServerSample.php).</li>
    <li>Apache webserver is started.</li>
    <li>The user types the ip address of the Apache Webserver followed by /Register.html .
      <i>Ex: 192.168.1.4/Register.html</i> .</li>
    <li>The user fills out the require information and submits the application.</li>
    <li>The following takes place:<br>
      <ol>
        <li>Register.html runs the Register.php script.</li>
        <li>Register.php sends input data to the RabbitMQ Server.</li>
        <li>RabbitMQ Server sends data to the RabbitMQServerSample.php script.</li>
        <li>RabbitMQServerSample.php sends data to the MySQL database.<li>
        <li>MySQL database responds back to RabbitMQServerSample.php with failure or success.</li>
        <li>RabbitMQServerSample.php sends failure or success data back to RabbitMQ Server.</li>
        <li>RabbitMQ Server sends data back to Register.php.</li>
        <li>Register.php displays the results.</li>
      </ol>
    </li>
    <li>The user then goes to the login page:
      <i>Ex: 192.168.1.4/Login.html .</i></li>
    <li>The user fills out the require information and submits the application.</li>
    <li>
      <ol>The following takes place:<br>
        <li>Login.html runs the Login.php script.</li>
        <li>Login.php sends the input data to the RabbitMQ Server.</li>
        <li>RabbitMQ Server sends data to the RabbitMQServerSample.php script.</li>
        <li>RabbitMQServerSample.php sends data to the MYSQL database.</li>
        <li>The MySQL database responds back to RabbitMQServerSample.php with failure or success.</li>
        <li>RabbitMQServerSample.php sends failure or success data back to RabbitMQ Server.</li>
        <li>RabbitMQ Server sends data back to Login.php.</li>
        <li>Login.php displays the results.</li>
      </ol>
    </li>
  </ol>

<br>What it's supposed to do</br>
  Display the user's Facebook, Twitter, Instagram on one page.
 
 
Last Modified: 3/17/2020





