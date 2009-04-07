<?php

function human_timespan($date)
{
	$past = "%s ago";
	$future = "%s from now";
	
	$diff = $date - time();
	$message = ($diff > 0) ? $future : $past;
	
	if ($diff < 0) {
		$diff *= -1;
	}

	$timespans = array(
		'year' 	=> 60 * 60 * 24 * 30 * 12,
		'month' => 60 * 60 * 24 * 30,
		'week' 	=> 60 * 60 * 24 * 7,
		'day' 	=> 60 * 60 * 24,
		'hour' 	=> 60 * 60,
		'minutes' => 60,
		'second' => 0,
	);

	foreach($timespans as $period => $seconds) {
		
		if ($diff > $seconds) {
			$num = round($diff/$seconds, 0) ;
			break;
		}
	}
	
	if($num > 1) {
		$period .= 's';	 
	}
	
	return sprintf($message, "$num $period");	
}

?>