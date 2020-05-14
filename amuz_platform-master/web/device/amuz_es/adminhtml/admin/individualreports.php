<?php
include("header.php");
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
<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
						<div class="panel panel-<?=$cssclass;?>">
							<div class="panel-heading">Report Summary for <?=ucfirst($_GET["val"]);?>s</div>
							<div class="panel-body">
								<?php
								$myfile = fopen("db/report.db", "r") or die("Unable to open file!");
								$nearr = array();
								while(! feof($myfile))
								{
									$gfile = fgets($myfile);
									$exfile = explode('||',$gfile);
									$nearr[] = $exfile;
								}	
								
								//print_r($nearr);
								
								?>
							<table id="example" class='table table-bordered display'>
								<thead>
									<tr>
										<th>Media Type</th>
										<th>Media Name</th>
										<th>Visit Count</th>
									</tr>
								</thead>
								<tbody>
									<?php
									
									if($_GET["val"] == "ad")
									{
										$videoarr = array();
										foreach($nearr as $chkarr)
										{
											if(@$chkarr[6] != "NULL" && @$chkarr[0] != "")
												$videoarr[] = $chkarr;
										}
										//print_r($adarr);
										$newArr = array();
										foreach ($videoarr as $val) {
											$newArr[$val[6]] = $val;    
										}
									}
									else
									{
									
										$videoarr = array();
										foreach($nearr as $chkarr)
										{
											if(in_array($_GET["val"],$chkarr))
												$videoarr[] = $chkarr;
										}
										
										//print_r($videoarr);
										$newArr = array();
										foreach ($videoarr as $val) {
											$newArr[$val[3]] = $val;    
										}
									}	
										
										
									$uniqvideoarr = $newArr;
									//print_r($uniqvideoarr);
									$keyarray = array_keys($uniqvideoarr);

									$tnum = array();
									
									$tcount = 0;
									foreach($keyarray as $val)
									{	
										$numb = 0;
										$mobnum = array();
										foreach($videoarr as $nar)
										{
											//print_r($nar);
											if(in_array($val,$nar))
											{
												$numb++;
												$mobnum[] = $nar[8];
											}
										}
										$tnum[] = $numb;
										//print_r($mobnum);
									?>
									<tr>
										<td><?=ucfirst($_GET["val"]);?></td>
										<td><?=$val;?></td>
										<td><?=$numb;?></td>
									</tr>
									<?php
									$tcount++;
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
					<div class="col-lg-12">
						<button class="btn btn-sm btn-<?=$buttonclass;?>" type="button" onClick="window.history.back();">Back</button>
                    </div>
                </div>
                <!-- /.row -->
				
			</div>
<?php include('footer.php');?>


