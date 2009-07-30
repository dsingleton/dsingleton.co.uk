<?php

class HTTPRequest
{
    function get($key, $default = null)
    {
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }
    
    function post($key, $default = null)
    {
        return isset($_POST[$key]) ? $_GET[$key] : $default;
    }
}
