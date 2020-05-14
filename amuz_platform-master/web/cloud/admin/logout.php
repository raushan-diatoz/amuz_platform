<?php




require_once 'KLogger.php';
$log = new KLogger ( "log.txt" , KLogger::DEBUG );
include("includes/clientIPAddress.php");
$ipaddress = get_client_ip();
$log->LogDebug("user ".$_SESSION["username"]." logged out with ip ".$ipaddress);

session_start();
session_unset();
session_destroy();
header('location:index.php');
?>