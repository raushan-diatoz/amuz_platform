<?php
ini_set('display_errors', 1);
include("includes/config.php");
include("checkconnection.php");

$phone = $_POST["phn1"]; 
if($phone != "")
{
	if($connection == "Connected")
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://amuze.co.in:8283/api/ws.php?action=rg&phonenum=".base64_encode($phone));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "");
		$response = curl_exec($ch);
		curl_close($ch);
		$re = json_decode($response);
		
		if($re->response == "existed in database verified" || $re->response == "validated")
		{
			setcookie("mobileVerification", rand(00000000,99999999), time()+(86400*200));
			setcookie("mobileNum", $phone, time()+(86400*200));
		}
		else
		{
			setcookie("mobileNum", $phone, time()+(86400*200));
		}
			setcookie("mobileNumver", "yes", time()+(86400*200));
	}
	else
	{
		$file = @fopen(ADMINPATH."db/phonecron.db","a+");

        $t = read_last_line(ADMINPATH.'db/phonecron.db');
        if($t != '')
        {
            $ex = explode('||',$t);
            //print_r($ex);
            $start = $ex[0]+1;
        }
        else
        {
            $start = 1;
        }
		setcookie("mobileNum", $phone, time()+(86400*200));
		$str = $start.'||'."http://amuze.co.in:8283/api/ws.php?action=rg&phonenum=".$phone.'||'.DSK.'||'.time()."\n";
		fwrite($file, $str); 
        fclose($file);
	}
	$pass = "yes";
}
else
{
    $pass = "no";
}
$connection = "";
echo $pass;
///////////////////////////////
function read_last_line ($file_path)
    {
        $line = '';
        $f = fopen($file_path, 'r');
        $cursor = -1;
        fseek($f, $cursor, SEEK_END);
        $char = fgetc($f);
        /**
        * Trim trailing newline chars of the file
        */
        while ($char === "\n" || $char === "\r") 
        {
            fseek($f, $cursor--, SEEK_END);
            $char = fgetc($f);
        }
        /**
        * Read until the start of file or first newline char
        */
        while ($char !== false && $char !== "\n" && $char !== "\r") 
        {
            /**
             * Prepend the new char
             */
            $line = $char . $line;
            fseek($f, $cursor--, SEEK_END);
            $char = fgetc($f);
        }

        return $line;
    }

?>