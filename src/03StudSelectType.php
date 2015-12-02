<?php
session_start();
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Select Advising Type</title>
	<link rel='stylesheet' type='text/css' href='./css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>Schedule Appointment</h1>
		<h2>What kind of advising appointment would you like?</h2><br>
	<!-- links to process type of appointment desired -->
	<form action="StudProcessType.php" method="post" name="SelectType">
	<!-- buttons to select type of appointment -->
	<div class="nextButton">
		<input type="submit" name="type" class="button large go" value="Individual">
		<input type="submit" name="type" class="button large go" value="Group" style="float: right;">
		<br>
		<input type="submit" name="type" class="button large go" value="Next Available Individual">
		<input type="submit" name="type" class="button large go" value="Next Available Group" style="float: right;">
		</form>
		</div>
	</div>
</div>

<br>
<br>
		<div>
	<!-- to cancel selection of type of appointment -->
		<form method="link" action="02StudHome.php">
		<input type="submit" name="home" class="button large" value="Cancel">
		</form>
		</div>
  </body>
</html>