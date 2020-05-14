<?php
$filedata = $_POST["select_all"];
$i = 0;
$topath = 	"/usr/share/nginx/adminhtml/admin/logs/piwik_data/";
$frompath  = "/usr/share/nginx/html/OurTV/logs/piwik_data/";
$deletefrompath  = "/usr/share/nginx/html/OurTV/logs/delete_piwik_data/";

include('Net/SFTP.php');
$sftp = new Net_SFTP('139.162.18.196');
if (!$sftp->login('root', '8m74AU3k')) {
	exit('Login Failed');
}
	foreach($filedata as $val)
	{
		$filename = $val;
		//echo $sftp->pwd()."\r\n";
		$sftp->put($topath.$filename, $frompath.$filename,FTP_ASCII);
		//$sftp->put($deletefrompath.$filename, $frompath.$filename,FTP_ASCII);
		exec("rm -rf ".$frompath.$filename);
		//rename($frompath.$filename, $frompath.'transferred_'.$filename);
		$i++;
	}

header("location:../../piwik_statistics.php");
///usr/share/nginx/html
?>

<?php

?>
