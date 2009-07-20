<?php

function parse_rss($url) {

    $list = array();
    
    if (!$xml = @file_get_contents($url)) {
        return $list;
    }
    
    $rss = new DOMDocument();
    $rss->loadXML($xml);

    foreach ($rss->getElementsByTagName("item") as $item) {
        
        $aItem = array();
        
        $dateField = $item->getElementsByTagName("pubDate")->item(0) ? 'pubDate' : 'date';
        $date = strtotime(substr($item->getElementsByTagName($dateField)->item(0)->nodeValue, 0, 25));

        @$aItem['date'] = $date;

        foreach (array('title', 'link', 'description') as $detail) {
            @$aItem[$detail] = $item->getElementsByTagName($detail)->item(0)->nodeValue;
        }
        
        foreach ($item->getElementsByTagName('category') as $tagNode) {
            $tag = $tagNode->nodeValue;
            if (strpos($tag, " ") !== false) {
                $aItem['tags'] = explode(" ", $tag);
            }
            else {
                @$aItem['tags'][] = $tag;
            }
        }
        
        $list[$date] = $item = new WebItem($aItem);
    }
    return $list;
}