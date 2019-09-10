<?php 
session_start();
include ('connection.php');

/*if ( array_key_exists("logout",$_GET) ) {
	
	unset($_SESSION);
	setcookie("id", "", time()- 60*60);
	$_COOKIE['id']="";
} else if (( array_key_exists("id" , $_SESSION) AND $_SESSION['id'] OR array_key_exists("id",$_COOKIE) AND $_COOKIE['id'])) {
	header("location:login.php");
	
}
*/


$error="";
if (array_key_exists("submit",$_POST)) {


if (!$_POST['email']) {
	$error.="an email address required<br>";
	
}
if (!$_POST['password']) {
	$error.="a password is required <br>";
	
}

if ($error !="") {
	$error = "there was an error in your form<br>".$error;
} else{

		if ($_POST['signup']== '1') {
			
		  


	      $query=" SELECT id FROM secret WHERE email='".mysqli_real_escape_string($conn,$_POST['email'])."' LIMIT 1";

	      $result= mysqli_query($conn,$query);

		  if (mysqli_num_rows($result) > 0) {
			
			$error = " that email address is taken";
		 }  else{ 

			$query= " INSERT INTO `secret`(email, password)  VALUES('".mysqli_real_escape_string($conn,$_POST['email'])."','".mysqli_real_escape_string($conn,$_POST['password'])."')"; 

			if (!mysqli_query($conn,$query)) {
					$error=" couldnt sign you up";
			}else{

				$query=" UPDATE secret SET password= '".md5(md5(mysqli_insert_id($conn)).$_POST['password']). "' WHERE id = ".mysqli_insert_id($conn).""; 

					mysqli_query($conn,$query);

					$_SESSION['id']= mysqli_insert_id($conn);
					if ($_POST['stayloggedin'] == '1') {
						setcookie("id",mysqli_insert_id($conn), time() * 60*60*24*365);
					}

				header("location:loggedinpage.php");
			} 
	} 
		} else{
			$query= " SELECT * FROM secret WHERE email ='".mysqli_real_escape_string($conn, $_POST['email'])."'";

						$result= mysqli_query($conn,$query);
						$row = mysqli_fetch_array($result);

						if (isset($row )){	
						$hashedpassword = md5(md5($row['id']).$_POST['password']);
					
						if ($hashedpassword == $row['password']) {
								echo $hashedpassword;

							$_SESSION['id']= $row['id'];
							if ($_POST['stayloggedin'] == '1') {
						   setcookie("id",$row['id'], time() + 60*60*24*365);
					      }
					      	header("location:loggedinpage.php");

						} else{
							$error="that email/password combination could not be found";
						
						}

					}
		}

 
} 




}


 ?>

<?php include("header.php") ?>

  <body>
	
		<div class="container">
			<div class="row">
				<div class="col-md-12">
			
		<h1>SECRET DIARY</h1>
		<p><strong>Store Your Thoughts Permanently</strong> </p>

<div></div>

	<?php if ($error !=""){
	echo "<p class='alert alert-success alert-dismissable'>$error</p>";
    }

    ?>
</p>

<form method="post" id="signupform">

	<fieldset class="form-group">
	<input type="email" class="form-control" name="email" placeholder="email">
	</fieldset>

	<fieldset class="form-group">
	<input type="password" class="form-control" name="password" placeholder="password">
</fieldset>

<div class="checkbox">
	<label>	
	<input type="checkbox"  name="stayloggedin" value="1"> stay Logged In 
</label>
</div>

<fieldset class="form-group">
	<input type="hidden" name="signup" value="1">
	<button type="text"class="btn btn-success" value= "" name="submit">sign up</button>
	</fieldset> <br>
	
	<p><a class="toggleForms"><b>LOG IN</b></a></p>

	
</form>

<form method="post" id="loginform"> 
<fieldset class="form-group">
	<input type="email" name="email" class="form-control" placeholder="email">
	</fieldset>

	<fieldset class="form-group">
	<input type="password" name="password" class="form-control" placeholder="password">
</fieldset>

<div class="checkbox">
	<label>	
	<input type="checkbox"  name="stayloggedin" value="1"> stay Logged In 
</label>
</div>


<fieldset class="form-group">
	<input type="hidden" name="signup"  value="0">
	<button type="text"class="btn btn-success" value= "" name="submit">Log In</button>

	</fieldset>

	<p><a class="toggleForms"><b>SIGN UP</b></a></p>
</form>


</div>
</div>
		</div>     




<<?php include("footer.php") ?>






   
