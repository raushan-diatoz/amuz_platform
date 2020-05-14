<?php
session_start();
$some=md5($_SESSION['furl'].$_SESSION['merchantID'].$_SESSION['amount'].$_SESSION['txnid']);
$hash = md5($_GET['salt'].$some);
if($_GET['hash']!=$hash)
	{
		header('Location:http://'.$_SERVER["HTTP_HOST"].'/demo/error.php');
		exit();
	}

include 'header.html';
?>
<table style="width:100%;"; border="0"; bgcolor="#FFFFFF">
		<tr><td  colspan="3" class="c"><br></td>
			</tr>
		<tr>
			<td style="width:10%"></td>
			<td class="c1"><h2>Transaction Failed</h2>	</td>
			<td style="width:10%"></td>
		</tr>

	</table>';
</div>
</body>
</html>