<?php
session_start();
$debug = false;
include('./CommonMethods.php');
include('./sqlQueries.php');
$COMMON = new Common($debug);

$studID = $_SESSION["studID"];
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>View Appointment</title>
	<link rel='stylesheet' type='text/css' href='./css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>View Appointment</h1>
	    <div class="field">
	    <?php
			$num_rows = appointmentInfo($studID); // finds appointment information based on student ID

			if($num_rows > 0)
			{
				$row = appointmentInfo($studID); // get legit data
				$advisorID = $row[2];
				$datephp = strtotime($row[1]);
				
				if($advisorID != 0){
					$sql2 = "select * from Proj2Advisors where `id` = '$advisorID'"; // retrieves advisor information based on advisor ID
					$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
					$row2 = mysql_fetch_row($rs2);
					$advisorName = $row2[1] . " " . $row2[2];
					$office = $row2[3];
				}
				else{$advisorName = "Group";} // sets to group appointment if advisorID is 0
			
				echo "<label for='info'>";
				echo "Advisor: ", $advisorName, "<br>";
				echo "Appointment: ", date('l, F d, Y g:i A', $datephp), "<br>";
				echo "Advisor Office: ", $office, "</label>", "<br>";
			}
			else // something is up, and their DB table needs to be fixed
			{
				echo("No appointment was detected. It may have been cancelled. Please make another appointment."); 
				$sql = "update `Proj2Students` set `Status` = 'N' where `StudentID` = '$studID'"; // updates student's appointment status
				$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			}
	

		?>
        </div>
	<!-- done viewing appointment -->
	    <div class="finishButton">
			<button onclick="location.href = '02StudHome.php'" class="button large go" >Return to Home</button>
	    </div>
		</div>
		</form>
  </body>
</html>