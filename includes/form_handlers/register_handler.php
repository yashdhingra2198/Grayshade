<?php


//Declaring variables to prevent errors
$fname = ""; //First name
$lname = ""; //Last name
$anonymous_name="";//anonymous name
$em = ""; //email

$password = ""; //password
$password2 = ""; //password 2
$date = ""; //Sign up date 
$error_array = array(); //Holds error messages

if(isset($_POST['register_button'])){

	//Registration form values

	//First name
	$fname = strip_tags($_POST['reg_fname']); //Remove html tags
	$fname = str_replace(' ', '', $fname); //remove spaces
	$fname = ucfirst(strtolower($fname)); //Uppercase first letter
	$_SESSION['reg_fname'] = $fname; //Stores first name into session variable

	//Last name
	$lname = strip_tags($_POST['reg_lname']); //Remove html tags
	$lname = str_replace(' ', '', $lname); //remove spaces
	$lname = ucfirst(strtolower($lname)); //Uppercase first letter
	$_SESSION['reg_lname'] = $lname; //Stores last name into session variable

	//Anonymous name
	$anonymous_name = strip_tags($_POST['anonymous_name']); //Remove html tags
	$anonymous_name = str_replace(' ', '', $anonymous_name); //remove spaces
	$anonymous_name = ucfirst(strtolower($anonymous_name)); //Uppercase first letter
	$_SESSION['anonymous_name'] = $anonymous_name; //Stores last name into session variable


	//email
	$em = strip_tags($_POST['reg_email']); //Remove html tags
	$em = str_replace(' ', '', $em); //remove spaces

	$_SESSION['reg_email'] = $em; //Stores email into session variable

	
	//Password
	$password = strip_tags($_POST['reg_password']); //Remove html tags
	$password2 = strip_tags($_POST['reg_password2']); //Remove html tags

	$date = date("Y-m-d"); //Current date


		//Check if email is in valid format 
		if(filter_var($em, FILTER_VALIDATE_EMAIL)) {

			$em = filter_var($em, FILTER_VALIDATE_EMAIL);

			//Check if email already exists 
			$e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

			//Count the number of rows returned
			$num_rows = mysqli_num_rows($e_check);

			if($num_rows > 0) {
				array_push($error_array, "Email already in use<br>");
			}
			else
			{
				$token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
				$token = str_shuffle($token);
				$token = substr($token, 0, 10);

			}


		}
		else {
			array_push($error_array, "Invalid email format<br>");
		}


	


	if(strlen($fname) > 25 || strlen($fname) < 2) {
		array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
	}

	if(strlen($lname) > 25 || strlen($lname) < 2) {
		array_push($error_array,  "Your last name must be between 2 and 25 characters<br>");
	}

	if($password != $password2) {
		array_push($error_array,  "Your passwords do not match<br>");
	}
	else {
		if(preg_match('/[^A-Za-z0-9]/', $password)) {
			array_push($error_array, "Your password can only contain english characters or numbers<br>");
		}
	}

	if(strlen($password > 30 || strlen($password) < 5)) {
		array_push($error_array, "Your password must be betwen 5 and 30 characters<br>");
	}


	if(empty($error_array)) {
		$password = md5($password); //Encrypt password before sending to database

		//Generate username by concatenating first name and last name
		$username = strtolower($fname . "_" . $lname);
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");


		$i = 0; 
		//if username exists add number to username
		while(mysqli_num_rows($check_username_query) != 0) {
			$i++; //Add 1 to i
			$username1 = $username . "_" . $i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username1'");
		}
		if($i>0)
		{
			$username=$username1;
		}
		$check_anonymous_name_query = mysqli_query($con, "SELECT anonymous_name FROM users WHERE anonymous_name='$anonymous_name'");
		$i = 0; 
		//if anonymous_name exists add number to anonymous_name
		while(mysqli_num_rows($check_anonymous_name_query) != 0) {
			$i++; //Add 1 to i
			$anonymous_name1 = $anonymous_name . "_" . $i;
			$check_anonymous_name_query = mysqli_query($con, "SELECT anonymous_name FROM users WHERE anonymous_name='$anonymous_name1'");
		}
		if($i>0)
		{
			$anonymous_name=$anonymous_name1;
		}

		//Profile picture assignment
		$rand = rand(1, 2); //Random number between 1 and 2

		if($rand == 1)
			{
				$profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
				$anonymous_profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
			}
		else if($rand == 2)
			{
				$profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";
				$anonymous_profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";
			}


		




    array_push($error_array, "A Confirmation Email will be sent within 5 minutes ! Please verify your Email to Login!<br>");
    $query = mysqli_query($con, "INSERT INTO users VALUES (0, '$fname', '$lname','$anonymous_name', '$username', '$em', '$password', '$date', '$profile_pic','$anonymous_profile_pic', 'no',1,'$token',',')");

}




		

		//Clear session variables 
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";
		$_SESSION['anonymous_name'] = "";
	}

}
?>
