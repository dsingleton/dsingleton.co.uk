---
layout: post
title: Giving XFN more visibility through CSS2.1 Attribute Selectors
date: 2007-09-12 00:00:00
categories: css xfn microformats
---

As I was redesigning a bit lately and making use of [FamFamFam’s](http://www.famfamfam.com/) very nice [Silk icon set](http://www.famfamfam.com/lab/icons/silk/) (used under the Creative Commons Attribution License) and it occurred to me I could use CSS2.1 [Attribute Selectors](http://www.w3.org/TR/CSS21/selector.html#attribute-selectors) to show the relationships the XFN defines.

If you’re not familiar with XHTML Friends Network (XFN) this [wikipedia article](http://en.wikipedia.org/wiki/XHTML_Friends_Network) gives a good introduction.

In the WordPress blogroll you get the option to add XFN relationships to the people/links, as I’ve been on a bit of a microformats kick i’ve been thinking how I can make better use

### The XHTML

```
<ul>
<li><a rel="friend met neighbor" xhref="http://www.simoncoltman.net/">Simon Coltman</a></li>
<li><a rel="friend met" xhref="http://fberriman.com/">Frances Berriman</a></li>
<li><a rel="acquaintance" xhref="http://moglenstar.net/">Max Glenister</a></li>
<li><a rel="friend met co-worker" xhref="http://www.ricardocabello.com">Ricardo Cabello</a></li>
<li><a rel="friend met" xhref="http://www.krisswatt.co.uk">Kriss Watt</a></li>
</ul>
```

### The CSS

```
ul.xfn_example a {
background-image: url(/images/icons/user_gray.gif);
}

ul.xfn_example a[rel*="acquaintance“] {
background-image: url(/images/icons/user_blue.gif);
}

ul.xfn_example a[rel*="friend“] {
background-image: url(/images/icons/user_green.gif);
}

ul.xfn_example a[rel*="co-worker“] {
background-image: url(/images/icons/user_suit.gif);
}
```

### Browser Difficulties

Attribute selectors are not supported in IE6 so the first rule sets the background **all** links, if the other more complicated rules aren’t understood then the icon stays a default grey. For the browser that do understand the more complex rules, assigning icons for some of the different relationship types.

They’re ordered so that, for example co-worker will override friend, should the XFN define both of these relationships. I’ve not done it here but if you wanted to you could chain the selectors and create a specific rule (and image) for someone who is a friend and a co-worker `a[rel*="friend“][rel*="co-worker“]`

With the announcement that IE7 will be supporting, amongst other things, attribute selectors I can imagine them being used a lot more as IE7 adoption increases and progressive enhancements like this becoming more common.

### Design Flaws

The different icons don’t do a great job of communicating the different relationships, but maybe more specific icons would help, or on a larger list maybe a key might help?

### Conclusions

This isn’t a particularly complicated idea but i’ve had a couple of people ask me about it, so I thought I’d give a brief explanation and maybe encourage people to take the idea further and make something cooler.
