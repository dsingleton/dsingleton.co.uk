<?php

function get_tagcloud_html($user)
{
	$path_format = 'http://ws.audioscrobbler.com/1.0/user/%s/weeklyartistchart.xml';

	$feed_path = sprintf($path_format, $user);
	$xsl_path =  'xsl/weeklyartists.xsl';

	$cache_token = 'weeklyartists-' . $user;
	$cloud_html = cache_get($cache_token, 60 * 60);

	if ($cloud_html === false) {

		$xslt = new SimpleXSLT();
		$cloud_html = $xslt->transform($feed_path, $xsl_path);	
		
		if ($cloud_html != NULL) {
			cache_set($cache_token, $cloud_html);
		}
	}
	return $cloud_html;
}

function get_user_thumbnail($user)
{
	$user_avatar = get_user_avatar($user);
	
	if ($user_avatar) {
		$user_avatar = 'http://panther1.last.fm/avatar_thumbnails/' . basename($user_avatar);		
	}

	return $user_avatar;
}

function get_user_avatar($user)
{
	if (!trim($user)) {
		return false;
	}
	
	$profile_url_format = 'http://ws.audioscrobbler.com/1.0/user/%s/profile.xml';
	$profile_url = sprintf($profile_url_format, $user);

	$cache_token = 'profile-' . $user;
	$profile_xml = cache_get($cache_token, 60*60);
		
	if ($profile_xml === false) {
		$profile_xml = @file_get_contents($profile_url);
		if ($profile_xml != NULL) {
			cache_set($cache_token, $profile_xml);
		}
	}

	$avatar_regex = '/<avatar>(.*?)<\/avatar>/si';
	preg_match($avatar_regex, $profile_xml, $matches);
	$user_avatar = $matches[1];

	return $user_avatar;
}


?>
