<?php
$ini_array = parse_ini_file("ini.properties");
define("ROOTPATH", $ini_array['mediapath']);
define("logopath", $ini_array['logopath']);
define("basepath", $ini_array['basepath']);
define("cheatcode", $ini_array['cheatcode']);
define("adpath", $ini_array['adpath']);
define("scanpath", $ini_array['scanpath']);
define("deviceserialkey", $ini_array['deviceserialkey']);
define("webserviceurl", $ini_array['webserviceurl']);
define("INVALIDOTP", $ini_array['invalidotpl']);

?>