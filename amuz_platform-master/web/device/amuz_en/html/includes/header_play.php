<!DOCTYPE html>
<html>
<head>
  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8"> 
  <title> OurTV </title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<script language="javascript" type="text/javascript" src="js/libs/jquery-1.7.2.min.js"></script>
<script language="javascript" type="text/javascript" src="js/libs/modernizr.js"></script> 
<script language="javascript" type="text/javascript" src="js/libs/jquery.cookie.js"></script>
<script src="css/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<!-- video vast plugin -->
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/vastvideoplugin.js"></script>
<!-- video vast plugin ends here -->

<!-- audio player plugin includes -->
<script type="text/javascript" src="js/audio/jquery-ui-1.8.min.js"></script>
<script type="text/javascript" src="js/audio/audio_main.js"></script>
<link rel="stylesheet" href="css/audio/audio_style.css">
<!-- audio player plugin includes ends here -->

<link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
?>
<div class="header-cont">
<?php 
$home = "/OurTV/index.php";
if ($_SERVER['REQUEST_URI'] == $home) {
  echo "<a href='index.php'><img src='images/ourtv_logo.png' width='55px' /></a>";
} 
else{
  echo "<div onclick='goBack()' class='h-lft' href='setting.php'>Back</div>";
  echo "<a href='index.php'><img src='images/ourtv_logo.png' width='55px' style='vertical-align:middle;'/></a>";  
  echo "<a class='' style='float:right; padding-right: 8px;' href='index.php'><img src='images/home.png' width='20px' height='25px'/></a>";
  //echo "<a class='lang-f-btn' style='float:right;margin-right: 5px; cursor:pointer;' ><img src='images/filter.png' width='20px' height='25px'/></a>";
}
?>
</div> 
<?php include("includes/config.php"); ?>
<?php include("includes/prescan.php"); ?>
<script>
function goBack() {
    window.history.back()
}
</script>

