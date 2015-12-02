<?php
session_start();

$debug = false;
include('./CommonMethods.php');
include('./sqlQueries.php');
$COMMON = new Common($debug);

$sql = "select * from Proj2Students"; // retrieves students' information
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

// saves student information (commented out because there is no need to save information anymore)
/* while($row = mysql_fetch_row($rs)){
	if($row[3] == $_SESSION["studID"]){
		
		$_SESSION["firstN"] = $row[1];
		$_SESSION["lastN"] = $row[2];
		$_SESSION["email"] = $row[4];
		$_SESSION["major"] = $row[5];
	}
} */ 

?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Edit Student Information</title>
	<link rel='stylesheet' type='text/css' href='./css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
			<div class="top">
			<h2>Edit Student Information<span class="login-create"></span></h2>
			<form action="StudProcessEdit.php" method="post" name="Edit">
			<!-- input student information for editing -->
			<div class="field">
				<label for="firstN">First Name</label>
				<input id="firstN" size="30" maxlength="50" type="text" name="firstN" required value=<?php echo $_SESSION["firstN"]?>>
			</div>
			<div class="field">
			  <label for="lastN">Last Name</label>
			  <input id="lastN" size="30" maxlength="50" type="text" name="lastN" required value=<?php echo $_SESSION["lastN"]?>>
			</div>
			<div class="field">
				<label for="studID">Student ID</label>
				<input id="studID" size="30" maxlength="7" type="text" pattern="[A-Za-z]{2}[0-9]{5}" title="AB12345" name="studID" disabled value=<?php echo $_SESSION["studID"]?>>
			</div>
			<div class="field">
				<label for="email">E-mail</label>
				<input id="email" size="30" maxlength="255" type="email" name="email" required value=<?php echo getStudentEmail(studid)?>>
			</div>
			<div class="field">
				  <label for="major">Major</label>
				  <select id="major" name = "major">
					<!-- replaced $_SESSION["major"] with getStudentMajor($_SESSION["studID"]) -->
					<option <?php if(getStudentMajor($_SESSION["studID"]) == 'Computer Engineering'){echo("selected");}?>>Computer Engineering</option>
					<option <?php if(getStudentMajor($_SESSION["studID"]) == 'Computer Science'){echo("selected");}?>>Computer Science</option>
					<option <?php if(getStudentMajor($_SESSION["studID"]) == 'Mechanical Engineering'){echo("selected");}?>>Mechanical Engineering</option>
					<option <?php if(getStudentMajor($_SESSION["studID"]) == 'Chemical Engineering '){echo("selected");}?>>Chemical Engineering</option>
<!-- someday
					<option <?php if(getStudentMajor($_SESSION["studID"]) == 'Africana Studies'){echo("selected");}?>>Africana Studies</option>
					<option <?php if(getStudentMajor($_SESSION["studID"]) == 'American Studies'){echo("selected");}?>>American Studies</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Ancient Studies'){echo("selected");}?>>Ancient Studies</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Anthropology'){echo("selected");}?>>Anthropology</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Asian Studies'){echo("selected");}?>>Asian Studies</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Biochemistry and Molecular Biology'){echo("selected");}?>>Biochemistry and Molecular Biology</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Bioinformatics and Computational Biology'){echo("selected");}?>>Bioinformatics and Computational Biology</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Biological Sciences'){echo("selected");}?>>Biological Sciences</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Business Technology Administration'){echo("selected");}?>>Business Technology Administration</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Chemistry'){echo("selected");}?>>Chemistry</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Dance'){echo("selected");}?>>Dance</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Economics'){echo("selected");}?>>Economics</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Financial Economics'){echo("selected");}?>>Financial Economics</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Emergency Health Services'){echo("selected");}?>>Emergency Health Services</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'English'){echo("selected");}?>>English</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Environmental Science and Environmental Studies'){echo("selected");}?>>Environmental Science and Environmental Studies</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Gender and Womens Studies'){echo("selected");}?>>Gender and Womens Studies</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Geography'){echo("selected");}?>>Geography</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Global Studies'){echo("selected");}?>>Global Studies</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Health Administration and Policy'){echo("selected");}?>>Health Administration and Policy</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'History'){echo("selected");}?>>History</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Information Systems'){echo("selected");}?>>Information Systems</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Interdisciplinary Studies'){echo("selected");}?>>Interdisciplinary Studies</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Management of Aging Services'){echo("selected");}?>>Management of Aging Services</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Mathematics'){echo("selected");}?>>Mathematics</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Statistics'){echo("selected");}?>>Statistics</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Media and Communication Studies'){echo("selected");}?>>Media and Communication Studies</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Modern Languages, Linguistics and Intercultural Communication'){echo("selected");}?>>Modern Languages, Linguistics and Intercultural Communication</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Music'){echo("selected");}?>>Music</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Philosophy'){echo("selected");}?>>Philosophy</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Physics'){echo("selected");}?>>Physics</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Political Sciences'){echo("selected");}?>>Political Science</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Psychology'){echo("selected");}?>>Psychology</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Social Work'){echo("selected");}?>>Social Work</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Sociology'){echo("selected");}?>>Sociology</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Theatre'){echo("selected");}?>>Theatre</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Visual Arts'){echo("selected");}?>>Visual Arts</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Undecided'){echo("selected");}?>>Undecided</option>
					<option <?php if(getStudentMajor($_SESSION["studid"]) == 'Other'){echo("selected");}?>>Other</option>
-->
					</select>
			</div>
			<!-- button to confirm new student information -->
			<div class="nextButton">
				<input type="submit" name="save" class="button large go" value="Save">
			</div>
			</div>
		</form>
  </body>
  
</html>
