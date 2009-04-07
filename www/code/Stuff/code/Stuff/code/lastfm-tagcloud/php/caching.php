<?php

function cache_get($token, $max_age)
{
	$file = cache_path($token);
	
	$age = time() - @filemtime($file);

	if ($age < $max_age) {
		return file_get_contents($file);
	}
	return false;
}

function cache_set($token, $contents)
{
	$file = cache_path($token);
	
	$fh = fopen($file, 'w');
	fwrite($fh, $contents);
	fclose($fh);
	
	return true;
}

function cache_path($token)
{
	$safe_token = ereg_replace('[^A-Za-z0-9\-]', '', $token);
	$path = './cache/' . $safe_token . '_' . md5($token) . '.cache';
	return $path;
}

function cache_destroy($token)
{
	return @unlink($token);
}

?>