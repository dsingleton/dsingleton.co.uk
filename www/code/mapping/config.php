<?php

//-------------------------------------------------------------------------
// API Keys and Secrets
//-------------------------------------------------------------------------

define('GMAPS_API_KEY', 'ABQIAAAAIrSZw_b0_cNzFdze8BPnOBTYjY64e1phfyCkMSo7ztCr8EL4dhQ1NYEPpKbuW_K6tb6awNEQZ02Jeg');

define('FLICKR_API_KEY', 'ec6aad78305bb091243df6848da0f056');
define('FLICKR_API_SECRET', '1c830663b51b29dc');

define('UPCOMING_API_KEY', '070ccdcaa8');
define('UPCOMING_AUTH_TOKEN', 'c86fe4393870137c549cee473f1ad9b02329bf49');

//-------------------------------------------------------------------------
// Locale Specific Settings - DB..
//-------------------------------------------------------------------------

switch($_SERVER['SERVER_NAME']) {
	
	// Home
	case 'code.dev':
	
		define("DB_HOST", "localhost"); 
		define("DB_USER", "root"); 
		define("DB_PASS", "");
		define("DB_NAME", "code");
		
	break;
	
	// Work
	case 'david.sprig-dev.com':
	case 'dsingleton.co.uk':
	
		define("DB_HOST", "localhost"); 
		define("DB_USER", "springdigital"); 
		define("DB_PASS", "79kHkjivNa");
		define("DB_NAME", "staff_david"); 		
		
		define('PEAR_DIR', '/usr/lib/php/');
		
	break;
	
	// No settings? Uh oh!
	default:
	
		trigger_error('Unknown Locale, unable to find configuration settings.', E_USER_ERROR);
		
	break;
}

