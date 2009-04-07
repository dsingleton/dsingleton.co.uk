<?php

class DeliciousNetwork
{
    private $feedURL = "http://feeds.delicious.com/v2/json/network/%s?count=100";
    private $user = false;
    private $feedItems = false;
    
    
    function __construct($user)
    {
        $this->user = $user;
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function getFeedURL()
    {
        return sprintf($this->feedURL, $this->getUser());
    }
    
    function getFeedItems()
    {
        if ($this->feedItems === false) {
            $this->feedItems = json_decode(file_get_contents($this->getFeedURL()));
        }
        return $this->feedItems;
    }
    
    private function getTopByProperty($property, $limit)
    {
        $aItems = array();
        foreach ($this->getFeedItems() as $oItem) {
            if (is_array($oItem->$property)) {
                $aItems = array_merge($aItems, $oItem->$property);
            }
            else {
                $aItems[] = $oItem->$property;
            }
        }
        return array_slice(self::aggregate($aItems), 0, $limit);
    }

    function getTopLinks($limit = 10)
    {
        return $this->getTopByProperty('u', $limit);
    }
    
    function getTopTags($limit = 10)
    {
        return $this->getTopByProperty('t', $limit);
    }
    
    
    function getTopAuthors($limit = 25)
    {
        return $this->getTopByProperty('a', $limit);
    }
    
    function getStartDate()
    {
        return new Date(array_pop($this->getFeedItems())->d);
    }
    
    function getEndDate()
    {
        return new Date(array_shift($this->getFeedItems())->d);
    }
    
    
    private static function aggregate($aItems)
    {
        $aItems = array_count_values($aItems);
        arsort($aItems);
        return $aItems;
    }
}

interface iTag
{
    public function getName();
    public function getURL($action = '');
}

class DeliciousTag implements iTag
{
    private $tag = false;
    private static $urlPattern = "http://delicious.com/tag/%s";
    
    function __construct($tag) 
    {
        $this->this = $tag;
    }
    
    function getName()
    {
        return $this->tag;
    }
    
    function getURL($action = '')
    {
        return sprintf(self::urlPattern, $this->getName());
    }
} 

class DeliciousUser
{
    
}

// class MagicList implements Iterator
// {
//     // return obejct as key, count as value;
// }