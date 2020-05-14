
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
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<script language="javascript" type="text/javascript" src="js/libs/jquery-1.11.2.js"></script>
<script language="javascript" type="text/javascript" src="js/libs/modernizr.js"></script>
<script language="javascript" type="text/javascript" src="js/libs/jquery.cookie.js"></script>
<script src="css/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.min.css"></link>
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/style.css">

<!-- <script src="Elite-video-player/deploy/js/froogaloop.js" type="text/javascript"></script>
<script src="Elite-video-player/deploy/js/jquery.mCustomScrollbar.js" type="text/javascript"></script> 
<script src="Elite-video-player/deploy/js/THREEx.FullScreen.js"></script>
<script src="Elite-video-player/deploy/js/videoPlayer.js" type="text/javascript"></script>
<script src="Elite-video-player/deploy/js/Playlist.js" type="text/javascript"></script>
<script type="text/javascript" src="Elite-video-player/deploy/js/ZeroClipboard.js"></script>
<link rel="stylesheet" href="Elite-video-player/deploy/css/elite.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="Elite-video-player/deploy/css/font-awesome.css" type="text/css">
<link rel="stylesheet" href="Elite-video-player/deploy/css/jquery.mCustomScrollbar.css" type="text/css"> -->

 <script src="evp/deploy/js/froogaloop.js" type="text/javascript"></script>
<script src="evp/deploy/js/jquery.mCustomScrollbar.js" type="text/javascript"></script> 
<script src="evp/deploy/js/THREEx.FullScreen.js"></script>
<script src="evp/deploy/js/videoPlayer.js" type="text/javascript"></script>
<script src="evp/deploy/js/Playlist.js" type="text/javascript"></script>
<script type="text/javascript" src="evp/deploy/js/ZeroClipboard.js"></script>
<link rel="stylesheet" href="evp/deploy/css/elite.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="evp/deploy/css/font-awesome.css" type="text/css">
<link rel="stylesheet" href="evp/deploy/css/jquery.mCustomScrollbar.css" type="text/css">


</head>
<body>
<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
?>
<!-- <div class="header-cont"> -->
<?php 
$home = "/OurTV/index.php";
if ($_SERVER['REQUEST_URI'] == $home) {
  //echo "<a href='index.php'><img src='images/ourtv_logo.png' width='55px' /></a>";
} 
else{
  // echo "<div onclick='goBack()' class='h-lft' href='setting.php'>Back</div>";
  // echo "<a href='index.php'><img src='images/ourtv_logo.png' width='55px' /></a>";  
  // echo "<a class='' style='float:right;' href='index.php'><img src='images/home.png' width='20px' height='25px'/></a>";
  //echo "<a class='lang-f-btn' style='float:right;margin-right: 5px; cursor:pointer;' ><img src='images/filter.png' width='20px' height='25px'/></a>";
}
?>
<!-- </div>  -->
<?php include("includes/config.php"); ?>
<?php include("prescan.php"); ?>
<script>
function goBack() {
    window.history.back()
}
</script>

