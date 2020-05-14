<?php
//session_start();
if(isset($_POST["phn"]) && $_POST["phn"] != "")
{
	$_SESSION["sessionmobile"] = $_POST["phn"];
	setcookie("sessionmobile", $_POST["phn"], time()+(86400*200));
}
$mediafile = str_replace('+','',$_POST["title"]);
$timeend = time()+ (86400*2);
$nmediafile = str_replace(" ","",$mediafile);

setcookie("sesiontimeend_".$nmediafile, $timeend, $timeend);
setcookie("sesiontimeend_", $timeend, $timeend);
setcookie("videotitle_".$nmediafile, $mediafile, $timeend);
?>