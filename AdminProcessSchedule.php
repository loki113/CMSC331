<?php
session_start();

// determines link depending on group or individual appointment
if ($_POST["next"] == "Group"){
	$_SESSION["advisor"] = $_POST["next"];
	header('Location: AdminScheduleGroup.php');
}
elseif ($_POST["next"] == "Individual"){
	header('Location: AdminScheduleInd.php');
}

?>