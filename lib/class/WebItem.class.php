<?php

class WebItem implements iWebItem
{
    private $title, $date, $link, $description, $tags;
    
    function __construct($aItem)
    {
        foreach($aItem as $key => $val) {
            $this->$key = $val;
        }
    }
    
    public function getTitle()
    {
        return $this->title;
    }

    public function getDate()
    {
        return $this->date;
    }
    
    public function getURL()
    {
        switch ($this->getSourceDomain()) {
            case 'dsingleton.tumblr.com':
            
            default:
                return $this->link;
            break;
        }
    }
    
    public function getExtract()
    {
        return $this->description;
    }
    
    public function getBody()
    {
        return $this->description;
    }
    
    public function getTags()
    {
        return $this->tags;
    }
    
    public function getSourceURL()
    {
        return $this->link;
    }
    
    public function getSourceDomain()
    {
        return parse_url($this->link, PHP_URL_HOST);
    }
}

?>
