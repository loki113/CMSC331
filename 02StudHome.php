<?php
session_start();
include('./CommonMethods.php');
include('./sqlQueries.php');
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Student Advising Home</title>
	<link rel='stylesheet' type='text/css' href='./css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h2>Hello 
		<?php
			echo getStudentMajor($_SESSION["studID"]); // displays student's name
		?>
        </h2>
	    <div class="selections">
		<!-- links to process student appointment information -->
		<form action="StudProcessHome.php" method="post" name="Home">
	    <?php
			
			$debug = false;
			$COMMON = new Common($debug);
			
			/* $_SESSION["firstN"] = strtoupper($_POST["firstN"]); // saves student's first name in all caps */
			/* $_SESSION["lastN"] = strtoupper($_POST["lastN"]); // saves student's last name in all caps */
			$_SESSION["studID"] = strtoupper($_POST["studID"]); // saves student ID in all caps
			/* $_SESSION["email"] = $_POST["email"]; // saves student's email */ // Not using a session variable for email anymore, need to save it to database
			/* $_SESSION["major"] = $_POST["major"]; // saves student's major */ // Not using a session variable for major anymore, need to save it to database

			$firstName = strtoupper($_POST["firstN"]); // saves student's first name in all caps	
			$lastName = strtoupper($_POST["lastN"]); // saves student's last name in all caps
			$studid = $_SESSION["studID"]; // saves student ID in all caps
			$email = $_POST["email"]; // saves student's email 
			$major = $_POST["major"]; // saves student's major

			if(!studExists($studid)){ // adds student into database if the student is not already listed
				$sql = "insert into Proj2Students (`FirstName`,`LastName`,`StudentID`,`Email`,`Major`) values ('$firstName','$lastName','$studid','$email','$major')";
				$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			}
			
			$_SESSION["studExist"] = false; // sets that the student has not been added to the database
			$adminCancel = false;
			$noApp = false;
			$studid = $_SESSION["studID"];

			$sql = "select * from Proj2Students where `StudentID` = '$studid'";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			$row = mysql_fetch_row($rs);
			
			if (!empty($row)){ // sees if the student exists
				$_SESSION["studExist"] = true;
				if($row[6] == 'C'){
					$adminCancel = true;
				}
				if($row[6] == 'N'){
					$noApp = true;
				}
			}

			if ($_SESSION["studExist"] == false || $adminCancel == true || $noApp == true){ // based on student existing and cancellation of appointment by advisor
				if($adminCancel == true){
					echo "<p style='color:red'>The advisor has cancelled your appointment! Please schedule a new appointment.</p>";
				}
				echo "<button type='submit' name='selection' class='button large selection' value='Signup'>Signup for an appointment</button><br>";
			}
			else{
				echo "<button type='submit' name='selection' class='button large selection' value='View'>View my appointment</button><br>";
				echo "<button type='submit' name='selection' class='button large selection' value='Reschedule'>Reschedule my appointment</button><br>";
				echo "<button type='submit' name='selection' class='button large selection' value='Cancel'>Cancel my appointment</button><br>";
			}
			echo "<button type='submit' name='selection' class='button large selection' value='Search'>Search for appointment</button><br>";
			echo "<button type='submit' name='selection' class='button large selection' value='Edit'>Edit student information</button><br>";
		?>
		</form>
        </div>
		<!-- logs out of student account -->
		<form action="Logout.php" method="post" name="Logout">
	    <div class="logoutButton">
			<input type="submit" name="logout" class="button large go" value="Logout">
	    </div>
		</div>
		</form>
  </body>
</html>