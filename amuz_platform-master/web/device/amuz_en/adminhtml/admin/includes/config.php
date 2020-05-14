<?php
$ini_array = parse_ini_file("ini.properties");
#define("ROOTPATH", $ini_array['mediapath']);
if (!defined('ROOTPATH')) define('ROOTPATH', $ini_array['mediapath']);
define("logopath", $ini_array['logopath']);
define("basepath", $ini_array['basepath']);
define("cheatcode", $ini_array['cheatcode']);
if (!defined('adpath')) define('adpath', $ini_array['adpath']);
#define("adpath", $ini_array['adpath']);
if (!defined('scanpath')) define('scanpath', $ini_array['scanpath']);
#define("scanpath", $ini_array['scanpath']);
define("deviceserialkey", $ini_array['deviceserialkey']);
define("webserviceurl", $ini_array['webserviceurl']);
#define("INVALIDOTP", $ini_array['invalidotpl']);

define("INVALIDOTP", $ini_array['invalidotp']);

?>