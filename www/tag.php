<?php require_once '../init.php'; ?>
<?php

// parse_request
// $oRequest->getDir() / getResource() / getFilter() / getPage()
@list(, $page, $tag, $source) = explode('/', urldecode($_SERVER['REQUEST_URI']));
$source = substr($source, 1);


$aBundles = array(
    'Front End Development & Design' => array('Web Development', 'PHP', 'CSS', 'Javascript', 'HTML', 'HTML5', 'Standards', 'Browsers'),
    'Back End Development' => array('PHP', 'MySQL', 'Python', 'Ruby', 'NoSQL', 'Scalability', 'Testing', 'Apache', 'Hacking', 'Unix', 'Bash', 'SQLite', 'Git', 'Programming', 'Security'),
    'London' => array('London', 'Things to do', 'Last.fm', 'Shoreditch', 'Pub Standards', 'Music', 'History', 'Hackney', 'Transport')
);

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
<article>
    <h1>
        My life in tags
    </h1>
    
    <p>Mostly of the sites I use daily give me the option to tag content, particuarly my bookmarks and photos, even Twitter has some explicit tagging (hash tags).</p>
    
    <p>This site takes content from each of those sites and filters it by tag, that mean if you visit my <a href="/tag/design">design</a> tag page, you'll get content form those sites that i've tagged design.</p>
    
    <p>These are some bundles (in <a href="http://delicious.com">delicious</a> terms) of grouped/related of the more common tags I use.</p>
    <?php foreach($aBundles as $bundleName => $aTags) { ?>
        <h2><?php h($bundleName); ?></h2>
        <ul class="tags">
            <?php foreach($aTags as $tag) { $oTag = new Tag($tag); ?>
            <li><a rel="tag" href="<?php h($oTag->getURL()); ?>"><?php h($oTag->getTitle()); ?></a></li>
            <?php } ?>
        </ul>
    <?php } ?>
</article>
    <?php } else { ?>

<article>
    <h1>
        <?php h("%s things tagged “%s”", count($list), $oTag->getTitle()); ?>
        <?php if ($source) { ?> 
            from <?php h($source); ?>
        <?php } ?>
    </h1>
    
    <ul class="hfeed things">
        <?php $lastDate = null; ?>
        <?php foreach ($list as $oItem) { ?>
        <li class="hentry">
            <hgroup>
                <?php if ($lastDate != date('d-m-y', $oItem->getDate())) { ?>
                <h2 class="date">
                    <abbr class="published" title="<?php d($oItem->getDate(), 'c'); ?>"><?php d($oItem->getDate()); ?></abbr>
                </h2>
                <?php 
                } 
                $lastDate = date('d-m-y', $oItem->getDate()); ?>
                <h3>
                    <a href="<?php h($oItem->getURL()); ?>" rel="bookmark" class="entry-title">
                        <?php h($oItem->getTitle()); ?>
                    </a>
                </h3>
            </hgroup>
            
            <!--
            <p class="info">
                A <strong>thing</strong> 
                from <a style="bacground-image: url()" class="favicon" href="<?php h($oItem->getSourceURL()); ?>"><?php h($oItem->getSourceDomain()); ?></a>
            </p>
            -->
            
            <div class="entry-content">
                <?php if ($oItem->getBody() && strip_tags($oItem->getBody())!=$oItem->getTitle()) { ?>
                    <?php echo $oItem->getBody(); ?>
                <?php } ?>
            </div>
            
            <?php if ($oItem->getTags()) { ?>
            <ul class="entry-tags tags" title="Tagged with&hellip;">
                <?php foreach($oItem->getTags() as $itemTag) { ?>
                    <li>
                        <a rel="tag" href="/tag/<?php h($itemTag); ?>" title="More things tagged &ldquo;<?php h($itemTag); ?>&rdquo;">
                            <?php h($itemTag); ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <?php } ?>
        </li>
        <?php } ?>
        
        <?php if (!$list) { ?>
            <p>Nothing found</p>
        <?php } ?>
    </ul>
</article>

    <?php } ?>
    
<?php require_once '_inc/footer.inc.php'; ?>