<?php 

function get_upcoming_api()
{

	require_once 'Upcoming/API.php';

	$api_key = UPCOMING_API_KEY;

	$opt = compact('api_key');

	$api =& new Upcoming_API($opt);

	return $api;
}

function get_my_events()
{
	$api = get_upcoming_api();

	$token = UPCOMING_AUTH_TOKEN;
	$user_id = 30794;

	$method = 'user.getWatchlist';

	$params = array(
		'token' => $token,
		'user_id' => $user_id,
		'show' => 'all'
	);

	$response = $api->callMethod($method, $params);

	$tree = $response;
	$events = $tree->children;

	$venues = array();

	if (!$events) {
		var_dump($tree, $api);
		trigger_error('No Events Found', E_USER_ERROR);
	}

	foreach($events as $e) {

		$e->attributes['description'] = $e->content; 
		$e = $e->attributes;

		if ($e['status'] != 'attend') {
			continue;
		}

		$id = $e['venue_id'];

		if (!$venues[$id]) {
			$venues[$id] = array(
				'id' => $id,
				'name' => $e['venue_name'],
				'date' => $e['start_date'],
				'events' => array($e),
			);
		}
		else {
			$venues[$id]['events'][] = $e;
		}
	}
	return $venues;
}

function display_venues($venues)
{
	foreach($venues as $v) {
		echo '<h2>' . $v['name'] . '</h2>';
	
		foreach($v['events'] as $e) {
		
			$l = '<a href="http://upcoming.org/event/%d">%s</a>';
			$l = sprintf($l, $e['id'], $e['name']);
			echo "$l <br />\n";

		} 
	}
}