<?php 

class DBConn
{
	function &getInstance()
	{
		static $instance = false;
		
		if(!$instance) {
			
			require_once 'DB.php';
			
			$dsn = array(
			    'phptype'  => 'mysql',
			    'username' => DB_USER,
			    'password' => DB_PASS,
			    'hostspec' => DB_HOST,
			    'database' => DB_NAME,
			);

			$options = array(
				'portability' => DB_PORTABILITY_ALL,
			);
			
			$db =& DB::connect($dsn, $options);
			
			if (PEAR::isError($db)) {
				trigger_error($db->getMessage(), E_USER_ERROR);
			}
			
			$db->setFetchMode(DB_FETCHMODE_ASSOC);
			
			$instance =& $db;
		}
		return $instance;
	}
}

?>