<?php
$ini_array = parse_ini_file("ini.properties");
if (!defined('ROOTPATH')) define('ROOTPATH', $ini_array['mediapath']);
//define("ROOTPATH", $ini_array['mediapath']);
define("logopath", $ini_array['logopath']);
define("basepath", $ini_array['basepath']);
if (!defined('adpath')) define('adpath', $ini_array['adpath']);
define("cheatcode", $ini_array['cheatcode']);
//define("adpath", $ini_array['adpath']);
if (!defined('scanpath')) define('scanpath', $ini_array['scanpath']);
//define("scanpath", $ini_array['scanpath']);
define("deviceserialkey", $ini_array['deviceserialkey']);
define("webserviceurl", $ini_array['webserviceurl']);
if(! isset($ini_array['invalidotpl'])){
    $ini_array['invalidotpl']  =null;
}
define("INVALIDOTP", $ini_array['invalidotpl']);

?>