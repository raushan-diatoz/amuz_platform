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

$image_extn = array("jpg","gif","png","JPEG");
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
     			$image_extn = array("jpg","gif","png","JPEG");
     			$media_path = $val;
     			$media_path = urlencode($media_path);       													
				$image_path = "images/def.png";	
				$img_exists = false;						
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
					echo "<a class='mov-ele' href='media_desc.php?list=".$list_path."&title=".$path_parts['filename']."&meta_path=".urlencode($filepath)."&media=".urlencode($media_path)."&img_path=".urlencode($image_path)."' class='mov-item'><div class='mov-img-lt'><img src='".$image_path."'></div><div class='mov-cont-rt'><div><span>".$meta_cont[2]."</span><br>".$meta_cont[0]." | ".$meta_cont[1]."<br><span class='stars'>".$meta_cont[5]."</span>(".$meta_cont[5]."/10)</div></div></a>"; 									
				} else {
				 	$f_title = (strlen($path_parts['filename']) > 25) ? substr($path_parts['filename'],0,25).'...' : $path_parts['filename'];
				 	if($path_parts['extension'] == "mp3"){ 
				 		if($img_exists){
						 	echo "<a class='mov-ele'  href='play.php?list=".$list_path."&title=".$path_parts['filename']."&media=".$media_path."&img_path=".urlencode($image_path)."' class='mov-item'><div class='mov-img-lt'><img src='".$image_path."'></div><div class='mov-cont-rt music-rt'><span>".$f_title."</span></div></a>"; 								
						 }
						 else{
							echo "<a class='mov-ele'  href='play.php?list=".$list_path."&title=".$path_parts['filename']."&media=".$media_path."&img_path=".urlencode($image_path)."' class='mov-item'><div class='mov-img-lt img_e'><img src='".$image_path."'></div><div class='mov-cont-rt music-rt'><span>".$f_title."</span></div></a>"; 														 	
						 }
					} else {
						if($img_exists){					 	
							echo "<a class='mov-ele'  href='play.php?list=".$list_path."&title=".$path_parts['filename']."&media=".$media_path."&img_path=".urlencode($image_path)."' class='mov-item'><div class='mov-img-lt'><img src='".$image_path."'></div><div class='mov-cont-rt'><span>".$f_title."</span></div></a>"; 								
						} 
						else{
							echo "<a class='mov-ele'  href='play.php?list=".$list_path."&title=".$path_parts['filename']."&media=".$media_path."&img_path=".urlencode($image_path)."' class='mov-item'><div class='mov-img-lt img_e'><img src='".$image_path."'></div><div class='mov-cont-rt'><span>".$f_title."</span></div></a>"; 								
						}
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
			echo "<a class='mov-ele wt-m folder' href='gal_list.php?gal=".$innerarr['name']."&id=$i&level=level'><img src='images/folder.png' alt='folder' width='150px' /><br><span>".$innerarr['name']."</span></a>";
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

?>