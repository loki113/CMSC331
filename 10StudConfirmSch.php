<?php
session_start();

// sets appointment time if received input from previous page
if (isset($_POST["appTime"])) {
	$_SESSION["appTime"] = $_POST["appTime"]; // radio button selection from previous form
}
// sets advisor if received input from prior page
if (isset($_POST["advisor"])) {
	$_SESSION["advisor"] = $_POST["advisor"];
}
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Confirm Appointment</title>
	<link rel='stylesheet' type='text/css' href='./css/standard.css'/>  </head>
  <body>
	<div id="login">
      <div id="form">
        <div class="top">
		<h1>Confirm Appointment</h1>
	    <div class="field">
		<form action = "StudProcessSch.php" method = "post" name = "SelectTime">
	    <?php
			$debug = false;
			include('./CommonMethods.php');
			include('./sqlQueries.php');
			$COMMON = new Common($debug);
			
			// saves student informtion
			$firstn = $_SESSION["firstN"];
			$lastn = $_SESSION["lastN"];
			$studid = $_SESSION["studID"];
			$major = getStudentMajor(studid); // replaced $_SESSION["major"] with getStudentMajor(studid)
			$email = getStudentEmail(studid); // replaced $_SESSION["email"] with getStudentEmail(studid)
			
			// if the student wants to reschedule the appointment
			if($_SESSION["resch"] == true){
				$row = appointmentInfo($studid);
				$oldAdvisorID = $row[2];
				$oldDatephp = strtotime($row[1]);
				
				// for individual appointment
				if($oldAdvisorID != 0){
					$sql2 = "select * from Proj2Advisors where `id` = '$oldAdvisorID'";
					$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
					$row2 = mysql_fetch_row($rs2);
					$oldAdvisorName = $row2[1] . " " . $row2[2];
				}
				// for group appointment
				else{$oldAdvisorName = "Group";}
				
				echo "<h2>Previous Appointment</h2>";
				echo "<label for='info'>";
				echo "Advisor: ", $oldAdvisorName, "<br>";
				echo "Appointment: ", date('l, F d, Y g:i A', $oldDatephp), "</label><br>";
			}
			
			// saves previous advisor name
			$currentAdvisorName;
			$currentAdvisorID = $_SESSION["advisor"];
			$currentDatephp = strtotime($_SESSION["appTime"]);
			if($currentAdvisorID != 0){
				$sql2 = "select * from Proj2Advisors where `id` = '$currentAdvisorID'";
				$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
				$row2 = mysql_fetch_row($rs2);
				$currentAdvisorName = $row2[1] . " " . $row2[2];
			}
			else{$currentAdvisorName = "Group";}
			
			// displays information of previous appointment
			echo "<h2>Current Appointment</h2>";
			echo "<label for='newinfo'>";
			echo "Advisor: ",$currentAdvisorName,"<br>";
			echo "Appointment: ",date('l, F d, Y g:i A', $currentDatephp),"</label>";
		?>
        </div>
	    <div class="nextButton">
		<?php
			// choose whether or not to go through with rescheduling
			if($_SESSION["resch"] == true){
				echo "<input type='submit' name='finish' class='button large go' value='Reschedule'>";
			}
			else{
				echo "<input type='submit' name='finish' class='button large go' value='Submit'>";
			}
		?>
			<input style="margin-left: 50px" type="submit" name="finish" class="button large" value="Cancel">
	    </div>
		</form>
		</div>
  </body>
</html>