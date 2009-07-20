<?php

function __autoload($class_name)
{
    $base = $lib_root = dirname(__FILE__) . '/../';
    
    if ($class_name[0] == 'i') {
        require_once $base . 'interface/' . $class_name . '.interface.php';
    }
    else {
        require_once $base . 'class/' . $class_name . '.class.php';
    }
}