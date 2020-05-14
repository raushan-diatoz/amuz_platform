<?php
$dir = '/usr/share/nginx/adminhtml/admin/logs/piwik_data/';
$str = "<?php";
$str.="?>";
$str.= "<script type='text/javascript'>";
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
        //echo $file;  
        $myfile = fopen($dir.$file, "r") or die("Unable to open file!");
        while(!feof($myfile)) {
          $str.= fgets($myfile);
        }
        fclose($myfile);
        }
        closedir($dh);
    }
}
$str.="</script>";

//echo $str;
$file = fopen("script.php","w") or die ("died");
fwrite($file,$str);
fclose($file);
 /* Script URL */
    $url = 'http://amuze.co.in:5534/admin/script.php';
    echo $url;	
    /* $_GET Parameters to Send */
    $params = array('foo' => 'foo', 'bar' => 'bar');

    /* Update URL to container Query String of Paramaters */
   //$url .= '?t=ishq';

    /* cURL Resource */
    $ch = curl_init();

    /* Set URL */
    curl_setopt($ch, CURLOPT_URL, $url);

    /* Tell cURL to return the output */
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    /* Tell cURL NOT to return the headers */
    curl_setopt($ch, CURLOPT_HEADER, false);

    /* Execute cURL, Return Data */
    $data = curl_exec($ch);

    /* Check HTTP Code */
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    /* Close cURL Resource */
    curl_close($ch);

    /* 200 Response! */
    if($status == 200){
        /* Debug */
        $arr = json_decode($data);
        print_r($arr);
        //echo $arr->Title;
    } else {
        /* Debug */
        var_dump($data);
        var_dump($status);
    }


?>