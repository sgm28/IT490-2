<?php

//Moustapha Sarr
//New Account Function

//Get function
function GET($FirstName, &$flag)
{
  global $db;
  $v = $_POST[$FirstName];
  $v = trim ($v);
  
  if ($v == "")
  { $flag = true; echo "<br><br> $FirstName is empty." ;return; }
  //$v = mysqli_real_escape_string($db, $v);
  echo "<br>The $FirstName you have entered is: $v" ;
  return $v;
}

function CreateAccount ($FirstName, $LastName, $Email, $Password, $DOB, $db){

    $s = "insert into UserData  values ( '$FirstName', '$LastName', '$Email', '$Password','$DOB')";  
    print "<br>SQL insert statement is: $s "; 
    ($t = mysqli_query( $db,  $s ) ) or die( "<br>SQL error: " . mysqli_error($db) );
    print "<br> Thank You ! Registration was Successful <br>";
}

?>


