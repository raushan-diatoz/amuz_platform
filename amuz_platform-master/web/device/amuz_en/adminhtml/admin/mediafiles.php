<?php


//shows all channels like movies, music
//basically should be a pendrive path
$dir = $_GET['dir'];
scan($dir);
$basepath="http://amuze.co.in:8283";
function scan($dir){

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
					"adpath" =>  'http://amuze.co.in:8283'.$meta[4],
					"rating" => $meta[5],
					"thumbnail" =>  'http://amuze.co.in:8283'.$dir.'/'.$path_parts['filename'].'.jpg',
					"is_premium" => $meta[6],
					"roll" => $meta[7],
					"published"=>$meta[9],
					"price" => $meta[10],
					"premiumtime" => $meta[11],
					"skip_flag" => $meta[8],
					 "link" => 'http://amuze.co.in:8283'.$dir . '/' . $f
					//"items" => scan($dir . '/' . $f) // Recursively get the contents of the folder
					);

					}		
				}
				
	
			
			}
			
			
		}
	
	}
	echo str_replace("\/","/",json_encode($files));
}



// Output the directory listing as JSON

// header('Content-type: application/json');

// echo json_encode(array(
// 	"name" => "Entertainment",
// 	"type" => "folder",
// 	"path" => $dir,
// 	"items" => $response
// ));
?>