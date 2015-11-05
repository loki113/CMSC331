<?php
session_start();

$_SESSION["firstN"] = strtoupper($_POST["firstN"]); // saves student's first name in all caps
$_SESSION["lastN"] = strtoupper($_POST["lastN"]); // saves student's last name in all caps
$_SESSION["studID"] = strtoupper($_POST["studID"]); // saves student ID in all caps
$_SESSION["email"] = $_POST["email"]; // saves student's email
$_SESSION["major"] = $_POST["major"]; // saves student's major

header('Location: 02StudHome.php');
?>