<?php
session_start();

$_SESSION["GroupApp"] = $_POST["GroupApp"]; // saves group appointment
$_SESSION["Delete"] = false;
<<<<<<< HEAD
//$_COOKIE["Delete"] = false;
=======
>>>>>>> bcc46b3a4bcc869f0cdd8346d6af601ba231d543

// determines link depending on whether or not to delete or edit
if ($_POST["next"] == "Delete Appointment"){
	$_SESSION["Delete"] = true;
<<<<<<< HEAD
	//$_COOKIE["Delete"] = true;
=======
>>>>>>> bcc46b3a4bcc869f0cdd8346d6af601ba231d543
	$_SESSION["advisor"] = $_POST["next"];
	header('Location: AdminConfirmEditGroup.php');
}
elseif ($_POST["next"] == "Edit Appointment"){
	header('Location: AdminProceedEditGroup.php');
}

?>