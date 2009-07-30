<?php

$env = in_array($_SERVER["SERVER_NAME"], array('dsingleton.co.uk', 'www.dsingleton.co.uk')) ? 'prod' : 'dev';

require_once dirname(__FILE__) . '/etc/' . $env . '.php';

require_once dirname(__FILE__) . '/lib/lib.php';

$oRequest = new HTTPRequest();
$oPage = new Page($oRequest);

$oPage->setEnv($env);

class Page
{
    private $env;
    private $title;
    
    function __construct(HTTPRequest $oRequest)
    {
        
    }
    
    function setTitle($title)
    {
        $this->title = $title;
    }
    
    function getTitle()
    {
        return $this->title;
    }
    
    function isProduction()
    {
        return $this->env == 'prod';
    }
    
    function setEnv($env)
    {
        $this->env = $env;
    }
}