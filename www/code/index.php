<?php require_once '../../init.php'; ?>
<?php

$oTag = new Tag('code');
$aPosts = $oTag->getItemsBySource('tumblr', 5);

$title = 'Code';

?>
<?php require_once '../_inc/header.inc.php'; ?>

    <h2>Code</h2>
    <p>These are some projects i've worked on, prototypes, proof of concepts or just quick experiments. They come in a variety of sizes and cover a range of technologies and languages. From front-end HTML/CSS/JS demos to web-services and applications.
    </p>
    
    <article>
        <h3>Projects &amp; Demos</h3>
        <dl>
            <dt><a href="https://github.com/dsingleton/playdar/tree">Playdar</a></dt>
            <dd>A content resolution service for music. I've contributed resolver scripts for <a href="http://hypem.com">Hype Machine</a> and <a href="http://last.fm">Last.fm</a> free downloads. Find out more at <a href="http://playdar.org">Playdar.org</a></dd>

            <dt><a href="https://github.com/dsingleton/dsingleton.co.uk/tree">dsingleton.co.uk</a></dt>
            <dd>The code for every page of this site is open source and freely available on GitHub. If you want to do something with it, particularly tag filer/aggregation, please get in touch.</dd>

            <dt><a href="/code/firefox-plugin-test-suite">Firefox plugin detection test-suite</a></dt>
            <dd>A set of heuristic test to detect certain plugins, like NoScript, FlashBlock and AdBlock.</dd>

            <dt><a href="/code/icon-selector">Icon Selector</a></dt>
            <dd>An interface to searching for icons within the excellent FamFamFam icon set, powered by jQuery. Provides a live search, with immediate visual feedback highlight matching icons.</dd>

            <dt><a href="/code/1bit">1bit Player</a></dt>
            <dd>A simple and lightweight inline Flash MP3 player with automatic JavaScript insertion. It's main purpose is to act as a quick in-page preview for audio files you link to from your website or blog.</dd>

            <dt><a href="/code/lifestream">Lifestream</a></dt>
            <dd>Powered by microformats (XFN relationships) and the Google Social Graph API. This takes a starting URL, like a users homepage, and tries to find feeds for all mapped sites, then builds an activity stream using this data.</dd>

            <dt>Last.fm Tag-Cloud <small>(retired)</small></dt>
            <dd>A visualization of a users weekly top artists. It combines a Last.fm webservice call and an XSL transformation to generate the tag-cloud markup.</dd>

            <dt><a href="/code/network-summary">Delicious Network Summary</a></dt>
            <dd>An aggregate view of my <a href="http://delicious.com">delicious</a> network page, it aims to highlight trends, tags and popular bookmarks across a number of friends</dd>

            <dt>Grabicon</dt>
            <dd>A short lived project to provide a consistent interface to website favicon images. As a 3rd party API you would call with the domain you wanted an icon for and it would return the image data. This was superseded by a Google service doing pretty much the same thing (though theirs came later)</dd>

            <dt>Older demos</dt>
            <dd>
                <p><a href="/code/better-tables">Better Tables</a> - An example of well designed table, visually and semantically.<br>
                <a href="/code/fades">Javascript Fades</a> - Using Javascript to fade content from one colour to any other.</p>
            </dd>
        </dl>
            
    </article>
    
    <aside>

        <h3>Blogging about code</h3>
        <p>Recent posts include, <?php foreach($aPosts as $oPost) { ?><?php l($oPost); ?>, <?php } ?>check out things i've tagged <a href="/tag/code">code</a> too.</p>
        
    </aside>

<?php require_once '../_inc/footer.inc.php'; ?>