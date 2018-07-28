<?php 
include("includes/header.php");

if(isset($_POST['post_feedback']))
{
	$body=$_POST['feedback_body'];
	$query = mysqli_query($con, "INSERT INTO feedbacks VALUES (0, '$body')");
}

?>


<form action="feedback.php" method="POST">
<textarea name="feedback_body" id="message_textarea" placeholder='Write your feedback ...'></textarea>
<input type="submit" name="post_feedback" class="info" id="message_submit" value="Send">
</form>