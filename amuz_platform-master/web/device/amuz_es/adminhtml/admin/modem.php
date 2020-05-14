<?php
include('header.php');

$ifconfig = exec("ifconfig ppp0| grep -i 'inet addr:'");
$xifconfig = explode(" ",$ifconfig);
$inetaddrar = explode(":",$xifconfig[11]); 
?>
 <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
<?php
if($inetaddrar[1] != ""){
echo "modem is on";

?>
<input type="button" value="OFF" onclick="modemfunction('OFF')"/>

<?php
}else{
echo "modem is off";
?>
<p id="onpara"></p>
<input type="button" value="ON" onclick="modemfunction('ON')"/>
<?php
}
?>
</div>
</div>
</div>
<script>
function modemfunction(type){
							var retVal = confirm("Are you sure, you want to "+type+" the modem");
							if(retVal == true){
							if(type == "ON"){
							$("#onpara").html("please refresh the page after 2 seconds");
							}
								$.ajax({
									type: "POST",
									url: "modemfunctions.php",
									data: {"type" : type},
									success: function(data)
									{
										alert(data);
										location.reload();
									}
								}); 
							}
						}
</script>


