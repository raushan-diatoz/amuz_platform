<?php
   $ping = "www.google.com";
   if($ping == NULL) return false;  
    $ch = curl_init($ping);  
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);  
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
    $data = curl_exec($ch);  
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);  
    curl_close($ch);  
    if($httpcode>=200 && $httpcode<400){
    
    
         $ifconfig = exec("ifconfig ppp0| grep -i 'inet addr:'");
     $xifconfig = explode(" ",$ifconfig);
     print_r($xifconfig);   
     $inetaddrar = explode(":",$xifconfig[11]); 
        print_r($inetaddrar);
  
    $url = 'http://zunder.lekshmanan%40gmail.com:megha12@dynupdate.no-ip.com/nic/update?hostname=amuztest.ddns.net&myip='.$inetaddrar[1];
    echo $url;
    

    /* cURL Resource */
    $ch1 = curl_init();

    /* Set URL */
    curl_setopt($ch1, CURLOPT_URL, $url);

    /* Tell cURL to return the output */
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);

    /* Tell cURL NOT to return the headers */
    curl_setopt($ch1, CURLOPT_HEADER, false);

    /* Execute cURL, Return Data */
    $data = curl_exec($ch1);

    /* Check HTTP Code */
    $status = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
        
    /* Close cURL Resource */
    curl_close($ch1);

    /* 200 Response! */
    if($status == 200){
        /* Debug */
        $arr = json_decode($data);
        print_r($arr);
//        echo $arr->Title;
    } else {
        /* Debug */
        var_dump($data);
        var_dump($status);
    }

    
}else{
 shell_exec("killall wvdial");
 shell_exec("wvdial bsnl");	
}
?>    