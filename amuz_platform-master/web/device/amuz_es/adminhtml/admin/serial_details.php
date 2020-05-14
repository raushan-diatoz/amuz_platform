<?php include('header.php');?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    
					
					<div class="col-lg-12">
						<table class="table table-bordered table-hover">
						<thead>
						<tr>
							<th>Created Date</th>
							<th>Created for Date</th>
							<th>Serial Key</th>	
						</tr>
						</thead>
						<?php
							$myfile = fopen("db/serial.db", "r") or die("Unable to open file!");
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
										<?=@date('d M, Y',$narr[4])?>
										</td>
										<td><?=@date('d M, Y',$narr[3])?></td>
										<td><?=$narr[0].'||'.$narr[1].'||'.$narr[2].'||'.$narr[3].'||'.$narr[5];?></td>	
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
						<button class="btn btn-sm btn-default" type="button" onClick="window.location = 'serialkey.php'">Back</button>
                    </div>
					
				
	

<?php include('footer.php');?>