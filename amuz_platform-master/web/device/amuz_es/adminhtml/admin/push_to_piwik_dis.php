<?php
include("header.php");
include("includes/netconnection.php");
?>
<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
					<?php
					if($log_access != "yes")
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
                        <h1 class="page-header">
                            Connection
                        </h1>
						<div style="min-height:470px; text-align:center;">
						<table class="table table-bordered table-hover">
						<thead>
						
						<?php
								$domain = 'www.amuze.co.in:8283/piwik/index.php';
								//$domain = 'www.yahoo.com';

								if (ping_domain($domain))
								{
									echo "<tr><td colspan='2'><font color='green'>On Line</font></td></tr>";
								}
								else
								{
									echo "<tr><td colspan='2'><font color='red'>Off line</font></td></tr>";
								}  
							?>
							</tr>
						</thead>
						</table>
						<form id="myForm" name="myForm" action="push_to_piwik.php" method="post" onsubmit="return formSubmit(this);">
						<table class="table table-bordered table-hover">
						<thead>
						<!--<tr>
							<td colspan="2">
								<div class="col-lg-12">
									<div style="margin:auto;width:200px;height:50px;">
										<div id="LoadingImg" style="float:left;display:none;"><img border='0' src='img/loading2.gif'></div>
										<div id="submitNew" style="float:left;margin:5px 0px 0px 10px"></div>
									</div>
								</div>
							</td>
							<td><button class='btn btn-sm btn-default' type='submit'>Push to Piwik</button></td>
						</tr>
						
						<tr>
							<th> <input type="checkbox" name="selecctall" id="selecctall"> Files</th>
							<th>Size</th>	
							<th>Status</th>	

						</tr>-->
						</thead>
							<?php
							$files = scandir(PIWIKADMINPATH);
							//print_r($files);
							$files = array_reverse($files);
							foreach($files as $imgf)
							{
								
								$extn = explode('.',$imgf);
								
								if($imgf != '.' && $imgf != '..' && $imgf != '' && isset($extn[1]) != '')
								{
									//echo '<br>'.$imgf;
								
									if(strpos($imgf,'updated_') === 0)
									{
										/* echo "<tr>
											<td align='left'><b><i class='fa'>&nbsp;&nbsp;&nbsp;".str_replace('updated_','',$imgf)."</i></b></td>
											<td align='left'>
												 <button class='btn btn-sm btn-default' type='button'>Done</button>
											</td>
										</tr>"; */
									}
									else
									{
										echo "<tr>
											<td align='left'><b><i class='fa'>&nbsp;&nbsp;&nbsp;".$imgf."</i></b></td>
											<td align='left'>
												 <button class='btn btn-sm btn-default' type='button' onClick='window.location = \"push_to_piwik.php?push=".$imgf."\"'>Push to Piwik</button>
											</td>
										</tr>"; 
										/* echo "<tr>
											<td align='left'><input type='checkbox' class='checkbox1' name='select_all[]' id='select_all' value='".$imgf."'>
											<b><i class='fa'>&nbsp;&nbsp;&nbsp;".$imgf."</i></b></td>
											<td align='left'>15 kb</td>
											<td align='left'>
												Pending
											</td>
										</tr>"; */
									}
								}
							}
							?>
							
							
						</div>
                    </div>
                </div>
				<?php
				}
				?>
                <!-- /.row -->
<?php include('footer.php');?>


<script type="text/javascript">
function formSubmit(form) {
	//if($('#select_all').val())
	{
		$('#submitNew').text("transferring...")
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