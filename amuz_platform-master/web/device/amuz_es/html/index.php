<?php include("includes/header.php"); ?>
<div class="container">
    <div class="row">
       <div class="media-list">         <!--     <a class="media-icon"  href="media.php">Amuze Me</a>
          <a class="media-icon"  href="#">How it Works</a>
<a class="media-icon"  href="downloads/ourtv.apk">Android App</a>
<a class="media-icon"  href="#">Feedback</a>    -->         
  <a class='mov-ele wt-m folder' href='media.php'><img src='images/ent.png' width='135px' /><br><span>Amuze Me</span></a>
  <a class='mov-ele wt-m folder' href='howithelps.php'><img src='images/howithelps.png'  width='135px' /><br><span>How it Works</span></a>
  <a class='mov-ele wt-m folder' href='downloads/amuz.apk'><img src='images/Android.png'  width='135px' /><br><span>Android App</span></a>
  <a class='mov-ele wt-m folder' href='feedback.php'><img src='images/feedback.jpg'  width='135px' /><br><span>feedback</span></a>
        </div>
    </div>
</div>
<script>
 detectbrowser();
            function detectbrowser(){

    var txt = "";
txt += "<p>Browser CodeName: " + navigator.appCodeName + "</p>";
txt += "<p>Browser Name: " + navigator.appName + "</p>";
txt += "<p>Browser Version: " + navigator.appVersion + "</p>";
txt += "<p>Cookies Enabled: " + navigator.cookieEnabled + "</p>";
txt += "<p>Browser Language: " + navigator.language + "</p>";
txt += "<p>Browser Online: " + navigator.onLine + "</p>";
txt += "<p>Platform: " + navigator.platform + "</p>";
txt += "<p>User-agent header: " + navigator.userAgent + "</p>";
//alert(txt);
}
</script>
<?php include("includes/footer.php"); ?>
