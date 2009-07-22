<?php require_once '../init.php'; ?>
<?php

// Demo page
$aRecentPosts = TumblrPost::getRecent(5);

$oRecentPost = array_shift($aRecentPosts);

?>
<?php require_once './_inc/header.inc.php'; ?>

<h2>Style Guide</h2>
<p>A style guide for this website</p>

<h3>One Col</h3>

<p>Lorem ipsum dolor sit amet, <a href="#">consectetur adipisicing</a> elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud <del>exercitation</del> ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor <em>in reprehenderit in voluptate</em> velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, <strong>sunt in culpa</strong> qui officia deserunt mollit anim id est laborum.</p>

<div class="l-2col">
    <h3>Two Col</h3>
    <div class="primary">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
    </div>
    
    <div class="secondary">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
    </div>
</div>

<div class="l-rcol">
    <h3>Right Col</h3>
    <div class="primary">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
    </div>
    
    <div class="secondary">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
</div>

<div class="l-3col">
    <h3>Three Col</h3>
    <div class="primary">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
    
    <div class="secondary">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
    
    <div class="tertiary">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
</div>

<h3>Notes</h3>

<?php require_once './_inc/footer.inc.php'; ?>