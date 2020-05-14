<?php
include("header.php");

$myfile = fopen("db/feedback.db", "r") or die("Unable to open file!");
// Output one line until end-of-file
$nearr = array();
while(!feof($myfile)) {
	$gfile = fgets($myfile);
	$exfile = explode('||',$gfile);
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
							<th>Date</th>
							<th>Rating</th>
							<th>Email</th>
                                                        <th>Phone Number</th>
                                                        <th>Comments</th>
						</tr>
					</thead>
					<tbody>
						<?php
                     //$exnarr=array();
                     foreach($nearr as $narr)
						{   
							#$exnarr = explode('||',$narr[1]);
							//print_r($narr[1]);die;
							if ( ! isset($narr[1])) {
								$narr[1] = null;
							 }
							 
							$exnarr = $narr[1];
							if($exnarr != "")
							{
						?>
							<tr>
								<td><?=@date('d M, Y',$narr[1])?></td>
								<td><?=$narr[2]?></td>
								<td><?=$narr[3]?></td>
  								<td><?=$narr[4]?></td>
								<td><?=$narr[5]?></td>

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