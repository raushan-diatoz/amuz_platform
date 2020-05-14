<?php
$ini_file = parse_ini_file("config.ini");

$servername = $ini_file['ip'];
$username = $ini_file['username'];
$password = $ini_file['password'];
$db = $ini_file['dbname'];

	//Function to connect database
	function getConnection(){
		global $servername, $username, $password, $db;
		$link = mysqli_connect($servername, $username, $password,$db);
		if (!$link) {
		    die('Could not connect: ' .mysql_error());
		}
		/*if (!mysql_select_db($db)) {
		    die('Could not select database: '.mysql_error());
		}*/
		else{
			//echo "DB conncted successfully </br>";
		  
			return $link;
		}
		
	}

?>