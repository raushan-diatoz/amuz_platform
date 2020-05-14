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

/////////////////////////////////////////////////////////////////

function medfilelist($medarr,$list_path){
$image_extn = array("jpg","gif","png","JPEG","GIF","BMP","JPG","bmp");
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
				$myfile = fopen($filepath, "r") or die("Unable to open file!");
					$nearr = array();
					while(! feof($myfile))
					{
						$gfile = fgets($myfile);
						$exfile = explode('||',$gfile);
						$nearr[] = $exfile;
					}
					//echo '<br>'.$nearr[0][9];
					if($nearr[0][9] == 1)
					{
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
							echo "<li><a class='mov-ele mov-item' href='media_desc.php?nlink=".$encripted."'>".$subscribe_img."<div class='mov-img-lt'><img src='".$image_path."'></div><div class='mov-cont-rt'><div><span>".$meta_cont[2]."</span><br>".$meta_cont[0]." | ".$meta_cont[1]."<br><span class='stars'>".$meta_cont[5]."</span>(".$meta_cont[5]."/10)</div></div></a></li>"; 									
						} else {
							$f_title = (strlen($path_parts['filename']) > 25) ? substr($path_parts['filename'],0,25).'...' : $path_parts['filename'];
							if($path_parts['extension'] == "mp3"){ 
								if($img_exists){
									echo "<li><a class='mov-ele'  href='play.php?list=".$list_path."&title=".$path_parts['filename']."&media=".$media_path."&img_path=".urlencode($image_path)."' class='mov-item'><div class='mov-img-lt'><img src='".$image_path."'></div><div class='mov-cont-rt'><div><span>".$f_title."</span><br>N/A<br>N/A</div></div></a></li>"; 								
								 }
								 else{
									echo "<li><a class='mov-ele'  href='play.php?list=".$list_path."&title=".$path_parts['filename']."&media=".$media_path."&img_path=".urlencode($image_path)."' class='mov-item'><div class='mov-img-lt img_e'><img src='".$image_path."'></div><div class='mov-cont-rt'><div><span>".$f_title."</span><br>N/A<br>N/A</div></div></a></li>"; 														 	
								 }
							} else {
								if($img_exists){					 	
									echo "<li><a class='mov-ele'  href='play.php?list=".$list_path."&title=".$path_parts['filename']."&media=".$media_path."&img_path=".urlencode($image_path)."' class='mov-item'><div class='mov-img-lt'><img src='".$image_path."'></div><div class='mov-cont-rt'><div><span>".$f_title."</span><br>N/A<br>N/A</div></div></a></li>"; 								
								} 
								else{
									echo "<li><a class='mov-ele'  href='play.php?list=".$list_path."&title=".$path_parts['filename']."&media=".$media_path."&img_path=".urlencode($image_path)."' class='mov-item'><div class='mov-img-lt img_e'><img src='".$image_path."'></div><div class='mov-cont-rt'><div><span>".$f_title."</span><br>N/A<br>N/A</div></div></a></li>"; 								
								}
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
				 	echo '<li class="box">
			                <a href="'.$val.'" class="swipebox" title="'.$ImgDetArr['filename'].'">
			                    <img src="'.$val.'" alt="'.$ImgDetArr['filename'].'">
			                </a>
			            </li>';		
				    }
				}
    		}
    	}
	}
}
}

}

function medfolder($medarr,$id){
	//unset($_SESSION['medfolder']);
	$medfolder = array();
	$fold_arr = $medarr['items'];	
	//echo "<pre>"; print_r($fold_arr); echo "</pre>";
	$i=0;
	foreach ($fold_arr as $innerarr){
		// echo "<pre>"; print_r($innerarr); echo "</pre>";
		// $innerarr['type'];
		if($innerarr['type'] == "folder"){
			//print_r($innerarr);
			echo "<li><a class='mov-ele wt-m folder' href='gal_list.php?gal=".$innerarr['name']."&id=$i&level=level'><img src='images/folder.png' alt='folder' width='150px' /><br><span>".$innerarr['name']."</span></a></li>";
			array_push($medfolder,$innerarr);
		}
		else{
			//medfile($innerarr,$i);
			medfilelist($innerarr,$i);
		}
		$i++;
	}

	//unset($_SESSION['medfolder']);
	if(!empty($medfolder)){
		$_SESSION['medfolder'] = $medfolder;
	} else {
		// $newarr = $_SESSION['medfolder'];
		// $_SESSION['medfolder'] = array(array('items'=>$newarr));
	}
}


/////////////////////
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

?>