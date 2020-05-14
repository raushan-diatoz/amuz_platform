<?php 
include('header.php');
?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
					<?php
					if($user_access != "yes")
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
                            User Management
                        </h1>
						<div style="min-height:470px;">
							<div style="height:50px; margin:10px;">
								<input type="button" name="addadmin" id="addadmin" class="btn btn-default" onClick="addAdmin(this.value)" value="Add New User">
							</div>
							<div class="contain_box" style="display:none;">
								<form name="myForm" id="myForm" method="post" action="add_admin.php" onsubmit="return formSubmit(this);" enctype="multipart/form-data">
									<table cellpadding="5" cellspacing="5" width="500px" class="table table-bordered table-hover">
										<tr>
											<td>User Name</td>
											<td><input type="text" name="admin_name" id="admin_name" data-validations="required" /></td>
											<td>User Login</td>
											<td><input type="text" name="admin_login" id="admin_login" data-validations="required" /></td>
											<td>User Password</td>
											<td><input type="text" name="password" id="password" data-validations="required" /></td>
										</tr>
										<tr>
											<td>User Email</td>
											<td><input type="text" name="admin_email" id="admin_email" data-validations="required|email" /></td>
											<td colspan="4"></td>
										</tr>
										<tr>
											<td>User Management</td>
											<td>
												<input type="radio" name="user_access" id="user_access1" value="1"> Yes
												<input type="radio" name="user_access" id="user_access2" value="0" checked> No
											</td>
											<td>Category Management</td>
											<td>
												<input type="radio" name="category_access" id="category_access1" value="1"> Yes
												<input type="radio" name="category_access" id="category_access2" value="0" checked> No
											</td>
											<td>Log Management</td>
											<td>
												<input type="radio" name="log_access" id="log_access1" value="1"> Yes
												<input type="radio" name="log_access" id="log_access2" value="0" checked> No
											</td>
										</tr>
										<tr>
											<td>Setting</td>
											<td>
												<input type="radio" name="services_access" id="services_access1" value="1"> Yes
												<input type="radio" name="services_access" id="services_access2" value="0" checked> No
											</td>
											<td>Coupon Management</td>
											<td>
												<input type="radio" name="coupon_access" id="coupon_access1" value="1"> Yes
												<input type="radio" name="coupon_access" id="coupon_access2" value="0" checked> No
											</td>
											<td>Serial Key Management</td>
											<td>
												<input type="radio" name="serial_key_access" id="serial_key_access1" value="1"> Yes
												<input type="radio" name="serial_key_access" id="serial_key_access2" value="0" checked> No
											</td>
										</tr>
										<tr>
											<td>Delivery Management</td>
											<td>
												<input type="radio" name="delivery_management_access" id="delivery_management_access1" value="1"> Yes
												<input type="radio" name="delivery_management_access" id="delivery_management_access2" value="0" checked> No
											</td>
											<td></td>
											<td>
												
											</td>
											<td></td>
											<td>
												
											</td>
										</tr>
										<tr>
											<td colspan="5"><input type="checkbox" name="allyes" id="allyes" value="1" onClick="superAdmin(this.value)"> Make this User as a Super Admin</td>
											<td><input type="submit" name="create" id="create" value="Create" /></td>
										</tr>
									</table>
								</form>
							
								<div class="col-lg-12">
									<div style="margin:auto;width:200px;height:50px;">
										<div id="LoadingImg" style="float:left;display:none;"><img border='0' src='img/loading2.gif'></div>
										<div id="submitNew" style="float:left;margin:5px 0px 0px 10px"></div>
									</div>
								</div>
							</div>
							<table class="table table-bordered table-hover">
							<thead>
							<tr>
								<th>Sl.</th>
								<th>User Name</th>
								<th>Email</th>
								<th>User Mng.</th>
								<th>Category Mng.</th>	
								<th>Log Mng.</th>	
								<th>Setting</th>	
								<th>Coupon Mng.</th>	
								<th>Serial Key Mng.</th>	
								<th>Delivery Mng.</th>	
							</tr>
							</thead>
							
							<?php
							$myfile = fopen("db/admin.db", "r") or die("Unable to open file!");
								$nearr = array();
								while(! feof($myfile))
								{
									$gfile = fgets($myfile);
									$exfile = explode('||',$gfile);
									$nearr[] = $exfile;
								}	
								
								foreach($nearr as $narr)
								{
									//echo $narr[0];
									if($narr[0] != '')
									{
										if($narr[0] == 1)
										{
												$umange = '<a href="#"><img src="img/Tick_gray.png"></a>';
												$catmange = '<a href="#"><img src="img/Tick_gray.png"></a>';
												$lmange = '<a href="#"><img src="img/Tick_gray.png"></a>';
												$service = '<a href="#"><img src="img/Tick_gray.png"></a>';
												$coupmange = '<a href="#"><img src="img/Tick_gray.png"></a>';
												$skmange = '<a href="#"><img src="img/Tick_gray.png"></a>';
												$dmange = '<a href="#"><img src="img/Tick_gray.png"></a>';
											
										}
										else
										{
											if($narr[4] == 0)
												$umange = '<a href="add_admin.php?arr='.$narr[0].'&po=4&cng=1&user='.$narr[1].'"><img src="img/cross.png"></a>';
											else
												$umange = '<a href="add_admin.php?arr='.$narr[0].'&po=4&cng=0&user='.$narr[1].'"><img src="img/tick.png"></a>';
											
											if($narr[5] == 0)
												$catmange = '<a href="add_admin.php?arr='.$narr[0].'&po=5&cng=1&user='.$narr[1].'"><img src="img/cross.png"></a>';
											else
												$catmange = '<a href="add_admin.php?arr='.$narr[0].'&po=5&cng=0&user='.$narr[1].'"><img src="img/tick.png"></a>';
											
											if($narr[6] == 0)
												$lmange = '<a href="add_admin.php?arr='.$narr[0].'&po=6&cng=1&user='.$narr[1].'"><img src="img/cross.png"></a>';
											else
												$lmange = '<a href="add_admin.php?arr='.$narr[0].'&po=6&cng=0&user='.$narr[1].'"><img src="img/tick.png"></a>';
											
											if($narr[7] == 0)
												$service = '<a href="add_admin.php?arr='.$narr[0].'&po=7&cng=1&user='.$narr[1].'"><img src="img/cross.png"></a>';
											else
												$service = '<a href="add_admin.php?arr='.$narr[0].'&po=7&cng=0&user='.$narr[1].'"><img src="img/tick.png"></a>';
											
											if($narr[8] == 0)
												$coupmange = '<a href="add_admin.php?arr='.$narr[0].'&po=8&cng=1&user='.$narr[1].'"><img src="img/cross.png"></a>';
											else
												$coupmange = '<a href="add_admin.php?arr='.$narr[0].'&po=8&cng=0&user='.$narr[1].'"><img src="img/tick.png"></a>';
											
											if($narr[9] == 0)
												$skmange = '<a href="add_admin.php?arr='.$narr[0].'&po=9&cng=1&user='.$narr[1].'"><img src="img/cross.png"></a>';
											else
												$skmange = '<a href="add_admin.php?arr='.$narr[0].'&po=9&cng=0&user='.$narr[1].'"><img src="img/tick.png"></a>';
											if($narr[12] == 0)
												$dmange = '<a href="add_admin.php?arr='.$narr[0].'&po=12&cng=1&user='.$narr[1].'"><img src="img/cross.png"></a>';
											else
												$dmange = '<a href="add_admin.php?arr='.$narr[0].'&po=12&cng=0&user='.$narr[1].'"><img src="img/tick.png"></a>';
										
										}
										
										?>
										<tr>
											<td><?=$narr[0];?></td>
											<td><?=$narr[1];?></td>
											<td><?=$narr[10];?></td>
											<td><?=$umange;?></td>
											<td><?=$catmange;?></td>
											<td><?=$lmange;?></td>
											<td><?=$service;?></td>
											<td><?=$coupmange;?></td>
											<td><?=$skmange;?></td>
											<td><?=$dmange;?></td>
											
										</tr>
										<?php
									}
										
								}
							?>
						</div>
                    </div>
					<?php
					}
					?>
                </div>
                <!-- /.row -->
				
<script>
	function addAdmin(val)
	{
		if(val == "Add New User")
		{
			$('.contain_box').show(500);
			$('#addadmin').attr('value', 'Cancel');
		}
		if(val == "Cancel")
		{
			$('.contain_box').hide(500);
			$('#addadmin').attr('value', 'Add New User');
			$('.error-message').css('display', 'none');
		}
		
	}
	
	function superAdmin(val)
	{
		if(val == 1)
		{
			$("#user_access1").prop("checked", true);
			$("#category_access1").prop("checked", true);
			$("#log_access1").prop("checked", true);
			$("#services_access1").prop("checked", true);
			$("#coupon_access1").prop("checked", true);
			$("#serial_key_access1").prop("checked", true);
			$("#delivery_management_access1").prop("checked", true);
			$('#allyes').attr('value', '2');
		}
		if(val == 2)
		{
			$("#user_access2").prop("checked", true);
			$("#category_access2").prop("checked", true);
			$("#log_access2").prop("checked", true);
			$("#services_access2").prop("checked", true);
			$("#coupon_access2").prop("checked", true);
			$("#serial_key_access2").prop("checked", true);
			$("#delivery_management_access2").prop("checked", true);
			$('#allyes').attr('value', '1');
		}
	}
	
</script>
<script type="text/javascript">
function formSubmit(form) {
	if($('#admin_name').val() != "" && $('#admin_login').val() != "" )
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
<?php include('footer.php');?>