<?php	
	ini_set('display_error',0);
	ini_set('error_log','/var/log/php.log');
	openlog('php', LOG_CONS | LOG_NDELAY | LOG_PID, LOG_USER | LOG_PERROR);
	syslog(LOG_ERR, 'Error!');
	syslog(LOG_INFO, 'Hello World!');
	closelog();
	error_log("Your message here");
	try {
		$error = 'Always throw this error';
		//throw new Exception($error);
		echo 'Never executed';
		$myfile = fopen("hello.txt","r");
		1/0;
	}
	catch(Exception $e) 
	{
		error_log('Caught exception:' . $e->getMessage(). "\n");
        }

?>
