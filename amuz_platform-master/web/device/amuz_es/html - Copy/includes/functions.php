<?php

function medfile($medarr,$id){

$id = $id;
$image_extn = array("jpg","gif","png","JPEG");
foreach ($medarr as $key => $val) {  
if (is_array($val)){
medfile($val,$id); // recursive array
}
else
{
	if($key == "path")
    {
		$path_parts = pathinfo($val);		        	
    	if(array_key_exists("extension", $path_parts)){
    		if($path_parts['extension'] == "mp4" || $path_parts['extension'] == "mp3"){    			
     			$image_extn = array("jpg","gif","png","JPEG");
     			$media_path = $val;    										
				$image_path = "images/def.png";							
				foreach ($image_extn as $extn){
					if(file_exists($path_parts['dirname'].'/'.$path_parts['filename'].'.'.$extn)){
				 		$image_path = $path_parts['dirname'].'/'.$path_parts['filename'].'.'.$extn;				 		
				 	}		
				}				
				$filepath = $path_parts['dirname'].'/'.$path_parts['filename'].'.txt';							
				$meta_cont = array();
				if(file_exists($filepath)){												
				$file_cont = file_get_contents($filepath, true);				
				$meta_cont = explode("||", $file_cont);
				 	echo "<a class='mov-ele' href='play.php?id=".$id."&title=".$path_parts['filename']."&meta_path=".urlencode($filepath)."&media=".urlencode($media_path)."&img_path=".urlencode($image_path)."' class='mov-item'><div class='mov-img-lt'><img src='".$image_path."'></div><div class='mov-cont-rt'><div><span>".$meta_cont[2]."</span><br>".$meta_cont[0]." | ".$meta_cont[1]."<br><span class='stars'>".$meta_cont[5]."</span>(".$meta_cont[5]."/10)</div></div></a>"; 
				 } else {
				 	$f_title = (strlen($path_parts['filename']) > 25) ? substr($path_parts['filename'],0,25).'...' : $path_parts['filename'];
				 	if($path_parts['extension'] == "mp3"){ 
					 	echo "<a class='mov-ele wt-m'  href='play.php?id=".$id."&title=".$path_parts['filename']."&media=".urlencode($media_path)."&img_path=".urlencode($image_path)."' class='mov-item'><div class='mov-img-lt'><img src='".$image_path."'></div><div class='mov-cont-rt music-rt'><span>".$f_title."</span></div></a>"; 								
					 } else{					 	
					 	echo "<a class='mov-ele wt-m'  href='play.php?id=".$id."&title=".$path_parts['filename']."&media=".urlencode($media_path)."&img_path=".urlencode($image_path)."' class='mov-item'><div class='mov-img-lt'><img src='".$image_path."'></div><div class='mov-cont-rt'><span>".$f_title."</span></div></a>"; 								
					 }
				}

    		}
    	}
	}
}
}

}

//helps to show all the videos, audios and images as a gallery

function medfilelist($medarr,$list_path){
$image_extn = array("jpg","jpeg","gif","png","JPEG","GIF","BMP","JPG","bmp");
$media_extn = array("mp4","mp3");
foreach ($medarr as $key => $val){  
if (is_array($val)){
	medfilelist($val); // recursive array
}
else
{
	if($key == "path")
    {
		$path_parts = pathinfo($val);		        	
		if(array_key_exists("extension", $path_parts)){
    		if($path_parts['extension'] == "mp4" || $path_parts['extension'] == "mp3"){    			

     			//$image_extn = array("jpg","gif","png","JPEG");
     			$media_path = $val;
     			$media_path = urlencode($media_path);       													
				$image_path = "images/def.png";	
				$img_exists = false;	
				$subscribe_img = "";					
				foreach ($image_extn as $extn){
					if(file_exists($path_parts['dirname'].'/'.$path_parts['filename'].'.'.$extn)){
				 		$image_path = $path_parts['dirname'].'/'.$path_parts['filename'].'.'.$extn;				 		
				 		$img_exists = true;
				 	}		
				}				
				$filepath = $path_parts['dirname'].'/'.$path_parts['filename'].'.txt';							
				$meta_cont = array();
				if(file_exists($filepath)){												
				$file_cont = file_get_contents($filepath, true);				
				$meta_cont = explode("||", $file_cont);	
					if(isset($meta_cont[6])){
						if($meta_cont[6] == "1"){
							$subscribe_img = "<span class='prem-tag'>Premium</span>";
						}else{
							$subscribe_img= "";
						}
					}
					else{
						$subscribe_img = "";
					}			 	
					$string = "list=".$list_path."&title=".$path_parts['filename']."&meta_path=".urlencode($filepath)."&media=".urlencode($media_path)."&img_path=".urlencode($image_path);
					$encripted = encrypt_decrypt('encrypt', $string);
					if($_SESSION["mobileNum"] == "")
					{
						$gclass = "show1 hrefloc";
					}
					else
					{
						$gclass = "";
					}
					//echo "<li><a class='mov-ele mov-item ".$gclass."' href='media_desc.php?nlink=".$encripted."'>".$subscribe_img."<div class='mov-img-lt'><img src='".$image_path."'></div><div class='mov-cont-rt'><div><span>".$meta_cont[2]."</span><br>".$meta_cont[0]." | ".$meta_cont[1]."<br><span class='stars'>".$meta_cont[5]."</span>(".$meta_cont[5]."/10)</div></div></a></li>"; 									
					echo "<li><a class='mov-ele mov-item' href='media_desc.php?nlink=".$encripted."'>".$subscribe_img."<div class='mov-img-lt'><img src='".$image_path."'></div><div class='mov-cont-rt'><div><span>".$meta_cont[2]."</span><br>".$meta_cont[0]." | ".$meta_cont[1]."<br><span class='stars'>".$meta_cont[5]."</span>(".$meta_cont[5]."/10)</div></div></a></li>"; 									
				} else {
				 	$f_title = (strlen($path_parts['filename']) > 25) ? substr($path_parts['filename'],0,25).'...' : $path_parts['filename'];
					$string = "list=".$list_path."&title=".$path_parts['filename']."&meta_path=".urlencode($filepath)."&media=".urlencode($media_path)."&img_path=".urlencode($image_path);
					$encripted = encrypt_decrypt('encrypt', $string);
				 	if($path_parts['extension'] == "mp3"){ 
				 		if($img_exists){
						 	echo "<li><a class='mov-ele'  href='play.php?nlink=".$encripted."' class='mov-item'><div class='mov-img-lt'><img src='".$image_path."'></div><div class='mov-cont-rt'><div><span>".$f_title."</span><br>N/A<br>N/A</div></div></a></li>"; 								
						 }
						 else{
							echo "<li><a class='mov-ele'  href='play.php?nlink=".$encripted."' class='mov-item'><div class='mov-img-lt img_e'><img src='".$image_path."'></div><div class='mov-cont-rt'><div><span>".$f_title."</span><br>N/A<br>N/A</div></div></a></li>"; 														 	
						 }
					} else {
						if($img_exists){					 	
							echo "<li><a class='mov-ele'  href='play.php?nlink=".$encripted."' class='mov-item'><div class='mov-img-lt'><img src='".$image_path."'></div><div class='mov-cont-rt'><div><span>".$f_title."</span><br>N/A<br>N/A</div></div></a></li>"; 								
						} 
						else{
							echo "<li><a class='mov-ele'  href='play.php?nlink=".$encripted."' class='mov-item'><div class='mov-img-lt img_e'><img src='".$image_path."'></div><div class='mov-cont-rt'><div><span>".$f_title."</span><br>N/A<br>N/A</div></div></a></li>"; 								
						}
					}
				}

    		}
    		else{  // To display image gallery
    			$ImgDetArr = pathinfo($val);
    			if(in_array($ImgDetArr['extension'], $image_extn)){
    				$exists = false;
	    			foreach ($media_extn as $extn){
						if(file_exists($ImgDetArr['dirname'].'/'.$ImgDetArr['filename'].'.'.$extn)){	// To check image is not cover pic of media				 					 		
							$exists = true;							
					 	}
					}
					if($exists == false){
						$title = '{"filename":"'.encrypt_decrypt('encrypt', $ImgDetArr["filename"]).'","dsk":"'.DSK.'","imgname":"'.$ImgDetArr["filename"].'.jpg"}';
						
				 	echo "<li class='box'>
			                <a href='".$val."' class='swipebox' title='".$title."'>
			                    <img src='".$val."' alt='".$ImgDetArr["filename"]."'>
			                </a>
			            </li>";		
				    }
				}
    		}
    	}
	}
}
}

}



//helps to display the play list of audio player input is directory path
function audio_playlist($audio_path){
	$playlist = array();
	foreach(scandir($audio_path) as $value){
		$arr = pathinfo($value);
		if($arr['extension'] == "mp3"){
			array_push($playlist, $value);
		}
    }
	return $playlist;
}
//to read last line of the supplied input file
function read_last_line ($file_path)
	{
		$line = '';
		$f = fopen($file_path, 'r');
		$cursor = -1;
		fseek($f, $cursor, SEEK_END);
		$char = fgetc($f);
		/**
		* Trim trailing newline chars of the file
		*/
		while ($char === "\n" || $char === "\r") 
		{
			fseek($f, $cursor--, SEEK_END);
			$char = fgetc($f);
		}
		/**
		* Read until the start of file or first newline char
		*/
		while ($char !== false && $char !== "\n" && $char !== "\r") 
		{
			/**
			 * Prepend the new char
			 */
			$line = $char . $line;
			fseek($f, $cursor--, SEEK_END);
			$char = fgetc($f);
		}

		return $line;
	}
//to generate a random string of supplied length
function generateRandomString($length) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
	//$output = str_split($randomString, 4);
	//$randomString = implode('-',$output);
    return $randomString;
}
?>