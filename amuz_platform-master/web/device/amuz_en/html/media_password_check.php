<?php
include("includes/config.php");
$domain = 'www.amuze.co.in:8283/piwik/index.php';
  

cheatcode;
$couponcode = $_POST["pwd"];
$mediafile = $_POST["title"];
$timeend = time()+(86400*2);
if($couponcode != "")
	{
		if(ping_domain($domain))
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, webserviceurl."/api/ws.php?action=cv&couponcode=".$couponcode."&medianame=".$mediafile);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "");
			$response = curl_exec($ch);
			curl_close($ch);
			$re = json_decode($response);
			
			if($re->response_code == 1)
			{
				$nmediafile = str_replace(" ","",$mediafile);
				setcookie("sesiontimeend_".$nmediafile, $re->validatedtill, $re->validatedtill);
				setcookie("videotitle_".$nmediafile, $mediafile, $re->validatedtill);
				setcookie("couponcode_".$nmediafile, $couponcode, $re->validatedtill);
				if($re->coupontype == "2")
				{
					setcookie("couponcode_master", $re->validatedtill, $re->validatedtill);
				}
				setcookie("couponstatus", rand(00000,99999), $re->validatedtill);
				
				$returnv = "yes";
			}
			else
			{
				$returnv = "no";
			}
		}
		else
		{
			$timeend = time()+ (86400*2);
			$nmediafile = str_replace(" ","",$mediafile);
			setcookie("sesiontimeend_".$nmediafile, $timeend, $timeend);
			setcookie("videotitle_".$nmediafile, $mediafile, $timeend);
			setcookie("couponcode_".$nmediafile, $couponcode, $timeend);
			setcookie("couponcode_master", $timeend, time()+ 3600*2);
			setcookie("couponcode_check", $couponcode, $timeend);
			setcookie("couponstatus", rand(00000,99999), $timeend);
			$returnv = "yes";
		}

	}
	else
	{
		$returnv = "no";	
	}
	$connection = "";
	echo $returnv;



function ping_domain($domain)
{
    $file = @fsockopen ($domain, 80, $errno, $errstr, 10);
	
    return (!$file) ? FALSE : TRUE;
}
?>