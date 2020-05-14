<?php include('header.php');

// get GEO from geo.db files
$filename = "db/geo.db";
$file = fopen($filename, "r");
if ($file) {
	$geoarray = explode("\n", fread($file, filesize($filename)));
}

// get Device from device.db files
$filename1 = "db/device.db";
$file1 = fopen($filename1, "r");
if ($file1) {
	$devicearray = explode("\n", fread($file1, filesize($filename1)));
}


?>
<style>
.error-message {
	color:#FF0000;
	font-size:10px;
}
</style>
<link rel="stylesheet" type="text/css" media="all" href="calender/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="calender/jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"date",
			dateFormat:"%d-%m-%Y"
		});
	};
</script>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
					<?php
					if($serial_key_access != "yes")
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
						
                            Serial Management >>
							</h4>
							<form name="myForm" id="myForm" method="post" action="add_serial.php" onsubmit="return formSubmit(this);" enctype="multipart/form-data">
							<div id='TextBoxesGroup'>
								<div id='TextBoxDiv1'>
									<table cellpadding="5" cellspacing="5"  class="table table-bordered table-hover" >
										<tr>
											<td style="width:16%">
												<select name="geo[]" id="geo" data-validations="required" >
													<option value="">GEO</option>
													<?php
													foreach($geoarray as $val)
													{
														$str = explode('||',$val);
														echo '<option value="'.$str[2].'">'.$str[1].'</option>';
													}
													?>
													
												</select>
												
											</td>
											<td style="width:16%">
											
												<select name="device_type[]" id="device_type" data-validations="required" >
													<option value="">Type</option>
													<?php
													foreach($devicearray as $val)
													{
														$str = explode('||',$val);
														echo '<option value="'.$str[2].'">'.$str[1].'</option>';
													}
													?>
												</select>
												
											</td>
											<td style="width:16%">
												<input type="text" name="batch[]" id="batch" value=""  placeholder="Batch" data-validations="required" />
											</td>
											<td style="width:16%">
												<input type="text" name="date[]" id="date" value="" readonly placeholder="Date" />
											</td>
											<td style="width:16%">
												<input type="text" name="count[]" id="count" value="" placeholder="Count Serial" size="10" data-validations="required|numeric" />
											</td>
											<td style="width:16%">
												<a href="javascript:void(0);" class="add" >Add More</a>
											</td>
										</tr>
										
									</table>
								</div>
							</div>
							<div class="contents"></div>
							
									<table cellpadding="5" cellspacing="5"  class="table table-bordered table-hover" >
										<tr>
											<td style="width:83%"></td>
											<td><input type="submit" name="create" value="Generate Serial key" /></td>
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
							<th>Created Date</th>
							<th>Created for Date</th>
							<th>Details</th>	
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
										<?=@date('d M, Y',$narr[4])?>
										</td>
										<td><?=@date('d M, Y',$narr[3])?></td>
										<td><a href="serial_details.php?cid=<?=$narr[3];?>">Details</a></td>	
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
	if($('#count').val() != "")
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
		//$('.error_on_register').hide();
		return false;
		 }

			
		});
</script>		



<script>
	$(document).ready(function() {
		$(".add").click(function() {
			if($("#geo").val()==''){$("#geo").css("border","1px solid red"); $( "#geo" ).focus(); return false;}
			if($("#device_type").val()==''){$("#device_type").css("border","1px solid red"); $( "#device_type" ).focus(); return false;}
			if($("#batch").val()==''){$("#batch").css("border","1px solid red"); $( "#batch" ).focus(); return false;}
			if($("#date").val()==''){$("#date").css("border","1px solid red"); $( "#date" ).focus(); return false;}
			if($("#count").val()==''){$("#count").css("border","1px solid red"); $( "#count" ).focus(); return false;}
			$('<div><table cellpadding="5" cellspacing="5"  class="table table-bordered table-hover" ><tr>' + 
			'<td style="width:16%"><input type="text" name="geo[]" id="batch" value="'+geo.value+'" readonly size="7"/></td>' + 
			'<td style="width:16%"><input type="text" name="device_type[]" id="batch" value="'+device_type.value+'" readonly size="9"/></td>' + 
			'<td style="width:16%"><input type="text" name="batch[]" id="batch" value="'+batch.value+'" readonly/></td>' + 
			'<td style="width:16%"><input type="text" name="date[]" id="batch" value="'+date.value+'" readonly/></td>' + 
			'<td style="width:16%"><input type="text" name="count[]" id="batch" value="'+count.value+'" readonly/></td>' + 
			'<td style="width:16%"><span class="rem"><a href="javascript:void(0);" >Remove</span></td></tr></table></div>').appendTo(".contents");
			$("#geo").val("");
			$("#device_type").val("");
			$("#batch").val("");
			$("#date").val("");
			$("#count").val("");
			$("#geo").css("border","");
			$("#device_type").css("border","");
			$("#batch").css("border","");
			$("#date").css("border","");
			$("#count").css("border","");
			
			
		});
	});
	
	$('.contents').on('click', '.rem', function() {
	  $(this).closest("table").remove();
	});
</script>




<?php include('footer.php');?>