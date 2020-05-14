<?php
$foldername = $_POST["foldername"];
$path = $_POST["path"];
mkdir($path.'/'.$foldername, 0777, true);
echo "Directory Created";
?>