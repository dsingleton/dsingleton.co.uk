---
layout: post
title: Using iTunes Mac to rip CDs at good quality
date: 2009-07-26 23:23:33
categories: music itunes tutorial
---

I haven’t had to rip any CDs on my current laptop till now. I didn’t have a decent ripper and I wouldn’t be using the one built in to iTunes (it’s rubbish). It’s such a rare task to setup a good ripper that I have to go searching for all the details again.

This is a bit of a post self-reference in the future, hopefully it’s helpful to you too

My tool of preference is [iTunes LAME](https://code.google.com/archive/p/blacktree-itunes-lame/downloads). The quality is a vast improvement over the default iTunes encoder. There are some tricky parts to the installation and setup process, here’s a bit of a guide.

## Installation and preferences

First download the app, install and run. Ignore the encoding quality drop-down for now and edit your preferences.

[![iTunes LAME preferences](http://farm4.static.flickr.com/3443/3758857643_873b62bce9.jpg)](http://www.flickr.com/photos/davidsingleton/3758857643/ "iTunes LAME preferences by David Singleton, on Flickr")

You’ll probably want to change your default destination (where the ripped files get put). You’ll also want to change the naming scheme as the default is _Artist\Album\Track_

The naming scheme looks a bit esoteric. The `:` is treated as a directory separator, as I assume backslash is reserved as an escape character. The full set of possible value and their equivalent value.

<dl>
  <dt>%a</dt>
    <dd>Artist Name</dd>

    <dt>%A</dt>
    <dd>Sort Artist</dd>

    <dt>%b</dt>
    <dd>Album Artist</dd>

    <dt>%B</dt>
    <dd>Sort Album Artist</dd>

    <dt>%c</dt>
    <dd>Composer</dd>

    <dt>%C</dt>
    <dd>Sort Composer</dd>

    <dt>%l</dt>
    <dd>Album Name</dd>

    <dt>%L</dt>
    <dd>Sort Album Name</dd>

    <dt>%t</dt>
    <dd>Track Name</dd>

    <dt>%T</dt>
    <dd>Sort Track Name</dd>

    <dt>%n</dt>
    <dd>Track Number</dd>

    <dt>%y</dt>
    <dd>Year</dd>

    <dt>%g</dt>
    <dd>Genre</dd>

    <dt>%G</dt>
    <dd>Grouping</dd>
</dl>

These are taken from [iTunes-LAME Encoding FAQ](http://code.google.com/p/blacktree-itunes-lame/source/browse/trunk/English.lproj/EncodingHelp.rtf?r=35).

My preference is _Artist - Year - Album\Track Number - Track Name_, which is `%a - %y - %l:%n - %t`.

## Encoding quality
[![iTunes LAME setup](http://farm3.static.flickr.com/2631/3758844105_cbec1a7ae6.jpg)](http://www.flickr.com/photos/davidsingleton/3758844105/ "iTunes LAME setup by David Singleton, on Flickr")

It’s been a good couple of years since I’ve last setup LAME and most of the ripping flags seem to have changed, or moved on. Back in the day `--alt-preset standard` (—aps)was the best “every day” setting. That whole alt-preset range seems to have been replaced with a much more sensible `-V [0-9]` scale, where —aps is equivalent to `-V 2`

I’m not going to get involved in quality wars, but given I have more HDD space than I did a few years ago, I’m happy to rip at `-V 0` - equivilent of the old `--alt-preset extreme`. Not loss-less, but certainly good quality for headphones and my Hi-Fi.

## Ripping

With everything setup, I just popped a CD in, hit export and 10 minutes later had some lovely MP3s. Easy.
