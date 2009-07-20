<?php require_once '../init.php'; ?>
<?php

// parse_request
// $oRequest->getDir() / getResource() / getFilter() / getPage()
@list(, $page, $tag, $source) = explode('/', urldecode($_SERVER['REQUEST_URI']));
$source = substr($source, 1);

$oTag = new Tag($tag);

if ($source) {
    $list = $oTag->getItemsBySource($source);
}
else {
    $list = $oTag->getRecentItems();
}

$title = 'Tagged ' . $oTag->getTitle();
$feed = array('url' => '/feed/tag/' . $oTag->getSlug() . '.rss');

?>
<?php require_once '_inc/header.inc.php'; ?>

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
    
<?php require_once '_inc/footer.inc.php'; ?>