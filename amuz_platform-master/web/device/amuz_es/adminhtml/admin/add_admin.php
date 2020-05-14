<?php
session_start();
include('config.php');
include('includes/utils.php');
require_once 'KLogger.php';
$log = new KLogger ( "log.txt" , KLogger::DEBUG );
if($_POST)
{
	$admin_name = $_POST['admin_name'];
	$admin_login = $_POST['admin_login'];
	$admin_email = $_POST['admin_email'];
	$password = $_POST['password'];
	$user_access = $_POST['user_access'];
	$category_access = $_POST['category_access'];
	$log_access = $_POST['log_access'];
	$services_access = $_POST['services_access'];
	$coupon_access = $_POST['coupon_access'];
	$serial_key_access = $_POST['serial_key_access'];
	$delivery_management_access = $_POST['delivery_management_access'];


	$file = @fopen(ADMINPATH."db/admin.db","a+");
	$t = read_last_line(ADMINPATH.'db/admin.db');

		$ex = explode('||',$t);
		$start = $ex[0]+1;
		
		$str = $start.'||'.$admin_name.'||'.MD5($admin_login).'||'.MD5($password).'||'.$user_access.'||'.$category_access.'||'.$log_access.'||'.$services_access.'||'.$coupon_access.'||'.$serial_key_access.'||'.$admin_email."||0||".$delivery_management_access."||\n";
		
		fwrite($file, $str); 
		fclose($file); 
}

if(isset($_GET["arr"]) != "")
{
	$myfile = fopen(ADMINPATH."db/admin.db", "r") or die("Unable to open file!");
	$nearr = array();
	while(! feof($myfile))
	{
		$gfile = fgets($myfile);
		$exfile = explode('||',$gfile);
		$nearr[] = $exfile;
	}
	
	//print_r($nearr);
	$arrayn = array();
	$enable = "disable";
	if($_GET['cng'] == 0)
	{
		$changval = 0;
	}
	else if($_GET['cng'] == 1)
	{
		$enable = "enable";
		$changval = 1;
	}
	foreach($nearr as $key=>$arr)
	{
		if($key == $_GET["arr"]-1)
		{
			$soarr = array();
			foreach($arr as $k=>$a)
			{
				if($k == $_GET["po"])
				{

					$soarr[] = $changval;
					if($_GET["po"] == 4){
						$log->LogInfo("User management of ".$_GET["user"]." is ".$enable." by ".ADMINUSER);
					}
					else if($_GET["po"] == 5){
						$log->LogInfo("Category management of ".$_GET["user"]." is ".$enable." by ".ADMINUSER);
					}
					else if($_GET["po"] == 6){
						$log->LogInfo("Log management of ".$_GET["user"]." is ".$enable." by ".ADMINUSER);
					}
					else if($_GET["po"] == 7){
						$log->LogInfo("Settings of ".$_GET["user"]." is ".$enable." by ".ADMINUSER);
					}
					else if($_GET["po"] == 8){
						$log->LogInfo("Coupon management of ".$_GET["user"]." is ".$enable." by ".ADMINUSER);
					}
					else if($_GET["po"] == 9){
						$log->LogInfo("Device Serial Key management of ".$_GET["user"]." is ".$enable." by ".ADMINUSER);
					}
					else if($_GET["po"] == 12){
						$log->LogInfo("Delivery management of ".$_GET["user"]." is ".$enable." by ".ADMINUSER);
					}
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
		$metafile = fopen(ADMINPATH."db/admin.db","w+");
		
	}
	echo $newtxt;
	fwrite($metafile, $newtxt) or die("not working");
	fclose($metafile);
}

header("location:user_management.php");
?>