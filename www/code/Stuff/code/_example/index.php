<?php require '../_resources/main.php' ?>
<?php

// $db = DBConn::getInstance();
// $venues = $db->getAll('SELECT * FROM code_venues');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Coding Resources</title>
	<link rel="stylesheet" href="../_static/css/text.css" type="text/css" />
	<link rel="stylesheet" href="../_static/css/structure.css" type="text/css" />
	<!-- <link rel="stylesheet" href="../_static/css/theme_green.css" type="text/css" /> -->
  </head>

  <body class="l-3col">
	
	<h1>Coding Resources</h1>
	
	<div class="primary content">
		<h2>What is this?</h2>
		<p>A collection of PHP/JS/CSS/Images for quick use with coding ideas and mini projects, so I can hit the ground running.</p>
		
		<h3>Styles</h3>
		<p>Simple text formatting for <strong>headings</strong>, <em>paragraphs</em>, code, <a href="#">links</a> and lists.</p>

		<h3>To Do</h3>
		<ol>
			<li>Table CSS</li>
			<li>Forms CSS</li>
			<li>Make Blockquote style</li>
			<li>Make background gradients</li>
			<li>Phase out old <em>lib</em> dir</li>
			<li>Move this page</li>
			<li>Look at proper line-height typography / margins</li>
			<li>Fix more link positioning</li>
			<li>Describe layout classes</li>
			<li>Make right col in 2/3col layouts match</li>
		</ol>

		<h3>Project Ideas</h3>
		<ul>
			<li>Compare the old <a href="/code/better-tables">Better Tables</a> with a fresh jQuery powered one.</li>
		</ul>
	
	</div>
	
	<div class="secondary content">
		
		<h2>Static Resources</h2>
		<p>A collection of images, Javascript and CSS for quick re-use.</p>
		<h3>Images</h3>
		<p>Assorted imagery, backgrounds, gradients, faux rounded corners and 1000 <a href="/code/icon-selector">Icons</a></p>
		<h3>CSS</h3>
		
		<h3>Javascript</h3>
		<p>There's a local version of <a href="/code/_static/js/jquery.js">jQuery</a> (Compressed).</p>
		<code>
&lt;script type=&quot;text/javascript&quot; src=&quot;/code/_static/js/jquery.js&quot;&gt;&lt;/script&gt;
	</code>
		
		<h4>Analytics Include</h4>
		<code>
&lt;script src=&quot;http://www.google-analytics.com/urchin.js&quot; type=&quot;text/javascript&quot;&gt;&lt;/script&gt;
&lt;script type=&quot;text/javascript&quot;&gt;_uacct = &quot;UA-609105-1&quot;; urchinTracker();&lt;/script&gt;
		</code>

	</div>
	
	<div class="tertiary content">
		
		<h2>Dynamic Resources</h2>
		
		<p>Load the dynamic resources, functions and classes.</p>
		
		<code>
require $_SERVER['DOCUMENT_ROOT'] . &apos;code/_resources/main.php&apos;;
		</code>
	
		<h3>Database</h3>
		<p>Get the single instance of a PEAR_DB object connected to <var>staff_david</var> table</p>
		<code>
$db = DBConn::getInstance();
		</code>
		
		<h3>PEAR</h3>
		<p>Available PEAR packages includes</p>
		<ul>
			<li>Flickr</li>
			<li>Upcoming</li>
		</ul>
	</div>
	
	<a href="/code" id="morelink">More Code</a>
	
  </body>
</html>