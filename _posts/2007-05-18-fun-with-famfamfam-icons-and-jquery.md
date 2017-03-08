---
layout: post
title:  Fun with FAMFAMFAM Icons and jQuery
date: 2007-05-18 00:00:00
categories: css icons javascript jquery
---

If you not familiar with the [FAMFAMFAM Silk icons](http://www.famfamfam.com/lab/icons/silk/) they’re a set of 1000 beautiful little 16×16px icons that you’re free to use under the CC-Attribution license.

I’ve been using them a little recently for a few things, including this blog and some [coding](/code/) projects. The problem is, with 1000 icons, finding the ones that are suitable for what you’re doing.

The [Silk webpage](http://www.famfamfam.com/lab/icons/silk/) used to have every icon on the page, with a little search box to only show ones matching your search. This was great, you could filter down to the more relevant ones, while still comparing them on the same page.

Unfortunately this seems to have gone now, so I thought I’d put together a version of it myself, mostly to make it easier to find icons, but also as an excuse to play around with jQuery.

[jQuery](http://jquery.com/) is one of the huge variety of Javascript libraries around at the moment. It’s got very powerful selectors, cross browser events and animation and is built around the idea of chaining. I’ve used it a little recently at work and it has made Javascript _fun_.

### The Icon Selector

In half an hour or so I knocked together a quick demo of (as i’ve now dubbed it) the **[Icon Selector](/code/icon-selector)**. I’m pretty happy with how it turned out, it’s easy to search for and preview the icons you want.

I’ve made a few tweaks since to speed it up a little, you can take a peak at the [Javascript source](https://github.com/dsingleton/icon-selector/blob/master/js/icons.js) if you want to see the jQuery magic, it’s pretty cool.

Most impressively it works well on all modern browsers. jQuery handles a lot of the inherent differences in the DOM and event models. Conclusions? jQuery is very nice, definately something i’ll be using more in the future.
