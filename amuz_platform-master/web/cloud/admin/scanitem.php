<?php

//$dir = "Entertainment";

// Run the recursive function 

//echo $_SESSION['adminmedia'] = scan('files/');

// This function scans the files folder recursively, and builds a large array
$dir ="";

function scanitem($dir){

	$files = array();

	// Is there actually such a folder/file?

	if(file_exists($dir)){
	
		foreach(scandir($dir) as $f) {
		
			if(!$f || $f[0] == '.') {
				continue; // Ignore hidden files
			}
			
			$ckdot = explode('.',$f);
			//print_r($ckdot);
			if(@$ckdot[1] != '')
			{
			if(is_dir($dir . '/' . $f)) {
				
				// The path is a folder
				$invfile = new SplFileInfo($dir . '/' . $f);
				$files[] = array(
					"name" => $f,
					"type" => "folder",
					"path" => $dir . '/' . $f,
					"datemodified" => $invfile->getMTime(),
					"size" => $invfile->getSize()
					//"items" => scan($dir . '/' . $f) // Recursively get the contents of the folder
				);
			}
			
			else {
					$invfile = new SplFileInfo($dir . '/' . $f);
				
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