<?php include('header.php');?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
					<?php
					if($coupon_access != "yes")
					{
					?>
					<h4 class="page-header">
						<font color="#FF000">You do not have permission to access this page</font>
					</h4>
					<?php
					}
					else
					{
					?>
                        <h4 class="page-header">
						
                            Coupon Management >>
							</h4>
							<form name="myForm" id="myForm" method="post" action="add_coupon.php" onsubmit="return formSubmit(this);" enctype="multipart/form-data">
								<table cellpadding="5" cellspacing="5"  class="table table-bordered table-hover" >
									<tr>
										<td>Number of Coupon</td>
										<td><input type="text" name="totalnumber" id="totalnumber"  data-validations="required|numeric" /></td>
									</tr>
									<tr>
										<td>Expiration Within</td>
										<td><input type="text" name="expiration" id="expiration"  data-validations="required|numeric" /> days</td>
									</tr>
									<tr>
										<td>Coupon Type</td>
										<td>
											<input type="radio" name="cpntype" id="cpntype" value="1" data-validations="required" > Single Video
											<input type="radio" name="cpntype" id="cpntype" value="2"> Full Trip
										</td>
									</tr>
									<tr>
										<td colspan=""></td>
										<td><input type="submit" name="create" id="create" value="Create Coupon" /></td>
									</tr>
								</table>
							</form>
							
                    </div>
					
					<div class="col-lg-12">
						<div style="margin:auto;width:200px;height:50px;">
							<div id="LoadingImg" style="float:left;display:none;"><img border='0' src='img/loading2.gif'></div>
							<div id="submitNew" style="float:left;margin:5px 0px 0px 10px"></div>
						</div>
					</div>
					<div class="col-lg-12">
						<table class="table table-bordered table-hover">
						<thead>
						<tr>
							<th>Date</th>
							<th>Validity</th>
							<th>Number of Coupons</th>
							<th>Details</th>	
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
								$copy = $nearr; // create copy to delete dups from
								$usedEmails = array(); // used emails

								for( $i=0; $i<count($nearr); $i++ ) {

									if ( in_array( @$nearr[$i][1], $usedEmails ) ) {
										unset($copy[$i]);
									}
									else {
										$usedEmails[] = @$nearr[$i][1];
									}

								}
								
								
							
							?>
						<tbody>
							<?php
							$copy = array_reverse($copy);
							foreach($copy as $narr)
								{
									if(is_array($narr) && @$narr[1] != '')
									{
									?>
									<tr>
										<td>
										<?=@date('d M, Y',$narr[1])?>
										</td>
										<td><?=@date('d M, Y',$narr[3])?></td>
										<td><?=$narr[4]?></td>	
										<td><a href="coupon_details.php?cid=<?=$narr[3];?>">Details</a></td>	
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
					<?php
					}
					?>
					
<script type="text/javascript">
function formSubmit(form) {
	if($('#totalnumber').val() != "" && $('#expiration').val() != "" )
	{
		$('#submitNew').text("Loading...")
		$('#LoadingImg').css("display","block")
		setTimeout(function() {
			form.submit();
		}, 3000);  // 3 seconds
		return false;
	}
}

var FormReader = 
	{
		init: function()
		{
			theFormObj = $('#myForm');
			return (FormReader._checkValidation(theFormObj))
			
		},
		_checkValidation: function(FormObj)
		{
			return FormObj.validator('checkform', FormObj);
		},

	};
		 $('#myForm').on('submit',function(e) {
		
		 if(FormReader.init())
		 { 
			//$('.error_on_register').hide();
			
			


		 }
			
		 else
		 {   
	$('.error').eq(0).focus();
		return false;
		 }

			
		});
</script>		
					
	

<?php include('footer.php');?>