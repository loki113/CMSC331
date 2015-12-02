<?php
session_start();

include('./CommonMethods.php');

$COMMON = new Common($debug);
$localMaj = getStudentMajor(studid); // saves student major -- replaced $_SESSION["major"] with getStudentMajor(studid)
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

// retrieves earliest possible group appointment
$sql = "select * from Proj2Appointments where $temp `EnrolledNum` < 10 
		and (`Major` like '%$localMaj%' or `Major` = '') and `Time` > '".date('Y-m-d H:i:s')."' and `AdvisorID` = 0 
		order by `Time` ASC limit 1"; // retrieves earliest possible group appointment
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
$_SESSION["advisor"] = 0; // saves advisor as a group
$_SESSION["appTime"] = $row[1]; // saves appointment time

header('Location: 10StudConfirmSch.php');
?>