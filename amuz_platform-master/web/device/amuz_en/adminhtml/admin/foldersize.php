<?php
    $units = explode(' ', 'B KB MB GB TB PB');
    $SIZE_LIMIT = 5368709120; // 5 GB
    #$disk_used = foldersize("files/");
     
    $disk_used = foldersize("C:/wamp/www/amuz_platform-master/web/device/amuz_es/adminhtml/admin/logs/piwik_data/");
     
  
    $disk_remaining = $SIZE_LIMIT - $disk_used;

   /* echo("<html><body>");
    echo('diskspace used: ' . format_size($disk_used) . '<br>');
    echo( 'diskspace left: ' . format_size($disk_remaining) . '<br><hr>');
    echo("</body></html>");*/


function foldersize($path) {
    
    $total_size = 0;
    $files = scandir($path);
    $cleanPath = rtrim($path, '/'). '/';

    foreach($files as $t) {
        if ($t<>"." && $t<>"..") {
            $currentFile = $cleanPath . $t;
            if (is_dir($currentFile)) {
                $size = foldersize($currentFile);
                $total_size += $size;
            }
            else {
                $size = filesize($currentFile);
                $total_size += $size;
            }
        }   
    }

    return $total_size;
}


function format_size($size) {
    global $units;

    $mod = 1024;

    for ($i = 0; $size > $mod; $i++) {
        $size /= $mod;
    }

    $endIndex = strpos($size, ".")+3;

    return substr( $size, 0, $endIndex).' '.$units[$i];
}

?>