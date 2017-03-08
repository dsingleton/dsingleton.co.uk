---
layout: post
title: Reblogging the past
date: 2009-07-21 09:37:00
categories: archive blog
---

Thanks to the beauty of the [Internet Archive](http://archive.org) I was able to find copies of all my old posts. An earlier version of this site was powered by a Wordpress install and apparently I didn’t make backups of the database. It’s quite sad losing content, some of it was quite good and it’s left lots of dead links.

I’m now using [Tumblr](http://tumblr.com) to power the blog part of my site. It allows you to post an entry with \_any\_ date, which means I can reenter all my old content with it’s original date. An [archived version of my site](http://web.archive.org/web/20070911174542/dsingleton.co.uk/) gave me access to all my old blog posts and I’ve now added to Tumblr with it’s original publishing date.

### Unbreaking links

The old Wordpress URL scheme is `/archive/*slug*/YYYY/MM/DD/`, vs current blog URLs being `/blog/*slug*`. To keep the old links working I’ve added a `htaccess` rule to [301 permanent redirect](http://en.wikipedia.org/wiki/HTTP_301) those old URLs to the new using mod\_rewrite

```
RewriteEngine On
    
    # Special cases where the slug has changed
    RewriteRule ^archive/sxsw-day-1-in-an-aeroplane-over-the-sea/{0,1}.*$ /blog/sxsw-day-1 [R=permanent,L,NC] 
    RewriteRule ^archive/post-dconstruct-a-review/{0,1}.*$ /blog/dconstruct-2006 [R=permanent,L,NC] 
    RewriteRule ^archive/28/{0,1}.*$ /blog/xfn-icons-css [R=permanent,L,NC] 
    
    # Default case, redirect with slug
    RewriteRule ^archive?/(.[^/.]*)/{0,1}.*$ /blog/$1 [R=permanent,L,NC]
```

The more I use mod\_rewrite the less it confuses me. The 3 special cases here are for articles where I changed the slug (because it was overly long, or just bad) and the rest is handled by the bottom, more generic, redirect rule. They also silently drop any extra information from the Wordpress URL. So it will work with or without the date info that follows the slug.

### Resurrected posts

- [Fun with FamFamFam icons and jQuery](/blog/fun-with-famfamfam-icons-and-jquery)
- [Giving XFN more visibility through CSS2.1 Attribute Selectors](/blog/xfn-icons-css)
- [Truck Festival 2007 Lineup](/blog/official-truck-festival-lineup)
- [Panels, gender, confusion and a rant](/blog/panels-gender-confusion-and-a-rant)
- [@media London 2007](/blog/media-london-2007)
- [Upgrading to PHP5 on OS X](/blog/upgrading-to-php5-on-os-x)
- [1 Bit Audio Player](/blog/1-bit-audio-player)
- [A last.fm tag-cloud generated from XSL](/blog/lastfm-xsl-tag-cloud)
- [Pixel Art Space Invaders](/blog/pixel-art-space-invaders)
- [ALA “Ruining User Experience”](/blog/ala-ruining-user-experience)
- [SXSW Day Three (and onwards)](/blog/sxsw-round-up)
- [SXSW Day Two](/blog/sxsw-day-two)
- [SXSW Day One](/blog/sxsw-day-one)
- [Recent downtime & upcoming events](/blog/recent-downtime-upcoming-events)
- [Teaching Bad Practice](/blog/teaching-bad-practice)
- [Code Golf: Whats your handicap?](/blog/code-golf-whats-your-handicap)
- [Dconstruct 2006](/blog/dconstruct-2006)
- [Google Code Search](/blog/google-code-search)
