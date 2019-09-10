<?php

$servername = "localhost";
$username = "root";
$password = "";
$mydatabase="first";


 // Create connection 

$conn = mysqli_connect($servername, $username, $password,$mydatabase );

//Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
//} else{
//echo "Connected successfully";
}





?>