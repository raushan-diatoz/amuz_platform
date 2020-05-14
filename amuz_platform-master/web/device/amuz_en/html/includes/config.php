<?php
// reading property file in the path "/usr/share/nginx/adminhtml/admin/ini.properties" 
$ini_array = parse_ini_file("./ini.properties");
define("ROOTPATH", $ini_array['mediapath']);
define("DSK", $ini_array['deviceserialkey']);
define("scanpath", $ini_array['scanpath']);
define("ADPATH", $ini_array['adpath']);
define("ADMINPATH", $ini_array['adminpath']);
define("cheatcode", $ini_array['cheatcode']);
define("webserviceurl", $ini_array['webserviceurl']);
define("INVALIDOTP", $ini_array['invalidotp']);
define("smsflag", $ini_array['smsflag']);
define("couponcodelength", $ini_array['couponcodelength']);
define("otplength", $ini_array['otplength']);
define("invalidotptimeout", $ini_array['invalidotptimeout']);
define("paymentoption", $ini_array['paymentoption']);
define("registrationflow", $ini_array['registrationflow']);
define("couponflow", $ini_array['couponflow']);
define("senderidcloud", $ini_array['senderidcloud']);
define("senderid", $ini_array['senderidcloud']);
define("alternatepathconfig", $ini_array['alternatepathconfig']);
define("alternatepath", $ini_array['alternatepath']);




?>