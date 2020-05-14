<?php include('header.php');
include("includes/getconnection.php");
$activecoupons= 0;
$usedcoupons = 0;
$cpnfile="db/cpn.db";
$linecount = 0;
$handle = fopen($cpnfile, "r");
while(!feof($handle)){
  $line = fgets($handle);
  $linecount++;
  $split = explode("||", $line);
  #if($split[6] == "505")
  if(in_array("505", $split)){
  $usedcoupons++; 	
  }else{
  $activecoupons++;
  }
}

fclose($handle);


$mp4watched = 0;
$mp3watched = 0;
$adwatched =0;
$picswatched = 0;
$adswatched = 0;
$moviecount = 0;
$audiocount = 0;
$imagecount = 0;
$adcount = 0;
$populardevice = 0;
$devicevisitcount = 0;
$route = "";
            $dblink = getConnection();
          
            global $dblink;
            $s="select distinct(custom_var_v5), count(*) from piwik_log_link_visit_action group by custom_var_v5";
            $q=mysqli_query($dblink,$s) or die($s);
            while($rw=mysqli_fetch_array($q)){
         if (strpos($rw['custom_var_v5'],'.mp4') !== false) {
                    $mp4watched++;
                    $moviecount = $moviecount + $rw["count(*)"];
                }
        else if (strpos($rw['custom_var_v5'],'.mp3') !== false) {
                    $mp3watched++;
                    $audiocount = $audiocount + $rw["count(*)"];
                }
        else{
                    $picswatched++;
                    $imagecount = $imagecount + $rw["count(*)"];
                }
       
         }  
         $s="select distinct(custom_var_v3), count(*) from piwik_log_link_visit_action where custom_var_v3 is not null and custom_var_v3 <> '' group by custom_var_v3";
            $q=mysqli_query($dblink,$s) or die($s);
            while($rw=mysqli_fetch_array($q)){
            $adswatched ++;
            $adcount = $adcount + $rw["count(*)"];
         }  
         $s="select distinct(custom_var_v1), count(*) from piwik_log_link_visit_action where custom_var_v1 is not null   group by custom_var_v1 order by custom_var_v1 desc limit 0,1";
            $q=mysqli_query($dblink,$s) or die($s);
            while($rw=mysqli_fetch_array($q)){
            $populardevice = $rw["custom_var_v1"];
            $devicevisitcount = $rw["count(*)"];
         }  

$myfile = fopen("db/serial.db", "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($myfile)) {

$array =  explode("||", fgets($myfile));

    if(substr($populardevice, 0, 3) == $array[0] && substr($populardevice, 3, 3) == $array[1] && substr($populardevice, 6, 2) == $array[2] && substr($populardevice, 8, 10) == $array[3] && substr($populardevice, 18, 1) == trim($array[5])){
     $route = $array[9]. " to ".$array[10]; 		
    }
}

  
fclose($myfile);


$sql = mysqli_query($dblink,"select custom_var_v2, count(*) as cnt from piwik_log_link_visit_action where custom_var_v4 not like '%.jpg' and custom_var_v5 not like '%.mp3' and custom_var_v2 != '' group by custom_var_v2");
$tnum = array();
while($res = mysqli_fetch_assoc($sql))
{
	$tnum[] = $res["cnt"];
}

?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin Dashboard
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->
                 <h5>Total Views</h5>   
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-video-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $moviecount?></div>
                                        <div>Movies Watched</div>
                                    </div>
                                </div>
                            </div>
                            <a href="logreport.php?val=video">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-audio-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $audiocount?></div>
                                        <div>Audios Listened</div>
                                    </div>
                                </div>
                            </div>
                            <a href="logreport.php?val=audio">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-image-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $imagecount?></div>
                                        <div>Images Seen</div>
                                    </div>
                                </div>
                            </div>
                            <a href="logreport.php?val=image">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-video-camera fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo array_sum($tnum);?></div>
                                        <div>Ads Watched</div>
                                    </div>
                                </div>
                            </div>
                            <a href="logreport.php?val=ad">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <h5>Unique Views</h5>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-video-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $mp4watched?></div>
                                        <div>Unique Movies Watched</div>
                                    </div>
                                </div>
                            </div>
                            <a href="logreport.php?val=video">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-audio-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $mp3watched?></div>
                                        <div>Unique Audios Listened</div>
                                    </div>
                                </div>
                            </div>
                            <a href="logreport.php?val=audio">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-image-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $picswatched?></div>
                                        <div>Unique Images Seen</div>
                                    </div>
                                </div>
                            </div>
                            <a href="logreport.php?val=image">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-video-camera fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $adswatched?></div>
                                        <div>Unique Ads Watched</div>
                                    </div>
                                </div>
                            </div>
                            <a href="logreport.php?val=ad">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
               
                
                    <div class="col-lg-3 col-md-6">
			 <h5>Popular Route</h5>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-video-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $devicevisitcount?></div>
                                        <div><?php echo $route?></div>
                                    </div>
                                </div>
                            </div>
                            <a href="logreport.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
		    	
                
		
                
                    <div class="col-lg-3 col-md-6">
			<h5>Coupons</h5>
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-video-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $linecount?></div>
                                        <div>Active: <?php echo $activecoupons; ?> Used: <?php echo $usedcoupons;?></div>
                                    </div>
                                </div>
                            </div>
                            <a href="couponreport.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
		    	
                

            </div>



<?php include('footer.php');?>