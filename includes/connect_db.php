<?php

//$server    = "127.0.0.1";
$server    = "localhost"; 
$username  = "root";
$password  = "root";
$database  = "home_made_food";

$conn = mysqli_connect($server, $username, $password, $database);

//if(!$conn){//$conn==false
//    die("Nuk munde te konektoheni me DB");
//    
//}

if (mysqli_connect_errno())//kthen 0 nese nuk ka error, e nese ka error kthen nje nr me te madhe se 0
  {
     die("Failed to connect to MySQL: " . mysqli_connect_error());//shfaqe gabimin
     //die e ndal skripten, Reminder: kur webi del online me hjek shfaqejen e gabimeve
  } 
?>
