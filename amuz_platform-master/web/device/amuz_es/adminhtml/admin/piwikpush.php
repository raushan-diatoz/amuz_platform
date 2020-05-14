<?php
$filename = $_GET['pass'];
$topath = 	"/var/www/html/downloads/";
$frompath  = "E:\xampp\htdocs\OurTVadmin\logs\piwik_data\ourtv_data_09072015.js";

include('includes/SSHconnection/Net/SFTP.php');
$sftp = new Net_SFTP('139.162.18.196');
if (!$sftp->login('root', '8m74AU3k')) {
    exit('Login Failed');
}

//echo $sftp->pwd()."\r\n";
$sftp->put($topath.$filename, $frompath.$filename);
//echo "uploaded";

header("location:piwik_statistics.php");

?>