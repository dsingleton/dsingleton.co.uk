<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/code/_resources/main.php' ?>
<?php 
$icons = glob('../_static/img/icons/*.png');
// $icons = array_slice($icons, 0, 100);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Icon Selector</title>
	<link rel="stylesheet" href="/code/_static/css/text.css" type="text/css" />
	<link rel="stylesheet" href="/code/_static/css/structure.css" type="text/css" />
	<link rel="stylesheet" href="icons.css" type="text/css" />
	
	<script type="text/javascript" src="/code/_static/js/jquery.js"></script>
	<script type="text/javascript" src="icons.js"></script>
  </head>

  <body class="l-flex">
	
	<h1>Silk Icons</h1>
	<p class="tagline">by <a href="http://www.famfamfam.com/">FamFamFam</a></p>
	
	<div class="primary">

		<ol class="icons">
<?php foreach($icons as $file) { ?>
			<li>
				<a title="<?php h(str_replace('_', ' ', basename($file, '.png'))) ?>" href="<?php h($file) ?>">
					<img src="<?php h($file) ?>" alt="<?php h($file) ?>" />
				</a>
			</li>
<?php } ?>
		</ol>
	</div>
	
	<a href="/code/" id="morelink">More Code</a>
	
	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
	<script type="text/javascript">_uacct = "UA-609105-1"; urchinTracker();</script>
	
  </body>
</html>