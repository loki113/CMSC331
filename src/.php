<?php 

class Common
{	
	var $conn;
	var $debug; // this is set by a initiated value in the constructor
			
	function Common($debug)
	{
		$this->debug = $debug; 
		//$rs = $this->connect("jeanice1"); // db name really here
		//$rs = $this->connect("web_coeadvising_prod"); // db name really here
		$rs = $this->connect("web.coeadvising"); // db name really here
		return $rs;
	}

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% */
	
	function connect($db)// connect to MySQL
	{
		$conn = @mysql_connect("web-db.umbc.edu", "web.coeadvising", "XXXXXXXXXXX") or die("<br> Could not connect to MySQL <br>");
		// $conn = @mysql_connect("studentdb.gl.umbc.edu", "jeanice1", "jeanice1") or die("<br> Could not connect to MySQL <br>");
		//$rs = @mysql_select_db($db, $conn) or die("<br> Could not connect to $db database <br>");
		$rs = @mysql_select_db("web_coeadvising_prod", $conn) or die("<br> Could not connect to $db database <br>");
		$this->conn = $conn; 
	}

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% */
	
	function executeQuery($sql, $filename) // execute query
	{
		if($this->debug == true) { echo("$sql <br>\n"); }
		$rs = mysql_query($sql, $this->conn) or die("<br> Could not execute query '$sql' in $filename <br>"); 
		return $rs;
	}			

} // ends class, NEEDED!!

?>
