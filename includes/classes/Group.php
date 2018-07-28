<?php
class Group {
	private $group;
	private $con;

	public function __construct($con, $groupname){
		$this->con = $con;
		$group_details_query = mysqli_query($con, "SELECT * FROM groups WHERE groupname='$groupname'");
		$this->group = mysqli_fetch_array($group_details_query);
	}

	public function getGroupName() {
		return $this->group['groupname'];
	}
	public function removeFromGroup($username){
		$groupname = $this->group['groupname'];

		$query = mysqli_query($this->con, "SELECT member_array FROM groups WHERE groupname='$groupname'");
		$row = mysqli_fetch_array($query);
		$member_array = $row['member_array'];

		$new_member_array = str_replace($username. ",", "", $this->group['member_array']);
		$remove_member = mysqli_query($this->con, "UPDATE groups SET member_array='$new_member_array' WHERE groupname='$groupname'");

	}
	public function addToGroup($username,$groupname){
		$add_member_query = mysqli_query($this->con, "UPDATE groups SET member_array=CONCAT(member_array, '$username,') WHERE groupname='$groupname'");
	}

	public function getGroupProfilePic() {
		$groupname = $this->group['groupname'];
		$query = mysqli_query($this->con, "SELECT group_profile_pic FROM groups WHERE groupname='$groupname'");
		$row = mysqli_fetch_array($query);
		return $row['group_profile_pic'];
	}
	public function getMemberNamesForProfile(){
		$groupname = $this->group['groupname'];
		$query = mysqli_query($this->con, "SELECT member_array FROM groups WHERE groupname='$groupname'");
		
		while($rows = mysqli_fetch_array($query)) {
   			$membername=explode(',', $rows['member_array']);//what will do here
   			foreach($membername as $out) {
      			echo "<a href=$out>$out</a><br><br>";
      			
  			}
		}
	}
}
?>