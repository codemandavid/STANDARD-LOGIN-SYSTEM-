<?php 
session_start();



if (array_key_exists("id",$_COOKIE)) {
	
	$_SESSION['id']= $_COOKIE['id']; 
}



if ( array_key_exists("id",$_SESSION)) {
	echo "LOGGED IN  <a href='login.php?logout=1'>log out</a>";
} else { 
	header("location:login.php");
}



 ?>
 <?php include("header.php") ?>
<div class="container">
	
<textarea id="diary" class="form-control ">
	

</textarea>












</div>






 <?php include("footer.php") ?>
