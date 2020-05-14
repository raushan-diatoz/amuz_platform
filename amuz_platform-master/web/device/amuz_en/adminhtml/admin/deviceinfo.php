<?php
include("header.php");
include("scan.php");

?>
<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Device Information
                        </h1>
				    </div>
                </div>
                <!-- /.row -->
				<div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Hardware </h3>
                            </div>
                            <div class="panel-body">
								<table class="table table-bordered table-hover">
									<tbody>
										<tr>
											<td><b>CPU</b></td>
											<td><?=exec("cat /proc/cpuinfo | grep -i 'model name' | uniq");?></td>
										</tr>
										<tr>
											<td></td>
											<td><?=exec(' cat /proc/cpuinfo | grep -i mhz | uniq');?></td>
										</tr>
										<tr>
											<td></td>
											<td><?=exec('cat /proc/cpuinfo | grep -i vendor_id | uniq');?></td>
										</tr>
										<tr>
											<td></td>
											<td><?=exec("cat /proc/cpuinfo | grep -i 'cpu cores' | uniq");?></td>
										</tr>
										<tr>
											<td colspan="2">&nbsp;</td>
										</tr>
										<tr>
											<td><b>RAM</b></td>
											<td><?=exec("cat /proc/meminfo | grep -i MemTotal");?></td>
										</tr>
										<tr>
											<td></td>
											<td><?=exec("cat /proc/meminfo | grep -i MemFree");?></td>
										</tr>
										<tr>
											<td></td>
											<td><?=exec("cat /proc/meminfo | grep -i MemAvailable");?></td>
										</tr>
										<tr>
											<td colspan="2">&nbsp;</td>
										</tr>
										
										<tr>
											<td><b>OS</b></td>
											<td><?="linux version: ".exec("uname -a");?></td>
										</tr>
									</tbody>
								</table>
							</div>
                        </div>
                    </div>
                    <!-- /.col-sm-4 -->
                    <div class="col-sm-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Software</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered table-hover">
									<tbody>
										<tr>
											<td><b>Version (FE)</b></td>
											<td>amuze 1.0</td>
										</tr>
										<tr>
											<td><b>Version (Admin)</b></td>
											<td>amuze 1.0</td>
										</tr>
										<tr>
											<td><b>Date updated (FE)</b></td>
											<td><?=date('d M, Y h:i:s a',filemtime(PHPFILEPATH."/ini.properties"));?></td>
										</tr>
										<tr>
											<td><b>Date updated (Admin)</b></td>
											<td><?=date('d M, Y h:i:s a',filemtime(PHPFILEPATH."/ini.properties"));?></td>
										</tr>
										<tr>
											<td><b>Serial key</b></td>
											<td><?=DEVICESERIALKEY;?></td>
										</tr>
										
									</tbody>
								</table>
                            </div>
                        </div>
						
						<div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Networking</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered table-hover">
									<tbody>
									<?php
									$ifconfig = exec("ifconfig eth0 | grep -i 'inet addr:'");
									$xifconfig = explode(":",$ifconfig);
								    if ( ! isset($xifconfig[1])) {
										$xifconfig[1] = null;
									 }
									 if ( ! isset($xifconfig[0])) {
										$xifconfig[0] = null;
									 }
									 if ( ! isset($xifconfig[3])) {
										$xifconfig[3] = null;
									 }
									 
									$inetaddrar = explode(" ",$xifconfig[1]);
									?>
										<tr>
											<td><b>IP address</b></td>
											<td><?=$inetaddrar[0];?></td>
										</tr>
										<tr>
											<td><b>net mask</b></td>
											<td><?=$xifconfig[3]?></td>
										</tr>
										<tr>
											<td><b>Gate way</b></td>
											<td><?=str_replace("gateway ","",exec("cat /etc/network/interfaces | grep gateway"));?></td>
										</tr>
										
									</tbody>
								</table>
                            </div>
                        </div>
					</div>
                    
                    <!-- /.col-sm-4 -->
                </div>
<?php include('footer.php');?>