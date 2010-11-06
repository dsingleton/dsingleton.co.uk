<?php

class TumblrPost implements iWebItem
{
    const TUMBLR_API = 'http://dsingleton.tumblr.com/api/read/json/';
    
    public static function getRecent($limit = 20)
    {
        $oPosts = self::callAPI(array('num' => $limit, 'type' => 'regular'), 60 * 60);
        $aPosts = array();
        
        foreach($oPosts->posts as $oPost) {
            $aPosts[] = new TumblrPost($oPost);
        }
        return $aPosts;
    }
    
    public static function getBySlug($slug)
    {
        $aPosts = self::getRecent(50);

        foreach($aPosts as $oPost) {

            if ($oPost->getSlug() == $slug) {

                return $oPost;
            }
        }
        return false;
    }
    
    public static function getById($id)
    {
        $oPosts = self::callAPI(array('id' => $id));
        
        if ($oPosts && isset($oPosts->posts[0])) {
            return new TumblrPost($oPosts->posts[0]);
        }
        
        return false;
    }
    
    protected static function callAPI($aParams, $timeout = 86400) 
    {
        $aParams = http_build_query(array_map('urlencode', $aParams));

        $oCache = Cache::instance();
        $key = "tumblr:api:{$aParams}";

        if (!$oResult = $oCache->get($key)) {
            $url = self::TUMBLR_API . '?' . $aParams . '&cache_bust=' . md5(time());

            $json = file_get_contents($url);
            $oResult = self::parseJSON($json);
            if ($oResult->posts) {
                $oCache->set($key, $oResult, $timeout);
            }
        }

        return $oResult;
    }
    
    protected static function parseJSON($json)
    {
        return json_decode(substr(trim($json), strpos($json, '{'), -1));
    }
    
    public function __construct($oPost)
    {
        foreach($oPost as $key => $val) {
            $this->$key = $val;
        }
    }
    
    public function getTitle()
    {
        return $this->{'regular-title'};
    }
    
    public function getBody()
    {
        return $this->{'regular-body'};
    }
    
    public function getSlug()
    {
        return substr($this->{'url-with-slug'}, strlen($this->url) + 1);
    }
    
    public function getURL()
    {
        return '/blog/' . $this->getSlug();
    }
    
    public function getDate()
    {
        return $this->date;
    }
    
    public function getTags()
    {
        return $this->tags;
    }
    
    public function getExtract($length = 300)
    {
        $raw = htmlspecialchars_decode(strip_tags($this->getBody()), ENT_QUOTES);
        $extract = substr($raw, 0, $length);
        return $extract;
    }
}
