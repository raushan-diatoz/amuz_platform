<?php
include('config.php');
$files = PIWIKADMINPATH;
$str = '';
foreach(glob($files.'/*') as $file){
$handle = @fopen($file, "r");
if ($handle) {
	while (($buffer = fgets($handle, 4096)) !== false) {
        $str.= $buffer;
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}

}
echo $str;
$file = fopen(PIWIKADMINPATH."/fullscript.js","w") or die ("died");
fwrite($file,$str);
fclose($file);
?>
<script type="text/javascript" src="logs/piwik_data/fullscript.js"></script>
<script>
setTimeout("window.location.href='index.php';",1000);
</script>