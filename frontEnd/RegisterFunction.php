<?php

//Moustapha Sarr
//New Account Function

//Get function
function GET($UserInput, &$flag)
{

  $v = $_GET [$UserInput];
  //Removes whitespace for the the UserInput
  $v = trim ($v);
  
  if ($v == "")
  { $flag = true; echo "<br><br> $UserInput is empty." ;return; }
  echo "<br>The $UserInput you have entered is: $v" ;
  return $v;
}



?>


