---
layout: post
title: Upgrading to PHP5 on OS X
date: 2007-05-27 00:00:00
categories: osx apache php
---

I’ve been meaning to upgrade PHP on my macbook for a while now, today I finally got around to it with a little help from [Marc Liyanage PHP Package](http://www.entropy.ch/software/macosx/php/).

Download the installer (~50MB), un-tar and run it. You should not have PHP5 installed on your system. However, you might have to do a bit of fiddling to get it working properly.

These are just the tweaks I needed, you might need to do more or less, but this might be useful in some fashion.

In _httpd.conf_ the PHP4 module was still being loaded, so comment that out and add an entry to load the PHP5 module instead.

```
#LoadModule php4_module libexec/httpd/libphp4.so
LoadModule php5_module local/php5/libphp5.so
```

For some reason the PHP5 module was installed at a different path to the oldPHP4 module and all other Apache modules. Rather than move it (and risk other problems) I left it where it was and just used the different path.

Further down _httpd.conf_ there’s another reference to PHP4, just update the number.

```
AddModule mod_php5.c
```

Restart Apache so the changes take effect, with _sudo apachectl graceful_

That should do it.
