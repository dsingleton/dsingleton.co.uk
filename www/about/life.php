<?php

/*
    Process
    
    * Form Graph URL
    * Split into sites and feeds
    * Guess feeds where possible (using a local site lookup)
    * Filter iffy domains, ie upcoming.org
    * Map domains together by type for iconing
    * Oh god, caching.
    * Get a XFN friends list, combine to make a friend activity watcher. (this could be awesome)
    
    Todo:
    
    * Nove to /code/lifestream with redirect
    * A Rules class (or somthing) to autocreate some feed urls (last.fm recent, and events?) Any other common ones that cn be constructed through URLS
    * Join google group (http://groups.google.com/group/social-graph-api) and ask aout lack of flickr/other auto RSS
    * Add auto-discoverable RSS to http://www.last.fm/user/underpangs/charts/?charttype=recenttracks
    * Huma date, show year if not this year
    * CSV list of excluded domains
    * Use social graph to do redirection, zomg
    
    URLs:
    
    * http://code.google.com/apis/socialgraph/docs/api.html
    * http://groups.google.com/group/social-graph-api
    * http://tinyurl.com/2egz9s (Flickr userid lookup)
    * http://tools.microformatic.com/
*/

date_default_timezone_set("Europe/London");
error_reporting(E_ALL);

$socialGraphAPI = "http://socialgraph.apis.google.com/lookup?q=%s&fme=1&pretty=1&callback=";

if (!$profileURL = @$_GET['profile']) {
    die('<h2>Need a profile URL (/life.php?profile=<URL HERE>)</h2>');
}

$response = json_decode(file_get_contents(sprintf($socialGraphAPI, $profileURL)));
    
$feeds = array();

foreach($response->nodes as $siteURL => $siteProfile) {
    $tmp = parse_url($siteURL);
    if (($domain = @$tmp['host']) && ($feed = @$siteProfile->attributes->rss)) {
        $feeds[$domain] = $feed;
    }
}

if (!$feeds) {
    echo '<h2>No feeds found</h2><pre>';
    var_dump($response);
    die;
}

$list = array();

$rss = new DOMDocument();

foreach ($feeds as $name => $feed) {
    
    @$rss->load($feed);
    
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

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>Activity derived from XFN</title>
        
        <style type="text/css">
        body {
            margin: 1em 0 3em;
            padding: 0 1em;
        	font-family: "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, Arial, sans-serif;
        	color: #333;
        	background: #fff;
        }
        a,
        a img {
        	border: none;
        }
        h1 {
        	margin: 0;
        }
        abbr {
        	text-decoration: none;
        	border: none;
        	text-align: right;
        	display: block;
        }
        
        table {
        	border-collapse: collapse;
        	margin: 0 7%;
        }
        thead th {
        	font-family: Georgia, "Times New Roman", serif;
        	font-size: 1.2em;
        	padding-top: 1em;
        }
        tbody td {
            border-bottom: 1px solid #999;
        }
        .link a {
        	background: #369;
        }
        
        img.icon {
            background: ;
        }
        
        </style>
    </head>
    <body class="l-3col">
        
        <h1>Activity derived from XFN</h1>
        <address style="display: inline; margin: 0;" class="vcard author"><a class="url fn" href="<?php echo htmlentities($profileURL); ?>">This person.</a></address>
        <p>Available as <a href="webcal://suda.co.uk/projects/microformats/hcalendar/get-cal.php?uri=http://dsingleton.co.uk/about/life.php?profile=<?echo htmlentities(rawurlencode($profileURL)) ?>">iCal</a>
            or
            <a href="feed://tools.microformatic.com/transcode/atom/hatom/dsingleton.co.uk/about/life.php<?php echo urlencode('?'); ?>profile=<?php echo htmlentities($profileURL); ?>">RSS</a>
        </p>
        
        <table class="hcalendar hfeed">
            <tbody>
        <?php $day = ""; ?>

        <?php foreach ($list as $timestamp => $item) { ?>

        <?php if ($day != ($this_day = date("F jS",$timestamp))) { ?>
            </tbody>
            
                <thead>
                      <tr>
                          <th colspan="3"><?php echo htmlentities($this_day); ?></th>
                      </tr>
                </thead>
    
            <tbody>                  
            
            <?php $day = $this_day; ?>

        <?php } ?> 
                <tr class="vevent hentry">
                    <th>
                        <abbr class="dtstart published" title="<?php echo date('c', $timestamp); ?>">
                            <?php echo date("g:ia",$timestamp); ?>
                            
                        </abbr>
                    </th>
        
                    <td>
                        <a class="url summary entry-title" rel="bookmark" href="<?php echo htmlentities($item["link"]); ?>">
                            <?php echo $item["title"]; ?>
                            
                        </a>
                    </td>
                    <td>
                        <?php printf('<img class="icon" src="http://me.dsingleton.co.uk/code/grabicon/?url=%s" alt="%s" title="%s" />', $item['name'], $item['name'], $item['name']); ?>
                        
                    </td>
                </tr>

        <?php } ?>
            </tbody>
        </table>

    </body>
</html>