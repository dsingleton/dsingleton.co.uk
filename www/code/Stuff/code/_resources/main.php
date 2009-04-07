<?php 

$dir = dirname(__FILE__) . '/';

// Load Bootstrap
require_once $dir . 'misc.php';

// Load Config
require_once $dir . 'config/db.php';

// Add pear paths
add_include_path($dir . 'pear/');
add_include_path('/usr/lib/php/');

// Load classes
glob_require_once($dir . 'classes/*.php');

// Load XML
require_once($dir . 'xml/inline_rss.php');

?>