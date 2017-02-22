---
layout: post
title: 1Bit player update
date: 2010-02-06 21:17:00
categories: 1bit javascript audio opensource github
---

1Bit is a simple way to let you preview MP3s linked in a web page. It’s a combination of Javascript and (a tiny bit) of flash to automatically pre-pend links to MP3s with a little play icon, allowing you to listen to the track inline. It’s been quite popular, mostly with music blogs. It was built by [and myself a year or two ago.](http://1bit.markwheeler.net/docs.php)

Towards the end of last year [James Weiner](http://www.unicorncreative.com) got in touch about 1bit, he’s an Oxford-based web developer/designer who i’ve had the pleasure to meet a few times at Pub Standards. He’d been using it on some client sites and wanted to add some new functionality.

Mark and I were too busy with work to add the features ourselves, but were happy for James (with some help from his brother [Ben Weiner](http://www.readingtype.org.uk/). The source for 1Bit is public and open (including the flash), so anyone can work on it if they like. Ben and James did just that and added the feature they wanted. Even better than that, they were happy to share the changes and for us to integrate them with the current version of 1Bit.

## 1Bit on Github

As a starting point for integrating these changes I’ve put the [source for 1Bit on GitHub](http://github.com/dsingleton/1bit-audio-player). I’ve been using Git for personal projects for a while and GitHub itself makes it easy for anyone to get involved, add code, fix bugs or fork a project entirely. It’s the natural choice for a project like this.

For now I’ve create a branch to start adding James and Ben’s new feature (modal playback) and you can [follow the progress](http://github.com/dsingleton/1bit-audio-player/tree/modal-playback) if you like. I’ve also start adding some basic Javascript testing with [QUunit](http://docs.jquery.com/QUnit) to ensure I don’t break anything while making changes. There’s only simple, high level tests at the moment but I plan to refactor the internals a bit so 1Bit can be tested in smaller cleaner chunks.

## The future of 1Bit

It’s exciting to be working on the project again, getting development completely public and incorporating changes from other people. Expect a new version with modal support in the future and possibly even some experimental HTML5 features. I’d also like to make 1Bit easier to use with major Javascript libraries, as that’s been bugging me for a while - particularly being able to use their selector functionality, which is vastly superior to the limited selector rules 1Bit supports. Keep an eye on the GitHub page for changes.
