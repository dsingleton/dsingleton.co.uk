<?php

function http_404($message = null)
{
     header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
}