<?php
class User {
	private $user;
	private $con;

	public function __construct($con, $user){
		$this->con = $con;
		$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$user'");
		$this->user = mysqli_fetch_array($user_details_query);
	}

	public function getUsername() {
		return $this->user['username'];
	}

	public function getEmail() {
		return $this->user['email'];
	}

	public function getNumPosts() {
		$username = $this->user['username'];
		$query = mysqli_query($this->con, "SELECT num_posts FROM users WHERE username='$username'");
		$row = mysqli_fetch_array($query);
		return $row['num_posts'];
	}

	public function getFirstAndLastName() {
		$username = $this->user['username'];
		$query = mysqli_query($this->con, "SELECT first_name, last_name FROM users WHERE username='$username'");
		$row = mysqli_fetch_array($query);
		return $row['first_name'] . " " . $row['last_name'];
	}

	public function getAnonymousName() {
		$username = $this->user['username'];
		$query = mysqli_query($this->con, "SELECT anonymous_name FROM users WHERE username='$username'");
		$row = mysqli_fetch_array($query);
		return $row['anonymous_name'];
	}

	public function getProfilePic() {
		$username = $this->user['username'];
		$query = mysqli_query($this->con, "SELECT profile_pic FROM users WHERE username='$username'");
		$row = mysqli_fetch_array($query);
		return $row['profile_pic'];
	}
	public function getAnonymousProfilePic() {
		$username = $this->user['username'];
		$query = mysqli_query($this->con, "SELECT anonymous_profile_pic FROM users WHERE username='$username'");
		$row = mysqli_fetch_array($query);
		return $row['anonymous_profile_pic'];
	}


	public function isClosed() {
		$username = $this->user['username'];
		$query = mysqli_query($this->con, "SELECT user_closed FROM users WHERE username='$username'");
		$row = mysqli_fetch_array($query);

		if($row['user_closed'] == 'yes')
			return true;
		else 
			return false;
	}

	public function isGrouped($username,$groupname) {
		$query = mysqli_query($this->con, "SELECT * FROM users WHERE username='$username'");
		$row = mysqli_fetch_array($query);
		$groupnameComma = ",".$groupname.",";

		if((strstr($row['group_array'], $groupnameComma))) {
			return true;
		}
		else {
			return false;
		}
	}

	public function removeGroup($groupname){
		$logged_in_user = $this->user['username'];

		$query = mysqli_query($this->con, "SELECT group_array FROM users WHERE username='$logged_in_user'");
		$row = mysqli_fetch_array($query);
		$group_array = $row['group_array'];

		$new_group_array = str_replace($groupname. ",", "", $this->user['group_array']);
		$remove_group = mysqli_query($this->con, "UPDATE users SET group_array='$new_group_array' WHERE username='$logged_in_user'");

	}
	public function addGroup($groupname,$username){
		$add_group_query = mysqli_query($this->con, "UPDATE users SET group_array=CONCAT(group_array, '$groupname,') WHERE username='$username'");
	}
	public function getGroupNames(){
		$logged_in_user = $this->user['username'];
		$query = mysqli_query($this->con, "SELECT group_array FROM users WHERE username='$logged_in_user'");
		
		while($rows = mysqli_fetch_array($query)) {
   			$groupname=explode(',', $rows['group_array']);//what will do here
   			foreach($groupname as $out) {
      			echo "<a href=group.php?u=$out>$out</a><hr>";
      			
  			}
		}
	}
	public function getGroupNamesForProfile(){
		$logged_in_user = $this->user['username'];
		$query = mysqli_query($this->con, "SELECT group_array FROM users WHERE username='$logged_in_user'");
		
		while($rows = mysqli_fetch_array($query)) {
   			$groupname=explode(',', $rows['group_array']);//what will do here
   			foreach($groupname as $out) {
      			echo "<a href=$out>$out</a><br><br>";
      			
  			}
		}
	}

	public function getGroupArray(){
		$logged_in_user = $this->user['username'];
		$query = mysqli_query($this->con, "SELECT group_array FROM users WHERE username='$logged_in_user'");
		
		return $query;
		}
	
}


?>