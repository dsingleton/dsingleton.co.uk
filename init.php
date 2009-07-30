<?php

$env = ($_SERVER["SERVER_NAME"] == 'dsingleton.co.uk') ? 'prod' : 'dev';

require_once dirname(__FILE__) . '/etc/' . $env . '.php';

require_once dirname(__FILE__) . '/lib/lib.php';