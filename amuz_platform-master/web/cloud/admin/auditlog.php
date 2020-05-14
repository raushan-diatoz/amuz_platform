<?php
include("header.php");

$myfile = fopen("log.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
$nearr = array();
while(!feof($myfile)) {
	$gfile = fgets($myfile);
	$exfile = explode(' - ',$gfile);
	$nearr[] = $exfile;
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
		<div class="row">
			<div class="col-lg-12">
				<table id="example" class='table table-bordered table-hover display'>
					<thead>
						<tr>
							<th>Log Time</th>
							<th>Log Type</th>
							<th>Log</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach($nearr as $narr)
						{   if(! isset($narr[1])){
							$narr[1]=null;
						}
							$exnarr = explode('-->',$narr[1]);
							if($exnarr[0] != "")
							{
						?>
							<tr>
								<td><?=$narr[0]?></td>
								<td><?=$exnarr[0]?></td>
								<td><?=$exnarr[1]?></td>
							</tr>
						<?php
							}
						}
						?>
					</tbody>
				<tbody>

			</div>
		</div>
	</div>
</div>
<?php
fclose($myfile);
?>
<?php include("footer.php");?>