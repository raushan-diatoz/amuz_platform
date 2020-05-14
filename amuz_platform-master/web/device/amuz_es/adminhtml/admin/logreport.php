<?php
include("header.php");
include("includes/getconnection.php");

if($_GET["val"] == "video")
{
	$cssclass="primary";
	$buttonclass="primary";
}
if($_GET["val"] == "audio")
{
	$cssclass="green";
	$buttonclass="success";
}
if($_GET["val"] == "image")
{
	$cssclass="yellow";
	$buttonclass="warning";
}
if($_GET["val"] == "ad")
{
	$cssclass="red";
	$buttonclass="danger";
}

?>
<link rel="stylesheet" type="text/css" href="pagination/css/jquery.dataTables.css">
	
	<style type="text/css" class="init">

	</style>
	<script type="text/javascript" language="javascript" src="pagination/js/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="pagination/js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="pagination/css/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="pagination/css/demo.js"></script>
	<script type="text/javascript" language="javascript" class="init">


$(document).ready(function() {
	$('#example').DataTable();
} );

	</script>


<script src="ttooltip/jquery-2.1.1.min.js"></script>
<link href="ttooltip/jBox.css" rel="stylesheet">
<script src="ttooltip/jBox.min.js"></script>
<script>
$(document).ready(function() {
	
	// Tooltip above and centered, this is the default setting
	$('.DemoTooltipAbove').jBox('Tooltip');
	
	// Tooltip to the left
	$('.DemoTooltipLeft').jBox('Tooltip', {
		position: {
			x: 'left',
			y: 'center'
		},
		outside: 'x' // Horizontal Tooltips need to change their outside position
	});
	
	
	
});
</script>	
<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
						<div class="panel panel-<?=$cssclass;?>">
							<div class="panel-heading">Report Summary for <?=ucfirst($_GET["val"]);?>s</div>
							<div class="panel-body">
								
							<table id="examplea" class='table table-bordered display'>
								<thead>
									<tr>
										<th>Media Type</th>
										<th>Media Name</th>
										<th>Visit Count</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$dblink = getConnection();
									global $dblink;
									if($_GET["val"] == "video")
									{
										$sql = mysql_query("select custom_var_v4, count(*) as cnt from piwik_log_link_visit_action where custom_var_v5 like '%.mp4' group by custom_var_v4;");
										
										$tnum = array();
										while($res = mysql_fetch_assoc($sql))
										{
										?>
										<tr>
											<td><?=ucfirst($_GET["val"]);?></td>
											<td><?=$res["custom_var_v4"];?></td>
											<td>
											<?php
											$tbls = "
											<div class='panel panel-".$cssclass."'>
											<div class='panel-heading'>Report Summary</div>
											<table class='table table-bordered display'>
												<thead>
													<tr>
														<th>&nbsp;Mobile</th>
														<th>&nbsp;Coupon</th>
													</tr>
												</thead>
												<tbody>";
											$sql1 = mysql_query("select custom_var_v6,custom_var_v7 from piwik_log_link_visit_action where custom_var_v4 = '".$res["custom_var_v4"]."' and custom_var_v5 != ''");
											while($res1=mysql_fetch_assoc($sql1))
											{
												if($res1["custom_var_v6"] != "")
												{
													$coupn = $res1["custom_var_v6"];
												}
												else
												{
													$coupn = "N/A";
												}
												
												$tbls .="<tr>
														<td>&nbsp;".$res1["custom_var_v7"]."</td>
														<td>&nbsp;".$coupn."</td>
													</tr>";
											}
											$tbls .="</tbody></table></div>";
											?>
											
												<span class="DemoTooltipLeft" title="<?=$tbls;?>" style="cursor: pointer;">
													<a href="visitbyreport.php?val=<?=$res["custom_var_v4"]?>"><?=$res["cnt"];?></a>
												</span>
											</td>
										</tr>
										<?php
										$tnum[] = $res["cnt"];
										$tcount++;
										}
									}
									
									if($_GET["val"] == "audio")
									{
										$sql = mysql_query("select custom_var_v4, count(*) as cnt from piwik_log_link_visit_action where custom_var_v5 like '%.mp3' group by custom_var_v4 and custom_var_v5 != '';");
										
										$tnum = array();
										while($res = mysql_fetch_assoc($sql))
										{
										?>
										<tr>
											<td><?=ucfirst($_GET["val"]);?></td>
											<td><?=$res["custom_var_v4"];?></td>
											<td><?=$res["cnt"];?></td>
										</tr>
										<?php
										$tnum[] = $res["cnt"];
										$tcount++;
										}
									}
									if($_GET["val"] == "ad")
									{
										$sql = mysql_query("select custom_var_v2, count(*) as cnt from piwik_log_link_visit_action where custom_var_v4 not like '%.jpg' and custom_var_v5 not like '%.mp3' and custom_var_v2 != '' group by custom_var_v2;");
										
										$tnum = array();
										while($res = mysql_fetch_assoc($sql))
										{
										?>
										<tr>
											<td><?=ucfirst($_GET["val"]);?></td>
											<td><?=$res["custom_var_v2"];?></td>
											<td><?=$res["cnt"];?></td>
										</tr>
										<?php
										$tnum[] = $res["cnt"];
										$tcount++;
										}
									}
									if($_GET["val"] == "image")
									{
										$sql = mysql_query("select custom_var_v5, count(*) as cnt from piwik_log_link_visit_action where custom_var_v5 not like '%.mp4' and custom_var_v5 not like '%.mp3' group by custom_var_v5 and custom_var_v5 != '';");
										
										$tnum = array();
										while($res = mysql_fetch_assoc($sql))
										{
										?>
										<tr>
											<td><?=ucfirst($_GET["val"]);?></td>
											<td><?=$res["custom_var_v5"];?></td>
											<td><?=$res["cnt"];?></td>
										</tr>
										<?php
										$tnum[] = $res["cnt"];
										$tcount++;
										}
									}
									?>
								</tbody>
								<tfoot>
									<tr>
										<td><b>Total</b></td>
										<td><b><?=$tcount;?></b></td>
										<td><b><?=array_sum($tnum);?></b></td>
									</tr>
								</tfoot>
							</table>
							</div>
						</div>
                    </div>
					
					<?php
					$sval = 1;
					$sql = mysql_query("select custom_var_v1, count(*) as cnt from piwik_log_link_visit_action group by custom_var_v1;");
					while($res = mysql_fetch_assoc($sql))
					{
						$srlkey = $res["custom_var_v1"];
						$output ="
								<div class='panel panel-".$cssclass."'>
								<div class='panel-heading'>Device Details</div>
								<table class='table table-bordered display'>
									
									<tbody>";
											
						$myfile = fopen("db/serial.db", "r") or die("Unable to open file!");
						// Output one line until end-of-file
						while(!feof($myfile)) {
						$array =  explode("||", fgets($myfile));
							if(substr($srlkey, 0, 3) == $array[0] && substr($srlkey, 3, 3) == $array[1] && substr($srlkey, 6, 2) == $array[2] && substr($srlkey, 8, 10) == $array[3] && substr($srlkey, 18, 3) == trim($array[5])){
							 $route = $array[9]. " to ".$array[10]; 
	
							$output .= '								
											<tr>
												<td><b>Name</b></td>
												<td>'.$array[6].'</td>
												<td><b>Mobile</b></td>
												<td>'.$array[7].'</td>
											</tr>
											<tr>
												<td><b>Email</b></td>
												<td>'.$array[8].'</td>
												<td><b>From</b></td>
												<td>'.$array[9].'</td>
											</tr>
											<tr>
												<td><b>To</b></td>
												<td>'.$array[10].'</td>
												<td><b>Details</b></td>
												<td>'.$array[11].'</td>
											</tr>
											<tr>
												<td><b>Operator</b></td>
												<td>'.$array[12].'</td>
												<td></td>
												<td></td>
											</tr>
										';
							}
						}
						
								
								$output .="</tbody></table></div>";
						
						
					?>
					<div class="col-lg-12 go-top-class-<?=$sval;?>">
						<div class="panel panel-<?=$cssclass;?>">
							<div class="panel-heading">
									Report Summary for <?=ucfirst($_GET["val"]);?>s in Device: 
									<span class="DemoTooltipAbove" title="<?=$output;?>" style="cursor: pointer;"><b><?=$srlkey?></b></span>
								<div class="buttonImage_<?=$sval;?>" onClick="addAdmin_<?=$sval;?>(thisval.value)" style="float:right;">
									<img src="img/bullet_toggle_plus.png" style="cursor: pointer;" />
									<input type="hidden" name="thisval" id="thisval" value="1">
								</div>
								
							</div>
							<div class="panel-body contain_box_<?=$sval;?>" style="display:none">
								
							<table id="exampleas" class='table table-bordered display'>
								<thead>
									<tr>
										<th>Media Type</th>
										<th>Media Name</th>
										<th>Visit Count</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if($_GET["val"] == "video")
									{
										$sqld = mysql_query("select custom_var_v4, count(*) as cnt from piwik_log_link_visit_action where custom_var_v5 like '%.mp4' and custom_var_v1 = '".$srlkey."' group by custom_var_v4;");
										
										$tnumd = array();
										while($res = mysql_fetch_assoc($sqld))
										{
										?>
										<tr>
											<td><?=ucfirst($_GET["val"]);?></td>
											<td><?=$res["custom_var_v4"];?></td>
											<td><a href="visitbyreport.php?val=<?=$res["custom_var_v4"]?>&dsk=<?=$srlkey?>"><?=$res["cnt"];?></a>
</td>
										</tr>
										<?php
										$tnumd[] = $res["cnt"];
										$tcountd++;
										}
									}
									
									if($_GET["val"] == "audio")
									{
										$sqld = mysql_query("select custom_var_v4, count(*) as cnt from piwik_log_link_visit_action where custom_var_v5 like '%.mp3' and custom_var_v1 = '".$srlkey."' group by custom_var_v4;");
										
										$tnumd = array();
										while($res = mysql_fetch_assoc($sqld))
										{
										?>
										<tr>
											<td><?=ucfirst($_GET["val"]);?></td>
											<td><?=$res["custom_var_v4"];?></td>
											<td><?=$res["cnt"];?></td>
										</tr>
										<?php
										$tnumd[] = $res["cnt"];
										$tcountd++;
										}
									}
									if($_GET["val"] == "ad")
									{
										$sqld = mysql_query("select custom_var_v2, count(*) as cnt from piwik_log_link_visit_action where custom_var_v4 not like '%.jpg' and custom_var_v5 not like '%.mp3' and custom_var_v2 != '' and custom_var_v1 = '".$srlkey."' group by custom_var_v2;");
										
										$tnumd = array();
										while($res = mysql_fetch_assoc($sqld))
										{
										?>
										<tr>
											<td><?=ucfirst($_GET["val"]);?></td>
											<td><?=$res["custom_var_v2"];?></td>
											<td><?=$res["cnt"];?></td>
										</tr>
										<?php
										$tnumd[] = $res["cnt"];
										$tcountd++;
										}
									}
									if($_GET["val"] == "image")
									{
										$sqld = mysql_query("select custom_var_v5, count(*) as cnt from piwik_log_link_visit_action where custom_var_v5 not like '%.mp4' and custom_var_v5 not like '%.mp3' and custom_var_v1 = '".$srlkey."' group by custom_var_v5;");
										
										$tnumd = array();
										while($res = mysql_fetch_assoc($sqld))
										{
										?>
										<tr>
											<td><?=ucfirst($_GET["val"]);?></td>
											<td><?=$res["custom_var_v5"];?></td>
											<td><?=$res["cnt"];?></td>
										</tr>
										<?php
										$tnumd[] = $res["cnt"];
										$tcountd++;
										}
									}
									?>
								</tbody>
								<tfoot>
									<tr>
										<td><b>Total</b></td>
										<td><b><?=$tcountd;?></b></td>
										<td><b><?=array_sum($tnumd);?></b></td>
									</tr>
								</tfoot>
							</table>
							</div>
						</div>
					</div>
<script>
function addAdmin_<?=$sval;?>(val)
	{
		var mImg = "img/bullet_toggle_minus.png";
		var pImg = "img/bullet_toggle_plus.png";
		//alert(val);
		if(val == "1")
		{
			//$('.contain_box_<?=$sval;?>').show(500);
			$('.contain_box_<?=$sval;?>').fadeToggle(500);
			$(".buttonImage_<?=$sval;?> img").attr("src", mImg);
			$("#thisval").val(2);
			$('.go-top-class-<?=$sval;?>').trigger('click');
		}
		if(val == "2")
		{
			//$('.contain_box_<?=$sval;?>').hide(500);
			$('.contain_box_<?=$sval;?>').fadeOut(500);
			$(".buttonImage_<?=$sval;?> img").attr("src", pImg);
			$("#thisval").val(1);
		}
		
	}
</script>
					<?php
					$tcountd = '';
					$tnumd = '';
					$sval++;
					}
					?>
				</div>
					
					<div class="col-lg-12">
						<button class="btn btn-sm btn-<?=$buttonclass;?>" type="button" onClick="window.history.back();">Back</button>
                    </div>
                </div>
                <!-- /.row -->
				
			</div>

<?php include('footer.php');?>
