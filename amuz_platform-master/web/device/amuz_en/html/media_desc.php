<?php
function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}
function base64_url_encode($val) {
    return base64_encode($val);
}
session_start();
session_regenerate_id();
include("includes/header.php"); 
include("includes/class_encription.php");
  $nlink = $_GET["nlink"];
  $dicrptlink = encrypt_decrypt('decrypt', $nlink);
  $arrdicptlink = explode('&',$dicrptlink);
  //print_r($arrdicptlink);
  $list = str_replace('list=','',$arrdicptlink[0]);
  $title = str_replace('title=','',$arrdicptlink[1]);
  $meta_path = str_replace('meta_path=','',$arrdicptlink[2]);
  $media = str_replace('media=','',$arrdicptlink[3]);
  $img_path = str_replace('img_path=','',$arrdicptlink[4]);
  
//print_r($_COOKIE);
?>
<script src="js/jquery.simplePopup.js" type="text/javascript"></script>
<script src="js/paychamp-hmac.js" type="text/javascript"></script>

<link href="css/style_pop.css" rel="stylesheet" />

<?php 
session_start();
include("includes/functions.php");?>
<!DOCTYPE html>
<html>
<div class="container">
    <div class="row">
      <?php if(isset($meta_path)){ 
        $image_path = urldecode($img_path);       
        $media_path = urldecode($media);   
        $meta_path =  urldecode($meta_path);    
        $met_str = file_get_contents($meta_path);
        $med_arr = explode("||",$met_str);
        $list_path = $list;
        $title= $title;
      
      $ntime = time();
      $nmediafile = str_replace(" ","",$med_arr[2]);
	if($ntime > $_COOKIE["sesiontimeend_".$nmediafile] && $_COOKIE["sesiontimeend_".$nmediafile] != "")
      {
    		setcookie("sesiontimeend_".$nmediafile, "", time() - 3600);
		setcookie("videotitle_".$nmediafile, "", time() - 3600);
      }
      
        $popup_enable = "no";
        // check if password enabled
            $titleval = $med_arr[2];
            if(isset($med_arr[6]) && $med_arr[6] == "1"){             
        if($ntime > $_COOKIE["sesiontimeend_".$nmediafile] || $_COOKIE["videotitle_".$nmediafile] != $med_arr[2])
        {
          $popup_enable = "yes";
        }
        }
            
            //ends here
      $list_path = $dicrptlink;
      //$list_path"&title=".$title."&img_path=".$image_path."&media=".$media_path."&meta_path=".$meta_path;
      $nlink = $nlink."&ssd=".base64_encode(session_id());
      ?>
      <div class="cont-blk">
        <div class="img-blk">
          <a class="<?php if($popup_enable == 'yes' && $_COOKIE["couponcode_master"] == '' && couponflow == 1) { echo 'show1 '; } elseif($_COOKIE["mobileNum"] == '' && $_COOKIE["sessionmobile"] == '' && $_COOKIE["couponstatus"] == "" && $_COOKIE["couponcode_master"] == '' && registrationflow != 0) { echo 'show2 ';} else { echo ' show3'; } ?> hrefloc" href='<?php echo "play.php?nlink=$nlink"; ?>'>
          <img src="<?php echo $image_path; ?>" />
          <span class="play-icon"><img src="images/play.png"/></span>
          </a>
          <?php
          if(isset($med_arr[6]) && $med_arr[6] == "1")
          {
          ?>
          <span class="premioum-icon">Premium</span>
          <span class="premioum-cost">Rs. <?=$med_arr[10];?>/-</span>
          <?php
          }
          ?>
        </div>
        <div class="desc-blk">
          <div class="row-data"><div class="r-h">Title:</div><div class="r-d"><?php echo $med_arr[2]; ?></div></div>
          <div class="row-data"><div class="r-h">Description:</div><div class="r-d"><?php echo $med_arr[3]; ?></div></div>
          <div class="row-data"><div class="r-h">Type:</div><div class="r-d"><?php echo $med_arr[1]; ?></div></div>
          <div class="row-data"><div class="r-h">Language:</div><div class="r-d"><?php echo $med_arr[0]; ?></div></div>
          <div class="row-data"><div class="r-h">Rating:</div><div class="r-d"><?php echo "<span class='stars'>".$med_arr[5]."</span>(".$med_arr[5]."/10)"; ?></div></div>
          <div class="row-data" style="text-align:center;margin:30px 0;">
            <a class="o-btn <?php  if($popup_enable == 'yes' && $_COOKIE["couponcode_master"] == '') {  echo ' show1'; } elseif($_COOKIE["mobileNum"] == '' && $_COOKIE["couponstatus"] == "" && $_COOKIE["couponcode_master"] == '' && registrationflow != 0) { echo ' show2'; } else { echo ' show3'; } ?> hrefloc" href='<?php echo "play.php?nlink=$nlink"; ?>'>Play</a>
          </div>
        </div>
      </div>
      <?php } else {        
        header("Location:media.php");
        } ?>
        
        <div id="pop1" class="simplePopup">
               <div id='couponcode'>
               <form method="post" name="couponphone" action="" onsubmit="return CheckPwd()">
               <p>*Choose an option to watch this video</p>
		<input type="radio" name="paymentmethod" value="couponradio">I have a coupon<br>
		<?php if(paymentoption == 1){ ?>
		<a id="yippster"> <input type="radio" name="paymentmethod" value="directradio">Direct Billing</a><br>
		<input type="radio" name="paymentmethod" value="paychampradio">Paychamp
		<?php } ?>
               </div>
           <div id="coupondiv" style="display:none">
                <p id="errmsg"></p>
                <p>*Please enter your coupon code</p>
                      <input  style="width:100%;" type="password" name="pwd" id="pwd" placeholder="Coupon Code"/> 
                </div>
              <?php
               if(!isset($_COOKIE["mobileNum"])  && registrationflow != 0)
               {
               ?>
                <p>Please enter your mobile number (optional)</p>
				<p id="errmsgphn"></p>
                      <input style="width:100%;" type="text" maxlength="10" onkeypress='return isNumberKey(event)' value="" name="phn" id="phn" placeholder="Mobile Number"/> 
                <?php
               }
				else
				{
					?>
					<input style="width:100%;" type="hidden" value="<?=$_COOKIE["mobileNum"]?>" name="phn" id="phn" /> 
					<?php
				}
               ?> 
<input type="submit" value="submit" id="tick_submit" style="display:none" />
                 </form>
                </div>
        </div>
      <div id="pop2" class="simplePopup">
                <!-- <p>Choose an option to watch this video</p> -->
                <div id='couponcode'>
               <form method="post" action="" onsubmit="return validatephn(0)">
                <p id="errmsg2"></p>
                <p>*Please enter your mobile number</p>
                      <input style="width:100%;" type="text" maxlength="10" onkeypress='return isNumberKey(event)' value="" name="phn1" id="phn1" placeholder="Mobile Number"/> 
                      <input type="submit" value="submit" id="tick_submit" />
                  </form>
        
                </div>
      </div>
    </div>
</div>
<style>
label {
  width: 200px;
  border-radius: 3px;
  border: 1px solid #01A0B3
} 
.simplePopup p{font-size: 11px;}
#errmsg{color: #FF0000;}
#errmsgphn{color: #FF0000;}
</style>
<script type="text/javascript">

$('.show1').click(function(){
  $('#pop1').simplePopup();
  return false;
});

$('.show2').click(function(){
  $('#pop2').simplePopup();
  return false;
});

$('.show3').click(function(){
  $.post("setmobilesession.php",
			{
			  title:"<?php echo $med_arr[2] ?>", 
			}
		);
	var url = $(".hrefloc").attr("href");
	//alert(url);
	setTimeout(function(){
		$(location).attr('href',url);
	}, 500);
});
 

function encrypt() {
		var payload = '{\"data\":{\"price\":1.0,\"contentSize\":0.0,\"itemRef\":\"speed-car.gif\",\"countryCode\":\"IN\",\"contentType\":17},\"algorithm\":\"HMAC-SHA256\"}';
		// alert("JSON: " + payload);
		var base64payload = btoa(payload);
		// alert("Base64 payload: " + base64payload);
		var safeBase64payload = base64payload.replace(/\+/g, '-').replace(/\//g, '_').replace(/\=+$/, '');
		// alert("Safe Base64 payload: " + safeBase64payload);
		var hash = CryptoJS.HmacSHA256(safeBase64payload, "1234");
		// alert("Hash: " + hash);
		var hashInBase64 = btoa(hash);
		// alert("Base64 hash: " + hashInBase64);
		var safeBase64hash = hashInBase64.replace(/\+/g, '-').replace(/\//g, '_').replace(/\=+$/, '');
		// alert("Safe Base64 hash: " + safeBase64hash);
		var encryptedText = safeBase64hash + "." + safeBase64payload;

		var redirectUrl = "http://amuze.co.in:8284/play.php?nlink=$nlink";
		var urlencoded = 'http://bill.paychamp.com/webservice/billme/initTrx/19204455/' + encryptedText
				+ '?transaction_ref=AMPC' + Math.floor((Math.random() * 100000000) + 1); + '&redirect_uri=' + encodeURIComponent(redirectUrl);
		window.location = urlencoded;
	}

$("input[type=radio]").change(function(){
    if(this.value == 'couponradio'){
    $("#coupondiv").show();
    $("#tick_submit").show();
    }else if(this.value == 'directradio'){
    $("#coupondiv").hide();    
    }else{
   	encrypt();
    }
});





$("#phn").oninput = function () {
    if (this.value.length > 10)
        this.value = this.value.slice(0,10); 
}

$("#phn1").oninput = function () {
    if (this.value.length > 10)
        this.value = this.value.slice(0,10); 
}




 




function CheckPwd(){
    var pwd = $("#pwd").val();
    var phn = $("#phn").val();
	var valid = phn.match(/^[789]\d{9}$/);
	if(phn != "" && valid != phn)
	{
		$("#errmsgphn").html("Invalid Mobile number");
		$( "#phn" ).focus();
		$( "#phn" ).css("border","2px solid red");
		return false;
	}
	else
	{
		//$.cookie('cookiemobile',phn);
		$.post("setmobilesession.php",
			{
			  phn: phn,    
			}
		);
	}
	//exit;
    //alert(phn);
    $.post("media_password_check.php",
        {
          pwd: pwd,    
          phn: phn,    
          title:"<?php echo $med_arr[2] ?>",    
        },
        function(data,status){          
            if(data == "yes"){
              var url = $(".hrefloc").attr("href");
              $(location).attr('href',url);             
            }
            else{
              $("#errmsg").html("Invalid coupon");
              $( "#pwd" ).focus();
              $( "#pwd" ).css("border","2px solid red");
            }
        }
    );
    return false;
}
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}



function validatephn(optional){
	//alert(optional);
	//debugger;
    if(optional == 0){
    var phn1 = $("#phn1").val();
    var valid = phn1.match(/^[789]\d{9}$/);
    if(valid == phn1)
		{
			//$.cookie('cookiemobile',phn1);
			//alert(phn1);
			$.post("setmobilesession.php",
					{
					  phn: phn1, 
					  title:"<?php echo $med_arr[2] ?>", 
					}
				);
			
			var url = $(".hrefloc").attr("href");
			setTimeout(function(){
			//alert(phn1);
			$(location).attr('href',url);
		}, 500);
		}
		else
		{
			alert("invalid phone number");
		}
    }
	else
	{
		var phn1 = $("#phn").val();
		var valid = phn1.match(/^[789]\d{9}$/);
		//alert(valid);
		if(valid == phn1)
		{
		//$.cookie('cookiemobile',phn1);
		$.post("setmobilesession.php",
				{
				  phn: phn1,
					title:"<?php echo $med_arr[2] ?>", 			  
				}
			);
		var url = $(".hrefloc").attr("href");
		$(location).attr('href',url);
		}
		else
		{
			//alert("optional but invalid phone number");
		}
    }
return false;
}
function changeType()
    {
        document.couponphone.pwd.type=(document.couponphone.option.value=(document.couponphone.option.value==1)?'-1':'1')=='1'?'text':'password';
    }

function saveMobile(){
    var phn1 = $("#phn1").val();
    //alert(phn1);
     $.post("save_contact.php",
        {
          phn1: phn1,    
        }, 
        function(data,status){ 
            alert(data);
	     debugger;	
            if(data == "yes"){
                var url = $(".hrefloc").attr("href");
                $(location).attr('href',url);
            }
            else if(data == "verify"){
                var url = $(".hrefloc").attr("href");
                $(location).attr('href',url);
            }
            else if(data.startsWith == "no"){
	     alert("here");
              $( "#phn" ).focus();
              $( "#phn" ).css("border","2px solid red");

	    }		
            else{
              $("#errmsg2").html("This field can not be empty.");
              $( "#phn" ).focus();
              $( "#phn" ).css("border","2px solid red");
            }
        }
    );
    return false;
}
var ua = navigator.userAgent.substring(navigator.userAgent.indexOf('(')+1, navigator.userAgent.indexOf(';'));

 if(ua == 'iPhone'){
	document.getElementById("yippster").href = "sms:52409&body=hello%20there";
 }else if(ua == 'Linux'){
        document.getElementById("yippster").href = "sms:52409;body=hello%20there";
 }else{
	document.getElementById("yippster").href = "ykit/index.php";

 }
</script>
<?php include("includes/footer.php"); ?>