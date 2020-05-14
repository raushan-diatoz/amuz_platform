<?php 
include("includes/header_play.php"); 
include("includes/class_encription.php");
include("includes/functions.php");
#include("includes/config.php");

?>
<style type="text/css">

    body{margin: 0;}

</style>
<script src="js/jquery.simplePopup.js" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="js/vastvideoplugin.js"></script>
    <link rel="stylesheet" type="text/css" href="css/site.css">
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    
<link href="css/style_pop.css" rel="stylesheet" />
<!-- Piwik -->
<div class="loader">Loading...</div>
<?php
//print_r($_SESSION);
/* if (isset($_COOKIE['amuzphntkn'])){ */

$nlink =  "K2J5M1ZCbE90MTB3NzR3Z3V5QTNvM1cxZFgrM3daeXhLbndPRVdCZDAxTEZtUjJKZjNBbHBPMlVNaWwzb1BFd1RZbkpKeitrMFF0b0xmZXV1b0wwQzF2R3JqelZWZHpZUU1LaHhaMllWdnFCR25tYkRZa1BoT0MrMzI0OFNKd05STzF4ak5laFQ4MHIxaWdpZnNSbGR6SWhndWZDYW00cU81MXVCMmR5VWxZTEpBU3BIRDZjbzQwOHhoeDNtTDVzUzIyejlEN3g0Qmgvc1R6d0JBVzlVUFRFL0pyZFlwNXQvYmRIaXRtaVV1VitaQjROUGFCNWp1L05sZ1RWN09nYmdmTklTUlpJc1hNdWhmK3ZhTXVOY1RSL2xXTFFTZWo4UmdqZFlxV0liTWNyQ1RFY1BPcVJLcUFibnR3b3RGa1ozbTljMUYvSEVWRi9lckt2dUZIanY1MUpsUlN5U2k3aDN1clpzZW1zSGVYRml0VEY0amwrQ0JNNy9aZXdwdUpIL3d1UkU0czZ1a1F4ZDhwRlVHRDN1N0NCMTYxdDFUMWFJd0FTM3RuV3d6dnZuc1A5TDFxbVc5T1lXZWkvdWJlTCtlb2xoQzdZV3cxNnFnVVY3NTYyZXZ1RWlXOFJFSXY5VjZFb29OODBrbk4ySnQzY1dpR1VyVFdRUklJUlhrZkFtNUsxWVBqSlVRLzIydHhLQTM1UnEyaDByVlErUTFiZVNHY1duVnR4N0ZiWDFJdEptSTdaM0YzTmE3VktON1lET1NKZktzKzlpWDFXem1wTjJybndmbklhNlZ3TEFSZGR2Y3pJOUQxYldBVmFDU1RQdzl0amwyc1d3a0pkaGlic2ZjSHJXei9IUDFwVkNkZXozUzFCV1YvSXFXTWVzWm5jaldGME5UQ0lmVUFVRXlndGEzWjdZVXhGb01FaTR5ZnB4OWlscndQSU1BVkdXV3o4N3hPUXZlU3lLdEIySGVxTHBLRHFBaWk1VnBFPQ";
# $_GET["nlink"];
#$dicrptlink =  "list=E:/Raushan/amuz_platform-master/amuz_media&title=Sample Video&meta_path=E:/Raushan/amuz_platform-master/amuz_media/SampleVideo_1280x720_1mb.mp4&media=E:/Raushan/amuz_platform-master/amuz_media&img_path=E:/Raushan/amuz_platform-master/amuz_media";
$dicrptlink =encrypt_decrypt('decrypt', $nlink);

$arrdicptlink = explode('&',$dicrptlink);
//print_r($arrdicptlink);
$list = str_replace('list=','',$arrdicptlink[0]);

$title = str_replace('title=','',$arrdicptlink[1]);
#$meta_path = str_replace('meta_path=','',$arrdicptlink[2]);
$meta_path = str_replace('meta_path=','','E:/Raushan/amuz_platform-master/amuz_media/SampleVideo_1280x720_1mb.txt');
#$media = str_replace('media=','',$arrdicptlink[3]);
$media = str_replace('media=','','E:/Raushan/amuz_platform-master/amuz_media/SampleVideo_1280x720_1mb.mp4');
#$img_path = str_replace('img_path=','',$arrdicptlink[4]);
$img_path = str_replace('img_path=','','E:/Raushan/amuz_platform-master/amuz_media/SampleVideo_1280x720_1mb.jpg');

	   
/*if($_COOKIE["couponstatus"] == "")
{
    $cnt = 5;
}
else
{
    $cnt = 1;
}*/
$cnt = 1;
//print_r($_COOKIE);

$ad_path = "";
$adenable = "no";
$roll_type = "pre";
$skip_flag = "0";
$med_extn = "mp4";    
if(isset($media)){ 
	           
            $title = $title;
            $img_path = urldecode($img_path);
            $media_path = str_replace("%2F","/",urldecode($media));
            if(isset($meta_path)){  
             
                $meta_str = file_get_contents(($meta_path));
                $med_arr = explode("||", $meta_str);
                $ad_path = $med_arr[4];
                $roll_type = $med_arr[7];
                $roll_type = $med_arr[7];
                $skip_flag = $med_arr[8];
                // redirect if password enabled and not set 
                $titleval = $med_arr[2];
                $ntime = time();
                $nmediafile = str_replace(" ","",$med_arr[2]);
		
		if(isset($_COOKIE["couponcode_master"]) && $ntime > $_COOKIE["couponcode_master"])
                {
		   
                    /* $_SESSION["couponcode_master"] == "";
                    unset($_SESSION["couponcode_master"]); */
					setcookie("couponcode_master", "", time() - 3600);
                }
                if(isset($_COOKIE["sesiontimeend_".$nmediafile]) && $ntime > $_COOKIE["sesiontimeend_".$nmediafile] && $_COOKIE["sesiontimeend_".$nmediafile] != "")
                {
		    	
                    /* $_SESSION["sesiontimeend_".$nmediafile] = "";
                    $_SESSION["videotitle_".$nmediafile] = "";
                    unset($_SESSION["sesiontimeend_".$nmediafile]);
                    unset($_SESSION["videotitle_".$nmediafile]); */
					
					setcookie("sesiontimeend_".$nmediafile, "", time() - 3600);
					setcookie("videotitle_".$nmediafile, "", time() - 3600);
                }
                if(!isset($_COOKIE["couponcode_master"]) && couponflow == 1)
                {
		     		
                    if(isset($med_arr[6]) && $med_arr[6] == "1"){               
                        if($ntime > $_COOKIE["sesiontimeend_".$nmediafile] || $_COOKIE["videotitle_".$nmediafile] != $med_arr[2])
                        {
                             $media_path = "";
                        }
                

                       /* if(isset($_SESSION['mediapwd'])){                 
                            if (!in_array($titleval, $_SESSION['mediapwd'])) { // check session value exists
                                $popup_enable = "yes";
                            }
                        }
                        else{
                            $popup_enable = "yes";
                        } */
                    }
                } 
             //   if($ad_path == "" && $ad_path == "no" ){
                    $adenable = "no";    
              /*  } else if(file_exists(ADPATH.'/'.$ad_path)){
                        $adenable = "yes";    
                    
                }*/

                
            }  
            else{
                $adenable = "no";
                $ad_path = "";
            }
    } else {
        header("Location:media.php");
    }
    $roll_type.="-roll";
    	
    ?>
    <!-- if cookie available -->
    <div class="container">
   

 <div class="row">
    <?php 
        $media_info = pathinfo($media_path); 
        $med_extn = 'mp4'; #$media_info['extension']; 
        if($med_extn == "mp3"){
    ?>
    <div style="margin-top:10px;position:relative;text-align:center;">  
        <div class="player">
            <div class="pl"></div>
            <div class="title"></div>
            <div class="cover"></div>
            <div class="controls">
                <div class="play"></div>
                <div class="pause"></div>
                <div class="rew"></div>
                <div class="fwd"></div>
            </div>
            <div class="volume"></div>
            <div class="tracker"></div>
        </div>
        <ul class="playlist">
            <li audiourl="<?php echo str_replace("+"," ",$media_path); ?>" cover="cover1.jpg" artist="Artist 1"><?php echo $title; ?></li>            
            <?php 
                if($aud_list = audio_playlist(encrypt_decrypt('decrypt',$list))){
                    foreach ($aud_list as $value) {
                        $file_info = pathinfo($value);
                        if($title != $file_info['filename']){
                            
            ?>
                <li audiourl="<?php echo str_replace("+"," ",encrypt_decrypt('decrypt',$list).'/'.$value); ?>" cover="" artist=""><?php echo $file_info['filename']; ?></li>       
            <?php
                    }
                    }
    ?>
                    
<script type="text/javascript">
    
	$.ajax({
        type: "GET",
        url: "piwikload.php?mpath=<?=encrypt_decrypt('encrypt', $media_path);?>&dsk=<?=DSK;?>&title=<?=$title;?>&type=audio"     
    });
</script>
    <?php
                } 
            ?>   
        </ul>
    </div>
    <?php 
        } else {
            $media_path = str_replace("+"," ",$media_path);
            
            $token_encrypted = encrypt_decrypt('encrypt', $media_path.'_tvt_s'.base64_decode('dDl0aDBnazZoYnFlYTU3aTB2bzA5ajZrNzU'));             
//$token_encrypted = base64_encode($media_path);    
//echo $adenable;
           if($adenable == "yes"){
             
         
              
    ?> 
    <div class="vidtag"  style="margin-top:10px;position:relative;background:#000;">   
        <video id="example_video_1" width = "100%" height="300" controls autoplay onended="videoEnded(this.src)"
        src="http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4"
          ads = '{"servers": [
                                 {
                                   "apiAddress": "vod/testads2.xml",
                                   "adURL":"http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4"
                                 }
                             ],
                    "schedule": [
                                  {
                                    "position": "<?php echo $roll_type?>",
                                    "startTime": "00:00:03"                                                                               
                                                                           
                                  }
                                ]
                }'> 
        </video>
        <?php
        if($skip_flag == "1"){
        ?>    
        <span class="skipBtn">Skip1</span> 
        <?php }
        ?> 
<?php
//print_r($_SESSION);
//echo 'dddddddddddddddddd'.$_SESSION["mobileVerification"];
//if(! isset($_SESSION["mobileVerification"]))

//{
?>

<?php
//}
?>      
    </div>
    <?php } else { ?>

    <div class="vidtag"  style="margin-top:10px;position:relative;background:#000;">   
    <!--   <video id="example_video_1" width = "100%" height="300" controls autoplay>
            <source src="http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4">
   -->


            <video id="example_video_1" src="http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4" width = "100%" height="300" controls  
    ads = '{"servers":[
                           {"apiAddress": "vod/testads1.xml",
                            "adURL":"http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4"
                            }
                         ],
               "schedule":[
                            {"position":"pre-roll",
                                "startTime": "00:00:03"  }
                          ]
              }'>
        </video>






       <!-- </video>         
        <span class="skipBtn">Skip2</span>   -->          
    </div>
    <span class="skipBtn">Skip</span>
     </center>
<script>initAdsFor("example_video_1");</script>
<?php
//echo 'sssssssssssssssssssss'.$_SESSION["mobileVerification"];
#if(! isset($_COOKIE["mobileVerification"])  && $_COOKIE["couponstatus"] == "" && $med_extn != "mp3")
if($med_extn != "mp3")
{
?>
<script type="text/javascript">
    /* var timesRun = 0;
    var interval = setInterval(function(){
    timesRun += 1;
    if(timesRun === <?=$cnt?>){
        clearInterval(interval);
    }
        //do whatever here..
        $('#pop2').simplePopup();
        $("#mphone").val(phn);
    }, 10000);  */
</script>   
<?php
}
?>      

    <?php 
        }  
        
    ?>
<div id="pop1" class="simpepopupplay">
                <!-- <p>Choose an option to watch this video</p> -->
                <input id="yippster" type="button" value="pay via yippster" style="display:none"/>
                <input id ="coupon" type="button" value="I have Coupon" style="display:none"/>
                <div id='couponcode'>
                <form method="post" action="" onsubmit="return saveMobile()">
                <p id="errmsg"></p>
                <p>*Please enter your mobile number</p>
                      <input style="width:100%;" type="text" maxlength="10" onkeypress='return isNumberKey(event)' value="" name="phn" id="phn" placeholder="Mobile Number"/> 
                      <input type="submit" value="submit" id="tick_submit"/>
                  </form>
                </div>
      </div>
      
        <div class="desc-blk">
            <div class="row-data"><div class="r-h">Title:</div><div class="r-d"><?php echo $med_arr[2]; ?></div></div>
           <?php if(isset($meta_path)){ ?> 
            <div class="row-data"><div class="r-h">Rating:</div><div class="r-d"><?php echo "<span class='stars'>".$med_arr[5]."</span>(".$med_arr[5]."/10)"; ?></div></div>
            <?php } ?>
        </div>

        <div class="media-list">
            <?php
                if(isset($list)){ 
            // echo encrypt_decrypt('decrypt', $list);                     
                    $res = scan(encrypt_decrypt('decrypt', $list)); 
              //print_r($res);  
                }
                foreach ($res as $inarray) {
                    if($inarray['type'] == "file"){
                        medfilelist($inarray,$list);
                    }
                }
        ?> 
        </div>
</div>
<script type="text/javascript">
    $.ajax({
        type: "GET",
	url: "piwikload.php?mpath=<?=encrypt_decrypt('encrypt', $media_path);?>&ad_path=<?=encrypt_decrypt('encrypt', $ad_path)?>&dsk=<?=DSK;?>&title=<?=$med_arr[2];?>&type=video<?php if(isset($_COOKIE["couponcode_".$nmediafile])) {?>&coupon=<?php echo $_COOKIE["couponcode_".$nmediafile]; }?><?php if(isset($_COOKIE["sessionmobile"])) {?>&contactnum=<?php echo $_COOKIE["sessionmobile"]; }?>"     
    });
</script>

    <?php } ?>

    </div>
    <div id="pop2" class="simpepopupplay">
                <!-- <p>Choose an option to watch this video</p> -->
                <form method="post" action="" onsubmit="return saveMobile1()">
					<p id="errmsgs"></p>
					<p>*Please enter the verification code that sent to your mobile</p>
					<input style="width:100%;" type="text" name="vcode" id="vcode" value="" placeholder="Key"/> 
					<input style="width:100%;" type="hidden" name="mphone" id="mphone" value="<?=$_COOKIE['mobileNum']?>" placeholder="Key"/> 
					<input type="submit" value="submit" id="tick_submit" />
				</form>
                </div>
    <?php
 /* } else {
    ?>



<div class="container">
 <div id="pop1" class="simpepopupplay">
                <form method="post" action="phnnumcookie.php" onsubmit="return setcookie()">
                <p id="errmsg"></p>
                <p>*Please enter the Phone Number</p>
                      <input style="width:100%;" name="phone" id="phone" placeholder="Enter Your Phone Number"/> 
                      <input type="submit" value="submit"/>
                  </form>
                
</div>
</div>
 <?php   

 }  */  
 //print_r($_SESSION);
?>        
<?php
#if($_COOKIE["couponcode_check"] != "" && $med_extn != "mp3")
if($med_extn != "mp3")
{
?>
<script type="text/javascript">
var intervalecpn = setInterval(function(){
	ckcoupononline();
}, 10000 );

function ckcoupononline(){
	
	var cpn = "<?=$_COOKIE["couponcode_check"]?>";
	$.post("checkservercpn.php",
		{
			pwd: cpn, 
			title: "<?=$med_arr[2]?>",
		},
		function(data,status){
		//alert(data);
         //do whatever here..
			if(data == "yes")
			{	 
				clearInterval(intervalecpn);
			}
			else if(data == "unset")
			{
				alert("Your coupon code is not valid");
				url = "http://amuze.co.in:8283/index.php";
				$(location).attr('href',url);
			}
			else
			{
				
			}
		
		}
	);
}
</script>
<?php	
}
?>
<script type="text/javascript">


<?php
if(!isset($_COOKIE["mobileNum"]) && isset($_COOKIE["sessionmobile"]) && registrationflow != 0 && $med_extn != "mp3")
{
?>
window.onload = function() {
   withintrvl();
};
var intervale = setInterval(function(){
		withintrvl();
}, 10000 );

function withintrvl(){
	
	var phn1 = <?=$_COOKIE["sessionmobile"]?>;
	$.post("checklocalphndata.php",
		{
			phn1: phn1, 
		},
		function(data,status){
		//alert(data);
         //do whatever here..
			if(data == "")
			{	 
				$.post("checkconnection.php",
				{
				  
				},
				function(data,status){
					//alert(data);
					if(data == "Connected")
					{
						getres = saveMobileFromCookie();
						if(getres != "")
						clearInterval(intervale);
					}
				}
				
				);
			}
			if(data == "yes" || data == "verify")
			{
				clearInterval(intervale);
			}
		
		}
	);
		
}
<?php
}
?>
 function setcookie(){
    var phone = $("#phone").val();
    $.post("phnnumcookie.php",
        {
          phone: phone,    
        },
        function(data,status){          
            if(data == "yes"){
             location.reload();
            }
            else{
              $("#errmsg").html("Invalid password");
            }
        }
    );
    return false;
}
<?php
if(isset($_COOKIE["sessionmobile"]))
{
?>
function saveMobileFromCookie(){
    //var phn1 = $.session.get("cookiemobile");
    	
    var phn1 = <?=$_COOKIE["sessionmobile"]?>;
    //alert(phn1);
    
     $.post("save_contact.php",
        {
          phn1: phn1,    
        }, 
        function(data,status){ 
            
            if(data == "yes"){
                /* $('#pop2').simplePopup();
                $("#mphone").val(phn); */
                var url = $(".hrefloc").attr("href");
                $(location).attr('href',url);
            }
            else if(data == "verify"){
                var url = $(".hrefloc").attr("href");
                $(location).attr('href',url);
            }
	    else if(data.startsWith = "no"){
		//alert(data);
	    }	
            else{
              $("#errmsg2").html("This field can not be empty.");
              $( "#phn" ).focus();
              $( "#phn" ).css("border","2px solid red");
            }
        }
    );
    return phn1;
}
<?php
}
?>
function saveMobile(){
    var phn = $("#phn").val();
    $.post("save_contact.php",
        {
          phn1: phn,    
        },
        function(data,status){ 
           
            if(data == "yes"){
                $('.simplePopupClose').click();
            }
            else if(data == "verify"){
                $('.simplePopupClose').click();
            }
	   	
            else{
              $("#errmsg").html("Invalidcccccccccc");
            }
        }
    );
    return false;
}

function saveMobile1(){
    var vcode = $("#vcode").val();
    var mphone = $("#mphone").val();
    //alert(vcode);
    $.post("mobile_verification.php",
        {
          vcode: vcode,    
          mphone: mphone,    
        },
        function(data,status){          
            //alert(data);
            if(data == "yes"){
                $('.simplePopupClose').click();
            }
            else{
              $("#errmsgs").html("Invalid verification code");
               $( "#vcode" ).focus();
              $( "#vcode" ).css("border","2px solid red");
              <?php
              if(INVALIDOTP == 1)
              {
              ?>
                setTimeout(function() {
                    window.location.href = "<?=webserviceurl?>";
                }, 5000);
                <?php
              }
              ?>
            }
        }
    );
    return false;
}
</script>
<?php
#if(! isset($_COOKIE["mobileVerification"]) && $_COOKIE["askverification"] != "no" && registrationflow != 0 && $med_extn != "mp3")
if($med_extn != "mp3")
{
?>
<script type="text/javascript">
    var couponcode_master = '<?=$_COOKIE["couponcode_master"]?>';
    var couponstatus = '<?=$_COOKIE["couponstatus"]?>';
    var registrationflow = '<?=registrationflow?>';
    var timesRun = 0;
    var interval = setInterval(function(){
        timesRun += 1;
        if(timesRun === <?=$cnt?>){
            clearInterval(interval);
		}
        //do whatever here..
        $.post("checksession.php",
            {
              
            },
            function(data,status){   
                //alert(data);
                var json = jQuery.parseJSON(data);
               
                if(json.mval == 1 && couponcode_master == "" && couponstatus == "" && registrationflow != 0)
                {
					$.post("checkconnection.php",
						{
						  
						},
						function(data,status){
							if(data == "Connected")
							{
								$('#pop1').simplePopup();
							}
						}
					);
                    
				}
                if(json.mval != 1 && json.mval != "2")
                {
                    //alert(data);
                    $('#pop2').simplePopup();
                    $("#mphone").val(json.mnum);
					<?php
					if($cnt == 1)
					{
						$_COOKIE["askverification"] = "no";
					}
					?>
                }
            }
        );
       
    }, <?php echo invalidotptimeout."000"?>);

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
initAdsFor("example_video_1"); 
</script>
<?php
}
?>
<script type="text/javascript">
$(window).load(function() {
	$(".loader").fadeOut("slow");
})
</script>
<?php include("includes/footer.php"); ?>