---
layout: post
title:  Last.fm Now-Playing information radiator
date: 2011-08-28 13:55:00
categories: lastfm music javascript
---

This is a litte project I started a while back but only finished/cleaned up recently. It’s a simple information radiator that shows you what a Last.fm user is listening to right now.

[![Now playing screen](http://farm7.static.flickr.com/6198/6086155862_ed082dee0f.jpg)](http://www.flickr.com/photos/davidsingleton/6086155862/ "Now playing screen by David Singleton, on Flickr")

It was designed to let one (or many people) know what’s playing at a glance. I’ve been using it while listening to Last.fm radio while getting ready for work, [shared office playback](https://twitter.com/#!/clientroomradio) (it works really well here) and even on top of Spotify playlists at parties. You can stalk along to someone else’s listening too, for the curious.

Dev/ops have made [heavy](http://www.flickr.com/photos/jwheare/3271781474/) [use](http://www.flickr.com/photos/davidsingleton/4112671768/) of radiators/glanceables for a while (that’s a whole ‘nothing post), but it’s nice to see more [social](http://www.flickr.com/photos/jwheare/5071607356/) and [experimental](http://booktwo.org/notebook/thamestide/) uses being applied. With ["second screens"](http://russelldavies.typepad.com/planning/2011/02/experimenting-with-a-second-screen.html) getting more popular I’m excited to see what else will get made soon.

Try the [hosted demo version](http://dsingleton.github.com/now-playing-radiator/) or [fork the project on Github](https://github.com/dsingleton/now-playing-radiator).

### Responsiveness
[![DSCF0009](http://farm7.static.flickr.com/6208/6088909992_73d26bf323.jpg)](http://www.flickr.com/photos/davidsingleton/6088909992/ "DSCF0009 by David Singleton, on Flickr")

It’s not strictly a responsive-design (no media queries in sight) but it does work really well across multiple devices. Only needing some font size adjustments on larger screens. [Matthew Sheret](http://matthewsheret.com/) has been running this on an old iPod touch sat on his desk for a few weeks, quite happily.

### How it works

There’s no server-side requirement, everything is HTML/CSS/JS, no PHP or Python dependency, which means it’s super easy to use locally. You can clone it from Github and use it immediately, no configuration. It includes a tiny Last.fm API client written in Javascript

Now-playing is part Last.fm [scrobbling API](http://www.last.fm/api/scrobbling), supported by most clients it’s sent at the begining of a track rather than at the end (like scrobbling). Becuase there’s no realtime API i’m polling on a with a tiny Javascript API client. By default it polls on a 5 second interval, which feels pretty snappy and sit well within the TOS (~1 req/sec max).

Checkout the source, on [Github](https://github.com/dsingleton/now-playing-radiator) and have a play.
