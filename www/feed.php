<?php require_once '../init.php'; ?>
<?php

$aSupportedFormats = array('atom', 'rss', 'json');
$aSupportedPages = array('blog', 'tag');
$aFilteredPages = array('tag');

@list(, , $page, $filter) = explode('/', urldecode($_SERVER['REQUEST_URI']));

if (in_array($page, $aFilteredPages)) {
    @list($filter, $format) = explode('.', $filter);
}
else {
    @list($page, $format) = explode('.', $page);
}

if (!in_array($page, $aSupportedPages)) {
    http_404();
    die('Invalid feed');
}

if (!in_array($format, $aSupportedFormats)) {
    http_404();
    die('Invalid feed format');
}

$pageURL = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $page;
if ($filter) {
    $pageURL .= '/' . $filter;
}

$transcodeURL = sprintf('http://tools.microformatic.com/transcode/%s/hatom/%s', $format, $pageURL);


// @cache
echo file_get_contents($transcodeURL);