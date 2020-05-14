<?php
if(isset($_POST['action']) && isset($_POST['service'])){
$password = 'pi123';
$action = $_POST['action'];
$service = $_POST['service'];
//echo 'here';
shell_exec('sudo su');
echo shell_exec('whoami');
$status = shell_exec('sudo service nginx stop');
echo $status;
}

?>
