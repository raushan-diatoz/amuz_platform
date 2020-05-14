<?php
include('config.php');
$files = PIWIKADMINPATH;
echo '<script type="text/javascript">';
$handle = @fopen($files.$_GET["push"], "r");
if ($handle) {
	while (($buffer = fgets($handle, 4096)) !== false) {
        echo $buffer;
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}
echo '</script>';
$oldfilename = $files.$_GET['push'];
$newfilename = $files.'updated_'.$_GET['push'];

//exec("mv ".$oldfilename." ".$newfilename);
rename($oldfilename, $newfilename);
//exec($files.$_GET["push"], 'done_'.$files.$_GET["push"]);

/* $filename = $_GET['pass'];
$topath = 	"/var/www/html/downloads/";
$frompath  = "E:\xampp\htdocs\OurTVadmin\logs\piwik_data\ourtv_data_09072015.js";

include('includes/SSHconnection/Net/SFTP.php');
$sftp = new Net_SFTP('139.162.18.196');
if (!$sftp->login('root', '8m74AU3k')) {
    exit('Login Failed');
}

//echo $sftp->pwd()."\r\n";
$sftp->put($topath.$filename, $frompath.$filename);
//echo "uploaded"; */

//header("location:piwik_statistics.php");
header( "refresh:1;url=piwik_statistics.php" );

?>
<script>
setTimeout("window.location.href='push_to_piwik_dis.php';",1000);
</script>