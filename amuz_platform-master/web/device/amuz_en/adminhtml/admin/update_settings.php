<?php
session_start();
include("config.php");
$target_dir = ADMINPATH.'images/';
if(isset($_POST["create"])){
	
	$files = scandir($target_dir);
	print_r($files);
	/* $myfile = fopen("db/settings/".$_SESSION['username']."_settings.db", "r") or die("Unable to open file!");
	$nearr = array();
	while(! feof($myfile))
	{
		$gfile = fgets($myfile);
		$exfile = explode('||',$gfile);
		$nearr[] = $exfile;
	}	 */
	
	//print_r($nearr[0]);
	@unlink($target_dir.'ourtv_logo.png');
	
	
	$ext = explode(".",$_FILES["adminlogo"]["name"]);
	//$newfilename = $_SESSION['username'].time().'.'.end($ext);
	$newfilename = 'ourtv_logo.png';
	//echo $newfilename;
	$target_file = $target_dir . basename($_FILES["adminlogo"]["name"]);
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	move_uploaded_file($_FILES["adminlogo"]["tmp_name"], $target_dir.$newfilename) or die('not uploaded');
	//print_r($_FILES); exit;
	/*$str = $_SESSION['username'].'||'.$newfilename.'||202';
	$metafile = fopen('db/settings/'.$_SESSION['username'].'_settings.db',"w+");
	fwrite($metafile,$str);
	fclose($metafile);*/
	// echo 'uploaded';
	header("location:settings.php");
}
?>