<?php
include("includes/config.php");

$phone = $_POST["phn1"]; 
if($phone != "")
{
    if (file_exists(ADMINPATH."db/phoneverify.db")) 
    {
        $myfile = @fopen(ADMINPATH."db/phoneverify.db", "r");
        $nearr = array();
        while(! feof($myfile))
        {
            $gfile = fgets($myfile);
            $exfile = explode('||',$gfile);
            $nearr[] = $exfile;
        }
        
        foreach($nearr as $nr)
        {
            if(in_array($phone,$nr))
            {
                //print_r($nr);
                if($nr[3] == 1)
                {
                    $pass = "verify";
                    setcookie("mobileVerification", rand(00000000,99999999), time()+ 3600*200);
					setcookie("mobileNum", $phone, time()+ 3600*200);
                }
                else
                {
                    setcookie("mobileNum", $phone, time()+ 3600*200);
                    $pass = "yes";
                }
                
            }
        }
    }
	echo $pass;
}