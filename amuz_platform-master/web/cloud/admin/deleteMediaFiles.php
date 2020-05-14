<?php

$dir = $_POST['path'];
$file = $_POST['file'];
if (strpos($file ,'.png') !== false || strpos($file ,'.PNG') !== false ||strpos($file ,'.jpg') !== false || strpos($file ,'.JPG') !== false || strpos($file ,'.jpeg') !== false || strpos($file ,'.mp3') !== false || strpos($file ,'.mp4') !== false) {
    exec("rm ".$dir."/".$file);
	echo "file deleted ".$dir."/".$file;
}
else{

exec("rm ".$dir."/".$file.".*");
echo "deleted ".$dir."/".$file;
}

?>