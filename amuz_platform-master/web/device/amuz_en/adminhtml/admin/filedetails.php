<!DOCTYPE html>
<link rel="stylesheet" href="css/jquery.css">
<style>
.ui-dialog-titlebar-close {
   background-image:url('images/close.png');
}
</style>
<?php


function dirToArray($dir) {
  
   $result = array();

   $cdir = scandir($dir);
   foreach ($cdir as $key => $value)
   {
      if (!in_array($value,array(".","..")))
      {
         if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
         {
            $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
         }
         else
         {
            $result[] = $value;
         }
      }
   }
  
   return $result;
}


include('header.php');
include("scan.php");
include("scansingle.php");
include("foldersize.php");

include("includes/config.php");
$paths = scan(adpath);
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
$gtfile = $_GET['file'];
$imagepath = ROOTPATH.'/'.$_GET['dir'];
$linkpath = $_GET['dir'];
if($_GET['file'])
    $linkpath .= '&file='.$_GET['file'];
//echo $dirpath;
$adfiles = dirToArray(adpath);
$itempaths = scansingle($dirpath,$gtfile);

?>

<script src="js/jqueryui.js"></script>
        <div id="page-wrapper">
        
            <div class="container-fluid">

                <!-- Page Heading -->
                <?php
                $myfile = fopen($dirpath."/".$gtfile.".txt", "r") or die("Unable to open file!");
                $gfile = fgets($myfile);
                $exfile = explode('||',$gfile);
                ?>
                
                <div class="col-lg-12">
                        <h4 class="page-header"><?=$gtfile;?> details</h4>
                        
                        
                        
                        <form name="myForm" id="myForm" method="post" action="uploadmedia.php" enctype="multipart/form-data">
                            
                            <input type="hidden" name="path" value="<?=$jspath?>">
                            <input type="hidden" name="path11" value="<?=$linkpath?>">
                            <input type="hidden" name="path22" value="filedetails.php">
                            <input type="hidden" name="getdirpath" value="<?=$_GET["dir"].'&file='.$_GET["file"];?>">
							<input type="hidden" name="passing" id="passing" value="test" />
                            <div class="contain_box" style="display:block;">
                                <table cellpadding="5" cellspacing="5" width="500px" class="table table-bordered table-hover">
                                    <tr>
                                        <td>Prefix</td>
                                        <td><input type="text" name="prefix" id="prefix" readonly value="<?=$gtfile;?>" /></td>
                                        <td>Thumbnail</td>
                                        <td>
                                        <img src="<?=$imagepath.'/'.$gtfile.'.jpg'?>" width="100px">
                                        <br />
                                        <br />
                                        <input type="file" name="thumbnail" id="thumbnail" onchange="checkType2(this.value)" />
					     <input type="button" name="genthumbnail" id="genthumbnail" value="generate thumbnail" />
	
                                            <div class="diserr" style="display:none;">Only jpg file is allow</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Title</td>
                                        <td><input type="text" name="title" id="title"  value="<?=$exfile[2];?>"/></td>
                                        <td>Description</td>
                                        <td><textarea name="description" id="description"><?=$exfile[3];?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Language</td>
                                        <td><input type="text" name="language" id="language"  value="<?=$exfile[0];?>"/></td>
                                        <td>Genre</td>
                                        <td><input type="text" name="genre" id="genre"  value="<?=$exfile[1];?>" /></td>
                                    </tr>
                                    <tr>
                                        <td>Rating</td>
                                        <td><input type="text" name="rating" id="rating"  value="<?=$exfile[5];?>" /></td>
                                        <td>Premium</td>
                                        <td>
                                            <select name="premium" id="premium">
                                                <option value="1" <?php if($exfile[6] == '1') { echo "selected";}?> >Yes</option>
                                                <option value="0" <?php if($exfile[6] == '0') { echo "selected";}?>>No</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Roll Type</td>
                                        <td>
                                            <select name="roletype" id="roletype">
                                                <option value="pre" <?php if($exfile[7] == 'pre') { echo "selected";}?>>Pre Roll</option>
                                                <option value="mid" <?php if($exfile[7] == 'mid') { echo "selected";}?>>Mid Roll</option>
                                                <option value="post" <?php if($exfile[7] == 'post') { echo "selected";}?>>Post Roll</option>
                                            </select>
                                        </td>
                                        <td>Ad Skip</td>
                                        <td>
                                            <select name="adskip" id="adskip">
                                                <option value="1" <?php if($exfile[8] == '1') { echo "selected";}?>>Yes</option>
                                                <option value="0" <?php if($exfile[8] == '0') { echo "selected";}?>>No</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                            <td>Price</td>
                                            <td><input id="price" name ="price" type="text" value="<?=$exfile[10];?>" /></td>
                                            <td>Premium time</td>
                                            <td><input id="time" name ="time" type="text" value="<?=$exfile[11];?>" /></td>
                                            
                                    </tr>
									<tr>
                                            <td>Payment Option</td>
                                            <td>
												<select name="metadata1" id="metadata1">
													<option value="0" <?php if($exfile[12] == 0) { echo "selected"; }?>>Coupon</option>
													<option value="1" <?php if($exfile[12] == 1) { echo "selected"; }?>>Direct Billing</option>
													<option value="2" <?php if($exfile[12] == 2) { echo "selected"; }?>>Trial</option>
													<option value="3" <?php if($exfile[12] == 3) { echo "selected"; }?>>Time</option>
												</select>
											</td>
                                            <td>Something 2</td>
                                            <td><input id="metadata2" name ="metadata2" type="text" value="<?=$exfile[13];?>" /></td>
                                    </tr>
                                    <tr>
                                            <td>Ad Path</td>
                                            <td>
                                            <select name="adpath" id="adpath">
                                            <?php 
                                            foreach($adfiles as $adfile) {
                                            if($exfile[4] == $adfile){
                                             echo "<option value=".$adfile." selected>".$adfile."</option>";   
                                            }else{
                                            echo "<option value=".$adfile.">".$adfile."</option>";    
                                            }    
                                            
                                            }
                                            ?>
                                            </select><input id="opener" type='button' value="opener"/>

                                            </td>
                                            
                                            
                                    </tr>       
    
                                    <tr>
                                        <td><input type="submit" name="upload" class="btn btn-default" value="Update"></td>
                                    </tr>
                                </table>
                            </div>
                            
                        </form>
                        <input type="button" name="back" class="btn btn-default" value="Back" onClick="history.go(-1); return false;">
                    </div>
                <div id="dialog" title="Ad Preview">
     
		</div>
                <!-- /.row -->
<script>
    function editClass()
    {
        $('.contain_box').show(100);
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
$(function() {
	
    $( "#dialog" ).dialog({
	
      beforeClose: function(event, ui) {
	 $("#example_video_1")[0].pause();
	 },	
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });
 
    $( "#opener" ).click(function() {
	var sourcemedia = <?php echo adpath.'/'?>+$("#adpath").find('option:selected').text();
	$('#dialog').attr("title", sourcemedia);
	$("#dialog").html('<video id="example_video_1" src="" width = "100%" height="300" controls autoplay></video>'); 
	var vid = document.getElementById("example_video_1");
	vid.src=sourcemedia;
       $( "#dialog" ).dialog( "open" );
    });
  });

  $("#genthumbnail").click(function() {
	$.ajax({
							type: "POST",
							url: "generateThumbnail.php",
							data: {"path": '<?=$jspath?>', "name" : '<?php echo $gtfile ?>'},
							 success: function(data)
									 {
									alert(data);
									location.reload();
									 }
								 
							
						});




   });	

</script>

<?php include('footer.php');?>