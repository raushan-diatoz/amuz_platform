<?php
include("includes/config.php");
$domain = 'www.amuze.co.in:8283/piwik/index.php';
  

cheatcode;
$couponcode = $_POST["pwd"];
$mediafile = $_POST["title"];
$timeend = time()+(86400*2);
if($couponcode != "")
	{
		
		$myfile = fopen(ADMINPATH."db/cpn.db", "r") or die("Unable to open file!");
		$nearr = array();
		while(! feof($myfile))
		{
			$gfile = fgets($myfile);
			$exfile = explode('||',$gfile);
			$nearr[] = $exfile;
		}
		
		
		//print_r($nearr);
		$arrayn = array();
		foreach($nearr as $nr)
		{
			if(in_array($couponcode,$nr))
			{
				if($nr[6] != 505)
				{
					$soarr = array();
					foreach($nr as $k=>$a)
					{
						if($k == 6)
						{
							$soarr[] = '505';
						}
						else
						{
							$soarr[] = $a;
						}
					}
					array_push($soarr, $mediafile, $timeend."\n");
					$arrayn[] = $soarr;
					$returnv = "yes";
				}	
				else
				{
					$arrayn[] = $nr;
					$returnv = "no";
				}
				
				if($nr[5] == 2)
				{
					$cpntyp = 'all';
				}
				else
				{
					$cpntyp = '';
				}
			}
			else
				$arrayn[] = $nr;
		}
		
		if($returnv == "yes")
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
			
			//print_r($arrayn);
			$newtxt = "";
			foreach($arrayn as $nv)
			{
				$newtxt .= implode('||',$nv);
			}
			//echo $newtxt;
			$metafile = fopen(ADMINPATH."db/cpn.db","w+");
			//echo $newtxt;
			fwrite($metafile, $newtxt) or die("not working");
			fclose($metafile);
		}
		else
		{
			$returnv = "no";
		}
		

		
		
		
		
		if(ping_domain($domain) && $returnv == "no")
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