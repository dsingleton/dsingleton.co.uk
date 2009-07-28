<?php require_once '../init.php'; ?>
<?php

// parse_request
// $oRequest->getDir() / getResource() / getFilter() / getPage()
@list(, $page, $tag, $source) = explode('/', urldecode($_SERVER['REQUEST_URI']));
$source = substr($source, 1);

if ($tag) {
    
    $oTag = new Tag($tag);

    if ($source) {
        $list = $oTag->getItemsBySource($source);
    }
    else {
        $list = $oTag->getRecentItems();
    }
    
    $title = 'Tagged ' . $oTag->getTitle();
    $feed = array('url' => '/feed/tag/' . $oTag->getSlug() . '.rss');
}
else {
    $title = "Tags";
}

?>
<?php require_once '_inc/header.inc.php'; ?>

    <?php if (!$tag) { ?>

    <h1>
        My life in tags
    </h1>
    
    <p>Mostly of the sites I use daily give me the option to tag content, particuarly my bookmarks and photos, even Twitter has some explicit tagging (hash tags).</p>
    
    <p>This site takes content from each of those sites and filters it by tag, that mean if you visit my <a href="/tag/design">design</a> tag page, you'll get content form those sites that i've tagged design.</p>
    
    <p>These are some bundles (in <a href="http://delicious.com">delicious</a> terms) of grouped/related of the more common tags I use.</p>
    
    <h2>Front End Development &amp; Design</h2>
    <p><a href="/tag/webdev">Web Development</a>, <a href="/tag/php">PHP</a>, <a href="/tag/css">CSS</a>, <a href="/tag/javascript">Javascript</a>, <a href="/tag/html">HTML</a>, <a href="/tag/html5">HTML5</a>, <a href="/tag/standards">Standards</a>, <a href="/tag/browser">Browsers</a>, <a href="/tag/flash">Flash</a></p>
        
    <h2>Back End Development</h2>
    <p><a href="/tag/php">PHP</a>, <a href="/tag/mysql">MySQL</a>, <a href="/tag/python">Python</a>, <a href="/tag/scalability">Scalability</a>, <a href="/tag/testing">Testing</a>, <a href="/tag/apache">Apache</a>, <a href="/tag/hacking">Hacking</a>, <a href="/tag/unix">Unix</a>, <a href="/tag/bash">Bash</a>, <a href="/tag/sqlite">SQLite</a>, <a href="/tag/Git">Git</a></p>
    
    <h2>London</h2>
    <p>
        <a href="/tag/london">London</a>, <a href="/tag/thingstodo">Things to do</a>, <a href="/tag/lastfm">Last.fm</a>, <a href="/tag/shoreditch">Shoreditch</a>, <a href="/tag/pubstandards">Pub Standards</a>, <a href="/tag/music">Music</a>, <a href="/tag/history">History</a>, <a href="/tag/hackney">Hackney</a>, <a href="/tag/transport">Transport</a>.
    </p>

    <?php } else { ?>
    <h2>
        Things I've tagged &ldquo;<?php h($oTag->getTitle()); ?>&rdquo;
        <?php if ($source) { ?> 
            from <?php h($source); ?>
        <?php } ?>
        <?php if ($list) ?>
            <!-- @CSS -->
            <span style="font-weight: normal">(<?php h('%s things', count($list)); ?>)</span>
        <?php ?>
    </h2>
    
    <ul class="hfeed">
        <?php foreach ($list as $oItem) { ?>
        <!-- @CSS -->
        <li class="hentry" style="border-bottom: 1px solid #ccc">
            <h3>
                <a href="<?php h($oItem->getURL()); ?>" rel="bookmark" class="entry-title">
                    <?php h($oItem->getTitle()); ?>
                </a>
                &nbsp;
                <!-- @CSS -->
                <span class="date" style="font-weight: normal">
                    (<abbr class="published" title="<?php d($oItem->getDate(), 'c'); ?>"><?php d($oItem->getDate()); ?></abbr>)
                </span>
            </h3>
            
            <?php if ($oItem->getBody() && strip_tags($oItem->getBody())!=$oItem->getTitle()) { ?>
            <p class="entry-content">
                <?php echo $oItem->getBody(); ?>
            </p>
            <?php } ?>
            
            <?php if ($oItem->getTags()) { ?>
            <!-- @CSS -->
            <p class="entry-tags" style="font-size: .8em; margin-top: -1em">
                Also tagged
                    <?php foreach($oItem->getTags() as $itemTag) { ?>
                        <a href="/tag/<?php h($itemTag); ?>"><?php h($itemTag); ?></a>
                    <?php } ?>
                </small>
            </p>
            <?php } ?>
        </li>
        <?php } ?>
        
        <?php if (!$list) { ?>
            <p>Nothing found for that tag</p>
        <?php } ?>
    </ul>
    
    <?php } ?>
    
<?php require_once '_inc/footer.inc.php'; ?>