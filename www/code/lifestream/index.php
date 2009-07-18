<?php

/*    
    Todo:

    * Character encoding issues, track down cause, fix
    * Fix bradfitz/adactio cass, slow, some feeds missing?
    * normalise cache URLs rather than hashing, easier debuging, but potential collisions 
    * Join google group (http://groups.google.com/group/social-graph-api) and ask aout lack of flickr/other auto RSS    
    * List friends, linkable list for exploration, building towards friend agrigates.
    * A Rules class (or somthing) to autocreate some feed urls (last.fm recent, and events?) Any other common ones that cn be constructed through URLS

    * Add auto-discoverable RSS to http://www.last.fm/user/underpangs/charts/?charttype=recenttracks
    * Huma date, show year if not this year
    * Use social graph to do redirection, zomg
    
    URLs:
    
    * http://code.google.com/apis/socialgraph/docs/api.html
    * http://groups.google.com/group/social-graph-api
    * http://tinyurl.com/2egz9s (Flickr userid lookup)
    * http://tools.microformatic.com/
*/

date_default_timezone_set("Europe/London");
//error_reporting(0);

function h($h) { echo htmlentities($h); }
function ifnull($what, $else) { return $what ? $what : $else; }

$socialGraphAPI = "http://socialgraph.apis.google.com/lookup?q=%s&fme=1&pretty=1";
$hKitURL = "http://tools.microformatic.com/query/json/hkit/%s";

$feeds = array();
$list = array();

$url = @$_GET['profile'];
$profileURL = preg_replace('/^(http[s]?:\/\/)([^\/]*)/i', '$1$2', $url);


if ($profileURL && !preg_match('/http[s]?:\/\//', $profileURL)) {
    $profileURL = 'http://' . $profileURL;
}


if ($profileURL) {
    // Log access
    $log = fopen('access.log', 'a');
    fwrite($log, date('r') . "\t$profileURL\n");
    fclose($log);
    
    // Up the hKit..
    $hCardURL = sprintf($hKitURL, $profileURL);
    $json = getCachedURL($hCardURL, 60 * 60 * 6);
    $hCard = @array_shift(json_decode($json));
    
    // $responseJSON = getCachedURL(sprintf($sgFriends, $profileURL), 60 * 60 * 6);
    // $responsePHP = json_decode($responseJSON);

    // Up the social graph
    $sgURL = sprintf($socialGraphAPI, $profileURL);
    $responseJSON = getCachedURL($sgURL, 60 * 60 * 6);
    if (@$_GET['dumpJSON']) {
        die($responseJSON);
    }
    
    $responsePHP = json_decode($responseJSON);

    foreach($responsePHP->nodes as $siteURL => $siteProfile) {

        if ($profileURL == $siteURL) {
            
        }
        
        $hasDomain = ($domain = parse_url($siteURL, PHP_URL_HOST)); 
        $feed = @$siteProfile->attributes->rss;
        
        // if ($hasDomain && !$feed) {
        //     if ($domain == 'www.last.fm') {
        //         $user = substr($siteURL, -11, 10);
        //         $feedURL = 'http://pipes.yahoo.com/pipes/pipe.run?_id=982b5cbb04dd3568eb973df43615520c&_render=rss&lastFmUser=%s';
        //         $feed = sprintf($feedURL, $user);
        //     }
        // }
        if ($hasDomain && $feed) {
            $feeds[$domain] = $feed;
        }
        elseif ($siteURL) {
            $noFeeds[$domain] = $siteURL;
        }
    }

    $list = feedsToList($feeds);
}

function getCachedURL($url, $timeout = 900) // 15 min
{
    $cache = 'cache/' . md5($url);
    $feed = @file_get_contents($cache);
    $age = time() - getlastmod($cache);
    if (!$feed || $age > $timeout ) {

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
        $feed = curl_exec($ch);
        file_put_contents($cache, $feed);
        
        if (@$_GET['showCaching']) trigger_error("Cache hit for ($url)", E_USER_NOTICE);
    }
    return $feed;
}

function feedsToList($feeds) {
    
    $list = array();
    foreach ($feeds as $name => $feed) {

        $feedStr = getCachedURL($feed);
        $rss = new DOMDocument();
        @$rss->loadXML($feedStr);
        foreach ($rss->getElementsByTagName("item") as $item) {
            
            $dateField = $item->getElementsByTagName("pubDate")->item(0) ? 'pubDate' : 'date';
            $date = strtotime(substr($item->getElementsByTagName($dateField)->item(0)->nodeValue, 0, 25));

            $list[$date]["name"] = $name;

            foreach (array('title', 'link') as $detail) {
                $list[$date][$detail] = $item->getElementsByTagName($detail)->item(0)->nodeValue;
            }
        }
    }
    krsort($list);
    return $list;
}

?>


<?php include 'header.php'; ?>


        <h1>Activity derived from XFN</h1>
        
        <div class="content secondary" style="float: right; width: 170px; margin-right: -200px">         
            <form action="./" method="get">
                <label for="profile">Enter a URL</label>
                <input type="text" class="text" id="profile" name="profile" />
                
                <input type="submit" class="submit" value="Go" />
                <p>Or try one of these&hellip; <a href="/code/lifestream/dsingleton.co.uk">dsingleton.co.uk</a>, <a href="/code/lifestream/ben-ward.co.uk">ben-ward.co.uk</a>, <a href="/code/lifestream/adactio.com">adactio.com</a>, <a href="/code/lifestream/bradfitz.com">bradfitz.com</a></p>
            </form>
            
            <?php if (@$profileURL) { ?>
                
            <h3>Activity for</h3>
            <p><a href="<?php h($profileURL) ?>"><?php h($profileURL) ?></a></p>
            
            <?php if (@$hCard->fn) { ?>
            <div class="vcard">
            <address>
                <?php if (@$hCard->logo) { ?>
                <img class="logo" src="<?php h($hCard->logo) ?>" alt="x" />
                <?php } ?>
                <a class="url fn" href="<?php h($profileURL); ?>">
                <?php echo htmlentities($hCard->fn); ?>
                </a>                
            </address>
            </div>
            <?php } else { ?>
                <p>No hCard found :(</p>
            <?php } ?>

            <?php if ($feeds) { ?>
            <p>
                Available as
                <a class="ical" href="webcal://suda.co.uk/projects/microformats/hcalendar/get-cal.php?uri=http://me.dsingleton.co.uk/code/lifestream/<?h(rawurlencode($profileURL)) ?>">iCal</a>
                or
                <a class="feed" href="feed://tools.microformatic.com/transcode/atom/hatom/me.dsingleton.co.uk/code/lifestream/<?php h($profileURL); ?>">RSS</a>
            </p>
            <?php } ?>
            
            <?php if (@$noFeeds) { ?>
            <h3>Links without feeds</h3>
            <ul class="noFeeds">
            <?php foreach($noFeeds as $domain => $feed) { ?>
            <li><img src="/code/grabicon/<?php h($feed) ?>" width="16" /> <a href="<?php h($feed) ?>"><?php h(ifnull($domain, $feed)) ?></a></li>
            <?php } ?>
            </ul>
            <?php } ?>
            
            <?php } ?>
        </div>
        
        <div class="content primary">
        <?php if (!$profileURL) { ?>
            
            <p>Enter a URL to search to the right, or try an example URL.</p>
            
            <p>The first load for a URL might be a little slow, after that it will cache for a while;</p>
            <ul>
                <li><strong>RSS</strong> - Cached for 15 minutes</li>
                <li><strong>hCard</strong>, <strong>Social Graph</strong> - Cached for 6 hours</li>
            </ul>
            
        <?php } else { ?>
            
            <?php if (!$list) { ?>
                <h3>Uh oh, couldn't find any feeds for your URL.</h3>
                
                <p>First of all, this requires you to have some XFN <em>rel=me</em> marked up around the web (or a discoverable FOAF file). If you haven't got these then it won't work :(</p>
                
                <p>Take a look at the <a href="<?php h($sgURL); ?>">Show SocialGraph API response</a>, if there are no claimed nodes then it's possible the API may not have indexed you properly, or not updated it's cache of your profile recently.</p>
                
                <p>If you're pretty sure your site is right you it may be a parsing bug with the SocialGraph API, why not visit the <a href="http://groups.google.com/group/social-graph-api">mailing list</a> and let them know.</p>
                
                <h4>Known Issues</h4>
                <ul>
                    <li>Don't use your twitter account as a start point, they use <strong>rel="me nofollow"</strong> so it's rightfully not followed. Bad twitter.</li>
                </ul>
            <?php } ?>
            
        <table class="hcalendar hfeed activity">
            <tbody>
        <?php $day = ""; ?>

        <?php foreach ($list as $timestamp => $item) { ?>

        <?php if ($day != ($this_day = date("F jS",$timestamp))) { ?>
            </tbody>
            
            <tbody> 
                <tr class="day">
                    <th colspan="3"><?php h($this_day); ?></th>
                </tr>
            
            <?php $day = $this_day; ?>

        <?php } ?> 
                <tr class="vevent hentry">
                    <th class="time">
                        <abbr class="dtstart published" title="<?php h(date('c', $timestamp)); ?>">
                            <?php echo date("g:ia",$timestamp); ?>
                            
                        </abbr>
                    </th>
        
                    <td class="item">
                        <a class="url summary entry-title" rel="bookmark" href="<?php h($item["link"]); ?>">
                            <?php echo htmlentities($item["title"]); ?>
                            
                        </a>
                    </td class="site">
                    <td>
                        <?php printf('<img class="icon" src="/code/grabicon/?url=%s" alt="%s" title="%s" width="16" />', $item['name'], $item['name'], $item['name']); ?>
                        
                    </td>
                </tr>

        <?php } ?>
            </tbody>
        </table>
        <?php } ?>
        
        <h3>URLs called</h3>
        <ul>
            <li><a href="<?php h($hCardURL)?>"><?php h($hCardURL) ?></a></li>
            <li><a href="<?php h($sgURL)?>"><?php h($sgURL) ?></a></li>
        </div>
        
<?php include 'footer.php'; ?>
