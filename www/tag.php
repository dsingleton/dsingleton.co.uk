<?php require_once '../init.php'; ?>
<?php

list(, $page, $tag) = explode('/', urldecode($_SERVER['REQUEST_URI']));

$list = array();

$feeds = array(
    'flickr' => 'http://api.flickr.com/services/feeds/photos_public.gne?id=60207094@N00&tags=%s&lang=en-us&format=rss2',
    'delicious' => 'http://feeds.delicious.com/v2/rss/dsingleton/%s?count=15',
    'twitter' => 'http://search.twitter.com/search.rss?q=+%s+from:dsingleton',
    'http://dsingleton.tumblr.com/tagged/%s/rss'
);


foreach($feeds as $feed => $url) {
    $remoteList = parse_rss(sprintf($url, urlencode($tag)));
    $list = $list + $remoteList;
}

krsort($list);

function parse_rss($url) {

    $list = array();
    
    if (!$xml = @file_get_contents($url)) {
        return $list;
    }
    
    $rss = new DOMDocument();
    $rss->loadXML($xml);

    foreach ($rss->getElementsByTagName("item") as $item) {
        $dateField = $item->getElementsByTagName("pubDate")->item(0) ? 'pubDate' : 'date';
        $date = strtotime(substr($item->getElementsByTagName($dateField)->item(0)->nodeValue, 0, 25));

        foreach (array('title', 'link', 'description') as $detail) {
            @$list[$date][$detail] = $item->getElementsByTagName($detail)->item(0)->nodeValue;
        }
        
        foreach ($item->getElementsByTagName('category') as $tagX) {
            @$list[$date]['tags'][] = $tagX->nodeValue;
        }
    }
    return $list;
}

$title = 'Tagged ' . $tag;
$feed = array('url' => '/feed/tag/' . $tag . '.rss');

?>
<?php require_once '_inc/header.inc.php'; ?>

    <h2>
        Things I've tagged &ldquo;<?php h($tag); ?>&rdquo;
        <?php if ($list) ?>
            <!-- @CSS -->
            <span style="font-weight: normal">(<?php h('%s things', count($list)); ?>)</span>
        <?php ?>
    </h2>
       
    <ul class="hfeed">
        <?php foreach ($list as $timestamp => $item) { ?>
        <!-- @CSS -->
        <li class="hentry" style="border-bottom: 1px solid #ccc">
            <h3>
                <a href="<?php h($item["link"]); ?>" rel="bookmark" class="entry-title">
                    <?php h($item["title"]); ?>
                </a>
                &nbsp;
                <!-- @CSS -->
                <span class="date" style="font-weight: normal">(<abbr class="published" title="<?php d($timestamp, 'c'); ?>"><?php d($timestamp); ?></abbr>)</span>
            </h3>
            
            <?php if ($item["description"] && strip_tags($item["description"])!=$item["title"]) { ?>
            <p class="entry-content">
                <?php echo $item["description"]; ?>
            </p>
            <?php } ?>
            
            <?php if (isset($item['tags'])) { ?>
            <!-- @CSS -->
            <p class="entry-tags" style="font-size: .8em; margin-top: -1em">
                Also tagged
                    <?php foreach($item['tags'] as $itemTag) { ?>
                        <a href="/tag/<?php h($itemTag); ?>"><?php h($itemTag); ?></a>
                    <?php } ?>
                </small>
            </p>
            <?php } ?>
        </li>
        <?php } ?>
    </ul>
    
<?php require_once '_inc/footer.inc.php'; ?>