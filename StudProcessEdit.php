<?php
session_start();

$_SESSION["firstN"] = strtoupper($_POST["firstN"]); // saves student's first name in all caps
$_SESSION["lastN"] = strtoupper($_POST["lastN"]); // saves student's last name in all caps
$_SESSION["email"] = $_POST["email"]; // saves student's email
$_SESSION["major"] = $_POST["major"]; // saves student's major

$firstn = strtoupper($_POST["firstN"]);
$lastn = strtoupper($_POST["lastN"]);
$studid = $_SESSION["studID"];
$email = $_POST["email"];
$major = $_POST["major"];

$debug = false;
include('./CommonMethods.php');
$COMMON = new Common($debug);
if($_SESSION["studExist"] == true){
	$sql = "update `Proj2Students` set `FirstName` = '$firstn', `LastName` = '$lastn', `Email` = '$email', `Major` = '$major' where `StudentID` = '$studid'"; // update student's information
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
}

header('Location: 02StudHome.php');
?>