<?php include('header.php');
include('includes/config.php');


	


?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
					<?php
					if($services_access != "yes")
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
						
                           Settings >>
							</h4>
							<form name="myForm" id="myForm" method="post" action="update_settings.php" onsubmit="return formSubmit(this);" enctype="multipart/form-data">
								<table cellpadding="5" cellspacing="5"  class="table table-bordered table-hover" >
									<tr>
										<td>Admin Logo</td>
										<td>
										<img src="http://139.162.18.196:8283/OurTV/images/ourtv_logo.png" width="100px">
										<input type="file" name="adminlogo" id="adminlogo"  data-validations="required" /></td>
									</tr>
									
									<tr>
										<td colspan=""></td>
										<td><input type="submit" name="create" id="create" value="Save" /></td>
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
					
					
<script type="text/javascript">
/* function formSubmit(form) {
	if($('#adminlogo').val() != "")
	{
		$('#submitNew').text("Loading...")
		$('#LoadingImg').css("display","block")
		setTimeout(function() {
			form.submit();
		}, 3000);  // 3 seconds
		return false;
	}
} */

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
					
	<?php
	}
	?>

<?php include('footer.php');?>