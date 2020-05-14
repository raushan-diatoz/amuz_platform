<?php
include("header.php");
?>
<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Device Dashboard
                        </h1>
						
							<?php
							$myfile = fopen("db/report.db", "r") or die("Unable to open file!");
							$nearr = array();
							while(! feof($myfile))
							{
								$gfile = fgets($myfile);
								$exfile = explode('||',$gfile);
								$nearr[] = $exfile;
							}	
							///////////////////////////////////////video
							
							$videoarr = array();
							foreach($nearr as $chkarr)
							{
								if(in_array('video',$chkarr))
									$videoarr[] = $chkarr;
							}
							
							$newArr = array();
							foreach ($videoarr as $val) {
								$newArr[$val[3]] = $val;    
							}
							$uniqvideoarr = $newArr;
							
							
							///////////////////////////////////////audio
							$audioarr = array();
							foreach($nearr as $chkarr)
							{
								if(in_array('audio',$chkarr))
									$audioarr[] = $chkarr;
							}
							
							$newArr1 = array();
							foreach ($audioarr as $val) {
								$newArr1[$val[3]] = $val;    
							}
							$uniqaudioarr = $newArr1;
							
							
							///////////////////////////////////////image
							$imagearr = array();
							foreach($nearr as $chkarr)
							{
								if(in_array('image',$chkarr))
									$imagearr[] = $chkarr;
							}
							
							$newArr2 = array();
							foreach ($imagearr as $val) {
								$newArr2[$val[3]] = $val;    
							}
							$uniqimagearr = $newArr2;
							
							
							///////////////////////////////////////ad
							$adarr = array();
							foreach($nearr as $chkarr)
							{
								if(@$chkarr[6] != "NULL" && @$chkarr[0] != "")
									$adarr[] = $chkarr;
							}
							
							$newArr3 = array();
							foreach ($adarr as $val) {
								$newArr3[$val[6]] = $val;    
							}
							$uniqadarr = $newArr3;
							
							?>
						
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
                                        <div class="huge"><?=count($videoarr);?></div>
                                        <div>Movies Watched</div>
                                    </div>
                                </div>
                            </div>
                            <a href="individualreports.php?val=video">
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
                                        <div class="huge"><?=count($audioarr);?></div>
                                        <div>Audios Listened</div>
                                    </div>
                                </div>
                            </div>
                            <a href="individualreports.php?val=audio">
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
                                        <div class="huge"><?=count($imagearr);?></div>
                                        <div>Images Seen</div>
                                    </div>
                                </div>
                            </div>
                            <a href="individualreports.php?val=image">
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
                                        <div class="huge"><?=count($adarr);?></div>
                                        <div>Ads Watched</div>
                                    </div>
                                </div>
                            </div>
                            <a href="individualreports.php?val=ad">
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
                                        <div class="huge"><?=count($uniqvideoarr)?></div>
                                        <div>Unique Movies Watched</div>
                                    </div>
                                </div>
                            </div>
                            <a href="individualreports.php?val=video">
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
                                        <div class="huge"><?=count($uniqaudioarr)?></div>
                                        <div>Unique Audios Listened</div>
                                    </div>
                                </div>
                            </div>
                            <a href="individualreports.php?val=audio">
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
                                        <div class="huge"><?=count($uniqimagearr)?></div>
                                        <div>Unique Images Seen</div>
                                    </div>
                                </div>
                            </div>
                            <a href="individualreports.php?val=image">
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
                                        <div class="huge"><?=count($uniqadarr)?></div>
                                        <div>Unique Ads Watched</div>
                                    </div>
                                </div>
                            </div>
                            <a href="individualreports.php?val=ad">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
			</div>
<?php include('footer.php');?>


