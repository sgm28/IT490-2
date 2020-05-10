#kamal

<?php
require_once("/var/www/html/IT490-2/frontEnd/IT490/login.php");
session_start();

if(isset($_SESSION["Username"];)){ 

  session_destroy();
  echo "<script>location.href='login/php'</script>; }
  
else{
  echo "<script>location.href='login/php'</script>;  }
  ?>
