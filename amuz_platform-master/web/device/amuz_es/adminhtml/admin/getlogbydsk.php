<?php
include('includes/getconnection.php');
$dsk = $_POST['dsk'];
$dblink = getConnection();
global $dblink;
$s="select *, custom_var_v3, count(*) from piwik_log_link_visit_action where custom_var_v1='".$dsk."' group by custom_var_v3";
$q=mysql_query($s) or die($s);
$report = array();
while($rw=mysql_fetch_array($q))
{
if(!$rw["custom_var_v3"] == ""){
  $report[] = array(
          "variable" => $rw["custom_var_k3"],
          "media" => $rw["custom_var_v3"],
          "count" => $rw["count(*)"]
          
        );  
  
 }        
}
$s="select *,custom_var_v2, count(*) from piwik_log_link_visit_action where custom_var_v1='".$dsk."' group by custom_var_v2";
$q=mysql_query($s) or die($s);
while($rw=mysql_fetch_array($q))
{
if(!$rw["custom_var_v2"] == ""){
  $report[] = array(
          "variable" => $rw["custom_var_k2"],
          "media" => $rw["custom_var_v2"],
          "count" => $rw["count(*)"]
          
        );  
  
 }        
}
$s="select *,custom_var_v4, count(*) from piwik_log_link_visit_action where custom_var_v1='".$dsk."' group by custom_var_v4";
$q=mysql_query($s) or die($s);
while($rw=mysql_fetch_array($q))
{
if(!$rw["custom_var_v4"] == ""){
  $report[] = array(
          "variable" => $rw["custom_var_k4"],
          "media" => $rw["custom_var_v4"],
          "count" => $rw["count(*)"]
          
        );  
  
 }        
}
$s="select *,custom_var_v5, count(*) from piwik_log_link_visit_action where custom_var_v1='".$dsk."' group by custom_var_v5";
$q=mysql_query($s) or die($s);
while($rw=mysql_fetch_array($q))
{
if(!$rw["custom_var_v5"] == ""){
  $report[] = array(
          "variable" => $rw["custom_var_k5"],
          "media" => $rw["custom_var_v5"],
          "count" => $rw["count(*)"]
          
        );  
  
 }        
}
	$echoval = '<script type="text/javascript" language="javascript" class="init">

$(document).ready(function() {
	$("#example1").DataTable();
} );


	</script>
	';
$echoval .= '<table id="example1" class="table table-bordered display">';
$echoval .= '<thead><tr><th>Media Type</th><th>Media Name</th><th>Visit Count</th></tr></thead><tbody>';

foreach($report as $nreport)
{
		$echoval .= '<tr><td>'.$nreport["variable"].'</td><td>'.$nreport["media"].'</td><td>'.$nreport["count"].'</td></tr>';
			
}
echo $echoval .= '</tbody></table>';
//echo json_encode($report);

?>
