<?php

function appointmentInfo($studID) // retrieves appointment info based on student ID
{
	$COMMON = new Common(false);

	$sql = "select * from Proj2Appointments where `EnrolledID` like '%$studID%'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]); // reports where some piece of code went wrong
	$row = mysql_fetch_row($rs);
	return $row;
}	

?>		