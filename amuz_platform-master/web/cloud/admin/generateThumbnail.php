<?php

$name = $_POST["name"];
$path = $_POST["path"];
$str = 'ffmpeg  -itsoffset -4 -i '.$path.$name.'.mp4 -y -vcodec mjpeg -vframes 1 -an -f rawvideo -s  320x240 '.$path.$name.'.jpg';
shell_exec($str);
echo "Thumbnail Generated";
?>