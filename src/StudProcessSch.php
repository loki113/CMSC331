<?phpf
session_start();
$debug = false;
include('./CommonMethods.php');
include('./sqlQueries.php');
$COMMON = new Common($debug);

if($_POST["finish"] == 'Cancel'){
	$_SESSION["status"] = "none";
}
else{
	$firstn = $_SESSION["firstN"]; // saves student's first name
	$lastn = $_SESSION["lastN"]; // saves student's last name
	$studid = $_SESSION["studID"]; // saves student's ID
	$major = getStudentMajor(studid); // saves student's major -- replaced $_SESSION["major"] with getStudentMajor(studid)
	$email = getStudentEmail(studid); // saves student's email -- replaced $_SESSION["email"] with getStudentEmail(studid)
	$advisor = $_SESSION["advisor"]; // saves student's advisor

	// if(debug) { echo("Advisor -> $advisor<br>\n"); }

	$apptime = $_SESSION["appTime"]; // saves student's appointment time
	/* if($_SESSION["studExist"] == false){ // adds student into database if the student is not already listed
		$sql = "insert into Proj2Students (`FirstName`,`LastName`,`StudentID`,`Email`,`Major`) values ('$firstn','$lastn','$studid','$email','$major')";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	} */


	// ************************ Lupoli 9-1-2015
	// we have to check to make sure someone did not steal that spot just before them!! (deadlock)
	// if the spot was taken, need to stop and reset
	if( isStillAvailable($apptime, $advisor) ) // then good, take that spot
	{ } 
	else // spot was taken, tell them to pick another
	{
		if($debug == false) 
		{
			header('Location: 13StudDenied.php');
			return;
		}
	}

	
	//regular new schedule
	if($_POST["finish"] == 'Submit'){
		if($_SESSION["advisor"] == 'Group')  // student scheduled for a group session
		{
			$sql = "select * from Proj2Appointments where `Time` = '$apptime' and `AdvisorID` = 0"; // retrieves information regarding appointment
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			$row = mysql_fetch_row($rs);
			$groupids = $row[4];
			$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum+1, `EnrolledID` = '$groupids $studid' where `Time` = '$apptime' and `AdvisorID` = 0"; // increments number of enrolled in group appointment
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		}
		else // student scheduled for an individual session
		{
			$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum+1, `EnrolledID` = '$studid' where `AdvisorID` = '$advisor' and `Time` = '$apptime'"; // marks the individual appointment as taken
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		}
		
	
		$_SESSION["status"] = "complete";
	}
	elseif($_POST["finish"] == 'Reschedule'){ // if the student wants to reschedule their appointment
		//remove stud from EnrolledID
		$sql = "select * from Proj2Appointments where `EnrolledID` like '%$studid%'"; // retrieves student's current appointment
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		$row = mysql_fetch_row($rs);
		$oldAdvisorID = $row[2];
		$oldAppTime = $row[1];
		$newIDs = str_replace($studid, "", $row[4]);
		
		$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum-1, `EnrolledID` = '$newIDs' where `AdvisorID` = '$oldAdvisorID' and `Time` = '$oldAppTime'"; // mark old appointment as unoccupied
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		
		//schedule new app
		if($_SESSION["advisor"] == 'Group'){
			$sql = "select * from Proj2Appointments where `Time` = '$apptime' and `AdvisorID` = 0"; // retrieve new appointment
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			$row = mysql_fetch_row($rs);
			$groupids = $row[4];
			$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum+1, `EnrolledID` = '$groupids $studid' where `Time` = '$apptime' and `AdvisorID` = 0"; // enter new group appointment
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		}
		else{
			$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum+1, `EnrolledID` = '$studid' where `Time` = '$apptime' and `AdvisorID` = '$advisor'"; // fill new individual appointment
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		}

		$_SESSION["status"] = "resch"; // update as rescheduling
	}

	//update stud status to ''
	$sql = "update `Proj2Students` set `Status` = '' where `StudentID` = '$studid'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

}
if($debug == false) { header('Location: 12StudExit.php'); }



function isStillAvailable($apptime, $advisor)
{
	// advisor could be "Group"
	global $debug; global $COMMON;
	$sql = "";

	if($advisor == "Group")
	{ $sql = "select `EnrolledNum`, `Max` from `Proj2Appointments` where `Time` = '$apptime' and `AdvisorID` = 0";  } // checks if group appointment is available
	else // then specific
	{ $sql = "select `EnrolledNum`, `Max` from `Proj2Appointments` where `Time` = '$apptime' and `AdvisorID` = '$advisor'";  } // checks if individual appointment is available
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_row($rs);

	// if max [1] =< EnrolledNum[0], then the spot was indeed taken
	if($row[1] > $row[0]) // then all good
	{ 
		if($debug) { echo("spot available\n<br>"); }
		return true; 
	}
	else // spot was taken
	{
		if($debug) { echo("spot NOT available\n<br>"); }	
		return false; 
	}

}

?>


