<?php include('header.php');?>
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
						<table id="example" class="table table-bordered table-hover display">
						<thead>
						<tr>
							<th>Date</th>
							<th>Validity</th>
							<th>Number of Coupons</th>
							<th>Status</th>	
						</tr>
						</thead>
						<?php
							$myfile = fopen("db/cpn.db", "r") or die("Unable to open file!");
							$nearr = array();
							while(! feof($myfile))
							{
								$gfile = fgets($myfile);
								$exfile = explode('||',$gfile);
								$nearr[] = $exfile;
							}	
							
							//print_r($nearr);
							$getlistarr = array();
							foreach($nearr as $chkarr)
							{
								if(in_array($_GET['cid'],$chkarr))
									$getlistarr[] = $chkarr;
							}
							//print_r($getlistarr);
							
								
							
							?>
						<tbody>
							<?php
							foreach($getlistarr as $narr)
								{
									if(is_array($narr) && @$narr[1] != '')
									{
									?>
									<tr>
										<td>
										<?=@date('d M, Y',$narr[1])?>
										</td>
										<td><?=@date('d M, Y',$narr[3])?></td>
										<td><?=$narr[2]?></td>	
										<td><?php if($narr[6] == 202) { echo 'Active';} else {echo "Used";}?></td>	
									</tr>	
									<?php
									}
									else
									{
										
									}
								}
							?>
							
							<?php
							fclose($myfile);
							?>
						</tbody>
						</table>
                    </div>
					<div class="col-lg-12">
						<button class="btn btn-sm btn-default" type="button" onClick="window.location = 'coupon_management.php'">Back</button>
                    </div>
					
				
	

<?php include('footer.php');?>