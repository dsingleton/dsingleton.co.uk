<?php

class TumblrPost implements iWebItem
{
    const TUMBLR_API = 'http://dsingleton.tumblr.com/api/read/json/';
    
    public static function getRecent($limit = 20)
    {
        $oPosts = self::callAPI(array('num' => $limit, 'type' => 'regular'));
        $aPosts = array();
        
        foreach($oPosts->posts as $oPost) {
            $aPosts[] = new TumblrPost($oPost);
        }
        return $aPosts;
    }
    
    public static function getBySlug($slug)
    {
        if ($id = self::slugToId($slug)) {
            return self::getById($id);
        }
        
        $oPosts = self::callAPI(array('search' => $slug));

        if ($oPosts && isset($oPosts->posts)) {
            foreach($oPosts->posts as $aPost) {

                $oPost = new TumblrPost($aPost);

                if ($oPost->getSlug() == $slug) {
                    return $oPost;
                }
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
    
    public static function slugToId($slug)
    {
        $aMap = array(
            'sxsw-day-two' => 144913919,
            '' => 0,
            'open-tech-2009' => 140265426
        );
        return isset($aMap[$slug]) ? $aMap[$slug] : false;
    }
    
    protected static function callAPI($aParams)
    {
        $aParams = http_build_query(array_map('urlencode', $aParams));
        $url = self::TUMBLR_API . '?' . $aParams;
        $json = file_get_contents($url);
        return self::parseJSON($json);
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