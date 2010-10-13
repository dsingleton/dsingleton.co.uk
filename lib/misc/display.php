<?php

/** Utility */

function html_escape($html)
{
    return htmlentities($html, ENT_COMPAT, 'UTF-8');
}

function html_array2attr(array $aParams)
{
    $params = '';
    foreach($aParams as $attr => $val) {
        $params .= sprintf(' %s="%s"', $attr, html_escape($val));
    }
    return $params;
}

/** Template functions */

function h($html, $args = null)
{
    $args = func_get_args();
    $html = array_shift($args);
    
    if ($args) {
        $html = vsprintf($html, $args);
    }
    echo html_escape($html);
}

function d($date, $format = 'l F j, Y')
{
    if (is_int($date)) {
        $timestamp = $date;
    }
    else {
        $timestamp = strtotime($date);
    }
    echo h(date($format, $timestamp));
}

function l($url, $name = array(), $aParams = array())
{
    if ($url instanceof iLinkable) {
        $oLinkable = $url;
        list($url, $name, $aParams) = array($oLinkable->getURL(), $oLinkable->getTitle(), $name);
    }
    
    $params = html_array2attr($aParams);
    printf('<a href="%s"%s>%s</a>', html_escape($url), $params, html_escape($name));
}