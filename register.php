<?php  
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>


<html>
<head>
	<title>Welcome to Anonymous!</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register_style_1.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>


</head>
<body>

	<?php  

	if(isset($_POST['register_button'])) {
		echo '
		<script>

		$(document).ready(function() {
			$("#first").hide();
			$("#second").show();
		});

		</script>

		';
	}


	?>




	<div class="wrapper">


<div class="container">
	<div class="row">
		<div class="col-sm-12 text-center pt-5 color"><img class="logo_main" src="assets/images/logo/Asset 4.png" alt="logo" width="60px" height="100px">
</div>
	</div>
</div>
		<div class="login_box">

			<div class="login_header">
				<h1></h1>
				Grayshade 
			</div>
			<br>
			<div id="first">

				<form action="register.php" method="POST">
					<input type="email" name="log_email" placeholder="Email Address" value="<?php 
					if(isset($_SESSION['log_email'])) {
						echo $_SESSION['log_email'];
					} 
					?>" required>
					<br><br>
					<input type="password" name="log_password" placeholder="Password">
					<br>
					
					<?php if(in_array("email is not confirmed!<br>", $error_array)) echo  "email is not confirmed!<br>";
							else if(in_array("Email or password was incorrect<br>", $error_array)) echo  "Email or password was incorrect<br>";
							else if(in_array("Your email has been verified! You can log in now!<br>", $error_array)) echo  "Your email has been verified! You can log in now!<br>";

					 ?>
					<br>
					<input type="submit" name="login_button" value="Login">
					<br><br>
					<a href="#" id="signup" class="signup color_white">Need an account? Register here!</a>

				</form>

			</div>

			<div id="second">

				<form action="register.php" method="POST">
					<input type="text" name="reg_fname" placeholder="First Name" value="<?php 
					if(isset($_SESSION['reg_fname'])) {
						echo $_SESSION['reg_fname'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "Your first name must be between 2 and 25 characters<br>"; ?>
					
					


					<input type="text" name="reg_lname" placeholder="Last Name" value="<?php 
					if(isset($_SESSION['reg_lname'])) {
						echo $_SESSION['reg_lname'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "Your last name must be between 2 and 25 characters<br>"; ?>

					

					<input type="text" name="anonymous_name" placeholder="Anonymous Name" value="<?php 
					if(isset($_SESSION['anonymous_name'])) {
						echo $_SESSION['anonymous_name'];
					} 
					?>" required>
					<br>
					

					

					<input type="email" name="reg_email" placeholder="Email" value="<?php 
					if(isset($_SESSION['reg_email'])) {
						echo $_SESSION['reg_email'];
					} 
					?>" required>
					<br>

					
					<?php if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>"; 
					else if(in_array("Invalid email format<br>", $error_array)) echo "Invalid email format<br>";
					 ?>


					<input type="password" name="reg_password" placeholder="Password" required>
					<br>
					<input type="password" name="reg_password2" placeholder="Confirm Password" required>
					<br>
					<?php if(in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>"; 
					else if(in_array("Your password can only contain english characters or numbers<br>", $error_array)) echo "Your password can only contain english characters or numbers<br>";
					else if(in_array("Your password must be betwen 5 and 30 characters<br>", $error_array)) echo "Your password must be betwen 5 and 30 characters<br>"; ?>

<br>
					<input type="submit" name="register_button" value="Register">
					<br>

					<?php if(in_array("Something went wrong. Please try again!<br>", $error_array)) echo "Something went wrong. Please try again!<br>";
							else if(in_array("A Confirmation Email will be sent within 5 minutes ! Please verify your Email to Login!<br>", $error_array)) echo "A Confirmation Email will be sent within 5 minutes ! Please verify your Email to Login!<br>";
					 ?>
					 <br>
					<a href="#" id="signin" class="signin color_white">Already have an account? Sign in here!</a>
				</form>
			</div>

		</div>

	</div>


</body>
</html>
