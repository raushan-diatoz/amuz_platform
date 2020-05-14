<?php include('header.php');
include("scan.php");
include("scanitem.php");
include("filescan.php");
include("foldersize.php");

if(isset($_GET['dir']) != '')
{
	$getdir = $_GET['dir'];
	$dirpath = ROOTPATH.'/'.$_GET['dir'].'/';
	$jspath = ROOTPATH.'/'.$_GET['dir'].'/';
}
else
{
	$getdir = '';
	$dirpath = ROOTPATH;
	$jspath = ROOTPATH.'/';
}

$paths = scan($dirpath);
$itempaths = filescan($dirpath);

?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
						<?php
						if($category_access != "yes")
						{
						?>
						<h4 class="page-header">
						<font color="#FF000">You do not have permission to access this page</font>
						</h4>
						<?php
						}
						else
						{
						?>
                        <h4 class="page-header">
            
                            Category Management >> <a href="category_management.php">/amuz/amuz_media</a> /
						  <?php
						  if($getdir != '')
						  {
							$getdir = str_replace('//','/',$getdir);
							$exdir = explode('/',$getdir);
							$link = '';
							$numItems = count($exdir);
							$i=0;
							foreach($exdir as $val)
							{
							  if(++$i === $numItems)
							  $link .= $val;
							  else
							  $link .= $val.'/';
							  echo ' <a href="?dir='.$link.'">'.$val.'</a>';
							  if($i!=$numItems)
								echo ' /';
							}
						  }
						  ?>
                        </h4>
            
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Folder</th>
									<th>Date Modified</th>
									<th>size</th> 
									<th>Actions</th>  
								</tr>
							</thead>
							<tbody>
							<?php
							foreach ($paths as $path) {
							if(isset($_GET['dir']) != '')
							{
							$pathname = $_GET['dir'].'/';
							}
							else
							{
							$pathname ='';
							}
							echo "<tr>
							<td><i class='fa fa-folder-open-o'> <a href='?dir=".$pathname.$path["name"]."'>".$path["name"]."</a></i> </td>
							<td>".@date('d M, Y',$path["datemodified"])."</td>
							<td>".format_size(foldersize($jspath.'/'.$path["name"]))."</td>
							<td><a onclick=deleteFolder('".$path["name"]."','".$jspath."')>Delete</a></td>
							</tr>";
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
								data: {"path": '<?=$jspath?>', "foldername" : retVal},
								success: function(data)
								{
									alert(data);
									location.reload();
								}
							});
						}
						function deleteFolder(folder, directory){
							var retVal = confirm("Are you sure, you want to delete Folder "+folder);
							if(retVal == true){
								$.ajax({
									type: "POST",
									url: "deleteFolder.php",
									data: {"path": directory, "folder" : folder},
									success: function(data)
									{
										alert(data);
										location.reload();
									}
								}); 
							}
						}
						function deleteMediaFiles(directory, filename){
						//debugger;
							var retVal = confirm("Are you sure, you want to delete media file "+filename);
							if(retVal == true){
								$.ajax({
								type: "POST",
								url: "deleteMediaFiles.php",
								data: {"path": directory, "file" : filename},
								success: function(data)
								{
									alert(data);
									location.reload();
								}
								}); 
							}
						}
						</script> 
            
                    </div>
          
					<div class="col-lg-12">
                        <h4 class="page-header">Upload a file to this folder //amuz/amuz_media/<?=$getdir;?></h4>
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Videos/Images</th>
									<th>Date Modified</th>
									<th>size</th> 
									<th>Action</th> 
								</tr>
							</thead>
							<tbody>
							<?php
							foreach ($itempaths as $path) {
								if(isset($_GET['dir']) != '')
								{
									$pathname = $_GET['dir'].'/';
								}
								else
								{     $_GET['dir']=null;
									$pathname ='';
								}
								$vfilename = explode('.',$path["name"]);

								if(file_exists(ROOTPATH.'/'.$pathname."/".$vfilename[0].".txt"))
								{
									$myfile = fopen(ROOTPATH.'/'.$pathname."/".$vfilename[0].".txt", "r") or die("Unable to open file!");
									$nearr = array();
									while(! feof($myfile))
									{
										$gfile = fgets($myfile);
										$exfile = explode('||',$gfile);
										$nearr[] = $exfile;
									} 

									if($nearr[0][9] == 1)
										$displaystatus = "<a title = 'Click to unpublish' href='publish_media.php?dir=".$_GET['dir']."&file=".$vfilename[0]."&publish=0'><font color='#00FF00'>Published</font></a>";
									else
										$displaystatus = "<a title = 'click to publish' href='publish_media.php?dir=".$_GET['dir']."&file=".$vfilename[0]."&publish=1'><font color='#FF0000'>Not Published</font></a>";
									echo "<tr>
										<td><img width='50' height='50' src='//amuz/amuz_media/".$_GET['dir'].'/'.$vfilename[0].".jpg'></img> <b><i class='fa'> <a href='filedetails.php?dir=".$_GET['dir']."&file=".$vfilename[0]."'>".$vfilename[0]."</a></i></b></td>
										<td>".@date('d M, Y',$path["datemodified"])."</td>
										<td>".format_size($path["size"])."</td>
										<td width='200px'> <a href='viewmediadetails.php?dir=".$_GET['dir']."&file=".$vfilename[0]."'>View</a> | 
										<a href='filedetails.php?dir=".$_GET['dir']."&file=".$vfilename[0]."'>Edit</a> | ".$displaystatus." | <a onclick=deleteMediaFiles('//amuz/amuz_media/".$_GET["dir"]."','".$vfilename[0]."')>Delete</a>
										</td>
									</tr>";
								}
							}

							$filesov = scandir($jspath);
							foreach($filesov as $imgfov)
							{
								$extn = explode('.',$imgfov);

								if(!file_exists($jspath.$extn[0].'.txt') && $imgfov != '.' && $imgfov != '..' && $imgfov != '' && isset($extn[1]) != '' && $extn[1] != 'jpeg' && $extn[1] != 'jpg' && $extn[1] != 'png')
								{
									echo "<tr>
										<td><img src='img/video_icon.png' width='50px' height='50px'> <b><i class='fa'>&nbsp;&nbsp;&nbsp;".$imgfov."</i></b></td>
										<td>".date('d M, Y',filectime($jspath.$imgfov))."</td>
										<td>".format_size(filesize($jspath.$imgfov))."</td>
										<td width='200px'>
										<a onclick=deleteMediaFiles('".$jspath."','".$imgfov."')>Delete</a>
										</td>
									</tr>";
								}
							}


							$files = scandir($jspath);
							foreach($files as $imgf)
							{
								$extn = explode('.',$imgf);
								if(!file_exists($jspath.$extn[0].'.mp4') && $imgf != '.' && $imgf != '..' && $imgf != '' && isset($extn[1]) != '')
								{
									echo "<tr>
										<td><img src='".$jspath.$imgf."' width='50px' height='50px'> <b><i class='fa'>&nbsp;&nbsp;&nbsp;".$imgf."</i></b></td>
										<td>".date('d M, Y',filectime($jspath.$imgf))."</td>
										<td>".format_size(filesize($jspath.$imgf))."</td>
										<td width='200px'>
										<a onclick=deleteMediaFiles('".$jspath."','".$imgf."')>Delete</a>
										</td>
									</tr>";
								}
							}
							 ?>

							</tbody>
						</table>
            
            <form name="myForm" id="myForm" method="post" action="uploadmedia.php" enctype="multipart/form-data">
              <table cellpadding="5" cellspacing="5" width="500px" class="table table-bordered table-hover">
                <tr>
                  <td><input type="file" name="uploaded_file" id="uploaded_file"class="btn btn-default btn-file" onchange="checkType(this.value)" /></td>
                  <input type="hidden" name="getdirpath" value="<?=$_GET['dir'];?>">
                </tr>
              </table>
              
              <input type="hidden" name="path" value="<?=$jspath?>">
              <div class="contain_box" style="display:none;">
                <table cellpadding="5" cellspacing="5" width="500px" class="table table-bordered table-hover">
                  <tr>
                    <td>Prefix</td>
                    <td><input type="text" name="prefix" id="prefix" value="" /><input type="hidden" name="passing" id="passing" value="" /></td>
                    <td>Thumbnail</td>
                    <td><input type="file" name="thumbnail" id="thumbnail" onchange="checkType2(this.value)" />
                      <div class="diserr" style="display:none;">Only jpg file is allow</div>
                    </td>
                  </tr>
                  <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" id="title" /></td>
                    <td>Description</td>
                    <td><textarea name="description" id="description"></textarea></td>
                  </tr>
                  <tr>
                    <td>Language</td>
                    <td><input type="text" name="language" id="language" /></td>
                    <td>Genre</td>
                    <td><input type="text" name="genre" id="genre" /></td>
                  </tr>
                  <tr>
                    <td>Rating</td>
                    <td><input type="text" name="rating" id="rating" /></td>
                    <td>Premium</td>
                    <td>
                      <select name="premium" id="premium">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>Roll Type</td>
                    <td>
                      <select name="roletype" id="roletype">
                        <option value="pre">Pre Roll</option>
                        <option value="mid">Mid Roll</option>
                        <option value="post">Post Roll</option>
                      </select>
                    </td>
                    <td>Ad Skip</td>
                    <td>
                      <select name="adskip" id="adskip">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                      </select>
                    </td>
                  </tr>
                  
                </table>
              </div>
              <table cellpadding="5" cellspacing="5" width="500px" class="table table-bordered table-hover">
                <tr>
                  <td><input type="submit" name="upload" class="btn btn-default" value="Upload"></td>
                </tr>
              </table>
            </form>
                    </div>
          
          <script>
            function checkType(val)
            {
              //alert(val);
              var getex = val.split('.');
              var ext = getex[1];
              if(ext == 'mp4' || ext == 'MP4')
              {
                $('.contain_box').show(100);
                $('#passing').attr('value', 'test');
              }
              else
              {
                $('.contain_box').hide(100);
                $('#passing').attr('value', '');
              }
                
            }
            function checkType2(val)
            {
              //alert(val);
              var getex = val.split('.');
              var ext = getex[1];
              if(ext != 'jpg')
              {
                $('.diserr').show(100);
              }
              else
              {
                $('.diserr').hide(100);
              }
                
            }
          </script>
          <?php
          }
          ?>
			</div>
                <!-- /.row -->
<?php include('footer.php');?>