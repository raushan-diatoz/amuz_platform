<?php
session_start();
include('config.php');
$dsk = str_replace("-","",$_GET["val"]);

		$myfile = fopen("db/serial.db", "r") or die("Unable to open file!");
		$nearr = array();
		while(! feof($myfile))
		{
			$gfile = fgets($myfile);
			$exfile = str_replace("\n","",explode('||',$gfile));
			$nearr[] = $exfile;
		}
		
		$arrayn = array();
		foreach($nearr as $nr)
		{    if(! isset($nr[6])){
			$nr[6]=null;
		}
		if(! isset($nr[7])){
			$nr[7]=null;
		}
		if(! isset($nr[8])){
			$nr[8]=null;
		}
		if(! isset($nr[9])){
			$nr[9]=null;
		}
		if(! isset($nr[10])){
			$nr[10]=null;
		}
		if(! isset($nr[11])){
			$nr[11]=null;
		}
		if(! isset($nr[12])){
			$nr[12]=null;
		}
			$exp11 = array_slice($nr,0,6,true);
			$nstr = trim(implode("",$exp11));
			if($dsk == $nstr)
			{
				//print_r($nr);
				
				echo $output = '<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover">
							<tr>
								<td><b>Name</b></td>
								<td>'.$nr[6].'</td>
								<td><b>Mobile</b></td>
								<td>'.$nr[7].'</td>
							</tr>
							<tr>
								<td><b>Email</b></td>
								<td>'.$nr[8].'</td>
								<td><b>From</b></td>
								<td>'.$nr[9].'</td>
							</tr>
							<tr>
								<td><b>To</b></td>
								<td>'.$nr[10].'</td>
								<td><b>Details</b></td>
								<td>'.$nr[11].'</td>
							</tr>
							<tr>
								<td><b>Operator</b></td>
								<td>'.$nr[12].'</td>
								<td></td>
								<td></td>
							</tr>
						</table>
							
				';
				
			}
		}

?>