<?php

// Extract domain
$aURL = @parse_url($_GET['url']);
$url = isset($aURL['host']) ? $aURL['host'] : $aURL['path'];

// Proxy on to google service
header('Location: http://www.google.com/s2/favicons?domain=' . urlencode($url));
exit;

/*
 * Deprecated in favour of the google service.
 * 
 * URL Rewriting: http://dsingleton.co.uk/code/favitar/png/google.com/
 * Cache defaults. (As symlinks, soft vs hard for date checking/accidental delete)
 * Better favico.ico test, HTTP following. - wget for everything? :/
 * Better scraping for rel linking
 * 
 *
 * Broken ones:
 * http://upcoming.yahoo.com/event/197924/ -- rel="shortcut icon" -- header bullshit
 * http://www.deviantart.com/ -- <link href="http://s.deviantart.com/icons/favicon.ico" rel="icon"/>
 */

if (!$url) {
    die('Demo page');
}

if (!$file = getCachedIcon($url)) {
    $favicon = findIconURL($url);
    if ($favicon) {
        $file = cacheIcon($url, $favicon);
    }
}

if (!$file && !isset($_GET['nodefault'])) {
    $file = generateCachePath('default');
}

if ($file) {
    header('Content-Type: image/png');
    echo file_get_contents($file);
}
else {
    header("HTTP/1.0 404 Not Found"); 
}

function findIconURL($domain)
{
    $parts = parse_url($domain);
    $domain = isset($parts['host']) ? $parts['host'] : $parts['path'];
    $url = 'http://' . $domain;
    $favicon = $url . '/favicon.ico';

    $headers = @join("\n", get_headers($favicon));
    // var_dump($headers);die;
    $isOK = strpos($headers, '200 OK') !== false && strpos($headers, '200 OK') < 30;
    $isImage = strpos($headers, 'Content-Type: image/') !== false;

    // This is still buggy, redirect following would be nice.

    if (!($isOK && $isImage)) {
        $favicon = extractFaviconLink($url);
    }
    
    return $favicon;
}

function extractFaviconLink($url)
{
    $grepFavicon = "wget -qO - $url | grep '<link'| grep 'rel=\"\(shortcut \)\?icon\"' | head -n 1 | perl -n -e '/href=\"(.[^\"]*)\"/ && print $1'";
    $favicon = exec($grepFavicon);

    if ($favicon && strpos($favicon, 'http') !== 0) {
        $favicon =  $url . $favicon;
    }

    return $favicon;
}

function cacheIcon($domain, $favicon)
{
    $tmp = '/tmp/favicon.ico';
    $cache = generateCachePath($domain);
    copy($favicon, $tmp);
    system("convert $tmp $cache");
    unlink($tmp);
    return $cache;
}

function generateCachePath($domain)
{
    return'icons/' . $domain . '.png';
}

function getCachedIcon($domain)
{
    $localFile = generateCachePath($domain);
    
    if (file_exists($localFile)) { // Check date
        return $localFile;
    }
    return false;
}

?>