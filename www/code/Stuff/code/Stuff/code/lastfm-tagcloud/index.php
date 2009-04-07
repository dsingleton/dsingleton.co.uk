<?php

// To Do:
//
// * Tidy XSL/HTML
// ** Comment
// * Update Blog
// * Make Blog Post

require_once 'php/lastfm.php';
require_once 'php/caching.php';
require_once 'php/SimpleXSLT.class.php';

$user = $_GET['user'];
$user_avatar = get_user_thumbnail($user);
$user_exists = (bool) $user_avatar;

if ($user_exists) {
	$user_tagcloud = get_tagcloud_html($user);
}

$user_escaped = htmlentities($user);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Last.fm Weekly Artist Tag Cloud</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	
	<div id="container">
		
		<div id="header">
			<span class="user">
				<?php if ($user_exists) { ?>
				<img class="icon" src="<?php echo htmlentities($user_avatar); ?>" width="16" height="16" alt="User Avatar" />
				<a href="http://last.fm/user/<?php echo $user_escaped ?>/"><?php echo $user_escaped ?></a> 
				<?php } else { ?>
				<strong>Oops!</strong> We couldn't find a user with this name
				<?php } ?>
			</span>

			<form action="" method="get" class="search">
				<label for="user">enter a <a href="http://last.fm">last.fm</a> username</label>
				<input type="text" class="text" name="user" id="user" />
				<input type="submit" value="Go" />
			</form>
		</div>
	
		<?php if ($user_exists) { ?>
			<?php echo $user_tagcloud; ?>
		<? } else { ?>
			<p>Enter a <em>last.fm</em> username in the box above to see their cloud</p>
			<p>Or try <a href="?user=underpangs">mine</a></p>
		<?php } ?>
	
	
		<a id="bloglink" href="http://dsingleton.co.uk/archive/lastfm-xsl-tag-cloud/2007/05/07/">More on my blog</a>
		
		<a href="http://last.fm">
			<img id="as_credit" src="http://static.last.fm/depth/advertising/as/mini_grey.gif" alt="Audioscrobbler Powered" />
		</a>
	
	</div>
	
	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
	<script type="text/javascript">_uacct = "UA-609105-1"; urchinTracker();</script>
	
</body>
</html>
