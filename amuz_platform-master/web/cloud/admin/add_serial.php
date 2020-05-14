<?php
include('config.php');
include('includes/utils.php');

$file = @fopen(ADMINPATH."db/serial.db","a+") or die("not open");

$t = read_last_line(ADMINPATH.'db/serial.db');
if($t != '')
{
	$ex = explode('||',$t);
	//print_r($ex);
	$start = $ex[5]+1;
}
else
{
	$start = 1;
}

$count = count($_POST['geo']);
$k=$start;
$str='';
for($i=0;$i<$count;$i++)
{
	$reprow = $_POST['count'][$i];
	
	for($j=0;$j<$reprow;$j++)
	{
		$datwtime = $_POST['date'][$i];
		$exdate = explode('-',$datwtime);
		$makelxtime = mktime(0,0,0,$exdate[1],$exdate[0],$exdate[2]);
		$str .= $_POST['geo'][$i].'||'.$_POST['device_type'][$i].'||'.$_POST['batch'][$i].'||'.$makelxtime.'||'.time().'||'.$k."\n";
		$k++;
	}
}



fwrite($file, $str); 
fclose($file);

header("location:serialkey.php")
?>