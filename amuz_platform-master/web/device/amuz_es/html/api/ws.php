<?php

include("../includes/config.php");
include("../includes/functions.php");
include("../includes/prescan.php");

if(isset($_GET['action'])){
	$action = $_GET['action'];

switch ($action) {
		case "ch" :	//get all the channels	
			
			getChannels(scanpath);
			break;

		case "mf" :	//get all the media files of channel	

			getmediaFiles($_GET['dir']);
			break;
		case "cf" :	//get all the configs	
			
			getConfigurations();
			break;

		case "cv" :  //couponvalidation
			if(isset($_GET['couponcode']) && $_GET['couponcode'] != ""){
				if(isset($_GET['medianame']) && $_GET['medianame'] != ""){
					validateCouponcode($_GET['couponcode'],  $_GET['medianame']);
				}
				else{
					echo '{"response_code": 0, "response" :"please enter media name" }';
				}
			}
			else{
			 echo '{"response_code": 0, "response" :"please enter coupon code" }';
			}
			break;
		case "pi":
			
				if(isset($_GET['useragent']) && $_GET['useragent'] != ""){
					if(isset($_GET['medianame']) && $_GET['medianame'] != ""){
						if(isset($_GET['adname']) && $_GET['adname'] != ""){
							pushtopiwik($_GET['phonenum'], $_GET['useragent'], $_GET['medianame'], $_GET['adname']);
						}
						else{
							echo '{"response_code": 0, "response" :"invalid adname" }';
						}
					}
					else{
					echo '{"response_code": 0, "response" :"invalid media name" }';
					}
				}
				else{
					echo '{"response_code": 0, "response" :"invalid user agent" }';
				}
			
			break;
		case "rg":
			if(isset($_GET['phonenum']) && $_GET['phonenum'] != ""){
			$_GET['phonenum'] = base64_decode($_GET['phonenum']);
			registration($_GET['phonenum']);
			}else{
			echo '{"response_code": 0, "response" :"please enter a phonenumber	" }';
			}
			break;
		case "vp":
			if(isset($_GET['phonenum']) && $_GET['phonenum'] != ""){

				if(isset($_GET['otp']) && $_GET['otp'] != ""){
					$_GET['phonenum'] = base64_decode($_GET['phonenum']);
					validatephonenum($_GET['phonenum'],  $_GET['otp']);
				}
				else{
					echo '{"response_code": 0, "response" :"please enter otp" }';
				}
			}
			else{
			 echo '{"response_code": 0, "response" :"please enter phonenum" }';
			}
			break;
		case "dr":
			if(isset($_GET['uuid']) && $_GET['uuid'] != ""){
			checkdeliveryreport($_GET['uuid']);
			}else{
			echo '{"response_code": 0, "response" :"please enter a uuid" }';
			}
			break;
		case "yt":

			getyoutubeChannels();
			break;
		default:
		     echo '{"response_code": 0, "response" :"invalid action" }';

	}

}
else{
	  echo '{"response_code": 0, "response" :"action undefined" }';
}



function getyoutubechannels(){


	
	 $ping = "www.google.com";
             if($ping == NULL) return false;  
             $ch1 = curl_init($ping);  
             curl_setopt($ch1, CURLOPT_TIMEOUT, 5);  
             curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, 5);  
             curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);  
             $data = curl_exec($ch1);  
              $httpcode = curl_getinfo($ch1, CURLINFO_HTTP_CODE);  
             curl_close($ch1);  
              if($httpcode>=200 && $httpcode<400){
		$msg = "HI,%20your%20verification%20code%20to%20register%20with%20amuz%20is:%20".$varificationcode;
		$ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/youtube/v3/videos?part=contentDetails&chart=mostPopular&regionCode=IN&key=AIzaSyBjSycRQWMUzI8iSjArMk3_6uGb8Oe8FTI");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "");
                echo $response = curl_exec($ch);
                curl_close($ch);
                $re = json_decode($response);	
		//print_r($re);
	       }



}


function getConfigurations(){
	echo '{"response_code": 1, "paymentoption" :'.paymentoption.', "invalidotptimeout" : '.invalidotptimeout.', "registrationflow" : '.registrationflow.', "couponflow" : '.couponflow.',"otplength": '.otplength.',"couponcodelength": '.couponcodelength.'}';
}

function checkdeliveryreport($uuid){
	     $ping = "www.google.com";
             if($ping == NULL) return false;  
             $ch1 = curl_init($ping);  
             curl_setopt($ch1, CURLOPT_TIMEOUT, 5);  
             curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, 5);  
             curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);  
             $data = curl_exec($ch1);  
              $httpcode = curl_getinfo($ch1, CURLINFO_HTTP_CODE);  
             curl_close($ch1);  
              if($httpcode>=200 && $httpcode<400){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://fastalerts.in/api/v1/811284ce-5780-11e5-91bd-778ce9f8c145/sms/".$uuid."/status");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
		$res = curl_exec($ch);
		curl_close($ch);
		if(strpos($res,'DELIVRD') !== false){
		echo '{"response_code": 1, "response" :"Delivered"}';
		}else{
		echo '{"response_code": 0, "response" :"Not Delivered"}';

		}
                
	    }


}
function validatephonenum($phone, $otp){

$vcode = $otp;
$mphone = $phone;

if($vcode != "")
{
	
	$myfile = fopen(ADMINPATH."db/phoneverify.db", "r") or die("Unable to open file!");
	$nearr = array();
	while(! feof($myfile))
	{
		$gfile = fgets($myfile);
		$exfile = explode('||',$gfile);
		$nearr[] = $exfile;
	}
	
	$arrayn = array();
	foreach($nearr as $nr)
	{
		if(in_array($mphone,$nr))
		{
			//print_r($nr);
			if($nr[2] == $vcode)
			{
				$soarr = array();
				foreach($nr as $k=>$a)
				{
					if($k == 3)
					{
						$soarr[] = '1';
					}
					else
					{
						$soarr[] = $a;
					}
				}
				//$_SESSION["mobileVerification"] = rand(00000000,99999999);
				$arrayn[] = $soarr;
				$returnv = "yes";
			echo '{"response_code": 1, "response" :"validated" }';

			}
			else
			{
				$arrayn[] = $nr;
				$returnv = "no";
			echo '{"response_code": 0, "response" :"invalid otp" }';
			}
		}
		else
			$arrayn[] = $nr;
	}
	$newtxt = "";
	foreach($arrayn as $nv)
	{
		$newtxt .= implode('||',$nv);
	}
	//echo $newtxt;
	$metafile = fopen(ADMINPATH."db/phoneverify.db","w+");
	//echo $newtxt;
	fwrite($metafile, $newtxt) or die("not working");
	fclose($metafile);
}


}

function registration($phone){
	if (file_exists(ADMINPATH."db/phoneverify.db")) 
	{
		$myfile = @fopen(ADMINPATH."db/phoneverify.db", "r");
		$nearr = array();
		while(! feof($myfile))
		{
			$gfile = fgets($myfile);
			$exfile = explode('||',$gfile);
			$nearr[] = $exfile;
		}
		
		foreach($nearr as $nr)
		{
			if(in_array($phone,$nr))
			{
				//print_r($nr);
				if($nr[3] == 1)
				{
					$pass = "verify";
					
					echo '{"response_code": 1, "response" :"existed in database verified" }';
				}
				else
				{
					
					$pass = "yes";
					echo '{"response_code": 2, "response" :"'.$nr[2].'" }';	
				}
				$inarr = "yes";
				
	
			}
		}
	}
	
	if($inarr != "yes" && $inarr == "")
	{

	$file = @fopen(ADMINPATH."db/phoneverify.db","a+");

        $t = read_last_line(ADMINPATH.'db/phoneverify.db');
        if($t != '')
        {
            $ex = explode('||',$t);
            //print_r($ex);
            $start = $ex[0]+1;
        }
        else
        {
            $start = 1;
        }

        $varificationcode = generateRandomString(otplength);
        $status = 0;
	$str .= $start.'||'.$phone.'||'.$varificationcode.'||'.$status.'||'.DSK.'||'.time()."\n";        
	if(smsflag == 0){
        shell_exec('sudo killall wvdial');
        sleep(1);
        shell_exec('sudo gsmsendsms -d /dev/ttyUSB0 -b 9600 '.$phone.' "HI, your verification code to register with amuz is: '.$varificationcode.'"');
        fwrite($file, $str); 
        fclose($file);
        $pass = "yes";
	echo '{"response_code": 1, "response" :"'.$varificationcode.'","senderid":"'.senderid.'"}';
        }else{
	     	
             $ping = "www.google.com";
             if($ping == NULL) return false;  
             $ch1 = curl_init($ping);  
             curl_setopt($ch1, CURLOPT_TIMEOUT, 5);  
             curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, 5);  
             curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);  
             $data = curl_exec($ch1);  
              $httpcode = curl_getinfo($ch1, CURLINFO_HTTP_CODE);  
             curl_close($ch1);  
              if($httpcode>=200 && $httpcode<400){
		$msg = "HI,%20your%20verification%20code%20to%20register%20with%20amuz%20is:%20".$varificationcode;
		$ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://fastalerts.in/api/v1/sms/single.json?token=811284ce-5780-11e5-91bd-778ce9f8c145&msisdn=".$phone."&text=".$msg."&sender_id=".senderidcloud."&route=TRANS&unicode=false&flash=false");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "");
                $response = curl_exec($ch);
                curl_close($ch);
                $re = json_decode($response);
		if(@$re->fastalerts->status == "Success"){
		fwrite($file, $str) or die("asdfgas"); 
                fclose($file);
		$pass = "yes";
		echo '{"response_code": 1, "response" :"'.$varificationcode.'","sender_id":"'.senderidcloud.'","uuid": "'.@$re->fastalerts->uuid.'"}';
                }
                else{
                $pass= "no";
		echo '{"response_code": 0, "response" :"'.@$re->fastalerts->description.'"}';
                }
             
              }else{
                 $str .= $start.'||'.$phone.'||'.$varificationcode.'||'.$status.'||'.DSK.'||'.time()."\n";
                    //$_SESSION["mobileNumber"] = rand(00000000,99999999);
                    //$_SESSION["mobileNum"] = $phone;
                    shell_exec('sudo killall wvdial');
                    sleep(1);
                    shell_exec('sudo gsmsendsms -d /dev/ttyUSB0 -b 9600 '.$phone.' "HI, your verification code to register with amuz is: '.$varificationcode.'"');
                    fwrite($file, $str); 
                    fclose($file);
                    $pass = "yes";
		    echo '{"response_code": 1, "response" :"'.$varificationcode.'","sender_id":"'.senderid.'" }';
  
              }  
        }
	}

}

function validateCouponcode($couponcode, $media){
$mediafile = $media;
$timeend = time()+(86400*2);
if(MD5($couponcode) == cheatcode)
{
	$timeend = time()+ (86400*2);
	$nmediafile = str_replace(" ","",$mediafile);
	echo '{"response_code": 1, "response" :"cheat code activated","validatedtill":"'.$timeend.'","coupontype":"2"}';
}
else if($couponcode != "")
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
			if($cpntyp == 'all')
			{
				echo '{"response_code": 1, "response" :"coupon validated", "coupontype":2,"validatedtill":"'.$timeend.'" }';
			}
			else{
				echo '{"response_code": 1, "response" :"coupon validated", "coupontype":1,"validatedtill":"'.$timeend.'" }';
			}
		}
		else
		{
			echo '{"response_code": 0, "response" :"invalid coupon" }';
		}
		

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
		echo "no";	
}
function pushtopiwik($phonenum, $useragent, $media_path, $ad_path){
	
$piwikdata = ' var adname = "'.$ad_path.'";
          var medianame = "'.$media_path.'";
          var ads = adname.split("/");
          var phonenum = "'.$phonenum.'";
          var useragent = "'.$useragent.'";
          var media = medianame.split("/");
    var dsk = "'.DSK.'";
  var _paq = _paq || [];
 _paq.push(["setCustomVariable", 1,"advertisementid","'.$expath[$countv-1].'","page"]);
          _paq.push(["setCustomVariable", 2, "mediaid","'.$exmediapath[$countm-1].'","page"]);
      _paq.push(["setCustomVariable", 3, "device serial key","'.DSK.'","page"]);
         _paq.push(["setCustomVariable", 4, "phonenum","'.$phonenum.'","page"]);
      _paq.push(["setCustomVariable", 5, "useragent","'.$useragent.'","page"]);
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);
  (function() {
    var u="//amuze.co.in:8283/piwik/";
    _paq.push(["setTrackerUrl", u+"piwik.php"]);
_paq.push(["setCustomVariable", 1,"advertisementid","'.$expath[$countv-1].'","page"]);
          _paq.push(["setCustomVariable", 2, "mediaid","'.$exmediapath[$countm-1].'","page"]);
		  _paq.push(["setCustomVariable", 3, "device serial key","'.DSK.'","page"]);
		    _paq.push(["setCustomVariable", 4, "phonenum","'.$phonenum.'","page"]);
      _paq.push(["setCustomVariable", 5, "useragent","'.$useragent.'","page"]);
    _paq.push(["setSiteId", 1]);
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0];
    g.type="text/javascript"; g.async=true; g.defer=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
  })();';
  
$date = date('dmY',time());
  
$file = fopen("../logs/piwik_data/ourtv_data_".$date.".js","a+");
fwrite($file, $piwikdata); 
fclose($file); 

}

function getChannels($dir)
{

	$paths = scan($dir);
	//print_r($paths);
	$narr = array();
	foreach($paths as $subfolder)
	{
		
		$newpath = $subfolder["path"];
		$newpaths = scan($newpath);
		foreach($newpaths as $val)
		{
			$vals[$val['name']] = webserviceurl.'/api/ws.php?action=mf&dir='.$val['path'];

			
		}
	}


	
	
	array_push($narr,$vals);
	$fj =  '{"links":'.json_encode($narr).'}';
	$fj =  str_replace('\/','/',$fj);
	echo str_replace('","', '"},{"', $fj);
}



function getmediaFiles($dir){
	$files = array();
	$channels = array();
	// Is there actually such a folder/file?
	$imageextn = array("jpg","gif","png","JPEG","GIF","BMP","JPG","bmp", "mp3");
	if(file_exists($dir)){
	
		foreach(scandir($dir) as $f) {
		
			if(!$f || $f[0] == '.') {
				continue; // Ignore hidden files
			}

			if(is_dir($dir . '/' . $f)) {

			}
			$path_parts = pathinfo($f);
			if(in_array($path_parts['extension'], $imageextn)){
				if(!file_exists($dir.'/'.$path_parts['filename'].'.mp4') && !file_exists($dir.'/'.$path_parts['filename'].'.txt')){
		        $files[] = array(
		           "link" => 'http://amuze.co.in:8283'.$dir . '/' . $f
		        );
		    }
      }
			else{
				$image_extn = array("jpg","gif","png","JPEG","GIF","BMP","JPG","bmp");
				$media_extn = array("mp4","mp3");
				if(array_key_exists("extension", $path_parts)){
					if($path_parts['extension'] == "mp4"){ 
					$metacontent = file_get_contents($dir.'/'.$path_parts['filename'].'.txt');
					$meta = explode("||", $metacontent);
					$channel = explode('/', $dir);
					$ImgDetArr = pathinfo($f);
					//echo $cm = $channel[count($channel) -1];
					$files[] = array(
					"channel" => $channel[count($channel) -1],
					"language" => $meta[0],
					"genre" => $meta[1],
					"title" => $meta[2],
					"desc" => $meta[3],
					"adpath" =>  str_replace(' ','%20',webserviceurl.ADPATH.'/'.$meta[4] ),
					"rating" => $meta[5],
					"thumbnail" =>  str_replace(' ','%20',webserviceurl.$dir.'/'.$path_parts['filename'].'.jpg'),
					"is_premium" => $meta[6],
					"roll" => $meta[7],
					"published"=>$meta[9],
					"price" => $meta[10],
					"premiumtime" => $meta[11],
					"skip_flag" => $meta[8],
					 "link" => str_replace(' ','%20',webserviceurl.$dir . '/' . $f)
					//"items" => scan($dir . '/' . $f) // Recursively get the contents of the folder
					);

					}	
				}
				
	
			
			}
			
			
		}
	
	}
	echo str_replace("\/","/",json_encode($files));




}

?>
