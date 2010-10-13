<?php

// Should have a page type interface
class Tag 
{
    public function __construct($tag)
    {
        $this->tag = $tag;
    }
    
    public function getSlug()
    {
        return strtolower($this->tag);
    }
    
    protected function getFeedURLs()
    {
        $aFeeds = array(
            'flickr' => 'http://api.flickr.com/services/feeds/photos_public.gne?id=60207094@N00&tags=%s&lang=en-us&format=rss2',
            'delicious' => 'http://feeds.delicious.com/v2/rss/dsingleton/%s?count=15',
            'twitter' => 'http://search.twitter.com/search.rss?q=+%s+from:dsingleton',
            'tumblr' => 'http://dsingleton.tumblr.com/tagged/%s/rss'
        );
        
        foreach($aFeeds as $source => $url) {
            $aFeeds[$source] = sprintf($url, urlencode($this->tag));
        }
        return $aFeeds;
    }
    
    public function getRecentItems($limit = 25)
    {
        $aFeeds = $this->getFeedURLs();

        $aItems = array();
        
        foreach($aFeeds as $feed => $url) {
            $remoteList = parse_rss(false, $this->fetchFeedXML($url));
            $aItems = $aItems + $remoteList;
        }

        krsort($aItems);
        return $aItems;
    }
    
    public function fetchFeedXML($url)
    {
        $oCache = Cache::instance();
        $key = "tag:feed:{$url}";
        
        if (!$xml = $oCache->get($key)) {
            $xml = @file_get_contents($url);
            if (trim($xml)) {
                $oCache->set($key, $xml, 60 * 60 * 2);
            }
        }
        
        return $xml;
    }
    
    public function getItemsBySource($source, $limit = 25)
    {
        $aFeeds = $this->getFeedURLs();
        
        if (!isset($aFeeds[$source])) {
            return array();
        }
        
        return parse_rss(false, $this->fetchFeedXML($aFeeds[$source]));
    }
    
    public function getTitle()
    {
        return $this->tag;
    }
    
    public function getURL()
    {
        return '/tag/' . $this->tag;
    }
}
