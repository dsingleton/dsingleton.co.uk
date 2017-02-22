---
layout: post
title: The importance of virtualised development environments
date: 2010-11-06 01:23:35
categories: development
---

[Gareth Rushgrove](http://morethanseven.net) just wrote a great blog post entitled [Why You Should Be Using Virtualisation](http://morethanseven.net/2010/11/04/Why-you-should-be-using-virtualisation.html), which puts out a great argument for using virtualised development environments.

The crux of the argument is that you should be testing and running your code in an environment as close as possible to production, and that virtualisation is the easiest way to do that. There are other benefits, but this is the most important by far.

To quote Gareth:

> But if you’re running those tests against code executing on different hardware, on a different operating system, with different low level libraries or a different web server version or a different database server then you are not going to catch all the problems. If you take this to an extreme then you can only get rid of all of these problems by giving each developer a full production stack of their very own.

A short example of this: A few months back I spent the better part of a day tracking a bug that was happening in production by utterly unreproducable in our development environment. The cause was a difference in the [Thrift](http://incubator.apache.org/thrift/) setup between the two - one was running a C extension while the other was a native PHP extension - and one had a bug.

It’s not important what the bug was, but that if the two had been in sync then the problem would have been caught much quicker and more easily.

### Current work setup

At [Last.fm](http://www.last.fm) each web developer has their own hosted and internally routed Virtual Machine, all based on the same VM image, which matches 99% of our production stack. There are still the occasional niggling 1% problems and mismatches, but each time we encounter one it gets fixed in the original VM image, so it’s a step closer to being fixed forever.

In contrast, there was a period where we were running differing versions of Apache and PHP compared to live (and different again to some non-production, non-development internal servers). Believe me when I say: this causes no end of problems, avoid it at all costs. It will sap developer time and enthusiasm faster than you’d think. As happy as many developers are playing at sys-admin, the majority would much rather be writing code and making _stuff_, not fighting workflow.

### Restore and rollback

Another benefit of visualisation is that you can get a new version of your VM running very quickly. This saves an awful lot of time for a new hire, but also if you lose your VM for any reason then you can generate a new VM or restore an archived version incredibly easily.

Due to a disk corruption I lost my development VM a few months ago, frustrating as it was I was able to get working again in under an hour. A new production-parity VM was generated and I pulled in code from our source repository, restarted Apache and away I went. All I lost was a (small) amount of uncommited code and a few shell scripts, which did teach me to treat a VM as a throwaway environment, commit or backup anything you would mind losing.

### Downsides

I can understand hesitation about setting up a production environments for dev, especially for the awkward medium sized projects (bigger than small, but not a serious endeavour), but it can give you some pretty big wins. The earlier you encounter bugs, the quicker you fix them and if disaster strikes you can resurrect your environment easily. I think it also forces you to be more controlled when adding dependencies in your production environment.

Of course, it’s not a silver bullet, you’ll still encounter weird production vs dev bugs, there’ll always be differences. Not just load/the real world, but it’s also like you might be missing some configuration or software, routing access or even domain variance than only production has.

To test against production as much as possible we use a few production web servers, pulled from the main pool, which are configured to run candidate releases of our code base. Developers and testers can set a cookie that our load balancer will use to route them to the QA servers. This allows us to test an unreleased version of the site using the exact hardware/software we use in production, that’s hosted in the same data centers and addressed by the real domain.

You can’t get any closer than that without putting the code live.
