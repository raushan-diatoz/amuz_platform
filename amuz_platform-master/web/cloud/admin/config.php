<?php
date_default_timezone_set('Asia/Kolkata');
$ini_array = parse_ini_file("ini.properties");

define("ROOTPATH", $ini_array['mediapath']);
define("scanpath", $ini_array['scanpath']);
define("ADMINPATH", $ini_array['adminpath']);
if(! isset($_SESSION)){
    $_SESSION['username'] =null;
}
define("ADMINUSER", $_SESSION['username']);
define("adpath", $ini_array['adpath']);
define("PIWIKPATH", $ini_array['piwikpath']);
define("PIWIKADMINPATH", $ini_array['piwikadmin']);
define("PHPFILEPATH", $ini_array['phpfilepath']);
define("BASEPATH", $ini_array['basepath']);
define("DEVICESERIALKEY", $ini_array['deviceserialkey']);
define("couponcodelength", $ini_array['couponcodelength']);
define("otplength", $ini_array['otplength']);
?>