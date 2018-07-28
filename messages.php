<?php 
include("includes/header.php");
$user_obj = new User($con, $userLoggedIn);
$message_obj = new Message($con, $userLoggedIn);
if(isset($_GET['u']) AND $_GET['u']!="new"){
	$user_to = $_GET['u'];
	$true_name=$user_to;
	$query=mysqli_query($con,"SELECT * FROM users WHERE username='$user_to'");
		
		if(mysqli_num_rows($query)==0)
		{
			$query1=mysqli_query($con,"SELECT * FROM users WHERE anonymous_name='$user_to'");
			$row1=mysqli_fetch_array($query1);
			$set=$row1['username'];
			$user_to=$set;
		}
		else
		{
			$row=mysqli_fetch_array($query);
			$set=$userLoggedIn;
		}
	
}
else {
	
	
		$user_to = 'new';
}

if($user_to != "new")
	{
		$user_to_obj = new User($con, $user_to);
	}

if(isset($_POST['post_message'])) {

	if(isset($_POST['message_body'])) {
		$body = mysqli_real_escape_string($con, $_POST['message_body']);
		$date = date("Y-m-d H:i:s");
		$message_obj->sendMessage($user_to, $body, $date,$set);
		    header ('Location: messages.php'.'?u=' . $_GET['u']);
                exit();
	}

}

 ?>

<!-- search bar starting -->

<div class="search_bar"></div>
	<div class="search" style="margin: 8px 0 0 20px;">

			<form action="search.php" method="GET" name="search_form">
				<input type="text" onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLoggedIn; ?>')" name="q" placeholder="Search..." autocomplete="off" id="search_text_input" style="
													border: thin solid #E5E5E5;
												  	/*float: left;*/
												  	height: 30px;
												  	position: relative;
												  	top:-35px;
												  	
												  	outline: 0;
												  	width: 100px;
												  	border-top-right-radius: 0;
												  	border-bottom-right-radius: 0;
												  	border-top-left-radius: 3px;
												  	border-bottom-left-radius: 3px;
												  	    margin-bottom: 10;
												  	        padding-left: 4px;
												  	            border-radius: 5px;



				">

				<div class="button_holder" style="
													background-color: #F1F1F1;
												  	border: thin solid #e5e5e5;
												  	cursor: pointer;
												  	/*float: left;*/
												  	position: relative;
												  	top: -35px;
												  	
												  	height: 30px;
												  	text-align: center;
												  	width: 50px;
												  	border-top-right-radius: 3px;
												  	border-bottom-right-radius: 3px;
												  	    border-radius: 5px;
	

				">
					<img src="assets/images/icons/magnifying_glass.png" style="margin-top: 4px;
    																			width: 20px;">
				</div>

			</form>

			<div class="search_results">
			</div>

			<div class="search_results_footer_empty">
			</div>



		</div>

								<!-- search bar ending -->


<br>
<br>
<br>



<div class="container-fluid " >
	<div class="row outline d-flex justify-content-center" >

<div class="col-xs-12 col-md-8 col-md-push-2" >
 <div class="user_details column float">
		<a href="<?php echo $userLoggedIn; ?>">  <img src="<?php echo $user['profile_pic']; ?>"> </a>

		<div class="user_details_left_right">
			<a class="space_between" href="<?php echo $userLoggedIn; ?>">
			<?php 
			echo $user['first_name'] . " " . $user['last_name'];

			 ?>
			</a>
			
			<div class="space_between"> <a class="space_between" href="messages.php?u=new">New Message</a>
			</div>
			
			<div class="space_between"><a class="space_between" href="group.php?u=new">New Group</a></div>
			
		</div>
	</div>
	</div>
	</div>
	</div>




	
	



		<div class="container-fluid" >
	
	<div class="row" >

<div class="col-xs-12 col-md-4 col-md-push-2" >

	<ul class="nav nav-pills">
  <li class="active"><a data-toggle="pill" href="#a">Your<br>Chats</a></li>
  <li><a data-toggle="pill" href="#b">Anonymous<br>Chats</a></li>
  <li><a data-toggle="pill" href="#c">Group<br>Chats</a></li>
</ul>

<div class="tab-content">
	<div class="user_details column tab-pane fade in active" id="a">
			<h4>Your Chats</h4>
			<div class="loaded_conversations">
				<?php echo $message_obj->getConvos(); ?>
			</div>
			<br>
			

		</div>






<div class="user_details column tab-pane fade" id="b">
			<h4>Anonymous Chats</h4>

			<div class="loaded_conversations">
				<?php echo $message_obj->getAnonymousConvos(); ?>
			</div>
			<br>
			

		</div>
	
	



	
	<div class="user_details column tab-pane fade" id="c">
			<h4>Group Chats</h4>

			<div class="loaded_conversations">
				<?php 

					
					$query=$user_obj->getGroupArray();
				while($rows = mysqli_fetch_array($query)) {
   					$groupnamee=explode(',', $rows['group_array']);//what will do here
   					foreach($groupnamee as $out) {
   						if($out!="")
      					echo $message_obj->getGroupConvos($out); 
      			
  					}
  				}
				?>
				
			</div>
			<br>
			

		</div>




</div>	

</div>




<div class="col-xs-12 col-md-4 col-md-push-2    " >
			<div class="main_column column" id="main_column">
		<?php  
		if($user_to != "new"){
			if($true_name==$user_to)
			{
				echo "<h4>You and <a href='$user_to'>" . $user_to_obj->getFirstAndLastName() . "</a></h4><hr><br>";
				echo "<div class='loaded_messages' id='scroll_messages'>";
				echo $message_obj->getAnonymousMessages($user_to);
				echo "</div>";
			}
		else
			{
				echo "<h4>You and " . $user_to_obj->getAnonymousName() . "</h4><hr><br>";
				echo "<div class='loaded_messages' id='scroll_messages'>";
				echo $message_obj->getMessages($user_to);
				echo "</div>";
			}

			
		}
		else {
			echo "<h4>New Message</h4>";
		}
		?>



		<div class="message_post">
			<form action="" method="POST">
				<?php
				if($user_to == "new") {
					echo "Select the friend you would like to message <br><br>";
					?> 
					To: <input type='text' onkeyup='getUsers(this.value, "<?php echo $userLoggedIn; ?>")' name='q' placeholder='Name' autocomplete='off' id='seach_text_input'>

					<?php
					echo "<div class='results'></div>";
				}
				else {
					echo "<textarea name='message_body' id='message_textarea' placeholder='Write your message ...'></textarea>";
					echo "<input type='submit' name='post_message' class='info' id='message_submit' value='Send'>";
				}

				?>
			</form>

		</div>

		<script>
			var div = document.getElementById("scroll_messages");
			div.scrollTop = div.scrollHeight;
		</script>

	</div>

</div>







</div>	

</div>

  <div class="footer">
  <strong>Copyright@2018  </strong><strong><a href="feedback.php">Feedback</a></strong>
</div>