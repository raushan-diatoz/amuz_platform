<?php
$filename = "ourtv_data_11072015.js";
$topath = 	"/usr/share/nginx/adminhtml/admin/logs/piwik_data/";
$frompath  = "/usr/share/nginx/html/OurTV/admin/logs/piwik_data/";

include('Net/SFTP.php');
$sftp = new Net_SFTP('139.162.18.196');
if (!$sftp->login('root', '8m74AU3k')) {
    exit('Login Failed');
}

//echo $sftp->pwd()."\r\n";
$sftp->put($topath.$filename, $frompath.$filename, FTP_ASCII);
echo "uploaded";
?>
