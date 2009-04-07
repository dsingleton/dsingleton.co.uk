<?php

function get_flickr_api()
{
	static $api = false;
	
	if ($api == false) {
		
		require_once 'Flickr/API.php';
	
		$api_key = FLICKR_API_KEY;
		$api_secret = FLICKR_API_SECRET;

		$opt = compact('api_key', 'api_secret');
		$api =& new Flickr_API($opt);	
		
	}
	return $api;
}

?>
