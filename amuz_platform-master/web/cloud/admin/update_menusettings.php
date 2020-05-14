<?php
session_start();
include('config.php');
require_once 'KLogger.php';
$log = new KLogger ( "log.txt" , KLogger::DEBUG );


if(isset($_POST["server_type"]) != "")
{
	$myfile = fopen("db/admin.db", "r") or die("Unable to open file!");
	$nearr = array();
	while(! feof($myfile))
	{
		$gfile = fgets($myfile);
		$exfile = explode('||',$gfile);
		$nearr[] = $exfile;
	}
	
	//print_r($nearr);
	$arrayn = array();
	
	
	foreach($nearr as $key=>$arr)
	{
		if($key == $_SESSION["userid"]-1)
		{
			$soarr = array();
			foreach($arr as $k=>$a)
			{
				if($k == 11)
				{

					$soarr[] = $_POST["server_type"]."\n";
					
				}
				else
				{
					$soarr[] = $a;
				}
			}
			$arrayn[] = $soarr;
		}
		else
		{
			$arrayn[] = $arr;
		}
	}

	//print_r($arrayn);
	$newtxt = "";
	foreach($arrayn as $nv)
	{
		$newtxt .= implode('||',$nv);
		$metafile = fopen("db/admin.db","w+");
		
	}
	fwrite($metafile, $newtxt) or die("not working");
	fclose($metafile);
}

header("location:menu_settings.php");
?>