<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/code/_resources/main.php' ?>
<?php 

$ext = '.png';
$files = glob('../_static/img/icons/*' . $ext);
$icons = array();
$filter = $_GET['search'];

foreach($files as $file) {
	$keywords = str_replace('_', ' ', basename($file, $ext));
	$matched = (!$filter || strpos($keywords, $filter) !== false);
	$icons[] = compact('file', 'keywords', 'matched');
}

// $icons = array_slice($icons, 0, 200);

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

  <body class="l-1col">
	
	<div class="container">
		
		<h1>Silk Icons</h1>
		<p class="tagline">by <a href="http://www.famfamfam.com/">FamFamFam</a></p>
	
		<div class="primary">

			<ol class="icons">
	<?php foreach($icons as $icon) { ?>
				<li>
					<a title="<?php h($icon['keywords']) ?>" href="<?php h($icon['file']) ?>" class="<?php echo $icon['matched'] ? '' : 'less' ?>">
						<img src="<?php h($icon['file']) ?>" alt="<?php h($icon['file']) ?>" />
					</a>
				</li>
	<?php } ?>
			</ol>
		</div>
	
		<form action="" class="filter">
			<h2><label for="search">Filter</label></h2>
			<input type="text" class="text" name="search" id="search" value="<?php h($filter) ?>" />
			<input type="submit" class="submit" value="Go" />
		</form>
	
	
	</div>

		<a href="/code/" id="morelink">More Code</a>
	
	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
	<script type="text/javascript">_uacct = "UA-609105-1"; urchinTracker();</script>
	
  </body>
</html>