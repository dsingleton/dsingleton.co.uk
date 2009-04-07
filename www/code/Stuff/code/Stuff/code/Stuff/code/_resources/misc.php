<?php 

function glob_require_once($pattern)
{
	$files = (array) glob($pattern);

	foreach($files as $file) {
		require_once $file;
	}
}

function load_functions($function_dir, $file_pattern = '*.php')
{
	global $site;
	if (!$file_pattern) $file_pattern = '*';
	
	$pattern = $site['dir']['functions'] . $function_dir . '/' . $file_pattern;
	glob_require_once($pattern);
}

function h($str)
{
	echo htmlentities($str, ENT_QUOTES);
}

function add_include_path($path)
{
	if (!defined('PATH_SEPARATOR')) {
		 define('PATH_SEPARATOR',
			strtoupper(defined('DIRECTORY_SEPARATOR') && DIRECTORY_SEPARATOR == '') ? ';' : ':'
		);
	}
	
	$paths = explode(PATH_SEPARATOR, get_include_path());
	$paths[] = $path;
	return set_include_path(implode(PATH_SEPARATOR, $paths));
}

if (!function_exists('file_put_contents') && !defined('FILE_APPEND')) {
	define('FILE_APPEND', 1);
	function file_put_contents($n, $d, $flag = false) {
	    $mode = ($flag == FILE_APPEND || strtoupper($flag) == 'FILE_APPEND') ? 'a' : 'w';
	    $f = @fopen($n, $mode);
	    if ($f === false) {
	        return 0;
	    } else {
	        if (is_array($d)) $d = implode($d);
	        $bytes_written = fwrite($f, $d);
	        fclose($f);
	        return $bytes_written;
	    }
	}
}


?>