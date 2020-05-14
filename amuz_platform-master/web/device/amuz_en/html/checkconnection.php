<?php
$domain = 'www.amuze.co.in:8283/piwik/index.php';
//$domain = 'www.yahoo.com';
if (ping_domain($domain))
{
	echo "Connected";
}
else
{
	echo "no";
}  


function ping_domain($domain)
{
    $file = @fsockopen ($domain, 80, $errno, $errstr, 10);
	
    return (!$file) ? FALSE : TRUE;
}
?>