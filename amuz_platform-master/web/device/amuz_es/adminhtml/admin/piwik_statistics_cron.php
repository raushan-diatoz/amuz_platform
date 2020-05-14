<?php
include('config.php');
include("includes/netconnection.php");
?>
<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
					<?php
					/* if($log_access != "yes")
					{
					?>
					<h4 class="page-header">
						<font color="#FF000">You do not have permission to access this page</font>
					</h4>
					<?php
					}
					else */
					{
					?>
                        <h1 class="page-header">
                            Connection
                        </h1>
						<div style="min-height:470px; text-align:center;">
						<table class="table table-bordered table-hover">
						<thead>
						
						
							</tr>
						</thead>
						</table>
						<form id="myForm" name="myForm" action="includes/SSHconnection/piwikpush.php" method="post" onsubmit="return formSubmit(this);">
						<table class="table table-bordered table-hover">
						<thead>
						<tr>
							<td colspan="2">
								
							</td>
							<td><button class='btn btn-sm btn-default' type='submit'>Transfer to Cloud</button></td>
						</tr>
						
						<tr>
							<th> <input type="checkbox" name="selecctall" id="selecctall"> Files</th>
							<th>Size</th>	
							<th>Status</th>	

						</tr>
						</thead>
							<?php
							$files = scandir('/usr/share/nginx/html/OurTV/logs/piwik_data/');
							//print_r($files);
							$files = array_reverse($files);
							foreach($files as $imgf)
							{

								$extn = explode('.',$imgf);
								
								if($imgf != '.' && $imgf != '..' && $imgf != '' && isset($extn[1]) != '')
								{
									if(strpos($imgf,'transferred_') === 0)
									{
										/* echo "<tr>
											<td align='left'><b><i class='fa'>&nbsp;&nbsp;&nbsp;".str_replace('transferred_','',$imgf)."</i></b></td>
											<td align='left'>
												 <button class='btn btn-sm btn-default' type='button'>Already Transferred</button>
											</td>
										</tr>"; */
									}
									else
									{
										echo "<tr>
											<td align='left'><input type='checkbox' class='checkbox1' name='select_all[]' id='select_all' checked value='".$imgf."'>
											<b><i class='fa'>&nbsp;&nbsp;&nbsp;".$imgf."</i></b></td>
											<td align='left'>15 kb</td>
											<td align='left'>
												Pending
											</td>
										</tr>";
									}
								}
							}
							?>
						</table>
							</form>
						</div>
                    </div>
                </div>
				<?php
				}
				?>
                <!-- /.row -->
<?php include('footer.php');?>
<script>document.getElementById('myForm').submit();</script>
<script type="text/javascript">
/* function formSubmit(form) {
	//if($('#select_all').val())
	{
		$('#submitNew').text("transferring...")
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
		
		
$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }
    });
   
});
</script>