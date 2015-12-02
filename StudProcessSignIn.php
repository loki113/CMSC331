<?php
session_start();
include('./CommonMethods.php');
include('./sqlQueries.php');

$debug = false;
$COMMON = new Common($debug);

/* $_SESSION["firstN"] = strtoupper($_POST["firstN"]); // saves student's first name in all caps */
/* $_SESSION["lastN"] = strtoupper($_POST["lastN"]); // saves student's last name in all caps */
$_SESSION["studID"] = strtoupper($_POST["studID"]); // saves student ID in all caps */
/* $_SESSION["email"] = $_POST["email"]; // saves student's email */ // Not using a session variable for email anymore, need to save it to database
/* $_SESSION["major"] = $_POST["major"]; // saves student's major */ // Not using a session variable for major anymore, need to save it to database

$firstName = strtoupper($_POST["firstN"]); // saves student's first name in all caps	
$lastName = strtoupper($_POST["lastN"]); // saves student's last name in all caps
$studid = $_SESSION["studID"]; // saves student ID in all caps
$email = $_POST["email"]; // saves student's email 
$major = $_POST["major"]; // saves student's major

if(!studExists($studid)){ // adds student into database if the student is not already listed
	$sql = "insert into Proj2Students (`FirstName`,`LastName`,`StudentID`,`Email`,`Major`) values ('$firstName','$lastName','$studid','$email','$major')";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
}

header('Location: 02StudHome.php');
?>