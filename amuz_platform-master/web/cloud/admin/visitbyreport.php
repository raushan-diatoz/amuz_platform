<?php
include("header.php");
include("includes/getconnection.php");
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
						<div class="panel panel-primary">
							<div class="panel-heading">Report Summary for <?=ucfirst($_GET["val"]);?>s</div>
							<div class="panel-body">
								
							<table id="examplea" class='table table-bordered display'>
								<thead>
									<tr>
										<th>Media Name</th>
										<th>Mobile</th>
										<th>Coupon</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$dblink = getConnection();
									global $dblink;
										$sql = mysql_query("select custom_var_v4,custom_var_v6,custom_var_v7 from piwik_log_link_visit_action where custom_var_v4 = '".$_GET["val"]."'");
										$tnum = array();
										while($res = mysql_fetch_assoc($sql))
										{
											if($res["custom_var_v6"] != "")
											{
												$coupn = $res["custom_var_v6"];
											}
											else
											{
												$coupn = "N/A";
											}
										?>
										<tr>
											<td><?=$res["custom_var_v4"];?></td>
											<td><?=$res["custom_var_v7"];?></td>
											<td><?=$coupn;?></td>
										</tr>
										<?php
										}
									?>
								</tbody>
								
							</table>
							</div>
						</div>
                    </div>

				</div>
					
					<div class="col-lg-12">
						<button class="btn btn-sm btn-primary" type="button" onClick="window.history.back();">Back</button>
                    </div>
                </div>
                <!-- /.row -->
				
			</div>

<?php include('footer.php');?>
