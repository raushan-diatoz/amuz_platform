<?php
include("includes/config.php");
$phone = $_POST["phn1"]; 
if($phone != "")
{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, webserviceurl."/api/ws.php?action=rg&phonenum=".base64_encode($phone));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "");
		$response = curl_exec($ch);
		curl_close($ch);
		$re = json_decode($response);
		
		if($re->response == "existed in database verified" || $re->response == "validated")
		{
			setcookie("mobileVerification", rand(00000000,99999999), time()+(86400*200));
			setcookie("mobileNum", $phone, time()+(86400*200));
		}
		else
		{
			setcookie("mobileNum", $phone, time()+(86400*200));
		}
		$pass = "yes";
}
else
{
    $pass = "no";
}
echo $pass;

?>