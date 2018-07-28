<?php 
include("includes/header.php");

$message_obj = new Message($con, $userLoggedIn);
$flag=0;
if(isset($_GET['profile_username'])) {
	$username = $_GET['profile_username'];
	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
	$user_array = mysqli_fetch_array($user_details_query);
	if($user_array==0)
	{
		$flag=1;
		$groupname=$_GET['profile_username'];
		$group_details_query=mysqli_query($con, "SELECT * FROM groups WHERE groupname='$groupname'");
		$group_array = mysqli_fetch_array($group_details_query);
		$profile_group_obj = new Group($con, $groupname); 

	}
}

 ?>

<style type="text/css">
	 	.wrapper {
	 		margin-left: 0px;
			padding-left: 0px;
	 	}

 	</style>


<div class="profile_left" style="
		top: -40px;
		width: 17%;
		max-width: 240px;
		min-width: 130px;
		height: 100%;
		float: left;
		position: relative;
		background-color: #37B0E9;
		border-right: 10px solid #83D6FE;
		color: #CBEAF8;
		margin-right: 20px;
		">
		<?php 
		if($flag==0)
			{
				$pic=$user_array['profile_pic'];
		 		echo "<img src=".$pic." style='
		 		min-width: 80px;
				width: 55%;
				margin: 20px;
				border: 5px solid #83D6FE;
				border-radius: 100px;

		 		'>";
	 		}
 		else
 			{
		 		$pic=$group_array['group_profile_pic'];
		 		echo "<img src=".$pic." style='
		 		min-width: 80px;
				width: 55%;
				margin: 20px;
				border: 5px solid #83D6FE;
				border-radius: 100px;

		 		'>";
 			}
 		?>

 		<?php if($flag==0){
 			$profile_user_obj = new User($con, $username); 
 			if($profile_user_obj->isClosed()) {
 				header("Location: user_closed.php");
 			}
 			}
 			?>




 	</div>

 
	<div class="profile_main_column column">

    <?php  
        
      if($flag==0)
      {
          echo "<h3>" . $profile_user_obj->getFirstAndLastName() . "</h3><hr>";

          echo "Username    :".$profile_user_obj->getUsername()."<br><br>";
          echo "Email       :".$profile_user_obj->getEmail()."<br><br>";

          echo "<h4>Your Groups :</h4>";
          echo $profile_user_obj->getGroupNamesForProfile();
      }
      else
      {
      	$groupname= $profile_group_obj->getGroupName();
      	  echo "<h3>" . $profile_group_obj->getGroupName() . "</h3><hr>";
      	  echo "<a href='uploadgrouppic.php?u=$groupname'>Upload new group profile picture</a> <br>";
      	   echo "<h4>Group Members :</h4><br>";
      	  echo $profile_group_obj->getMemberNamesForProfile();
      }

?>

   </div>


	</div>
	
</body>




</html>
