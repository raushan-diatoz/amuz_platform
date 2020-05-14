<?php
include('header.php');
$file = fopen("db/serial.db","r");
$file2 = fopen("db/serial.db","r");


?>
<div id="page-wrapper">
        
	<div class="container-fluid">

	<!-- Page Heading -->
		<div class="row">


			<div class="col-lg-12">
			<h4 class="page-header">Delivery Management</h4>
			
			<input type="button" name="button1" class="btn btn-default" onClick="openViewCustomer()" value="View Customers">
			<input type="button" name="button2" class="btn btn-default" onClick="openAddCustomer()" value="Add Customer">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="searchkey" id="searchkey" value="" style="width:300px;" placeholder="Search Serial Key">
			<input type="submit" name="button3" class="btn btn-default" onClick="searchSerialKey(searchkey.value)"  value="Search">
			<br /><br /><br />
				
				<div class="add_customer" style="display:none">
					<b>Add Customer</b><br /><br />
					<form name="myForm" id="myForm" method="post" action="updatedeleverymanagement.php" enctype="multipart/form-data">
						<div class="contain_box" style="display:block;">
							<table cellpadding="5" cellspacing="5" width="500px" class="table table-bordered table-hover">
								<tr>
									<td>Device Serial Key</td>
									<td>
										<select name="dsk">
										<?php
										while(! feof($file))
										{
											$datastr = fgets($file);
											$exp = explode("||",$datastr);
											$exrep = count($exp);
											$str = implode("",$exp);
											$length = strlen($str);
											$lastr = substr($str,24,$length);
											$cntlstr = strlen($lastr);
											if($cntlstr >= 6)
											{
												$lstsubstr = substr($lastr,0,3).'-'.substr($lastr,3,10);
											}
											else
											{
												$lstsubstr = $lastr;
											}
											$firstsubstr = chunk_split(substr($str,0,24), 4, '-').$lstsubstr;
											if($exrep <= 6 && $exrep >= 2)
											echo "<option value=".$datastr.">".$firstsubstr."</option>";                      
										}
										?>
										<select>
									</td>
								</tr>
								<tr>
									<td colspan="6"><b>Customer Details</b>
									</td>
								</tr>
								<tr>
									<td>Name</td>
									<td><input type="text" name="customername" data-validations="required" /></td>
									<td>Phone No</td>
									<td><input type="text" name="phonenum" data-validations="required" /></td>
									<td>Email</td>
									<td><input type="text" name="email" data-validations="required" /></td>  
								</tr>
								<tr>
									<td>From</td>
									<td><input type="text" name="destfrom" data-validations="required" /></td>
									<td>To</td>
									<td><input type="text" name="destto" data-validations="required" /></td>
									<td>Operator</td>
									<td><input type="text" name="operator" data-validations="required" /></td>
								</tr>
								<tr>
									<td ><b>Details</b></td>
									<td colspan="5">
										<textarea name="details" cols="50" rows="6"></textarea>
									</td>
								</tr>
								<tr>
									<td><input type="submit" name="submit" class="btn btn-default" value="Save"></td>
								</tr>

							</table>     
						</div>
					</form>
				</div>
				<div class="view_customer">
					<b>View Customer</b><br /><br />
					<table class="table table-bordered table-hover">
						<thead>
						<tr>
							<th>Sl.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Serial Key</th>
							<th>Operator</th>
							<th>Action</th>
						</tr>
						</thead>
						
						
								<?php
								$sl=1;
								while(! feof($file2))
								{
									$datastr1 = fgets($file2);
									
									$exp1 = explode("||",$datastr1);
									$exrep1 = count($exp1);
									if($exrep1 > 6)
									{	
									//echo $datastr1;
									$exp1 = explode("||",$datastr1);
									$exp11 = array_slice($exp1,0,6,true);
									//print_r($exp11);
									$str1 = implode("",$exp11);
									$length1 = strlen($str1);
									$lastr1 = substr($str1,24,$length1);
									$cntlstr1 = strlen($lastr1);
									if($cntlstr1 >= 6)
									{
										$lstsubstr1 = substr($lastr1,0,3).'-'.substr($lastr1,3,10);
									}
									else
									{
										$lstsubstr1 = $lastr1;
									}
									
									$firstsubstr1 = chunk_split(substr($str1,0,24), 4, '-').$lstsubstr1;
									?>
									<tr>
										<td><?php echo $sl;?>.</td>
										<?php if(! isset($exp1[6])){
										$exp1[6]=null;
										   }
										   if(! isset($exp1[8])){
											$exp1[8]=null;
										}
										if(! isset($exp1[7])){
											$exp1[7]=null;
										}
										if(! isset($exp1[12])){
											$exp1[12]=null;
										}
										?>  
										<td><?php echo $exp1[6];?></td>
										<td><?php echo $exp1[8];?></td>
										<td><?php echo $exp1[7];?></td>
										<td><?php echo $firstsubstr1;?></td>

										<td><?php echo $exp1[12];?></td>
										<td><a href="#" onClick="searchSerialKey('<?php echo $firstsubstr1;?>')">View</a></td>
									</tr>
									<?php
									$sl++;
									}
								
								}
								?>
							
					</table>
				</div>
				<div class="searchcomp"></div>
			</div>
		</div>       
		
<script type="text/javascript">

function searchSerialKey(val)
{
	//alert(val);
	url="searchskey.php?val="+val;
	try
	{// Firefox, Opera 8.0+, Safari, IE7
		xm=new XMLHttpRequest();
	}
	catch(e)
	{// Old IE
		try
		{
			xm=new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(e)
		{
			alert ("Your browser does not support XMLHTTP!");
			return;
		}
	}
	
	xm.open("GET",url,false);
	xm.send(null);
	msg=xm.responseText;
	var account_name=msg;
	var combo = account_name;
	//alert(combo);
	$('.searchcomp').html(combo).show(500);
	$('.add_customer').hide(500);
	$('.view_customer').hide(500);
}

function openAddCustomer()
{
	$('.add_customer').show(500);
	$('.view_customer').hide(500);
	$('.searchcomp').hide(500);
}
function openViewCustomer()
{
	$('.view_customer').show(500);
	$('.add_customer').hide(500);
	$('.searchcomp').hide(500);
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