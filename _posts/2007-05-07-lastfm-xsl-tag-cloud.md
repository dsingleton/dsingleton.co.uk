---
layout: post
title: A last.fm tag-cloud generated from XSL
date: 2007-05-07 00:00:00
categories: xsl xslt lastfm tagcloud code
---

If you use last.fm the you can get some pretty interesting statistical data about your musical habits.

Being a web _and_ music geek I’ve put together a simple tag-cloud to show what i’ve listened to that week. _Everyone_ loves a nice tag-cloud.

### ⚠️ Update ⚠️

Sadly the tag-cloud generator is no longer functional. The Last.fm API powering it was deprecated. Theres a [copy of the code on Github](https://github.com/dsingleton/lastfm-tagcloud/) for posterity, but it can't do anything.

Original post continues below…

### How it was made

I’ve had a rough version of this for a while, but it had quite a few issues, was generally a little broken and not very semantic. So I took a few hours to re-write it and make then make it public.

First of it all it uses my last.fm [Weekly Artists](http://ws.audioscrobbler.com/1.0/user/underpangs/weeklyalbumchart.xml) XML, which gets turned in to HTML through a simple XSL transformation then styled with CSS.

The glue that holds it together is the extremely useful [inlineRSS](https://wordpress.org/plugins/tags/inline-rss) plugin for Wordpress. this handled the fetching of the XML and the XSL transformation, with a little caching too.

### XSL Transformation

Take a look at the [full XSL file](https://github.com/dsingleton/lastfm-tagcloud/blob/master/xsl/weeklyartists.xsl).

The XSL that converts the last.fm feed into the tag-cloud HMTL is fairly simple, grabbing a bunch of artists and looping through them to build an ordered list. The tricky bit is defining the differing sizes between artists based on the playcount. There are a couple of other bits might benefit from further explanation:

```
<xsl:variable name="max_artists" select="20"/>
<xsl:variable name="min_playcount" select="2" />
```

These specify a maximum number of artists and a minimum number of plays to be included in the cloud. This solves two problems, a large number of artists being played making the tag-cloud huge and playing just one or two tracks for an artist (Like with compilations) which just swamps the tag cloud with lots of low played artists.

```
<xsl:variable name="weight" select="playcount div $max_playcount" />
<xsl:variable name="size" select="($weight * $size_range) + $size_min" />
```

To calculate the _weighting_, how big the font-size should be, it takes the highest played artists playcount as a baseline and treats every other artist as a fraction of that. This fraction, the weight, is then used to the size using the min and max sizes as boundaries.

The rest of the XSL just builds the list, link and span tags/content.

```
<xsl:variable name="artists" select="/weeklyartistchart/artist[playcount >= $min_playcount and position() <= $max_artists]" />
```

This is the XPATH query used to get the set of valid artists than have the minimum playcount and caped at the maximum number of artists

### Semantics

Tag-clouds have a reputation as being pretty unsemantic when it comes to HTML. Often just being an alphabetised list when viewed without styling. [Norm](http://cackhanded.net/) had a go at [marking up tag-clouds semantically](http://24ways.org/2006/marking-up-a-tag-cloud), which i’ve followed with one exception.

Rather than using a set of class names I opted for inline styles declaring the font-size. Heresy! Well, yes and no. I want the cloud items to be properly scaled and the scale easy to modify, this just isn’t possible using a set combination of classes mapped to sizes.

This doesn’t really bother me much, especially with the extra semantic information added. So the final markup looks like so:

```
<li style="font-size: 4.000em;">
  <span><span class="weighting">26</span> listens to</span>
    <a xhref="http://www.last.fm/music/Stars" mce_href="http://www.last.fm/music/Stars" title="Stars (26 listens)">
      Stars
    </a>
  </li>
  <li style="font-size: 3.077em;">
    <span>
      <span class="weighting">18</span>
      listens to
    </span>
    <a xhref="http://www.last.fm/music/The+Microphones" mce_href="http://www.last.fm/music/The+Microphones" title="The Microphones (18 listens)">
      The Microphones
    </a>
  </li>
```

If you’re paying attention you’ll have spotted _another_ span in there, inside the one used to hide the non-artist-name information. Why add it? It gives a semantic hook to get the actual weighting value of the cloud, in this case listens.

With this you could create a very simple piece of javascript to turn the tag cloud back in to a chart, ordered by listens rather than alphabetically.

### Styling

There’s only some very simple styling on the list itself. Mostly just visual formating, but importantly a rule to hide the span of contextual information leaving just the artist name.

```
ol {
  width: 700px;
  margin: 0 auto;

  list-style: none;
  text-align: center;

  font-size: .6em;
}

li {
  display: inline;
  margin: 0 .2em;
  padding: 0 .3em;

  line-height: 1.5;
  vertical-align: middle;
}

li span {
  position: absolute;
  left: -999px;
  width: 990px;
}
```

### Known Issues

There are still a few things I’m unhappy about with this, when using artist names rather than tags you’re far more likely to get spaces and end up with an artist name split across two lines. This can often end up looking like two separate artists if you’re not familiar with the name.

And, the obvious problem – it’s all reliant on data from another site, last.fm. I can’t be sure it’ll always be up, or that formats wont change. This is the price you pay for relying on external service, in this case it’s nothing critical or even important, but it’s something people seem to forget a lot of the time.
