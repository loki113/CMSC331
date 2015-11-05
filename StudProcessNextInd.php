<?php
session_start();
include('./CommonMethods.php');

$COMMON = new Common($debug);

$localMaj = $_SESSION["major"]; // saves student major
if ($localMaj == "Computer Science")
{
	$localMaj = "CMSC";
} 
else if ($localMaj == "Computer Engineering")
{
	$localMaj = "CMPE";
}
else if ($localMaj == "Mechanical Engineering")
{
	$localMaj = "MENG";
}
else if ($localMaj == "Chemical Engineering")
{
	$localMaj = "CENG";
}
else if ($localMaj == "Engineering Undecided")
{
	$localMaj = "ENGR";
}

// retrieves earliest possible individual appointment
$sql = "select * from Proj2Appointments where $temp `EnrolledNum` = 0 
and (`Major` like '%$localMaj%' or `Major` = '') and `Time` > '".date('Y-m-d H:i:s')."' and `AdvisorID` != 0 
order by `Time` ASC limit 30";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
$_SESSION["advisor"] = $row[2]; // saves advisor ID
$_SESSION["appTime"] = $row[1]; // saves earliest appointment time

header('Location: 10StudConfirmSch.php');
?>