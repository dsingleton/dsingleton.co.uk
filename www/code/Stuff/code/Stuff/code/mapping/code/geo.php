<?php

function save_venue_geo($venue)
{
	// $venue should be an assiative array with values for;
	// name, lat, long, upcoming_id (optional), lat_fm_id (optional)
	
	// This is shit, it needs tidying
	$SQL = <<<SQL
	
	INSERT INTO `code_venues`
	(`name`, `latitude`, `longitude`, `upcoming_id`, `last_fm_id`, `added`)
	VALUES ('{$venue['name']}', '{$venue['lat']}', '{$venue['long']}', '{$venue['upcoming_id']}', '', NOW())
SQL;

	$result = mysql_query($SQL) or trigger_error(mysql_error() . "($SQL)", E_USER_ERROR);
	return mysql_insert_id();
}

function get_event_geo($event_id)
{
	$api = get_flickr_api();
	
	$machine_tag = 'upcoming:event=';
	
	// Limited to 8 machine tags when in an OR search
	// Restrict event set, or do multiple queries?
	if (is_array($event_id)) {
		$tags = array();
		foreach($event_id as $id) {
			$tags[] = $machine_tag . $id;
		}
		$tags = array_slice($tags, 0, 4);
		$tags = implode(' ', $tags);
	} 
	else {
			$tags = 'upcoming:event=' . $event_id;
	}
	
	$method = 'flickr.photos.search';

	$params = array(
		'machine_tags' => $tags,
		'machine_tag_mode' => 'any',
		'extras' => 'geo, tags, machine_tags',
		'accuracy' => 11,
		'bbox' => '-180, -90, 180, 90',
	);
	echo "<!-- $tags --> \n";
	$response = $api->callMethod($method, $params);

	$photos = $response->children[0]->children;
	
	if (!$photos) {
		return false;
		// var_dump($tree); die;
	}
	
	$geo = $geo_lat = $geo_long = array();
	
	foreach($photos as $photo) {
		$photo = $photo->attributes;
		
		if (!($photo['latitude'] && $photo['longitude'])) {
			continue;
		}
		
		$geo[] = array(
			'lat' => $photo['latitude'],
			'long' => $photo['longitude']
		);
		
		$geo_lat[] =  $photo['latitude'];
		$geo_long[] = $photo['longitude'];
	}
	
	if (!$geo) {
		
		return false;
	}
	
	$geo_lat_avg = array_sum($geo_lat) / count($geo_lat);
	$geo_long_avg = array_sum($geo_long) / count($geo_long);
	
	return array('lat' => $geo_lat_avg, 'long' => $geo_long_avg);
	
	// Snip here
	
	printf("%d Total Photos, %d with Geo Data\n\n", count($photos), count($geo));
		
	$link = sprintf('<a href="http://maps.google.co.uk/?z=14&ll=%f,%f">M</a>', $geo_lat_avg, $geo_long_avg);
	
	printf("AVG - Lat: %f - Long: %f. ($link)\n\n", $geo_lat_avg, $geo_long_avg); 
		
	foreach($geo as $g) {
		printf("GEO - Lat: %f - Long: %f. \n", $g['lat'], $g['long']); 
	}
	
	var_dump($geo);

	var_dump($photos);
	
die;	
	
	# check the response
	if ($response){
		# response is an XML_Tree root object
		var_dump($response);
	}else{
		# fetch the error
		$code = $api->getErrorCode();
		$message = $api->getErrorMessage();
		var_dump($code, $message);	
	}
	
die;
	
}