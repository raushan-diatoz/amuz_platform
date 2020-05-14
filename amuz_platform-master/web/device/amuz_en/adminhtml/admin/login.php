<?php
session_start();
require_once 'KLogger.php';
$log = new KLogger ( "log.txt" , KLogger::DEBUG );
include("includes/clientIPAddress.php");
$ipaddress = get_client_ip();
$log->LogDebug("web page accessed from ip ".$ipaddress);
if(isset($_REQUEST['user_login']) != '')
		{
		$userlogin = MD5($_REQUEST['user_login']);
		$userpassword = MD5($_REQUEST['user_password']);
		$filename = 'db/admin.db';
		$handle = fopen($filename, "r");
		$nearr = array();
		while(! feof($handle))
		{
			$gfile = fgets($handle);
			$exfile = explode('||',$gfile);
			$nearr[] = $exfile;
		}	
		foreach($nearr as $val)
		{
			if(in_array($userlogin,$val))
			{
				$userpassword;
				$admin_pwd = $val[3];
				
					if ($userpassword == $admin_pwd)
					{
						$_SESSION["userid"] = $val[0];
						$_SESSION["username"] = $val[1];
						header('location:index.php');
						$log->LogDebug("user ".$_SESSION["username"]." logged in with ip ".$ipaddress);
						break;
					}
					else
					{
						
					}
			
			}else{
				$log->LogDebug("user ".$_REQUEST['user_login']." tried to logged in with ip ".$ipaddress." authentication failed");
			}
		}
		
		
		}


?>

<!doctype html>

<head>

	<!-- Basics -->
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>Login</title>

	<!-- CSS -->
	
	<link rel="stylesheet" href="css/logincss/reset.css">
	<link rel="stylesheet" href="css/logincss/animate.css">
	<link rel="stylesheet" href="css/logincss/styles.css">
	
</head>

	<!-- Main HTML -->
	
<body>
	
	<!-- Begin Page Content -->
	
	<div id="container">
		
		<form name="login-form" class="login-form" action="" method="post">
		
		<label for="name">Username:</label>
		
		<input type="name" name="user_login" id="user_login">
		
		<label for="username">Password:</label>
		
		
		
		<input type="password" name="user_password" id="user_password">
		
		<div id="lower">
		<p><a href="#">Forgot your password?</a></p>
		<input type="checkbox"><label class="check" for="checkbox">Keep me logged in</label>
		
		<input type="submit" value="Login">
		
		</div>
		
		</form>
		
	</div>
	
	
	<!-- End Page Content -->
	
</body>

</html>
	
	
	
	
	
		
