<?php
$ini_file = parse_ini_file("config.ini");

$servername = $ini_file['ip'];
$username = $ini_file['username'];
$password = $ini_file['password'];
$db = $ini_file['dbname'];

	//Function to connect database
	function getConnection(){
		global $servername, $username, $password, $db;
		$link = mysqli_connect($servername, $username, $password);
		if (!$link) {
		    die('Could not connect: ' .mysqli_error());
		}
		if (!mysqli_select_db($link,$db)) {
		    die('Could not select database: '.mysqli_error());
		}
		else{
			//echo "DB conncted successfully </br>";
			return $link;
		}
		
	}

?>