<?php 
include("includes/header_play.php"); 
include("includes/class_encription.php");
include("includes/functions.php");
include("includes/config.php");
?>
<style type="text/css">
    body{margin: 0;}

</style>
<script src="js/jquery.simplePopup.js" type="text/javascript"></script>
<link href="css/style_pop.css" rel="stylesheet" />
<!-- Piwik -->
<div class="loader">Loading...</div>
<?php
//print_r($_SESSION);
/* if (isset($_COOKIE['amuzphntkn'])){ */
   
    if ( ! isset($_GET["nlink"])) {
        $_GET["nlink"] = null;
     }  
$nlink = $_GET["nlink"];

$dicrptlink = encrypt_decrypt('decrypt', $nlink);

$arrdicptlink = explode('&',$dicrptlink);
//print_r($arrdicptlink);
if ( ! isset($arrdicptlink[0])) {
    $arrdicptlink[0] = null;
 }
$list = str_replace('list=','',$arrdicptlink[0]);
//print_r($list);die;
if ( ! isset($arrdicptlink[1])) {
    $arrdicptlink[1] = null;
 }
$title = str_replace('title=','',$arrdicptlink[1]);

if ( ! isset($arrdicptlink[2])) {
    $arrdicptlink[2] = null;
 }
$meta_path = str_replace('meta_path=','',$arrdicptlink[2]);
//print_r($arrdicptlink[2]);die;
if ( ! isset($arrdicptlink[3])) {
    $arrdicptlink[3] = null;
 }
$media = str_replace('media=','',$arrdicptlink[3]);
if ( ! isset($arrdicptlink[4])) {
    $arrdicptlink[4] = null;
 }
$img_path = str_replace('img_path=','',$arrdicptlink[4]);
//print_r('images_path'.$img_path);die;
if ( ! isset($_COOKIE["couponstatus"])) {
    $_COOKIE["couponstatus"] = null;
 }
	   
if($_COOKIE["couponstatus"] == "")
{
    $cnt = 5;
}
else
{
    $cnt = 1;
}

//print_r($_COOKIE);

$ad_path = "";
$adenable = "no";
$roll_type = "pre";
$skip_flag = "0";    
if(isset($media)){ 
	           
            $title = $title;
            $img_path = urldecode($img_path);
            $media_path = str_replace("%2F","/",urldecode($media));
         //   print_r($media_path);die;
            if($meta_path){  
               // print_r($meta_path);die;
                //print_r($meta_path);print_r('asfsaf');die;
               // print_r($media_path);die;
                $meta_str = @file_get_contents(urldecode($meta_path));
                $med_arr = explode("||", $meta_str);
                if(! isset($med_arr[4])){
                    $med_arr[4]=null; 
                }
                $ad_path = $med_arr[4];
                if(! isset($med_arr[7])){
                    $med_arr[7]=null; 
                }
                $roll_type = $med_arr[7];
                if(! isset($med_arr[8])){
                    $med_arr[8]=null; 
                }
                if(! isset($med_arr[8])){
                    $med_arr[8]=null; 
                }
                $skip_flag = $med_arr[8];
                // redirect if password enabled and not set 
                if(! isset($med_arr[2])){
                    $med_arr[2]=null; 
                }
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
                if($ad_path == "" && $ad_path == "no" ){
                    $adenable = "no";    
                } else if(file_exists(ADPATH.'/'.$ad_path)){
                        $adenable = "yes";    
                    
                }

                
            }  
            else{
                $adenable = "no";
                $ad_path = "";
            }
    } else {
        header("Location:media.php");
    }
    $roll_type.="-roll";
   // print_r($media_path);die;	
    ?>
    <!-- if cookie available -->
    <div class="container">
   

 <div class="row">
    <?php 
        $media_info = pathinfo($media_path);
        if ( ! isset($media_info['extension'])) {
            $media_info['extension'] = null;
         } 
        $med_extn = $media_info['extension']; 
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
            if ( ! isset($_GET['ssd'])) {
                $_GET['ssd'] = null;
             }
             
            $token_encrypted = encrypt_decrypt('encrypt', $media_path.'_tvt_s'.base64_decode($_GET['ssd']));             
//$token_encrypted = base64_encode($media_path);    
//echo $adenable;
           if($adenable == "yes"){
             
         
              
    ?> 
    <div class="vidtag"  style="margin-top:10px;position:relative;background:#000;">   
        <video id="example_video_1" width = "100%" height="300" controls autoplay onended="videoEnded(this.src)"
        src="<?php echo $media_path; ?>"
          ads = '{"servers": [
                                 {
                                   "apiAddress": "vod/testads2.xml",
                                   "adURL":"<?php echo ADPATH.'/'.$ad_path ?>"
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
        <span class="skipBtn">Skip</span> 
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
        <video id="example_video_1" width = "100%" height="300" controls autoplay>
            <source src="<?php echo $media_path;?>">
        </video>           
        <span class="skipBtn">Skip</span>           
    </div>
<?php
//echo 'sssssssssssssssssssss'.$_SESSION["mobileVerification"];
if(! isset($_COOKIE["mobileVerification"])  && $_COOKIE["couponstatus"] == "" && $med_extn != "mp3")
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
        <?php if ( ! isset($med_arr[2])) {
           $med_arr[2] = null;
          } ?>
            <div class="row-data"><div class="r-h">Title:</div><div class="r-d"><?php echo $med_arr[2]; ?></div></div>
           <?php if(isset($meta_path)){ ?> 
            <?php if ( ! isset($med_arr[5])) {
           $med_arr[5] = null;
          } ?>
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
                    <?php  if ( ! isset($_COOKIE["mobileNum"])) {
   $_COOKIE["mobileNum"] = null;
}    ?>
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

if ( ! isset($_COOKIE["couponcode_check"])) {
    $_COOKIE["couponcode_check"] = null;
 }
if($_COOKIE["couponcode_check"] != "" && $med_extn != "mp3")
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
if ( ! isset($_COOKIE["mobileVerification"])&&! isset($_COOKIE["askverification"])) {
    $_COOKIE["mobileVerification"] = null;
    $_COOKIE["askverification"] = null;

 }
if(! isset($_COOKIE["mobileVerification"]) && $_COOKIE["askverification"] != "no" && registrationflow != 0 && $med_extn != "mp3")
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
                //alert(json);
                if(json.mval == 1 && couponcode_master == "" && couponstatus == "" && registrationflow != 0 && $med_extn != "mp3")
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