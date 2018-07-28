	<?php  
	include("../../config/config.php");
	include("../classes/User.php");

	$query = $_POST['query'];
	$userLoggedIn = $_POST['userLoggedIn'];
	$groupname=$_POST['groupname'];



	$names = explode(" ", $query);

	if(strpos($query, "_") !== false) {
		$usersReturned = mysqli_query($con, "SELECT * FROM users WHERE username LIKE '$query%' AND user_closed='no' LIMIT 8");
	}
	else if(count($names) == 2) {
		$usersReturned = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '%$names[0]%' AND last_name LIKE '%$names[1]%') AND user_closed='no' LIMIT 8");
	}
	else {
		$usersReturned = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '%$names[0]%' OR last_name LIKE '%$names[0]%') AND user_closed='no' LIMIT 8");
	}
	if($query != "") {
		while($row = mysqli_fetch_array($usersReturned)) {

			
	 			

			$user = new User($con, $userLoggedIn);
			

			$username=$row['username'];


			echo "<div class='resultDisplay' style='    padding: 5px 0 5px;
													    height: 60px;
													    border-bottom: 1px solid #D3D3D3;
													    background-color: white;'>
						
							<div class='liveSearchProfilePic'>
								<img src='". $row['profile_pic'] . "'>
							</div>

							<div class='liveSearchText'>
								".$row['first_name'] . " " . $row['last_name']. "
								<p style='margin: 0;'>". $row['username'] . "</p>
								
							</div>
						
						<form action='group.php?u=new' method='POST'>
							
								<input type='hidden' name='var' value=".$username."> 
								<input type='hidden' name='var1' value=".$groupname."> 
								
								
	 								<input type='submit' name='add_friend' class='success' value='Add'>
									<input type='submit' name='Remove_friend' class='danger' value='Remove'>
							


	 			
	 					</form>


					</div>";



			
			

		}
	}

	?>
