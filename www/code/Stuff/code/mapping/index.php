<?php

require_once 'config.php';
require_once 'DBConn.class.php';

$include_paths = explode(PATH_SEPARATOR, get_include_path());
$include_paths[] = PEAR_DIR;
set_include_path(implode(PATH_SEPARATOR, $include_paths));

$db = DBConn::instance();

$rows = $db->getAll('SELECT * FROM code_venues');
var_dump($rows);


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
 <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
 <title>Mapping &amp; Fun</title>
</head>

 <body>
	<h1>Mini Projects</h1>
	
	<ul>
		<li><a href="geo-cache">Venue geo-caching</a></li>
		<li><a href="map">Test Map</a></li>
	</ul>
 </body>
</html>