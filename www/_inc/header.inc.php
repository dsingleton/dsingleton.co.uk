<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
 <title><?php h((isset($title) ? $title : 'Home') . ' - David Singleton'); ?></title>
 
 <meta http-equiv="Content-Type" content="utf-8" /> 
 <meta name="description" content="The blog of David Singleton, Ramblings of a Web Developer" />
 <meta name="keywords" content="david singleton, dave singleton, web developer, london, css, php, lamp, mysql, unix, programming, web standards, coding, microformats, web sites, angry rants" />
 <meta name="robots" content="index, follow" />
 <meta name="author" content="David Singleton" />

 <link rel="openid.server" href="http://www.myopenid.com/server" />
 <link rel="openid.delegate" href="http://dsingleton.myopenid.com/" />
 <meta http-equiv="X-XRDS-Location" content="http://dsingleton.myopenid.com/xrds" />
 
 <link rel="stylesheet" href="/static/css/harmonise.css" type="text/css" charset="utf-8" />
 <link rel="stylesheet" href="/static/css/default.css" type="text/css" charset="utf-8" />
 <?php if (isset($feed)) { ?>
 <link href="<?php h($feed['url']); ?>" rel="alternate" type="application/rss+xml" title="<? h($title); ?>" />
 <?php } ?>
 
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/prototype/1.6/prototype.js"></script>
 
</head>

<body id="dsingleton-co-uk" class="l-3col">

<div id="page">

     <div id="header">

         <p>
              <a href="/" >
                  <span class="firstname">David</span> <span class="lastname">Singleton</span>
              </a>, 
                  a <a href="/tag/web"><span class="title">Web Developer</span></a> working at <a href="http://last.fm">Last.fm</a>,
                  living in <span class="adr"><span class="locality"><a href="/tag/london">London</a></span>.
              </span>
          </p>
    </div>
    
    <div id="content">