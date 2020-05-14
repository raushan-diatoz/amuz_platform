<?php
session_start();
include('config.php');

//print_r($_POST);
if(isset($_POST["dsk"]) && $_POST["dsk"] != "")
{
$dsk = $_POST["dsk"]."||";
$customername = $_POST["customername"];
$phonenum = $_POST["phonenum"];
$email = $_POST["email"];
$destfrom = $_POST["destfrom"];
$destto = $_POST["destto"];
$details = $_POST["details"];
$operator = $_POST["operator"];


		$myfile = fopen(ADMINPATH."db/serial.db", "r") or die("Unable to open file!");
		$nearr = array();
		while(! feof($myfile))
		{
			$gfile = fgets($myfile);
			$exfile = str_replace("\n","",explode('||',$gfile));
			$nearr[] = $exfile;
		}
		
		$timeend = time()+160;
		$arrayn = array();
		foreach($nearr as $nr)
		{
			$soarr = $nr;
			$nstr = trim(implode("||",$nr)).'||';
			if($dsk == $nstr)
			{
				array_push($soarr,$customername,$phonenum,$email,$destfrom,$destto,$details,$operator,time());
				$arrayn[] = $soarr;
			}
			else
				$arrayn[] = $nr;
		}
		

		$newtxt = "";
		foreach($arrayn as $nv)
		{ 
			if(count($nv) > 5)
			$newtxt .= trim(implode('||',$nv))."\n";
		}
		$metafile = fopen(ADMINPATH."db/serial.db","w+");
		fwrite($metafile, $newtxt) or die("not working");
		fclose($metafile);
		
}
header("location:deliveryManagement.php");
?>