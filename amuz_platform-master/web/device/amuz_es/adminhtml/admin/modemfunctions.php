<?php
$action =  $_POST["type"];
exec("echo 'avench' | usb_modeswitch -c /etc/usb_modeswitch.d/12d1\:1446");

if($action == "ON"){

exec("echo 'avench' | sudo -S killall wvdial");
exec("echo 'avench' | sudo -S wvdial bsnl");

echo "Modem started successfully";

}else{

exec("echo 'avench' | sudo -S killall wvdial");


echo "Modem stopped successfully";

}



?>