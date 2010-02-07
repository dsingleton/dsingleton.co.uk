<?php

class Cache
{
    private static $instance = null;
    public $cache = null;
    
    function __construct()
    {   
        try {
            $oMemcache = new Memcache();
            if (!$oMemcache->connect("127.0.0.1", 11211)) {
                throw new Exception();
                
            }
            $this->cache = $oMemcache;
        }
        catch(Exception $oException) {
            throw new Exception("Failed to connect to external service (memcached)");
        }
    }
    
    function get($key)
    {
        return $this->cache->get($key);
    }
    
    function set($key, $value, $timeout = 0)
    {
        return $this->cache->set($key, $value, 0, $timeout);
    }
    
    static function instance()
    {
        if (!self::$instance) {
            self::$instance = new Cache();
        }
        return self::$instance;
    }
}


?>