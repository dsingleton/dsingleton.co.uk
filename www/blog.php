<?php require_once '../init.php'; ?>
<?php

@list(, $page, $post) = explode('/', urldecode($_SERVER['REQUEST_URI']));

if ($post) {
    $action = 'view';
    $oPost = TumblrPost::getBySlug($post);
    if ($oPost) {
        $title = $oPost->getTitle();
    }
    else {
        $action = '404';
    }
}
else {
    $action = 'list';
    $title = "Blog";
    $aPosts = TumblrPost::getRecent(50);
}

$feed = array('url' => '/feed/blog.rss');

?>
<?php require_once './_inc/header.inc.php'; ?>

<p style="padding: 10px 0 0;">See also, other recent <a href="/blog">blog posts</a>.</p>

<?php if ($action == 'view') { ?>

        <h3><?php h($oPost->getTitle()); ?></h3>
        <?php echo $oPost->getBody(); ?>
        
        <div class="tags">
            <h4>Tagged with;</h4>
            <ul class="tags">
                <?php foreach($oPost->getTags() as $tag) { ?>
                    <li><a href="/tag/<?php h($tag); ?>"><?php h($tag); ?></a></li>
                <?php } ?>
            </ul>
        </div>
        
<?php } elseif ($action == 'list') { ?>
    
    <div class="hfeed">
        <?php foreach($aPosts as $oPost) { ?>
        <div class="hentry">
            <h3 class="entry-title">
                <a href="<?php h($oPost->getURL())?>" rel="bookmark">
                    <?php h($oPost->getTitle()); ?>
                </a>
            </h3>
            
            <p class="post-info">
                Written on 
                <span class="published" title="<?php d($oPost->getDate(), 'c'); ?>"><?php d($oPost->getDate()); ?></span>
                | By
                <span class="vcard"><a class="url fn" href="/">David Singleton</a></span>
            </p>
            
            <p class="entry-content"><?php echo ($oPost->getExtract()); ?>&hellip; <a href="<?php h($oPost->getURL()); ?>">read more</a>.</p>
        </div>
        <?php } ?>
    </div>
<?php } else { ?>
    
    <h3>404, post not found.</h3>
    
<?php } ?>
<?php require_once './_inc/footer.inc.php'; ?>