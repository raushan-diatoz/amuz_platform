<?php
$mobileNum = $_COOKIE["mobileNum"];
$vrify = $_COOKIE["mobileVerification"];
$arval["mnum"] = $mobileNum;

if($mobileNum == "")
{
	$arval["mval"] = 1;
	echo json_encode($arval);
}
else if($vrify == "")
{
	$arval["mval"] = 0;
	echo json_encode($arval);
}
else
{
	$arval["mval"] = 2;
	echo json_encode($arval);
}
?>