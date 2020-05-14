<?php
include("couponvalidation.php");
include("includes/config.php");
if(isset($_GET['action'])){
	$action = $_GET['action'];

switch ($action) {
		case "ch" :	//get all the channels	

			getChannels(scanpath);
			break;

		case "mf" :	//get all the media files of channel	

			getmediaFiles($_GET['dir']);
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
			if(isset($_GET['phonenum']) && $_GET['phonenum'] != ""){
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
			}
			else{
			echo '{"response_code": 0, "response" :"invalid phone number" }';
			}
			break;
		default:
		     echo '{"response_code": 0, "response" :"invalid action" }';

	}

}
else{
	  echo '{"response_code": 0, "response" :"action undefined" }';
}




function validateCouponcode($couponcode, $media){
		if(strlen($couponcode) == 12){
			$fpath = "../db/cpn.db";
			$contents = file_get_contents($fpath) or die('cannot open a file');
			if (strpos($contents, $couponcode) !== false) {
				echo '{"response_code": 1, "response" :"valid Coupon" }';
		} else {
				echo '{"response_code": 0, "response" :"invalid coupon" }';
			}
		}elseif (!strcmp(md5($couponcode), cheatcode)) {
				echo '{"response_code": 1, "response" :"cheat code activated" }';
		}else{
		echo '{"response_code": 0, "response" :"wrong coupon code entered" }';
		}
}
function pushtopiwik($phonenum, $useragent, $media_path, $ad_path){
	
$piwikdata = ' var adname = "'.$ad_path.'";
          var medianame = "'.$media_path.'";
          var ads = adname.split("/");
          var phonenum = "'.$phonenum.'";
          var useragent = "'.$useragent.'";
          var media = medianame.split("/");
    var dsk = "'.$dsk.'";
  var _paq = _paq || [];
 _paq.push(["setCustomVariable", 1,"advertisementid","'.$expath[$countv-1].'","page"]);
          _paq.push(["setCustomVariable", 2, "mediaid","'.$exmediapath[$countm-1].'","page"]);
      _paq.push(["setCustomVariable", 3, "device serial key","'.$dsk.'","page"]);
         _paq.push(["setCustomVariable", 4, "phonenum","'.$phonenum.'","page"]);
      _paq.push(["setCustomVariable", 5, "useragent","'.$useragent.'","page"]);
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);
  (function() {
    var u="//amuze.co.in:8283/piwik/";
    _paq.push(["setTrackerUrl", u+"piwik.php"]);
_paq.push(["setCustomVariable", 1,"advertisementid","'.$expath[$countv-1].'","page"]);
          _paq.push(["setCustomVariable", 2, "mediaid","'.$exmediapath[$countm-1].'","page"]);
		  _paq.push(["setCustomVariable", 3, "device serial key","'.$dsk.'","page"]);
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

function getChannels($dir){
	$files = array();
	$channels = array();
	// Is there actually such a folder/file?

	if(file_exists($dir)){
	
		foreach(scandir($dir) as $f) {
		
			if(!$f || $f[0] == '.') {
				continue; // Ignore hidden files
			}

			if(is_dir($dir . '/' . $f)) {

				// The path is a folder

				$files[] = array(
					//"name" => $f,
					//"type" => "folder",
					$f => 'http://amuze.co.in:5534/admin/api/ws.php?action=mf&dir='.$dir .'/' . $f,
					//"items" => getChannels($dir . '/' . $f) // Recursively get the contents of the folder
				);
			}
			
			
		}
	
	}
	$channels[] = array(
		"links" => $files
		);
	$file = fopen("channels.json","w");
	fwrite($file,json_encode($channels));
	fclose($file);
	$ch = str_replace("\/","/",json_encode($channels));
	echo substr($ch, 1, strlen($ch)-2);

}

function getmediaFiles($dir){
	$files = array();
	$channels = array();
	// Is there actually such a folder/file?

	if(file_exists($dir)){
	
		foreach(scandir($dir) as $f) {
		
			if(!$f || $f[0] == '.') {
				continue; // Ignore hidden files
			}

			if(is_dir($dir . '/' . $f)) {
/*
				// The path is a folder

				$files[] = array(
					//"name" => $f,
					//"type" => "folder",
					$f => $basepath.'/'.$dir . '/' . $f,
					//"items" => scan($dir . '/' . $f) // Recursively get the contents of the folder
				);*/
			}else{
				$image_extn = array("jpg","gif","png","JPEG","GIF","BMP","JPG","bmp");
				$media_extn = array("mp4","mp3");
				$path_parts = pathinfo($f);
				if(array_key_exists("extension", $path_parts)){
					if($path_parts['extension'] == "mp4" || $path_parts['extension'] == "mp3"){ 
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
					"adpath" =>  'http://amuze.co.in:5534'.adpath.'/'.$meta[4],
					"rating" => $meta[5],
					"thumbnail" =>  'http://amuze.co.in:5534'.$dir.'/'.$path_parts['filename'].'.jpg',
					"is_premium" => $meta[6],
					"roll" => $meta[7],
					"published"=>$meta[9],
					"price" => $meta[10],
					"premiumtime" => $meta[11],
					"skip_flag" => $meta[8],
					 "link" => 'http://amuze.co.in:5534'.$dir . '/' . $f
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
