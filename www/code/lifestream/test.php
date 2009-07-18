<?php

$url = "http://socialgraph.apis.google.com/lookup?q=last.fm%2Fuser%2Funderpangs%2Clast.fm%2Fuser%2Fphae%2Clast.fm%2Fuser%2Fshovel&fme=1&pretty=1&sgn=1";

if (!trim($response = file_get_contents('testcache'))) {
    $response = file_get_contents($url);
    file_put_contents('testcache', $response);
}

$graph = json_decode($response, true);
$people = $graph['canonical_mapping'];

echo "<h2>People</h2>";
echo "<ul><li>" . join($people, "</li><li>") . "</li></ul>";

$people = array_flip($people);
$nodes = $graph['nodes'];

foreach($people as $url => $foo) {
    
    $node = $graph['nodes'][$url];

    // $people[$url]['attr'] = $node['attributes'];
    
    $claimed = array();
    
    foreach ($node['claimed_nodes'] as $cNode) {
        $profile = $nodes[$cNode]['attributes']['profile'];
        if ($profile) {
            $claimed[] = $profile;
        }
    }

    $people[$url] = $claimed;
}

var_dump($people);

die;

foreach($nodes as $canURL => $node) {
    
    if (isset($requested[$canURL])) {
        // one of our start points
        
        // foreach($node['claimed_nodes'] as $) {
        //     
        // }
    }
    var_dump($canURL, $node);
}

die;
