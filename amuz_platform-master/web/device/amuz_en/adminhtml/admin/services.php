<?php
include("header.php");
$nginxStatus = shell_exec('service nginx status');
$status = explode(" ", $nginxStatus);
$action = '';
if(strcmp($status[2], 'running.')){
$action = 'stop';
}else{
$action = 'start';
}

?>
<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    
					
<div class="col-lg-12">
<table table-bordered table-hover>
<tr>
<th>Services</th><th>Status</th><th>Action</th>
</tr>
<tr>
<td>nginx</td><td><?php echo "$status[2]"; ?></td><td><input id='nginx' type='button' value='<?php echo $action?>'  /></td>
</tr>
</table>
</div>
</div>
</div>
</div>
<script>
$("#nginx").on("click", function(){
	$.ajax({
		url: 'serviceaction.php',
		data: {action: '<?php echo $action?>', service: this.id},
		type: 'post',
		success: function(data){
		alert(data);
		}	
	});
});

</script>
