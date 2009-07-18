<?php

$aLibFiles = glob(dirname(__FILE__) . '/*.php');

foreach($aLibFiles as $file) {
    require_once $file;
}