<?php

$dir = $_POST['path'];
$folder = $_POST['folder'];
exec("rm -rf ".$dir.$folder);
echo "deleted";


?>