<?php
include("includes/config.php");
if(!isset($_SESSION)) 
{
	session_start();
}
$vcode = $_POST["vcode"];
$mphone = $_POST["mphone"];
//print_r($_POST);
if($vcode != "")
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://amuze.co.in:8283/api/ws.php?action=vp&phonenum=".base64_encode($mphone)."&otp=".$vcode);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "");
	$response = curl_exec($ch);
	curl_close($ch);
	$re = json_decode($response);
	
	if($re->response == "validated")
	{
		setcookie("mobileVerification", rand(00000000,99999999),  time()+(86400*200));
	}
	
	$returnv = "yes";
}
else
{
	$returnv = "no";
}

echo $returnv;