<?php

function appointmentInfo($studID) // retrieves appointment info based on student ID
{
	$COMMON = new Common(false);

	$sql = "select * from Proj2Appointments where `EnrolledID` like '%$studID%'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]); // reports where some piece of code went wrong
	$row = mysql_fetch_row($rs);
	return $row;
}	

function studExists($studID) // retrieves appointment info based on student ID
{
	$COMMON = new Common(false);

	$sql = "select * from Proj2Students where `StudentID` like '%$studID%'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]); // reports where some piece of code went wrong
	$row = mysql_fetch_row($rs);
	$exists = mysql_num_rows($rs);
	if ($exists == false) {
		return false;
	}
	else {
		return true;
	}
}	

function getStudentMajor($studID) // retrieves student's major based on student ID
{
	$COMMON = new Common(false);
	
	$sql = "select `Major` from Proj2Students where `StudentID` like '%$studID%'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_row($rs);
	return $row;
}

function getStudentEmail($studID) // retrieves student's major based on student ID
{
	$COMMON = new Common(false);
	
	$sql = "select `Email` from Proj2Students where `StudentID` like '%$studID%'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_row($rs);
	return $row;
}
?>		