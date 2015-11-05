<?php
session_start();
if ($_POST["type"] == "Group"){ // if student chose group appointment
	$_SESSION["advisor"] = $_POST["type"];
	header('Location: 08StudSelectTime.php');
} 
elseif ($_POST["type"] == "Individual"){ // if student chose individual appointment
	header('Location: 07StudSelectAdvisor.php');
}
elseif ($_POST["type"] == "Next Available Individual") { // if student chose earliest possible individual appointment
	header('Location: StudProcessNextInd.php');
}
elseif ($_POST["type"] == "Next Available Group") { // if student chose earliest possible group appointment
	header('Location: StudProcessNextGroup.php');
}
?>