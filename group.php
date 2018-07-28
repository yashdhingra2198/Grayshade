<?php 
include("includes/header.php");
$error_array=array();





if(isset($_POST['post_addmember'])) {
$groupname=$_POST['addto_group'];
$query=mysqli_query($con,"SELECT * FROM groups WHERE group_name='$groupname'");
$row = mysqli_fetch_array($query);
if($row==0)
{
	
	array_push($error_array,"this group name does not exists!<br>");
	$groupname="";
	$_SESSION['groupname']="";
}


}
else
$groupname="";
if(isset($_POST['post_groupname'])) {
	$groupname1=$_POST['group_name'];
	$member=$userLoggedIn.",";
	$rand = rand(1, 2); //Random number between 1 and 2

		if($rand == 1)
			{
				$group_profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
				
			}
		else if($rand == 2)
			{
				$group_profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";
				
			}

	$query = mysqli_query($con, "INSERT INTO groups VALUES (0, '$groupname1', '$member','$group_profile_pic')");
	$query1=mysqli_query($con,"SELECT * FROM users WHERE username='$userLoggedIn'");
	$row = mysqli_fetch_array($query1);
	$new_group_array=$row['group_array']."$groupname1".",";
	$query2 = mysqli_query($con, "UPDATE users SET group_array='$new_group_array' WHERE username='$userLoggedIn'");

}


$message_obj = new Message($con, $userLoggedIn);
$user_obj = new User($con, $userLoggedIn);


if(isset($_GET['u']) AND $_GET['u']!="new"){
	$user_to = $_GET['u'];
		$query=mysqli_query($con,"SELECT * FROM groups WHERE group_name='$user_to'");
	
}
else {
	
		$user_to = 'new';
}

if($user_to != "new")
	{
		$group_to_obj = new Group($con, $user_to);
	}

if(isset($_POST['post_message'])) {

	if(isset($_POST['message_body'])) {
		$set="1";
		$body = mysqli_real_escape_string($con, $_POST['message_body']);
		$date = date("Y-m-d H:i:s");
		$message_obj->sendMessage($user_to, $body, $date,$set);
		    header ('Location: messages.php'.'?u=' . $_GET['u']);
                exit();
	}

}



if(isset($_POST['Remove_friend'])) {

	if(isset($_POST['var'])&&isset($_POST['var1']))
	{
		$usernamex=$_POST['var'];
		echo $usernamex;
		$groupnamex=$_POST['var1'];
		$user = new User($con,$usernamex);
		$user->removeGroup($groupnamex);
		$group = new Group($con, $groupnamex);
		$group->removeFromGroup($usernamex);
		header('Location: group.php');
		
		
	}
	
	
}


if(isset($_POST['add_friend'])) {

	if(isset($_POST['var'])&&isset($_POST['var1']))
	{
			$usernamex=$_POST['var'];
			$groupnamex=$_POST['var1'];
			$user = new User($con, $usernamex);
			$user->addGroup($groupnamex,$usernamex);
			$group = new Group($con, $groupnamex);
			$group->addToGroup($usernamex,$groupnamex);
			header('Location: group.php');
		
			
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





<div class="container-fluid " >
	<div class="row outline d-flex justify-content-center" >
<br>
<br>
<br>

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
			
			<div class="space_between"><a class="space_between" href="group.php?u=new">Group Workspace</a></div>
			
		</div>
	</div>
	</div>
	</div>
	</div>


		<div class="container-fluid" >
		<div class="row" >

<div class="col-xs-12 col-md-4 col-md-push-2" >


	<ul class="nav nav-pills"	>
  <li class="active"><a data-toggle="pill" href="#a">My<br>Chats</a></li>
  <li><a data-toggle="pill" href="#b">Anonymous<br>Chats</a></li>
  <li><a data-toggle="pill" href="#c">Group<br>Chats</a></li>
  
</ul>

<div class="tab-content">
	<div class="user_details column tab-pane fade in active" id="a">
			<h4>Chats initialised by me</h4>
			<div class="loaded_conversations">
				<?php echo $message_obj->getConvos(); ?>
			</div>
			<br>
			

		</div>






<div class="user_details column tab-pane fade" id="b">
			<h4>Chats initialsed by someone with me</h4>

			<div class="loaded_conversations">
				<?php echo $message_obj->getAnonymousConvos(); ?>
			</div>
			<br>
			

		</div>
	
	



	
	<div class="user_details column tab-pane fade" id="c">
			<h4>Group Chats that you are part of</h4>

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


	<div class="col-xs-12 col-md-4 col-md-push-2 " >

		<ul class="nav nav-pills">
  			<li class="active"><a data-toggle="pill" href="#e"><?php if($user_to != "new") echo $user_to; else echo "Create <br>New Group"?></a></li>
  			<li><a data-toggle="pill" href="#f">Add or Remove<br>Members</a></li>
  			<li><a data-toggle="pill" href="#d">Your<br>Groups</a></li>
  			
		</ul>
		<div class="tab-content">
			<div class="main_column column tab-pane fade in active" id="e">
		<?php  
		if($user_to != "new"){
			
				echo "<h4><a href='$user_to'>"."<div class='user_found_messages' style='". "'><img src='" . $group_to_obj->getGroupProfilePic() . "' style='border-radius: 5px; margin-right: 5px;'>".$group_to_obj->getGroupName()."</a></h4><hr><br>";
				echo "<div class='loaded_messages' id='scroll_messages'>";
				echo $message_obj->getGroupMessages($user_to);
				echo "</div>";
			
		}
		else {
			echo "<h4>Create New Group</h4>";
		}
		?>



		<div class="message_post">
			<form action="" method="POST">
				<?php
				if($user_to == "new") {


					echo "<textarea name='group_name' id='name_textarea' placeholder='Write group name ...'></textarea>";
					echo "<input type='submit' name='post_groupname' class='info' id='message_submit' value='Create Group'><br><br>";
					

					
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

	<div class="user_details column tab-pane fade" id="d">
			<h4>Your Groups</h4>

			<div class="loaded_conversations">
				<?php echo $user_obj->getGroupNames(); ?>
			</div>
			<br>
			

		</div>



		<div class="user_details column tab-pane fade" id="f">
			<h4>Add or Remove Members</h4>

			<div class="message_post">
			<form action="" method="POST">
				<?php
				


			
                                       	echo "Select the group to add members to it!<br> <br>";

					$query=$user_obj->getGroupArray();
						while($rows = mysqli_fetch_array($query)) 
						{
   							$groupnamee=explode(',', $rows['group_array']);//what will do here

   							echo "<Select class='change_size' name='addto_group'>";


   								foreach($groupnamee as $out) 
   								{
   									if($out!="")
   									echo "<option value=".$out.">".$out."</option>";
   								}

   								echo "</Select>";

   						}

   						echo "<input type='submit' name='post_addmember' class='info' id='message_submit' value='Done'><br><br><br>";
					
					if(in_array("this group name does not exists!<br>", $error_array)) echo  "this group name does not exists!<br>";
					if($groupname!="")
					{
						$_SESSION['groupname']=$groupname;
					}
					else if(array_key_exists('groupname',$_SESSION))
					{
						$groupname=$_SESSION['groupname'];
					}


					echo "Select the members you would like to add to ".$groupname." group <br>
					Anybody can add members to the group<br><br>";


					?> 
					Add: <input type='text' onkeyup='getUsersForGroup(this.value, "<?php echo $userLoggedIn; ?>","<?php echo $groupname; ?>")' name='q' placeholder='Name' autocomplete='off' id='seach_text_input'>

					<?php
					echo "<div class='results'></div>";
				

				?>
			</form>

		</div>
			

		</div>


</div>


</div>	


</div>	

</div>

<div class="footer">
  <strong>Copyright@2018</strong><strong><a href="feedback.php"> Feedback</a></strong><strong> Founded by APPLET & FORMAT</strong>
</div>