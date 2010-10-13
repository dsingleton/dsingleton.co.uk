<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	
	<title>Home - David Singleton</title>

    
    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    	
    <meta name="description" content="The blog of David Singleton, Ramblings of a Web Developer" />
    <meta name="keywords" content="david singleton, dave singleton, web developer, london, css, php, lamp, mysql, unix, programming, web standards, coding, microformats, web sites, angry rants" />
    <meta name="author" content="David Singleton" />
    <meta name="robots" content="index, follow" />

    <link rel="openid.server" href="http://www.myopenid.com/server" />
    <link rel="openid.delegate" href="http://dsingleton.myopenid.com/" />
    <meta http-equiv="X-XRDS-Location" content="http://dsingleton.myopenid.com/xrds" />

    <link rel="stylesheet" href="/static/css/less.css" type="text/css" />
    <link rel="stylesheet" href="/static/css/base.css" type="text/css" />
    <link rel="stylesheet" href="/static/css/typography.css" type="text/css" />
    
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
    
    <?php if (isset($extra_css)) { foreach($extra_css as $path) { ?>
    <link rel="stylesheet" href="<?php h($path); ?>" type="text/css" />
    <?php } } ?>

    <?php if (isset($extra_js)) { foreach($extra_js as $path) { ?>
    <script type="text/javascript" src="<?php h($path); ?>"></script>
    <?php } } ?>

    <?php if (isset($feed)) { ?>
    <link href="<?php h($feed['url']); ?>" rel="alternate" type="application/rss+xml" title="<? h($title); ?>" />
    <?php } ?>
	
	<meta name="viewport" content="initial-scale=1.0, width=device-width, maximum-scale=1.0"/>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
</head>

<body>
    
    <div id="page">

        <header>
            <p>
                <a class="name" href="/" ><span class="firstname">David</span> <span class="lastname">Singleton</span></a>
                A <a href="/tag/web"><span class="title">web developer</span></a>
                living in <span class="adr"><span class="locality"><a href="/tag/london">London</a></span></span>
                and working at <a href="http://last.fm">Last.fm</a>
            </p>
                  
            <span class="tagline">I write a <a href="/blog">blog</a>, collect and <a href="/tag">tag things</a> and write <a href="/code">code</a></span>
            &para;<br>
            <span class="contact">You can find out more <a href="/about">about me</a> or get in <a href="/about#contact">contact</a></span>
            &para;
        </header>