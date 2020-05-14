<?php
session_start();
$hash = hash('sha512',($_SESSION['merchantkey'].$_SESSION['key'].$_SESSION["txnid"].$_SESSION["amount"].$_SESSION["firstname"].$_SESSION["lastname"].$_SESSION["email"].$_SESSION["productinfo"].$_POST['payphone']));

if($_POST['hash']!=$hash)
	{
		header('Location:http://'.$_SERVER["HTTP_HOST"].'/demo/error.php');
		exit();
	}
$_SESSION['state']="paid";
include 'header.html';
?>
</div>
<br><br>
<div style="text-align: center; font-size:17px;">Successfully Purchased <span style="text-decoration: underline; font-weight: bold">India Today </span> for Rs. <?php echo $_SESSION['amount'].'/-. Txn ID:'.$_SESSION['txnid'].' from <span style="text-decoration: underline; font-weight: bold">Phone:'.$_POST['payphone'].'</span>';?></div><br>

	<div style="text-align: center; font-size:17px;"><img src="images/1.jpg"></img>&nbsp;&nbsp;<img src="images/2.jpg"></img></div><br/>




</body>
</html>