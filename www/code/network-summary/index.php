<?php require '../../../init.php'; ?>
<?php

require_once 'DeliciousNetwork.class.php';

if (@!$user = $_GET['user']) {
    $user = "dsingleton";
}

$oNetwork = new DeliciousNetwork($user);

$aLinks = $oNetwork->getTopLinks(5);

$aTags = $oNetwork->getTopTags(5);
$aAuthors = $oNetwork->getTopAuthors(5);
// $aDomains = $oNetwork->getTopDomains(10);

?>
<?php require '../../_inc/header.inc.php'; ?>
    
    <h2>Delicious Network Summary</h2>
    <p>
        What have <?php l('http://delicious.com/' . $oNetwork->getUser(), $oNetwork->getUser()); ?>'s friends been bookmarking recently? 
        (all <?php echo count($oNetwork->getTopAuthors()); ?> of them)
    </p>
    
    <div>
        <h2>Top Bookmarks</h2>
        <ol>
            <? foreach($aLinks as $link => $count): ?>
            <li>
                <?php l($link, $link); ?>
                <small>(saved <?= $count; ?> times)</small>
            </li>
            <? endforeach; ?>
        </ol>
    </div>
    
<div class="l-3col">
    <div class="primary content">
        <h2>Top Domains</h2>
        <ol>
            <? foreach($aLinks as $link => $count): ?>
            <li>
                <?php l('http://' . parse_url($link, PHP_URL_HOST), parse_url($link, PHP_URL_HOST)); ?>
                <small>(<?= $count; ?>&nbsp;times)</small>
            </li>
            <? endforeach; ?>
        </ol>
    </div>

    <div class="secondary content">
        <h2>Top Authors</h2>
        <ol>
            <? foreach($aAuthors as $author => $count): ?>
            <li>
                <?php l('http://delicious.com/' . $author, $author); ?>
                <small>(<?= $count; ?>&nbsp;items)</small>
            </li>
            <? endforeach; ?>
        </ol>
    </div>

    <div class="tertiary content">

        <h2>Top Tags</h2>
        <ol>
            <? foreach($aTags as $tag => $count): ?>
            <li>
                <a href="http://delicious.com/network/dsingleton/<?= h($tag); ?>"><?= h($tag); ?></a>
                <small>(<?= $count; ?>&nbsp;uses)</small>
            </li>
            <? endforeach; ?>
        </ol>
    </div>
</div>
    
<?php require '../../_inc/footer.inc.php'; ?>