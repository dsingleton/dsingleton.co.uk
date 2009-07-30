<?php

require_once dirname(__FILE__) . '/etc/dev.php';
require_once dirname(__FILE__) . '/lib/lib.php';

$oRequest = new HTTPRequest();
$oPage = new Page($oRequest);

class Page
{
    function __construct(HTTPRequest $oRequest)
    {
        
    }
    
    function setTitle()
    {
        
    }
}