<?php

// Unix Time values
$actualTime = time();
$past4HoursTime = time() - 3600*4;
$past8HoursTime = time() - 3600*8;
$past1DayTime = time() - 3600*24;

// Online/Offline devices
$totalon = 0;
$totaloff = 0;

$totalcount = $totaloff + $totalon; 
$onOffCount = "($totalon/$totalcount)";

function GetServerStatus($site, $port)
{
	$status = array("<div class='online'>Online</div>", "<div class='offline'>Offline</div>");
	$fp = @fsockopen($site, $port, $errno, $errstr, 2);
  
	if (!$fp) {
    	global $totaloff;
        $totaloff++;
	    return $status[1];
	} else { 
        global $totalon;
        $totalon++;
        return $status[0];
    }
}
?>