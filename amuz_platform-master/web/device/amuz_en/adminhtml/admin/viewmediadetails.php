<!DOCTYPE html>
<link rel="stylesheet" href="css/jquery.css">

<script src="js/vastvideoplugin.js"></script>
<style>
.ui-dialog-titlebar-close {
   background-image:url('images/close.png');
}
</style>
<?php
include('header.php');
include("scan.php");
include("scansingle.php");
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
$gtfile = $_GET['file'];
$imagepath = ROOTPATH.'/'.$_GET['dir'];
$linkpath = $_GET['dir'];
if($_GET['file'])
    $linkpath .= '&file='.$_GET['file'];
//echo $dirpath;
$paths = scansingle($dirpath);
$itempaths = scansingle($dirpath,$gtfile);

?>
<script src="js/jqueryui.js"></script>
        <div id="page-wrapper">

            <div class="container-fluid">

                <?php
                $myfile = fopen($dirpath."/".$gtfile.".txt", "r") or die("Unable to open file!");
                $gfile = fgets($myfile);
                $exfile = explode('||',$gfile);
                //print_r($exfile);
                
                ?>
                
                <div class="col-lg-12">
                        <h4 class="page-header"><?=$gtfile;?> details</h4>
                        
                        
                        
                        <form name="myForm" id="myForm" method="post" action="uploadmedia.php" enctype="multipart/form-data">
                            
                            <input type="hidden" name="path" value="<?=$jspath?>">
                            <input type="hidden" name="path11" value="<?=$linkpath?>">
                            <input type="hidden" name="path22" value="filedetails.php">
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
                    <!--                    <input readonly type="file" name="thumbnail" id="thumbnail" onchange="checkType2(this.value)" /> -->
                                            <div class="diserr" style="display:none;">Only jpg file is allow</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Title</td>
                                        <td><input type="text" readonly name="title" id="title"  value="<?=$exfile[2];?>"/></td>
                                        <td>Description</td>
                                        <td><textarea name="description" readonly id="description"><?=$exfile[3];?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Language</td>
                                        <td><input readonly type="text" name="language" id="language"  value="<?=$exfile[0];?>"/></td>
                                        <td>Genre</td>
                                        <td><input type="text" readonly name="genre" id="genre"  value="<?=$exfile[1];?>" /></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Rating</td>
                                        <td><input type="text" readonly name="rating" id="rating"  value="<?=$exfile[5];?>" /></td>
                                        <td>Premium</td>
                                        <td>
                                            <select name="premium" id="premium" disabled>
                                                <option value="1" <?php if($exfile[6] == '1') { echo "selected";}?> >Yes</option>
                                                <option value="0" <?php if($exfile[6] == '0') { echo "selected";}?>>No</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Roll Type</td>
                                        <td>
                                            <select name="roletype" id="roletype" disabled>
                                                <option value="pre" <?php if($exfile[7] == 'pre') { echo "selected";}?>>Pre Roll</option>
                                                <option value="mid" <?php if($exfile[7] == 'mid') { echo "selected";}?>>Mid Roll</option>
                                                <option value="post" <?php if($exfile[7] == 'post') { echo "selected";}?>>Post Roll</option>
                                            </select>
                                        </td>
                                        <td>Ad Skip</td>
                                        <td>
                                            <select name="adskip" id="adskip" disabled>
                                                <option value="1" <?php if($exfile[8] == '1') { echo "selected";}?>>Yes</option>
                                                <option value="0" <?php if($exfile[8] == '0') { echo "selected";}?>>No</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                            <td>Price</td>
                                            <td><input id="price" name ="price" type="text" value="<?=$exfile[10];?>" readonly/></td>
                                            <td>Premium time</td>
                                            <td><input id="time" name ="time" type="text" value="<?=$exfile[11];?>" readonly/></td>
                                            
                                    </tr>
                                    <tr>
                                            <td>Payment Option</td>
											<?php
											if($exfile[12] == 0)
											{
												$paymentoption = "Coupon";
											}
											if($exfile[12] == 1)
											{
												$paymentoption = "Direct Billing";
											}
											if($exfile[12] == 2)
											{
												$paymentoption = "Trial";
											}
											if($exfile[12] == 3)
											{
												$paymentoption = "Time";
											}
											?>
                                            <td><input id="metadata1" name ="metadata1" type="text" value="<?=$paymentoption;?>" readonly/></td>
                                            <td>Premium time</td>
                                            <td><input id="metadata2" name ="metadata2" type="text" value="<?=$exfile[13];?>" readonly/></td>
                                            
                                    </tr>
                                    <tr>
                                        <td>Ad Path</td>
                                        <td><input type="text" readonly name="adpath" id="rating"  value="<?=$exfile[4];?>" /></td>
                                        
                                    </tr>   
                                </table>    
                                    
                                    
                                
                            </div>
                            <input type="button" name="back" class="btn btn-default" value="Back" onClick="history.go(-1); return false;">
			    <input type="button" name="preview" id="preview" class="btn btn-default" value="Show Preview">	
                        </form>
                    <!--    <input type="button" name="back" class="btn btn-default" value="Back" onClick="history.go(-1); return false;"> -->
	
                    </div>
         <div id="dialog" title="Media preview">
     		
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
 
    $( "#preview" ).click(function() {
    	 
	var sourcemedia = "<?php echo$dirpath."/".$gtfile.".mp4"; ?>";
	$('#dialog').attr("title", sourcemedia);
	$("#dialog").html('<div class="vidtag" style="margin-top:10px;position:relative;background:#000;"><video id="example_video_1" src="" width = "100%" height="300" controls autoplay ads = \'{"servers": [{"apiAddress": "vod/testads2.xml", "adURL":"<?php echo adpath."/".$exfile[4]?>"}],"schedule": [{"position": "<?php echo $exfile[7]."-roll"?>","startTime": "00:00:03"}]}\'></video><span class="skipBtn">Skip</span></div>'); 
	var vid = document.getElementById("example_video_1");
	vid.src=sourcemedia;
	initAdsFor("example_video_1");
      $( "#dialog" ).dialog( "open" );
    });
  });
</script>

<?php include('footer.php');?>