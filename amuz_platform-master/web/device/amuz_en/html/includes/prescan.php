<?php

// This function scans the files folder recursively, and builds a large array input is directory to be scanned

function scan($dir){
	
	$files = array();
      
	// Is there actually such a folder/file?

	
	if(!file_exists($dir) && alternatepathconfig == 1){
	
 	$dir = alternatepath;
	}

	if(file_exists($dir)){
		foreach(scandir($dir) as $f) {
		
			if(!$f || $f[0] == '.') {
				continue; // Ignore hidden files
			}

			if(is_dir($dir . '/' . $f)) {

				// The path is a folder

				$files[] = array(
					"name" => $f,
					"type" => "folder",
					"path" => $dir . '/' . $f,
					//"items" => scan($dir . '/' . $f) // Recursively get the contents of the folder
				);
			}
			
			else {
				if($f == "meta.txt"){	
				$file = fopen($dir . '/' . $f,"r");
				$meta = fread($file,filesize($dir . '/' . $f));
				fclose($file);

				$files[] = array(
					"name" => $f,
					"type" => "Metafile",
					"path" => $dir . '/' . $f,
					"size" => filesize($dir . '/' . $f), // Gets the size of this file
					"content" => $meta
				);
				}else{
					$files[] = array(
					"name" => $f,
					"type" => "file",
					"path" => $dir . '/' . $f,
					"size" => filesize($dir . '/' . $f) // Gets the size of this file
				);	
				}
			}
		}
	
	}
	
	return $files;
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