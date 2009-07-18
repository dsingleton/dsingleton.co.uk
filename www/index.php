<?php require_once '../init.php'; ?>
<?php

$aRecentPosts = TumblrPost::getRecent(3);

?>
<?php require_once './_inc/header.inc.php'; ?>

        <h3>About</h3>
        <p>
            Check out my <a href="/about/cv/">CV</a> (recently updated) for more about my skills and work history. Working on something interesting? Let me know. Or take a look at my "elsewhere" links to learn a bit more about me personally.
        </p>
        
        <p>I have a few projects of my own hosted here, such as; 
            a selector for <a href="/code/icon-selector">Famfamfam silk icons</a>,
            a JS/Flash MP3 player called <a href="/code/1bit">1Bit</a>,
            and some prototype hacking on <a href="/code/lifestream">activity/life streaming</a> (powered by <a href="http://delicious.com/dsingleton/microformats">microformats</a> and Google <a href="http://delicious.com/dsingleton/socialgraph">Social Graph</a>).
        </p>
        
        <p>I occasionally <a href="/blog">blog</a>; some recent posts</p>
        <ol>
            <?php foreach($aRecentPosts as $oPost) {?>
            <li><a href="<?php h($oPost->getURL()); ?>"><?php h($oPost->getTitle()); ?></a></li>
            <?php } ?>
        </ol>

        <p>You can contact me via <em>[my first name]</em>@<em>[this domain]</em>. No spam please.</p>

        <h3>Elsewhere online</h3>
        <p>
            I collect <a href="http://del.icio.us/dsingleton/" rel="me">links</a>, 
            take <a href="http://flickr.com/photos/davidsingleton/" rel="me">photos</a>,
            listen to <a href="http://last.fm/user/underpangs/" rel="me">music</a>,
            attend <a href="http://upcoming.yahoo.com/user/30794/" rel="me">events</a>,
            write <a href="http://github.com/dsingleton" rel="me">code</a>
            and talk <a href="http://twitter.com/dsingleton/" rel="me">nonsense</a>.
        </p>

        <p>There are also some other David Singletons. You might be looking for <a href="http://www.google.com/search?q=david%20singleton%20-dsingleton.co.uk">one of them</a> instead.</p>

<?php require_once './_inc/footer.inc.php'; ?>