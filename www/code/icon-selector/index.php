<?php require_once '../../../init.php'; ?>
<?php 

$icons = glob('icons/*.png');
// $icons = array_slice($icons, 0, 100);

$title = "Icon Selector";
$extra_css = array('icons.css', '/static/css/slim.css');
$extra_js = array('/static/js/jquery.js', 'icons.js');

?>
<?php require '../../_inc/header.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <div class="l-3col">
        <div class="primary">
        	<h1>Icon Selector</h1>
        	<p class="tagline">For the <a href="http://www.famfamfam.com/">Silk Icon</a> set, <a href="/blog/fun-with-famfamfam-icons-and-jquery">find out more</a></p>
        </div>
    </div>
    
	<div id="iconSelector">
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
	
		
<?php require '../../_inc/footer.inc.php'; ?>