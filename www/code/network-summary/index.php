<?php

require_once '../_resources/main.php';
require_once 'DeliciousNetwork.class.php';

if (!$user = $_GET['user']) {
    $user = "dsingleton";
}

$oNetwork = new DeliciousNetwork($user);

$aLinks = $oNetwork->getTopLinks();
$aTags = $oNetwork->getTopTags();
$aAuthors = $oNetwork->getTopAuthors(10);
// $aDomains = $oNetwork->getTopDomains(10);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Delicious Network Summary</title>
    <link rel="stylesheet" href="../_static/css/text.css" type="text/css" />
    <link rel="stylesheet" href="../_static/css/structure.css" type="text/css" />
    
    <style>
        ol {
            list-style-type: decimal;
        }
    </style>
  </head>

  <body class="l-3col">
      
    <h1>Delicious Network Summary</h1>
    <p>For <a href=""><?= h($oNetwork->getUser())?></a> from X friends</p>
    
    <div class="">
        <h2>Top Bookmarks</h2>
        <ol>
            <? foreach($aLinks as $link => $count): ?>
            <li>
                <a href=""><?= h($link); ?></a>
                <small>(saved <?= $count; ?> times)</small>
            </li>
            <? endforeach; ?>
        </ol>
    </div>
    
    <div class="primary content">
        <h2>Top Domains</h2>
        <ol>
            <? foreach($aLinks as $link => $count): ?>
            <li>
                <a href=""><?= h($link); ?></a>
                <small>(saved <?= $count; ?> times)</small>
            </li>
            <? endforeach; ?>
        </ol>
    </div>

    <div class="secondary content">
        <h2>Top Authors</h2>
        <ol>
            <? foreach($aAuthors as $author => $count): ?>
            <li>
                <a href=""><?= h($author); ?></a>
                <small>(saved <?= $count; ?> items)</small>
            </li>
            <? endforeach; ?>
        </ol>
    </div>

    <div class="tertiary content">

        <h2>Top Tags</h2>
        <ol>
            <? foreach($aTags as $tag => $count): ?>
            <li>
                <a href=""><?= h($tag); ?></a>
                <small>(used <?= $count; ?> times)</small>
            </li>
            <? endforeach; ?>
        </ol>

    </div>

    <a href="/code" id="morelink">More Code</a>

  </body>
</html>