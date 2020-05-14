<?php
include("header.php");
?>
<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Speed Tester
                        </h1>
						<div style="min-height:470px; text-align:center; border:0px solid red;">
						<div style="min-height:270px; width: 500px; margin:20px auto; padding:20px;background-color:#000;">
						
							<!-- BEGIN SPEED TEST - DO NOT ALTER BELOW-->
							<script type="text/javascript" src="mini/speedtest/swfobject.js?v=2.2"></script>
								  <div id="mini-demo">
									 
								  </div><!--/mini-demo-->
								<script type="text/javascript">
								  var flashvars = {
										upload_extension: "php"
									};
									var params = {
										wmode: "transparent",
										quality: "high",
										menu: "false",
										allowScriptAccess: "always"
									};
									var attributes = {};
									swfobject.embedSWF("mini/speedtest.swf?v=2.1.8", "mini-demo", "350", "200", "9.0.0", "speedtest/expressInstall.swf", flashvars, params, attributes);
								</script>
							<!-- END SPEED TEST - DO NOT ALTER ABOVE -->
						
						</div>
						</div>
                    </div>
                </div>
                <!-- /.row -->
<?php include('footer.php');?>


