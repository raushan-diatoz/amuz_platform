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
			curl_setopt($ch, CURLOPT_URL, "http://amuze.co.in:8283/api/ws.php?action=cv&couponcode=".$couponcode."&medianame=".$mediafile);
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
				if($re->coupontype == 2)
				{
					setcookie("couponcode_master", $re->validatedtill, $re->validatedtill);
				}
				setcookie("couponstatus", rand(00000,99999), $re->validatedtill);
				$returnv = "yes";
			}
			else
			{
				setcookie("sesiontimeend_".$nmediafile, "", time() - 3600);
				setcookie("videotitle_".$nmediafile, "", time() - 3600);
				setcookie("couponcode_".$nmediafile, "", time() - 3600);
				setcookie("couponcode_master", "", time() - 3600);
				setcookie("couponstatus", "", time() - 3600);
				
				$returnv = "unset";
			}
		}
		else
		{
			$returnv = "no";
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