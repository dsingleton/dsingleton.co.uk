<?php

function get_tagcloud_html($user)
{
    $path_format = 'http://ws.audioscrobbler.com/1.0/user/%s/weeklyartistchart.xml';

    $feed_path = sprintf($path_format, $user);
    $xsl_path =  'xsl/weeklyartists.xsl';

    $cloud_html = xslt_transform(file_get_contents($feed_path), file_get_contents($xsl_path));
    return $cloud_html;
}   

function xslt_transform($xml_source, $xsl_source)
{
    $oXML = new DOMDocument();
    $oXML->loadXML($xml_source);

    $oXSL = new DOMDocument();
    $oXSL->loadXML($xsl_source);

    $oXSLT = new XSLTProcessor();
    $oXSLT->importStyleSheet($oXSL);
    return $oXSLT->transformToXML($oXML);
}


?>
