<?php  
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Group.php");
include("includes/classes/Message.php");

if (isset($_SESSION['username'])) {
	$userLoggedIn = $_SESSION['username'];
	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
	$user = mysqli_fetch_array($user_details_query);
}
else {
	header("Location: register.php");
}

?>

<html>
<head>
	<title>Welcome to Grayshade</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Javascript -->
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/bootbox.min.js"></script>
	<script src="assets/js/demo.js"></script>
	<script src="assets/js/jquery.Jcrop.js"></script>
	<script src="assets/js/jcrop_bits.js"></script>




	<!-- CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style_1.css">
	<link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />
	<link rel="stylesheet" href="assets/css/edits.css">
	
</head>
<body>

	<div class="top_bar"> 

		<div class="logo">
			<a href="messages.php">Grayshade</a>
		</div>

	

		<nav>
			
			<?php
				//Unread messages 
				$messages = new Message($con, $userLoggedIn);
				$num_messages = $messages->getUnreadNumber();
				$num_anonymous_messages=$messages->getAnonymousUnreadNumber();
				$num_group_anonymous_messages=$messages->getGroupAnonymousUnreadNumber();
			?>

			
			<a href="messages.php">
				<i class="fa fa-home fa-lg"></i>
			</a>
			<a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'message')" >
				<i class="fa fa-comments fa-lg"></i>
				<?php
				if($num_messages > 0)
				 echo '<span class="notification_badge" id="unread_message" style="
																				padding: 3px 7px;
																				font-size: 12px;
																				font-weight: 700;
																				line-height: 1;
																				color: #fff;
																				text-align: center;
																				white-space: nowrap;
																				vertical-align: baseline;
																				background-color: #F00;
																				border-radius: 10px;
																				position: absolute;
																				left: 8px;
																				top: -5px;
				">' . $num_messages . '</span>';
				?>
			</a>
			<a href="javascript:void(0);" onclick="getAnonymousDropdownData('<?php echo $userLoggedIn; ?>', 'message')" >
				<i class="fa fa-exclamation-circle fa-lg"></i>
				<?php
				if($num_anonymous_messages > 0)
				 echo '<span class="notification_badge" id="unread_message" style="
																				padding: 3px 7px;
																				font-size: 12px;
																				font-weight: 700;
																				line-height: 1;
																				color: #fff;
																				text-align: center;
																				white-space: nowrap;
																				vertical-align: baseline;
																				background-color: #F00;
																				border-radius: 10px;
																				position: absolute;
																				left: 8px;
																				top: -5px;
				">' . $num_anonymous_messages . '</span>';
				?>
			</a>


			<a href="javascript:void(0);" onclick="getGroupAnonymousDropdownData('<?php echo $userLoggedIn; ?>', 'message')" >
				<i class="fa fa-users fa-lg"></i>
				<?php
				if($num_group_anonymous_messages > 0)
				 echo '<span class="notification_badge" id="unread_message" style="
																				padding: 3px 7px;
																				font-size: 12px;
																				font-weight: 700;
																				line-height: 1;
																				color: #fff;
																				text-align: center;
																				white-space: nowrap;
																				vertical-align: baseline;
																				background-color: #F00;
																				border-radius: 10px;
																				position: absolute;
																				left: 8px;
																				top: -5px;
				">' . $num_group_anonymous_messages . '</span>';
				?>
			</a>

			
			<a href="settings.php">
				<i class="fa fa-cog fa-lg"></i>
			</a>
			<a href="includes/handlers/logout.php">
				<i class="fa fa-sign-out fa-lg"></i>
			</a>

		</nav>

		<div class="dropdown_data_window" style="height:0px; border:none;
												background-color: #fff;
												border: 1px solid #DADADA;
												border-radius: 0 0 8px 8px;
												border-top: none;
												width: 300px;
												position: absolute;
												right: 10px;
												top: 40px;
												overflow: scroll;
												z-index: 2;
		"></div>
		<input type="hidden" id="dropdown_data_type" value="">


	</div>


	

	<div class="wrapper">