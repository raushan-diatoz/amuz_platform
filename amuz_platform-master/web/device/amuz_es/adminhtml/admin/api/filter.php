<?php

?>

<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>

<script>
var data = [{"channel":"BitsofKnowledge","language":"telugu","genre":"Knowledge","title":"Knowledge 2","desc":"Helps to improve the knowledge","adpath":"http://amuze.co.in:8283/Advertisements/sample_ad1.mp4","rating":"1","thumbnail":"http://amuze.co.in:8283/entertainment/Curated_Content/BitsofKnowledge/VID-20150430-WA0010.jpg","is_premium":"0","roll":"pre","published":"1","price":"12.00","premiumtime":"2","skip_flag":"0","link":"http://amuze.co.in:8283/entertainment/Curated_Content/BitsofKnowledge/VID-20150430-WA0010.mp4"},{"channel":"BitsofKnowledge","language":"english","genre":"Knowledge","title":"Knowledge 1","desc":"Helps to improve the knowledge","adpath":"http://amuze.co.in:8283/Advertisements/sample_ad5.mp4","rating":"1","thumbnail":"http://amuze.co.in:8283/entertainment/Curated_Content/BitsofKnowledge/VID-20150430-WA0018.jpg","is_premium":"1","roll":"pre","published":"1","price":"5.00","premiumtime":"2","skip_flag":"0","link":"http://amuze.co.in:8283/entertainment/Curated_Content/BitsofKnowledge/VID-20150430-WA0018.mp4"}];



    var returnedData = $.grep(data, function(element, index){
          return element.language== "hindi";
    });
    
    alert(JSON.stringify(returnedData)); 
</script>