<?php

function multi_require_once($aFiles)
{
    foreach($aFiles as $file) {
        require_once $file;
    }    
}

multi_require_once(glob(dirname(__FILE__) . '/misc/*.php'));

