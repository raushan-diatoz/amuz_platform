<?php include("includes/header.php"); ?>
<?php include("includes/functions.php");
include("includes/class_encription.php");
$gtpath = encrypt_decrypt('decrypt', $_GET['path']);
//print_r($_SESSION);
//echo $_SESSION["mobileNumber"];

?>
<script type="text/javascript" src="js/jquery-1.11.0.min.js" ></script>
<link rel="stylesheet" href="css/swipebox.css">
<script src="js/libs/jquery.swipebox.js"></script>
<script src="js/jquery.simplePopup.js" type="text/javascript"></script>
<link href="css/style_pop.css" rel="stylesheet" />
<div class="container">
    <div class="row">
    	<div>
    	<div class="media-list">    	
	  	<?php
            if(isset($gtpath)){
            	$pinfo = pathinfo($gtpath);
                $res = scan($gtpath); 
		  //print_r($res);    
            } else {
                $res = scan(ROOTPATH);  
            }
        ?>
        <h2><?php echo $pinfo['filename']; ?></h2>
        <ul>
        <?php                 
            foreach ($res as $inarray) {
                if($inarray['type'] == "file"){
			         medfilelist($inarray,$_GET['path']);
                }
                else if($inarray['type'] == "folder"){    
                    echo "<li><a class='mov-ele wt-m folder' href='gal_list.php?path=".encrypt_decrypt("encrypt",$inarray['path'])."'><img src='images/folder.png' alt='folder' width='150px' /><br><span>".$inarray['name']."</span></a></li>";
                }
            }
    	?>
        </ul>   
        </div>
    	</div>
        
	</div>
</div>
	<div id="pop1" class="simplePopup">
                <!-- <p>Choose an option to watch this video</p> -->
                <input id="yippster" type="button" value="pay via yippster" style="display:none"/>
                <input id ="coupon" type="button" value="I have Coupon" style="display:none"/>
                <div id='couponcode'>
               <form method="post" action="" onsubmit="return saveMobile()">
                <p id="errmsg"></p>
                <p>*Please enter your mobile number</p>
			 <hr/>
                      <input style="width:100%;" type="text" maxlength="10" onkeypress='return isNumberKey(event)' value="" name="phn" id="phn" placeholder="Mobile Number"/> 
                      <input type="submit" value="submit" id="tick_submit" />
                  </form>
                </div>
      </div>
	
	<div id="pop2" class="simplePopup">
                <!-- <p>Choose an option to watch this video</p> -->
                <form method="post" action="" onsubmit="return saveMobile1()">
                <p id="errmsgs"></p>
                <p>*Please enter the verification code that sent to your mobile</p>
                      <input style="width:100%;" type="text" name="vcode" id="vcode" placeholder="Key"/> 
                      <input style="width:100%;" type="hidden" name="mphone" id="mphone" placeholder="Key"/> 
                      <input type="submit" value="submit" id="tick_submit" />
                  </form>
                </div>
      </div>
<script>

$( '.swipebox' ).swipebox();
	
$('.show1').click(function(){
  $('#pop1').simplePopup();
  return false;
});

function saveMobile(){
    var phn = $("#phn").val();
    $.post("save_contact.php",
        {
          phn: phn,    
        },
        function(data,status){ 
			//alert(data);
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
            else{
              $("#errmsg").html("This field can not be empty.");
			  $( "#phn" ).focus();
			  $( "#phn" ).css("border","2px solid red");
            }
        }
    );
    return false;
}

/* $('body').keyup(function(e) {
	alert(e);
			//if(e.which===27){ object.prepend(close); } // 27 is the keycode for the Escape key
		}); */

		
function saveMobile1(){
    var vcode = $("#vcode").val();
    var mphone = $("#mphone").val();
    $.post("mobile_verification.php",
        {
          vcode: vcode,    
          mphone: mphone,    
        },
        function(data,status){          
			//alert(data);
            if(data == "yes"){
				var url = $(".hrefloc").attr("href");
              $(location).attr('href',url);
            }
            else{
              $("#errmsgs").html("Invalid varification code");
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
</script>	

<?php include("includes/footer.php"); ?>