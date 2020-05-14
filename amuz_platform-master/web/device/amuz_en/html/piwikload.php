<?php
include("includes/class_encription.php");
include("includes/config.php");
include("includes/functions.php");
if($_GET["ad_path"] != '')
{
	$ad_path = encrypt_decrypt('decrypt', $_GET["ad_path"]);
}
	$media_path = encrypt_decrypt('decrypt', $_GET["mpath"]);
	$dsk = $_GET["dsk"];
	$title = $_GET["title"];
	$type = $_GET["type"];
	$coupon = $_GET["coupon"];
	$contactnum = $_GET["contactnum"];
	//<script type="text/javascript">
	if($_GET["ad_path"] != '')
	{
		$expath = explode('/',$ad_path);
		$countv = count($expath);
	}

	$exmediapath = explode('%2F',$media_path);
	$countm = count($exmediapath);
	$filedata = $exmediapath[$countm-1];
	$exmediapathss = explode('/',$filedata);
	$countmss = count($exmediapathss);
	
	
	
	
	//print_r($exmediapath);
	$piwikdata = ' 
		 var _paq = _paq || [];
		_paq.push(["setCustomVariable", 1, "device serial key","'.$dsk.'","page"]);';
	
	if($_GET["ad_path"] != '')
	{
	$piwikdata .= ' _paq.push(["setCustomVariable", 2,"advertisementname","'.$expath[$countv-1].'","page"]);
		_paq.push(["setCustomVariable", 3,"adid","'.$expath[$countv-1].'","page"]);';
	}
	$piwikdata .= '	
		_paq.push(["setCustomVariable", 4, "medianame","'.$title.'","page"]);
		_paq.push(["setCustomVariable", 5, "mediaid","'.$exmediapathss[$countmss-1].'","page"]);';
	
	if($coupon != '')
	{
	$piwikdata .= '_paq.push(["setCustomVariable", 6,"coupon","'.$coupon.'","page"]);';
	}
	
	if($contactnum != '')
	{
	$piwikdata .= '_paq.push(["setCustomVariable", 7,"mobilenumber","'.$contactnum.'","page"]);';
	}
	
	
	$piwikdata .= '_paq.push(["trackPageView"]);
		_paq.push(["enableLinkTracking"]);
		(function() {
			var u="//amuze.co.in:8283/piwik/";
			_paq.push(["setTrackerUrl", u+"piwik.php"]);
			_paq.push(["setSiteId", 1]);
			var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0];
			g.type="text/javascript"; g.async=true; g.defer=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
		})();';
  
	$date = date('dmY',time());
	  
	$nfile = fopen("logs/piwik_data/ourtv_data_".$date.".js","a+");
	fwrite($nfile, $piwikdata); 
	fclose($nfile); 
 ////////////////////////////
 
	
	$nfile = @fopen(ADMINPATH."db/report.db","a+");
	$t = read_last_line(ADMINPATH.'db/report.db');

	$ex = explode('||',$t);
	if(is_array($ex))
		$start = $ex[0]+1;
	else
		$start = 1;

	$str = $start.'||'.$dsk.'||'.$type.'||';
	if($title != "")
		$str .= $title.'||';
	else
		$str .= $exmediapathss[$countmss-1].'||';
	
	$str .= $exmediapathss[$countmss-1].'||';
	if($_GET["ad_path"] != '')
		$str .= $expath[$countv-1].'||'.$expath[$countv-1].'||';
	else
		$str .= 'NULL||NULL||';
	if($coupon != '')
		$str .= $coupon.'||';
	else
		$str .= 'NULL||';
	if($contactnum != '')
		$str .= $contactnum.'||';
	else
		$str .= 'NULL||';
	
	$str .= time()."||\n";
	echo $str;
	fwrite($nfile, $str); 
	fclose($nfile);  



?>