<?php
session_start();
include('config.php');
include("scan.php");
include("scanitem.php");
include("filescan.php");
include("foldersize.php");

if(isset($_GET['dir']) != '')
{
	$getdir = $_GET['dir'];
	$dirpath = ROOTPATH.'/'.$_GET['dir'].'/';
	$jspath = ROOTPATH.'/'.$_GET['dir'].'/';
}
else
{
	$getdir = '';
	$dirpath = ROOTPATH;
	$jspath = ROOTPATH.'/';
}

//echo $dirpath;
$paths = scan($dirpath);
$itempaths = filescan($dirpath);

$pathname = ROOTPATH.'/'.$_GET['dir'].'/';
/* echo $pathname; */
$vfilename = explode('.',$itempaths[0]["name"]);
$filename=$vfilename[0];

	//echo $pathname.$_GET["file"].".txt";
	$myfile = fopen($pathname.$_GET["file"].".txt", "r") or die("Unable to open file!");
	$nearr = array();
	while(! feof($myfile))
	{
		$gfile = fgets($myfile);
		$exfile = explode('||',$gfile);
		$nearr[] = $exfile;
	}
	
	$getarray = $nearr[0];
	$rcount = count($getarray);
	
	
	if($_GET["publish"] == 0)
	{
		$getarray[9] = '0';
	}
	if($_GET["publish"] == 1)
	{
		$getarray[9] = '1';
	}
	
	$newtxt = implode('||',$getarray).'||'.$status;
	$metafile = fopen($pathname.$_GET["file"].".txt","w+");
	fwrite($metafile, $newtxt) or die("not wright");
	
	fclose($metafile);
	$link = "?dir=".$_GET['dir'];
	header("location:category_management.php".$link);

?>