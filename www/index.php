<?php require_once '../init.php'; ?>
<?php

$extra_css = array('/static/css/home.css');

$aPosts = TumblrPost::getRecent(3);

$feed = array('url' => '/feed/blog.rss');

?>
<?php require_once './_inc/header.inc.php'; ?>
    <article>
        <h2>Hello</h2>
        
<a href="http://www.flickr.com/photos/visivo/4669744135/" title="lastfm BBQ 4 lyfe by visivo, on Flickr"><img class="snapshot" src="http://farm5.static.flickr.com/4018/4669744135_b1c3a3634b_m.jpg" width="180" height="240" alt="lastfm BBQ 4 lyfe" /></a>
        
        <p>My name is David and I like to make <strong>things</strong>. Mostly on the web, but sometimes with paper, pens or potatoes.</p>
        
        <p>I live in London, I'm a web developer and I like doing a bit of everything. I work at <a href="http://last.fm">Last.fm</a> where I enjoy building things used by millions of people every day.</p>

        <p>I also like to write about my passions; <a href="/blog">technology</a>, <a href="http://last.fm/user/underpangs">music</a>, and <a href="http://munchmun.ch">food</a>, that sort of thing.</p>
        <br>
        
        <!-- <p>I have a few projects of my own hosted here, such as; 
                    a selector for <a href="/code/icon-selector">Famfamfam silk icons</a>,
                    a JS/Flash MP3 player called <a href="/code/1bit">1Bit</a>,
                    and some prototype hacking on <a href="/code/lifestream">activity/life streaming</a> (powered by <a href="/tag/microformats">microformats</a> and Google <a href="/tagsocialgraph">Social Graph</a>).
                </p> -->
        
        <h2>Recent blog posts</h2>
        <div class="hfeed">
            <?php foreach($aPosts as $oPost) { ?>
            <div class="hentry">
                <h3 class="entry-title">
                    <a href="<?php h($oPost->getURL())?>" rel="bookmark">
                        <?php h($oPost->getTitle()); ?>
                    </a>
                </h3>

                <p class="entry-content"><?php echo ($oPost->getExtract()); ?>&hellip; <a href="<?php h($oPost->getURL()); ?>">more &raquo;</a></p>
            </div>
            <?php } ?>
            <p><a href="/blog">Older Posts &raquo;</a></p>
        </div>
    </article>
    
    <aside>
        <h2>Get in touch</h2>
        
        <p>You can contact me via <a href="mailto:david@dsingleton.co.uk" class="email">david@dsingleton.co.uk</a> or <a href="http://twitter.com/?status=@dsingleton">@dsingleton</a> me on Twitter</p>
        
        <h2>Find me on&hellip;</h2>
        <ul>
            <li><a href="http://last.fm/user/underpangs/" rel="me">Last.fm</a></li>
            <li><a href="http://twitter.com/dsingleton/" rel="me">Twitter</a></li>
            <li><a href="http://delicious.com/dsingleton/" rel="me">Delicious</a></li>
            <li><a href="http://flickr.com/photos/davidsingleton/" rel="me">Flickr</a></li>
            <li><a href="http://github.com/dsingleton" rel="me">Github</a></li>
            <li><a href="http://upcoming.yahoo.com/user/30794/" rel="me">Upcoming</a></li>
        </ul>
        
        <p>There are also some other David Singletons. You might be looking for <a href="http://www.google.com/search?q=david%20singleton%20-dsingleton.co.uk">one of them</a> instead.</p>
    </article>

<?php require_once './_inc/footer.inc.php'; ?>