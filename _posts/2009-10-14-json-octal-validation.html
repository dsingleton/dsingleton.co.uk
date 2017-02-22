---
layout: post
title: JSON, Octal Numbers &amp; Validation
date: 2009-10-14 16:14:00
categories: json javascript bug
---

Now it’s launched in London I’ve been playing around with the Foursquare API. While it’s not the best API i’ve come across it gives you reasonable access to their data, so i’ve been pretty happily building some small tools using their data.

hit a rather usual bug with JSON parsing for a Foursquare venue, in this case the [Bricklayers Arms](http://foursquare.com/venue/140854) (The home of Pub Standards). The JSON response looks something like this:

```
{
    "venue": {
        "id": 145975,
        "name": "Bricklayers Arms",
        "address": "31 Gresse St",
        "city": "Camden Town",
        "state": "Greater London",
        "zip": "W1T 1",
        "phone": 02076365593,
        "geolat": 51.5176421,
        "geolong": -0.1334817,
        "stats": {
            "checkins": 0 
        }
    }
}
```

Looks pretty reasonable, right? But my JSON parser chocked on this and called it invalid. Running it through [JSON Lint](http://www.jsonlint.com/) gives a bit more information, but is still a bit vague:

> syntax error, unexpected TNUMBER, expecting ‘}’ at line 9

Let’s see, line 9 is the phone number key/val, that seems like it should be valid, I mean the leading zero is odd but… oh. You may, or may not, remember that standard notation for [octal numbers](http://en.wikipedia.org/wiki/Octal) is a leading 0, it’s not something you run in to very often.

So why is an octal number invalid? Because the JSON spec doesn’t explicitly support octal numbers as native types and parsers aren’t compelled to either. Some may do, but this is probably more luck than judgement - a side effect of loose typing.

I’ve reported the bug to the Foursquare team and it sounds like it’ll be fixed shortly (as part of an API rewrite), in the mean time i’ll be using a dirty regex to quote the offending number before parsing.

If there’s one thing to take from this it’s how important validation is, even if it does nothing more than prove it’s not your bug. Looking at the original response and trying to work our why it didn’t parse with validation would have been very painful, it’s not a bug easily caught by a human, you need rigorous machine testing.
