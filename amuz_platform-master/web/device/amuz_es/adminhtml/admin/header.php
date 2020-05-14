<?php
session_start();

if($_SESSION['userid'] == '')
{
	header('location:login.php');
}
include('config.php');
$target_dir = 'images/';
$myfile = fopen("db/settings/Admin_settings.db", "r") or die("Unable to open file!");
	$nearr = array();
	while(! feof($myfile))
	{
		$gfile = fgets($myfile);
		$exfile = explode('||',$gfile);
		$nearr[] = $exfile;
	}	

$userid = $_SESSION['userid'];
$myfile = fopen("db/admin.db", "r") or die("Unable to open file!");
	$nearr = array();
	while(! feof($myfile))
	{
		$gfile = fgets($myfile);
		$exfile = explode('||',$gfile);
		$nearr[] = $exfile;
	}
	
	foreach($nearr as $val)
	{
		if($val[0] == $userid)
		{
			if($val[4] == 1) {$user_access = "yes";} else {$user_access = "no";}
			if($val[5] == 1) {$category_access = "yes";} else {$category_access = "no";}
			if($val[6] == 1) {$log_access = "yes";} else {$log_access = "no";}
			if($val[7] == 1) {$services_access = "yes";} else {$services_access = "no";}
			if($val[8] == 1) {$coupon_access = "yes";} else {$coupon_access = "no";}
			if($val[9] == 1) {$serial_key_access = "yes";} else {$serial_key_access = "no";}
		}
	}
	
	$myfile = fopen(ADMINPATH."db/admin.db", "r") or die("Unable to open file!");
	$nearr = array();
	while(! feof($myfile))
	{
		$gfile = fgets($myfile);
		$exfile = explode('||',$gfile);
		$nearr[] = $exfile;
	}
	
	$arrayn = array();
	
	
	foreach($nearr as $key=>$arr)
	{
		if($key == $_SESSION["userid"]-1)
		{
			$svrsts = $arr;
			
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<script type="text/javascript" src="js/jquery-1.11.0.min.js" ></script>
	<script type="text/javascript" src="js/validation.js"></script>
	
    
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
.error-message {
	color:#FF0000;
}
</style>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Admin Console</a>
				
            </div>
            <!-- Top Menu Items -->
           
            <ul class="nav navbar-right top-nav">
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=ADMINUSER;?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="menu_settings.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
			 <ul class="nav navbar-middle top-nav" style="text-align:center">
				<img src="http://139.162.18.196:8283/images/ourtv_logo.png" height="50px">
			</ul>

<style>		
.examplemodal {
    width: 100%;
    height: 50px;
    position: fixed;
    top: 0%; 
    left: 0%;
    background-color: #F1F1F1;
    border-radius: 5px;
    text-align: center;
    z-index: 10; /* 1px higher than the overlay layer */
}

.maincontent {
    margin: 0px;
}

.closex{
	position: fixed;
    top: 0%; 
    left: 98%;
}
</style>		
		
	<?php
	$files = scandir(PIWIKADMINPATH);
			$newarr = array();
			foreach($files as $nr)
			{
				$extn = explode('.',$nr);
				$narr = explode('_',$nr);
				if(in_array('updated',$narr))
				{
				}
				else
				{
					if($nr != '.' && $nr != '..')
					$newarr[] = $nr;
				}
			}
			$files = array_reverse($newarr);
			$tcnt = count($files);
			$incrcnt = 100/$tcnt;
			$cnt = $incrcnt;
			if($tcnt > 0)
			{
	?>
	<div class="examplemodal" style="display:block">
		<?php
		include("autopush.php");
		?>
	<div class="closex">X</div>
	</div>

<script>	
$(".closex").click(function(){
	$(".examplemodal").css("display","none");
})
</script>	
<?php
			}
?>


		  <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
			<?php
			
			$requri = str_replace('/admin/','',$_SERVER['REQUEST_URI']);
			?>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
					<?php if(file_exists(PHPFILEPATH.'/index.php')) {?>
                    <li <?php if($requri=='index.php') { echo 'class="active"';} ?> >
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i>Admin Dashboard</a>
                    </li>
					<?php } ?>
					<?php if(file_exists(PHPFILEPATH.'/indexs.php')) {?>
					<li <?php if($requri=='indexs.php') { echo 'class="active"';} ?> >
                        <a href="indexs.php"><i class="fa fa-fw fa-dashboard"></i>Device Dashboard</a>
                    </li>
					<?php } ?>
					<?php if(file_exists(PHPFILEPATH.'/deviceinfo.php')) {?>
					<li <?php if($requri=='deviceinfo.php') { echo 'class="active"';} ?> >
                        <a href="deviceinfo.php"><i class="fa fa-fw fa-dashboard"></i> Device Info</a>
                    </li>
					<?php } ?>
					<?php 
					
					if(trim($svrsts[11]) == "Cloud")
					{
						if(file_exists(PHPFILEPATH.'/user_management.php')) {
						if($user_access == "yes") {?>
						<li <?php if($requri=='user_management.php') { echo 'class="active"';} ?> >
							<a href="user_management.php"><i class="fa fa-fw fa-bar-chart-o"></i> User Management</a>
						</li>
						<?php } }?>
						
						<?php if(file_exists(PHPFILEPATH.'/category_management.php')) {
							if($category_access == "yes") {?>
						<li <?php if($requri=='category_management.php') { echo 'class="active"';} ?> >
							<a href="category_management.php"><i class="fa fa-fw fa-table"></i> Category Management</a>
						</li>
						<?php } } ?>
						
				
						<?php if(file_exists(PHPFILEPATH.'/coupon_management.php')) {
							if($coupon_access == "yes") {?>
						<li <?php if($requri=='coupon_management.php') { echo 'class="active"';} ?> >
							<a href="coupon_management.php"><i class="fa fa-fw fa-dashboard"></i> Coupon Management</a>
						</li>
						<?php } } ?>
						
						<?php if(file_exists(PHPFILEPATH.'/serialkey.php')) {
							if($serial_key_access == "yes") {?>
						<li <?php if($requri=='serialkey.php') { echo 'class="active"';} ?> >
							<a href="serialkey.php"><i class="fa fa-fw fa-dashboard"></i> Serial Key Management</a>
						</li>
						<?php } } ?>
						<?php if(file_exists(PHPFILEPATH.'/deliveryManagement.php')) {
							if($serial_key_access == "yes") {?>
						<li>
						 <a href="deliveryManagement.php"><i class="fa fa-fw fa-dashboard"></i> Delivery Management</a>
						</li>	
						<?php } } ?>
						
						<?php if(file_exists(PHPFILEPATH.'/nginx_status.php')) {
							if($serial_key_access == "yes") {?>
						<li>
						 <a href="nginx_status.php"><i class="fa fa-fw fa-dashboard"></i>Nginx status</a>
						</li>	
						<?php } } ?>

						<?php if(file_exists(PHPFILEPATH.'/settings.php')) {
							if($services_access == "yes") {?>
						<li <?php if($requri=='settings.php') { echo 'class="active"';} ?> >
							<a href="settings.php"><i class="fa fa-fw fa-dashboard"></i> Settings</a>
						</li>
						<?php } } ?>
						<?php if(file_exists(PHPFILEPATH.'/speedtester.php')) {?>
						<li <?php if($requri=='speedtester.php') { echo 'class="active"';} ?> >
							<a href="speedtester.php"><i class="fa fa-fw fa-dashboard"></i>Speed Test</a>
						</li>
						<?php
						}
						?>
						<?php
					if(file_exists(PHPFILEPATH.'/piwik_statistics.php') || file_exists(PHPFILEPATH.'/push_to_piwik_dis.php') || file_exists(PHPFILEPATH.'/rpi_monitor.php')) {
					?>
							 <?php if($log_access == "yes") {?>
						<li <?php if($requri=='Statistics.php') { echo 'class="active"';} ?> >
							<a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Log Management <i class="fa fa-fw fa-caret-down"></i></a>
							<ul id="demo" <?php if($requri != 'piwik_statistics.php' && $requri != 'push_to_piwik_dis.php') { echo 'class="collapse"';} ?>>
								<?php
								if(file_exists(PHPFILEPATH.'/piwik_statistics.php')) {
								?>
								<li>
									<a href="piwik_statistics.php">Log Transfer</a>
								</li>
								<?php
								}
								?>
								<?php
								if(file_exists(PHPFILEPATH.'/push_to_piwik_dis.php')) {
								?>
								<li>
									<a href="push_to_piwik_dis.php">Log Process</a>
								</li>
								<?php
								}
								?>
								<?php
								if(file_exists(PHPFILEPATH.'/rpi_monitor.php')) {
								?>
								<li>
									<a href="rpi_monitor.php">RPI Monitor</a>
								</li>
								<?php
								}
								?>
								
							</ul>
						</li>
						<?php 
						} 
						} 
					}
					
					?>
					<?php
					if(file_exists(PHPFILEPATH.'/auditlog.php') || file_exists(PHPFILEPATH.'/logreport.php')) {
					?>
					<li <?php if($requri=='logreport.php') { echo 'class="active"';} ?> >
                       <a href="javascript:;" data-toggle="collapse" data-target="#demo1"><i class="fa fa-fw fa-arrows-v"></i> Reports <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo1" <?php if($requri != 'feedbackreport.php' && $requri != 'auditlog.php') { echo 'class="collapse"';} ?>>
                            
							<?php
							if(file_exists(PHPFILEPATH.'/auditlog.php')) {
							?>
							<li>
                                <a href="auditlog.php">Audit Logs</a>
                            </li>
			    </li>
							<?php
							}
							?>
							<?php
							if(file_exists(PHPFILEPATH.'/feedbackreport.php')) {
							?>
							<li>
                                <a href="feedbackreport.php">Feedback Report</a>
                            </li>				<?php
							}
							?>
						</ul>
                    </li>
					<?php
					}
					?>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

  
  
<script>
$("img").on("contextmenu",function(e){
       return false;
    }); 
</script>