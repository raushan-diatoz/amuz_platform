<?php
// reading property file in the path "/usr/share/nginx/adminhtml/admin/ini.properties" 
$ini_array = parse_ini_file("ini.properties");
#define("ROOTPATH", $ini_array['mediapath']);
if (!defined('ROOTPATH')) define('ROOTPATH',$ini_array['mediapath']);
#define("DSK", $ini_array['deviceserialkey']);
if (!defined('DSK')) define('DSK',$ini_array['deviceserialkey']);

#define("scanpath", $ini_array['scanpath']);
if (!defined('scanpath')) define('scanpath',$ini_array['scanpath']);

#define("ADPATH", $ini_array['adpath']);
if (!defined('ADPATH')) define('ADPATH',$ini_array['adpath']);

#define("ADMINPATH", $ini_array['adminpath']);
if (!defined('ADMINPATH')) define('ADMINPATH',$ini_array['adminpath']);

#define("cheatcode", $ini_array['cheatcode']);
if (!defined('cheatcode')) define('cheatcode',$ini_array['cheatcode']);

#define("webserviceurl", $ini_array['webserviceurl']);
if (!defined('webserviceurl')) define('webserviceurl',$ini_array['webserviceurl']);

#define("INVALIDOTP", $ini_array['invalidotp']);
if (!defined('INVALIDOTP')) define('INVALIDOTP',$ini_array['invalidotp']);

#define("smsflag", $ini_array['smsflag']);
if (!defined('smsflag')) define('smsflag',$ini_array['smsflag']);

#define("couponcodelength", $ini_array['couponcodelength']);
if (!defined('couponcodelength')) define('couponcodelength',$ini_array['couponcodelength']);

#define("otplength", $ini_array['otplength']);
if (!defined('otplength')) define('otplength',$ini_array['otplength']);

#define("invalidotptimeout", $ini_array['invalidotptimeout']);
if (!defined('invalidotptimeout')) define('invalidotptimeout',$ini_array['invalidotptimeout']);

#define("paymentoption", $ini_array['paymentoption']);
if (!defined('paymentoption')) define('paymentoption',$ini_array['paymentoption']);

#define("registrationflow", $ini_array['registrationflow']);
if (!defined('registrationflow')) define('registrationflow',$ini_array['registrationflow']);

#define("couponflow", $ini_array['couponflow']);
if (!defined('couponflow')) define('couponflow',$ini_array['couponflow']);

#define("senderidcloud", $ini_array['senderidcloud']);
if (!defined('senderidcloud')) define('senderidcloud',$ini_array['senderidcloud']);

#define("senderid", $ini_array['senderidcloud']);
if (!defined('senderid')) define('senderid',$ini_array['senderidcloud']);

#define("alternatepathconfig", $ini_array['alternatepathconfig']);
if (!defined('alternatepathconfig')) define('alternatepathconfig',$ini_array['alternatepathconfig']);

#define("alternatepath", $ini_array['alternatepath']);
if (!defined('alternatepath')) define('alternatepath',$ini_array['alternatepath']);





?>