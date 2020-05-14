<?php


include("includes/config.php");
scan(scanpath);
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

				// The path is a folder

				$files[] = array(
					//"name" => $f,
					//"type" => "folder",
					$f => 'http://amuze.co.in:8283/admin/mediafiles.php?dir='.$dir .'/' . $f,
					//"items" => scan($dir . '/' . $f) // Recursively get the contents of the folder
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



// Output the directory listing as JSON

// header('Content-type: application/json');

// echo json_encode(array(
// 	"name" => "Entertainment",
// 	"type" => "folder",
// 	"path" => $dir,
// 	"items" => $response
// ));
?>