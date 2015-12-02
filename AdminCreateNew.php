<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Create New Admin</title>
<<<<<<< HEAD
    <script type="text/javascript"> // <-- here
=======
    <script type="text/javascript">
>>>>>>> bcc46b3a4bcc869f0cdd8346d6af601ba231d543
    function saveValue(target){
	var stepVal = document.getElementById(target).value;
	alert("Value: " + stepVal);
    }
    </script>
    	<link rel='stylesheet' type='text/css' href='./css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h2>New Advisor has been created:</h2>

		<?php
<<<<<<< HEAD
		$first = $_POST["firstN"]; //replaced with getAdvFName($UserN)
		$last = $_POST["lastN"]; //replaced with getAdvLName($UserN)
		$user = $_POST["UserN"];
		$office = $_POST["office"]; //replaced with getAdvOffice($UserN)
		$pass = $_POST["PassW"];
		$confP= $_POST["ConfP"];
		$_SESSION["PassCon"] = false;
		
		//$pass = $_POST["PassW"]; //replaced with getAdvPW($UserN)
		if($pass != $confP){
			$_SESSION["PassCon"] = true;
			header('Location: AdminCreateNewAdv.php');   // <-- here
		} else { 
			// saves information about new advisor
			// $first = $_SESSION["AdvF"];
			// $last = $_SESSION["AdvL"];
			// $user = $_SESSION["AdvUN"];
			// $pass = $_SESSION["AdvPW"];
			// $office = $_SESSION["AdvO"];
=======
			// saves information about new advisor
			$first = $_SESSION["AdvF"];
			$last = $_SESSION["AdvL"];
			$user = $_SESSION["AdvUN"];
			$pass = $_SESSION["AdvPW"];
			$office = $_SESSION["AdvO"];
>>>>>>> bcc46b3a4bcc869f0cdd8346d6af601ba231d543

			include('./CommonMethods.php');
			$debug = false;
			$Common = new Common($debug);

<<<<<<< HEAD
			// retrieves information based on advisor information
			  $sql = "SELECT * FROM `Proj2Advisors` WHERE `Username` = '$user' AND `FirstName` = '$first' AND  `LastName` = '$last' AND `office` = '$office'";
			  $rs = $Common->executeQuery($sql, "Advising Appointments");
			  $row = mysql_fetch_row($rs);
			// determines if advisor has already been entered in the database
			  if($row){
				echo("<h3>Advisor $first $last already exists</h3>");
			  }
			  else{
					$sql = "INSERT INTO `Proj2Advisors`(`FirstName`, `LastName`, `Username`, `Password`, `office`) 
					VALUES ('$first', '$last', '$user', '$pass', '$office')";
				echo ("<h3>$first $last<h3>");
				$rs = $Common->executeQuery($sql, "Advising Appointments");
			  }
}
=======
	// retrieves information based on advisor information
      $sql = "SELECT * FROM `Proj2Advisors` WHERE `Username` = '$user' AND `FirstName` = '$first' AND  `LastName` = '$last' AND `office` = '$office'";
      $rs = $Common->executeQuery($sql, "Advising Appointments");
      $row = mysql_fetch_row($rs);
	// determines if advisor has already been entered in the database
      if($row){
        echo("<h3>Advisor $first $last already exists</h3>");
      }
      else{
  			$sql = "INSERT INTO `Proj2Advisors`(`FirstName`, `LastName`, `Username`, `Password`, `office`) 
  			VALUES ('$first', '$last', '$user', '$pass', '$office')";
        echo ("<h3>$first $last<h3>");
        $rs = $Common->executeQuery($sql, "Advising Appointments");
      }
>>>>>>> bcc46b3a4bcc869f0cdd8346d6af601ba231d543
		?>
		<!-- button to return to home-->
		<form method="link" action="AdminUI.php">
			<input type="submit" name="next" class="button large go" value="Return to Home">
		</form>
	</div>
	</div>
	</div>
	</form>
  </body>
  
</html>
