<?php

function ping_domain($domain)
{
    $file = @fsockopen ($domain, 80, $errno, $errstr, 10);
	
    return (!$file) ? FALSE : TRUE;
}
?>
