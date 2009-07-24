<?php require '../../../init.php'; ?>
<?php

$title = "1Bit Audio Player";
$extra_css = array('1bit.css');
$extra_js = array('js/1bit.js', 'js/swfobject.js');

?>
<?php require '../../_inc/header.inc.php'; ?>

    <script type="text/javascript">
    	oneBit = new OneBit('flash/1bit.swf');
    	oneBit.ready(function() {
    		oneBit.apply('ol.simon a.tea', '#3DB213');
    		oneBit.apply('a', '#263B83');
    	});
    </script>

    <h1>1Bit Audio Player</h1>

	<blockquote>&hellip;a very simple and lightweight Adobe Flash MP3 player with automatic JavaScript insertion. It's main purpose is to act as a quick in-page preview for audio files you link to from your website or blog.</blockquote>

    <div class="l-rcol">

    	<div class="primary content">
    		<h2>Development</h2>
    		
			<p>The current version can be found at <a href="http://1bit.markwheeler.net/">1bit.markwheeler.net</a>, while this is the development page.</p>
			
    		<p>I've been re-writing the the Javascript to make 1Bit unobtrusive and generally improve it. The first version used <a href="jquery.com">jQuery</a>, but has since ben re-written to make it smaller and more portable.</p>
		
    		<p>There's still some work to do, but the aim is to continue making 1bit easier to use; to play nice with other scripts and have smarter defaults so it needs less configuration.</p>
		
    		<h3>Documentation</h3>
    		<p><em>This is a little sparse at the moment, sorry.</em></p>
		
    		<p>There are 4 options, only the first is required and the other 3 are optional. Though it is recomended setting a value for 'color' as it defaults to #111111</p>
		    <pre><code class="js">oneBit.apply(selector, color[, background[, size])</code></pre>
			
    		<dl>
    		    <dt>selector</dt>
    		    <dd>a CSS selector string to select the links you want to have a player. This supports <a href="http://www.openjs.com/scripts/dom/css_selector">most CSS2 and some CSS3 selectors</a>.</dd>
    		    
    		    <dt>color</dt>
    			<dd>the color the player icons will be. Specified as a full hex color code, including the #.</dd>
    			
    			<dt>background</dt>
    			<dd>The background color of the player. this defaults to transparent. Specified as a full hex color code, including the #.</dd>
    			
    			<dt>size</dt>
    			<dd>The dimensions of of the player in pixels, by default 1bit will estimate the correct size. It's recommended you don't change this unless you encounter problems. There is only one value as height and width are the same.</dd>
    		</dl>
		    
		    <h4>HTML Output</h4>
    		<p>Once one bit has been applied to a link this is the markup, you can use these elements/classes to manipulate the style of 1bit.</p>
		
    		<pre><code class="html">&lt;span class=&quot;onebit_mp3&quot;&gt;
	&lt;a href=&quot;file.mp3&quot;&gt;example&lt;/a&gt;
	&lt;span class=&quot;onebit_player&quot; id=&quot;oneBitInsert_1&quot;&gt;
		[Flash goes here]
	&lt;/span&gt;
&lt;/span&gt;</code></pre>
		
    		<h3>Notes</h3>
    		<ol>
    			<li>Improve documentation</li>
    			<li>Hide the complexity of knowing if the DOM is loaded from the end user</li>
    			<li>Use Dean Edward's <a href="http://dean.edwards.name/packer/">Packer</a> for script compression</li>
    			<li>Add an option to make OneBit modal, so it can only play one MP3 at once</li>
    		</ol>
		
    	</div>
	
    	<div class="secondary content">
		
    		<h2 id="examples">Demo</h2>
    		<p>Here's an example MP3 that you can play. <a class="mp3" href="./mp3s/Emerald%20Get.mp3">Test Track</a> - taken from the classic Sonic the Hedgehog (it's also short and quick to load)</p>
		
    		<h3>More example tracks</h3>
    		<p>From Last.fm <a href="">free downloads</a></p>
    		<ol>
    		  <li><a class"mp3" href="http://freedownloads.last.fm/download/149985970/Dance%2BDance%2BDance.mp3">Dance Dance Dance</a> (3:42) - Lykke Li</li>
    		  <li><a class"mp3" href="http://freedownloads.last.fm/download/192660296/Discipline.mp3">Discipline</a> (4:18) - Nine Inch Nails</li>
    		  <li><a class"mp3" href="http://freedownloads.last.fm/download/7032151/Space%2Band%2Bthe%2BWoods.mp3">Space and the Woods</a> (3:57) - Late of the Pier </li>
    		</ol>

    		<h2>Usage</h2>
    		<p class="callout code">
    			<a href="js/1bit.js">Download 1bit.js</a>			
    		</p>
    		
    		<p>You'll need <a href="js/1bit.js">1bit javascript</a> and <a href="flash/1bit.swf">1bit flash</a> files, as well as the <a href="js/swfobject.js">swfobject javascript</a>, which 1Bit requires.</p>
    		
    		<p>Then use like so (full documentation to come).</p>
    		
    		<pre><code>
oneBit = new OneBit('flash/1bit.swf');

oneBit.ready(function() {
  oneBit.apply('.content a', '#263B83');
});
    		</code></pre>
		
    	</div>
    </div>
    
<?php require '../../_inc/footer.inc.php'; ?>