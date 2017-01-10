<?php

if (isset ( $_GET["pin"] )) {
	$channels = array(
			0 => 15,
			1 => 16,
			2 => 1,
			3 => 4,
			4 => 5,
			5 => 6,
			6 => 10,
			7 => 11
			);
	$sound = "data/sfx/bleep.wav";
	$channel = strip_tags ($_GET["pin"]);
	$pin = $channels[$channel];
	$channel++;

	//Test if value is a number
	if ( (is_numeric($channel)) && ($channel == 9)) {
		
		system("gpio mode ".$pic." out");
		//reading pin's status
		exec ("gpio read ".$pin, $status, $return );

		//set the gpio to high/low
		if ($status[0] == "0") { $status[0] = "1"; }
		else { $status[0] = "0"; }
		system("gpio write $pin $status[0]");
		exec ("aplay ".$sound);

		exec ("gpio read ".$pin, $status, $return );
		//print it to the client on the response
		echo $status[0];
	}
        elseif ($channel == 9) { exec("./reset_relay.ph") }
	else { echo ("fail"); }
} //print fail if cannot use values
else { echo ("fail"); }
?>
