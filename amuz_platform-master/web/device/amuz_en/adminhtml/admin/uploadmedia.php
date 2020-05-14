<?php
include("config.php");

if($_REQUEST["passing"] == 'test'){
      $target_dir = $_POST["path"].'/';

      $ext = explode(".",$_FILES["uploaded_file"]["name"]);
      $newfilename = $_POST['prefix'].'.'.end($ext);
      //echo $newfilename;
      $target_file = $target_dir . basename($_FILES["uploaded_file"]["name"]);
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], $target_dir.$newfilename);

      $ext = explode(".",$_FILES["thumbnail"]["name"]);
      $newfilename = $_POST['prefix'].'.'.end($ext);
      //echo $newfilename;
      $target_file = $target_dir . basename($_FILES["thumbnail"]["name"]);
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_dir.$newfilename);
      

      $str =  $_POST['language'].'||'.$_POST['genre'].'||'.$_POST['title'].'||'.$_POST['description'].'||'.$_POST['adpath'].'||'.$_POST['rating'].'||'.$_POST['premium'].'||'.$_POST['roletype'].'||'.$_POST['adskip'].'||1||'.$_POST['price'].'||'.$_POST['time'].'||'.$_POST['metadata1'].'||'.$_POST['metadata2'];
	  
	  $metafile = fopen($target_dir.$_POST['prefix'].'.txt',"w");
      fwrite($metafile,$str);
      fclose($metafile);
     // echo 'uploaded';
}
else if(isset($_POST["upload"]) && $_POST["passing"] == ""){
	$target_dir = $_POST["path"].'/';
	$newfilename = $_FILES["uploaded_file"]["name"];
	//echo $newfilename;
	$target_file = $target_dir . basename($_FILES["uploaded_file"]["name"]);
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], $target_dir.$newfilename);
	
}

$iter = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator(ROOTPATH, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST,
    RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
);

$paths = array(ROOTPATH);
foreach ($iter as $path => $dir) {
    if ($dir->isDir()) {
        $paths[] = $path;
    }
}

$getpath = $_POST['getdirpath'];
 if($_POST['path22'] == 'filedetails.php')
     $prelink = 'filedetails.php';
 else
    $prelink = 'category_management.php';

if($getpath != '')
{
    $link = $prelink.'?dir='.$getpath;
}
else
{
    $link = 'category_management.php';
}

header('location:'.$link);

?>