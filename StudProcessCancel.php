<?php
session_start();
$debug = false;
include('./CommonMethods.php');
$COMMON = new Common($debug);

if($_POST["cancel"] == 'Cancel'){
	$firstn = $_SESSION["firstN"]; // saves student's first name
	$lastn = $_SESSION["lastN"]; // saves student's last name
	$studid = $_SESSION["studID"]; // saves student's ID
	$major = $_SESSION["major"]; // saves student's major
	$email = $_SESSION["email"]; // saves student's email
	
	//remove stud from EnrolledID
	$sql = "select * from Proj2Appointments where `EnrolledID` like '%$studid%'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_row($rs);
	$oldAdvisorID = $row[2];
	$oldAppTime = $row[1];
	$newIDs = str_replace($studid, "", $row[4]);
	
	$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum-1, `EnrolledID` = '$newIDs' where `AdvisorID` = '$oldAdvisorID' and `Time` = '$oldAppTime'"; // marks appointment as not filled
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	
	//update stud status to noApp
	$sql = "update `Proj2Students` set `Status` = 'N' where `StudentID` = '$studid'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	
	$_SESSION["status"] = "cancel";
}
else{
	$_SESSION["status"] = "keep";
}
header('Location: 12StudExit.php');
?>