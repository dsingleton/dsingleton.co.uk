<?php require_once '../init.php'; ?>
<?php

@list(, $page, $post) = explode('/', urldecode($_SERVER['REQUEST_URI']));

$aPosts = TumblrPost::getRecent(50);

if ($post) {
    $action = 'view';
    $oPost = TumblrPost::getBySlug($post);
    if ($oPost) {
        $title = $oPost->getTitle();
        $aPosts = array_slice($aPosts, 0, 10);
    }
    else {
        $action = '404';
    }
}
else {
    $action = 'list';
    $title = "Blog";
}

$feed = array('url' => '/feed/blog.rss');

?>
<?php require_once './_inc/header.inc.php'; ?>

<?php if ($action == 'view') { ?>
        
<article class="blog-entry">
        <h1><?php h($oPost->getTitle()); ?></h1>
        <?php echo $oPost->getBody(); ?>

        <ul class="tags">
        <?php foreach($oPost->getTags() as $tag) { ?>
            <li><a rel="tag" href="/tag/<?php h($tag); ?>"><?php h($tag); ?></a></li>
        <?php } ?>
        </ul>
</article>

<aside>
    <div class="recent posts">
        <h4>Recent posts</h4>
        <ul class="posts">
        <?php foreach($aPosts as $oPost) { ?>
            <li><a href="<?php h($oPost->getURL()); ?>"><?php h($oPost->getTitle()); ?></a></li>
        <?php } ?>
        </ul>
        
        <p><a href="/blog">More&hellip;</p>
    </div>
</aside>

<?php } elseif ($action == 'list') { ?>

<article>
    <h1>Blog</h1>
    <div class="hfeed">
        <?php foreach($aPosts as $oPost) { ?>
        <div class="hentry">
            <h2 class="entry-title">
                <a href="<?php h($oPost->getURL())?>" rel="bookmark">
                    <?php h($oPost->getTitle()); ?>
                </a>
            </h2>
            
            <p class="post-info">
                Written on 
                <abbr class="published" title="<?php d($oPost->getDate(), 'c'); ?>"><?php d($oPost->getDate()); ?></abbr>
                <span class="attibution">| By <span class="vcard"><a class="url fn" href="/">David Singleton</a></span></span>
            </p>
            
            <p class="entry-content"><?php echo ($oPost->getExtract()); ?>&hellip; <a href="<?php h($oPost->getURL()); ?>">read more</a>.</p>
        </div>
        <?php } ?>
    </div>
</article>
<?php } else { ?>
<article>
    <h3>404, post not found.</h3>
</article>
<?php } ?>
</article>

<?php require_once './_inc/footer.inc.php'; ?>