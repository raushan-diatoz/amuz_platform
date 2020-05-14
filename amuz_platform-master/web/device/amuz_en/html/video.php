
<?php include("includes/header.php"); ?>
<div class="container">


   <div class="row">
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
 </div>
 <div class="row-data"><div class="r-h">Title:</div><div class="r-d">Big Buck Bunny</div></div>
 <div class="row-data"><div class="r-h">Rating:</div><div class="r-d">3</div></div>
 </div>