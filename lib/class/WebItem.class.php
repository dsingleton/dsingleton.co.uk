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
        return $this->link;
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
}

?>