<?php

function h($h)
{
    if ($args = func_get_args()) {
        $h = vsprintf(array_shift($args), $args);
    }
    echo htmlentities($h, ENT_COMPAT, 'UTF-8');
}

function send404($message = null)
{
     header("HTTP/1.0 404 Not Found");
     die($message);
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