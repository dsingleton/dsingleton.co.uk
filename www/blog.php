<?php 

list(,, $post) = explode('/', urldecode($_SERVER['REQUEST_URI']));

switch($post)
{
	case 'playdar-os-x-10-4':
		$url = "http://dsingleton.tumblr.com/post/94533381/playdar-os-x-10-4";
	break;

	default:
		header("HTTP/1.0 404 Not Found");
		exit;
	break;
}

header("Location: $url");

