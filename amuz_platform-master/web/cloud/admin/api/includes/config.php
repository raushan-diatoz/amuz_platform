<?php
$ini_array = parse_ini_file("../ini.properties");
define("ROOTPATH", $ini_array['mediapath']);
define("cheatcode", $ini_array['cheatcode']);
define("adpath", $ini_array['adpath']);
define("scanpath", $ini_array['scanpath']);
define("deviceserialkey", $ini_array['deviceserialkey']);
?>