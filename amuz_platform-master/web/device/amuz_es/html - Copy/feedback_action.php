<?php
include('includes/config.php');
include('includes/functions.php');
$rating = $_POST['rating'];
$comment = $_POST['comment'];
$clientemail = $_POST['clientemail'];
$contactno = $_POST['contactno'];

if($rating != "" && $contactno != "" && $comment != "")
{
	$file = fopen(ADMINPATH."db/feedback.db","a+") or die ("not open");

	//$t = read_last_line(ADMINPATH.'db/feedback.db');
	$t = '';
		$f = fopen(ADMINPATH.'db/feedback.db', 'r');
		$cursor = -1;
		fseek($f, $cursor, SEEK_END);
		$char = fgetc($f);
		/**
		* Trim trailing newline chars of the file
		*/
		while ($char === "\n" || $char === "\r") {
			fseek($f, $cursor--, SEEK_END);
			$char = fgetc($f);
		}
		/**
		* Read until the start of file or first newline char
		*/
		while ($char !== false && $char !== "\n" && $char !== "\r") {
			/**
			 * Prepend the new char
			 */
			$t = $char . $t;
			fseek($f, $cursor--, SEEK_END);
			$char = fgetc($f);
	}

	//return $line;
	
	
	
	if($t > 0)
	{
		$ex = explode('||',$t);
		$start = $ex[0]+1;
	}
	else
	{
		$start = 1;
	}

	$str = "";
	
		echo $str.= $start.'||'.time().'||'.$rating.'||'.$clientemail.'||'.$contactno.'||'.$comment.'||feedback'."\n";
	


	fwrite($file, $str); 
	fclose($file); 
	//echo "Generated Successfully";
	header("location:index.php");
}
else
	header("location:feedback.php");
?>