<?php
/*IP CHECK*/
if($_SERVER['REMOTE_ADDR']=='54.254.156.46')
{

/*CHECK FOR PARAMETERS*/
if(isset($_REQUEST['txnid']) && isset($_REQUEST['status']) && isset($_REQUEST['number']))
{

/*DB UPDATE*/
include('dbconnect.php');
mysql_query("update transactions set status='".$_REQUEST['status']."', payphone='".$_REQUEST['number']."', number='".$_REQUEST['number']."', ctimestamp='".$timestamp."' where txnid='".$_REQUEST['txnid']."'",$con);
$reply=array('txnid'=>$_REQUEST['txnid'],'status'=>'Problem');
if(mysql_affected_rows($con)!=0 && mysql_affected_rows($con)!=-1)
	{
	$reply=array('txnid'=>$_REQUEST['txnid'],'status'=>'Received');
	}

/*JSON RESPONSE BASED ON UPDATE SUCCESS*/
echo json_encode($reply);
}

}
?>