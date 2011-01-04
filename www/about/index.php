<?php require_once '../../init.php'; ?>
<?php

$title = 'About';

?>
<?php require_once '../_inc/header.inc.php'; ?>
<article>
    <h2>About</h2>
    <p>I'm a web developer, I wrote code for a living and for fun. I live in East London, also for fun.</p>
    
    <p>I love taking things apart, figuring out how they work, and solving problems. Mostly <a href="/tag/code">code</a> or <a href="/code/design">design</a>, but sometimes baking too. Sometimes I write about these things on my <a href="/blog">blog</a>.</p>
    
    <p>My day job is web developer at <a href="http://last.fm">Last.fm</a>, a large music social network. I do both front and back end development and have been working with the web for about 10 years now.</p>
    
    <p>I like to visit geek events and gigs in London, so you might meet be at a conference, a hack-day or a barcamp (or just in the pub).</p>
    
    <!-- @CSS -->
    <style type="text/css">
    
    #about-photos li {
        list-style: none;
        float: left;
    }
    
    ul.photos li a {
        margin: 5px 8px;
        display: block;

    }
    
    ul.photos li a img {
        padding: 1px;
        border: 1px solid #ccc;
        
    }
    
    </style>
    
    <h2>Photos</h2>
    <p>There are more <a href="http://www.flickr.com/people/davidsingleton/photosof/" rel="me">photos of me</a> on Flickr.</p>
    <ul id="about-photos" class="inline photos">
        <li><a href="http://www.flickr.com/photos/davidsingleton/3353460521/" title="Me on a lock by David Singleton, on Flickr"><img src="http://farm4.static.flickr.com/3620/3353460521_0ec66c7113_s.jpg" width="75" height="75" alt="Me on a lock" /></a></li>
        <li><a href="http://www.flickr.com/photos/davidsingleton/3057540234/" title="David on deck by David Singleton, on Flickr"><img src="http://farm4.static.flickr.com/3178/3057540234_51d0c64afe_s.jpg" width="75" height="75" alt="David on deck" /></a></li>
        <li><a href="http://www.flickr.com/photos/davidsingleton/3748186365/" title="7 Year old t-shirt by David Singleton, on Flickr"><img src="http://farm4.static.flickr.com/3437/3748186365_4fc2c56d31_s.jpg" width="75" height="75" alt="7 Year old t-shirt" /></a></li>
        <li><a href="http://www.flickr.com/photos/davidsingleton/3650496383/" title="Me in my jumpsuit by David Singleton, on Flickr"><img src="http://farm4.static.flickr.com/3619/3650496383_3d97eb0c2b_s.jpg" width="75" height="75" alt="Me in my jumpsuit" /></a></li>
    </ul>

    <h2>Elsewhere online</h2>
    <p>
        I collect <a href="http://del.icio.us/dsingleton/" rel="me">links</a>, 
        take <a href="http://flickr.com/photos/davidsingleton/" rel="me">photos</a>,
        listen to <a href="http://last.fm/user/underpangs/" rel="me">music</a>,
        attend <a href="http://upcoming.yahoo.com/user/30794/" rel="me">events</a>,
        write <a href="http://github.com/dsingleton" rel="me">code</a>
        and talk <a href="http://twitter.com/dsingleton/" rel="me">nonsense</a>.
    </p>
    
     <p>There are also some other David Singletons. You might be looking for <a href="http://www.google.com/search?q=david%20singleton%20-dsingleton.co.uk">one of them</a> instead.</p>

</article>

<aside>
    <h3>Contact</h3>
    <p>You can email at <a href="mailto:david@dsingleton.co.uk">david@dsingleton.co.uk</a>, or you could <em>@reply</em> me on <a href="http://twitter.com/dsingleton">Twitter</a>.</p>

    <p>I don't have a comments on my blog, so if you want to get in touch email is your best bet.</p>
    
    <h3>Curriculum Vitae</h3>
    <p>
        I have an online <a href="/about/cv/">curriculum vitae</a>, if you're interested in my skills and work history. 
    </p>
    
    <p>
        Or 
        <!-- @CSS -->
        <img style="position: relative; top: 3px" src="http://dsingleton.co.uk/code/icon-selector/icons/page_white_put.png" /> <a href="/about/cv/David+Singleton.pdf">Download PDF</a> version.
    </p>
    
    <h3>Colophon</h3>
    <p>This site is hand built by me, using HTML5, CSS, PHP, SQLite, Apache2. The code is freely available on <a href="http://github.com/dsingleton/dsingleton.co.uk">GitHub</a>.</p>
    
    <p>All content, unless otherwise noted, is released under a <a href="http://creativecommons.org/licenses/by-nc/2.5/" rel="license">Creative Commons Non-Commercial Attribution</a> license.</p>
</aside>
    
<?php require_once '../_inc/footer.inc.php'; ?>