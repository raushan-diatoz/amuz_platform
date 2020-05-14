<?php
include("includes/header.php");
include("scan.php");
$paths = scan(ROOTPATH);
?>
<h3><?php echo ROOTPATH ?></h3>
<table class="dashboardlisting">
	<thead>
	<tr>
		<th>Folder</th>
		<th>Date Modified</th>
		<th>size</th>	
		<th></th>	

	</tr>
	</thead>
	<tbody>
	<?php
  	foreach ($paths as $path) {
  		echo "<tr><td><i class='fa fa-fw fa-folder-open-o'>".$path["name"]."</i></td><td>".$path["datemodified"]."</td><td>".$path["size"]."</td><td></td></tr>";
        }
   ?>

	</tbody>	

</table>
<p>
<a class="btn btn-default" onclick="getFolderName()">
<i class="fa fa-fw fa-plus"></i>
Create folder
</a>
</p>
<script>
function getFolderName(){
	var retVal = prompt("Enter Folder name : ", "New Folder Name");
	$.ajax({
  	type: "POST",
  	url: "createFolder.php",
  	data: {"path": $("h3").text(), "foldername" : retVal},
  	 success: function(data)
             {
         	alert(data);
		location.reload();
             }
         
  	
});
        
}
</script>	