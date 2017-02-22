---
layout: post
title: Batch event importing to Last.fm
date: 2010-01-06 22:20:24
categories: events lastfm
---

Over christmas I sorted out some old boxes from University and found all the [paper ticket stubs](http://www.flickr.com/photos/davidsingleton/tags/tickets/) for gigs from 2002 to 2005. That’s some meaty data I didn’t want to lose, I copied it to a spreadsheet with plans to import it in to the [Last.fm events system](http://last.fm/user/underpangs/events/) (where I track all my current gig habbits).

Unfortunately the [add events workflow](http://last.fm/events/add) is a real pain for adding more than one event at once, let alone the 50 I had. In the future we hope to add better support for adding multiple events, either with a new tool (aimed at promoters) or creating an _event.add_ [API method](http://last.fm/api) (and let someone else build it), but in the meantime I wanted a quick hack solution to speed things up.

Seeing as I had all my data in CSV already, the simplest approach is to generate URLs that pre-fill the “Add Event” form data and let you skip to the last step. **Note;** We use one-time form tokens to prevent XSRF attacks, so you can’t just submit the form a script. All the fields can be passed as GET variables to prefill, here are the query param names you’ll need to do this:

<dl>
<dt>type</dt>
    <dd>"gig" or "festival"</dd>

    <dt>startday</dt>
    <dd>2 digit day, eg <em>03</em>
</dd>

    <dt>startmonth</dt>
    <dd>2 digit month, eg <em>11</em>
</dd>

    <dt>startyear</dt>
    <dd>4 digit year, eg <em>2002</em>
</dd>

    <dt>starttime</dt>
    <dd>24 hour time separated by a colon, eg <em>20:00</em>
</dd>

    <dt>venueid</dt>
    <dd>The Last.fm venue id, you can find this in the venue URL</dd>

    <dt>festivalName</dt>
    <dd>Confusingly this is just event name/title, not festival specific</dd>

    <dt>artistNames</dt>
    <dd>Multiple artist names, specified as an array, eg artistNames[]=Blur&&;artistNames[]=Radiohead&&;artistNames[]=Pulp</dd>
</dl>

So a complete ex&le looks like:

`http://last.fm/events/add?type=gig&artistNames[]=Sparta&startday=04&startmonth=10&startyear=2005&starttime=20:00&venueid=8777858&festivalName=`

If you have your events in a structured format then it’s easy to build a quick script to generate these links and really reduce the time needed to add events. Far far from ideal I know (and I’m a bit embarrassed to post it) but it might save you some time. I promise to build event.add to the API soon.
