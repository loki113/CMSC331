<?php
session_start();

$_SESSION["GroupApp"] = $_POST["GroupApp"]; // saves group appointment
$_SESSION["Delete"] = false;

// determines link depending on whether or not to delete or edit
if ($_POST["next"] == "Delete Appointment"){
	$_SESSION["Delete"] = true;
	$_SESSION["advisor"] = $_POST["next"];
	header('Location: AdminConfirmEditGroup.php');
}
elseif ($_POST["next"] == "Edit Appointment"){
	header('Location: AdminProceedEditGroup.php');
}

?>