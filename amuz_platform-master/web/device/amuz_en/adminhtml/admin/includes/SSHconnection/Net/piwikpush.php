<?php
include("SSH2.php");
$connection = ssh2_connect('139.162.18.196', 22);
ssh2_auth_password($connection, 'root', '8m74AU3k');

ssh2_scp_send($connection, 'logs/piwik_data/'.$_GET['pass'], 'usr/share/nginx/html/piwik/logs/'.$_GET['pass'], 0644);

header("location:piwik_statistics.php");


$filename = $_GET['pass'];
$topath = 	"/var/www/html/downloads/";
$frompath  = "C:\Users\Public\Pictures\Sample Pictures\Desert.jpg";

include('Net/SFTP.php');
$sftp = new Net_SFTP('139.162.18.196');
if (!$sftp->login('root', '8m74AU3k')) {
    exit('Login Failed');
}

//echo $sftp->pwd()."\r\n";
$sftp->put($topath.$filename, $frompath.$filename);
echo "uploaded";

?>