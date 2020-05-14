<?php
$array = array(
    array('dave','jones','c@b.c'),
    array('dave','jones','a@c.d'),
    array('dave','jones','c@b.c'),
    array('dave','jones','e@v.d'),
    array('dave','jones','a@c.d')	
);

$copy = $array; // create copy to delete dups from
$usedEmails = array(); // used emails

for( $i=0; $i<count($array); $i++ ) {

    if ( in_array( $array[$i][2], $usedEmails ) ) {
    	unset($copy[$i]);
    }
    else {
    	$usedEmails[] = $array[$i][2];
    }

}

print_r($copy);

?>