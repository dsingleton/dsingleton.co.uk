---
layout: post
title: Using xargs like I mean it, a bash example
date: 2009-07-13 21:21:00
categories: bash xargs code
---

> Using xargs like I mean it. svn st \* | grep “^ C” | cut -c 8- | xargs svn revert
- [http://twitter.com/dsingleton/status/2616994594](http://twitter.com/dsingleton/status/2616994594)

A couple of people asked me to explain what this did, so here’s a quick 2 minute explanation (I’ll assume you’re familiar with unix pipes)

First, what was I trying to do? I’d just merged a large branch back down to trunk and for some reason it had a huge number of SVN property conflicts. I wanted to resolve or revert all of these before committing the reset of my changes.

I could have fixed them individually, but that’s a lot of repetition and there are more elegant ways to do it programmatically.

So how does this resolve only my property conflicts?

First get a list of all modified files in our SVN respiratory (in my case, this was actually multiple repositories)

```
svn st *
```

I’m only interested in the property conflicts though. Property status codes are differentiated from regular status changes by a space prefix. The grep filters our list of SVN changes to just these.

```
grep "^ C"
```

The output at this stage looks something like ” C path/to/file” (for each matched file). I want just the file name and need to strip the preceding information. Luckily the length of this prefixed information is a constant 7 characters. Cut lets you chop lines based on delimiters (like tabs, or commas), or by character, here I use it to get the 8th character and onwards

```
cut -c 8-
```

At this point we have a list of file paths, one per line. xargs is a command that can take another command (and it’s options, flags, etc) and run it for a large list of files. The files are passed via standard input, one file per line. So this is telling xargs to run svn revert for each of the files passed from the previous commands.

```
xargs svn revert
```

The end result is that all my property change conflicted files have been reverted, though I could have equally resolved, or told SVN to use my version.

I hope this is a nice little example of the power of the unix command line philosophy, lots of small commands - that do one thing very well - chained together with pipes.
