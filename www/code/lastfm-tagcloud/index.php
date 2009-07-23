<?php require_once '../../../init.php'; ?>
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
$user_exists = false;
if ($user) {
    // $user_tagcloud = get_tagcloud_html($user);
}

?>
<?php require_once '../../_inc/header.inc.php'; ?>
	
	<style type="text/css">
        
        #page {
            width: 100%;
        }
        
	</style>
	
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
	
<?php require_once '../../_inc/footer.inc.php'; ?>