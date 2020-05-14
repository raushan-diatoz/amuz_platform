<?php
session_start();
  		$_SESSION["txnid"]=time();
        $_SESSION["surl"]="http://".$_SERVER["HTTP_HOST"]."/demo/receive.php";
        $_SESSION["furl"]="http://".$_SERVER["HTTP_HOST"]."/demo/fail.php";
        $_SESSION["curl"]="http://".$_SERVER["HTTP_HOST"]."/demo/cancel.php";
        $_SESSION["firstname"]="";
        $_SESSION["lastname"]="";
        $_SESSION["email"]="";
        $_SESSION["phone"]="";
        $_SESSION["productinfo"]="Demo";
        $_SESSION["amount"]="2";
        $_SESSION["merchantID"]="69";
        $_SESSION['merchantkey']="788756d";


include 'header.html';
?>
<table style="width:100%;"; border="0"; bgcolor="#FFFFFF">
		<tr><td  colspan="3" class="c"><br><img src="images/india-today.jpg"></td>
			</tr>
		<tr>
			<td style="width:10%"></td>
			<td class="c1"><h>India Today Rs.<?php echo $_SESSION["amount"];?>/-</h><a href="ext.php"><img src="http://yippster.com/smspay/button.php?amt=<?php echo $_SESSION["amount"];?>"></a><br><br>
				</td>
			<td style="width:10%"></td>
			<a href="sms:123456789,+123456789?body=Hello">SMS Me</a>
		</tr>
	</table>';
</div>
</body>
</html>