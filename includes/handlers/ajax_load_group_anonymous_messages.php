<?php
include("../../config/config.php");
include("../classes/User.php");
include("../classes/Message.php");
include("../classes/Group.php");

$limit = 7; //Number of messages to load

$message = new Message($con, $_REQUEST['userLoggedIn']);
echo $message->getGroupAnonymousConvosDropdown($_REQUEST, $limit);

?>