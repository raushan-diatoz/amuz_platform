<?php
include('config.php');
include('includes/utils.php');
$totalnumber = $_POST['totalnumber'];
$cpntype = $_POST['cpntype'];
$expiration = time() + $_POST['expiration']*86400;

$file = @fopen(ADMINPATH."db/cpn.db","a+");

$t = read_last_line(ADMINPATH.'db/cpn.db');
if($t > 0)
{
	$ex = explode('||',$t);
	$start = $ex[0]+1;
}
else
{
	$start = 1;
}

$str = "";
for($i=$start; $i < $start+$totalnumber; $i++){
	$str.= $i.'||'.time().'||'.generateRandomString(couponcodelength).'||'.$expiration.'||'.$totalnumber.'||'.$cpntype.'||202'."\n";
}


fwrite($file, $str); 
fclose($file); 
function generateRandomString($length) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
	//$output = str_split($randomString, 4);
	//$randomString = implode('-',$output);
    return $randomString;
}

//echo "Generated Successfully";
header("location:coupon_management.php")
?>