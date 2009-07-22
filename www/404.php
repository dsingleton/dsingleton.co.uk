<?php require_once '../init.php'; ?>
<?php

header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");

@list(, $controller, $slug) = explode('/', urldecode($_SERVER['REQUEST_URI']));

?>
<?php require_once './_inc/header.inc.php'; ?>

    <h2>Page not found</h2>
    <p>You asked for something I don't have, or couldn't find. Sorry!</p>
    
    <p>Try my <a href="/">home page</a> or <a href="/blog">blog</a> instead?</p>

<?php require_once './_inc/footer.inc.php'; ?>