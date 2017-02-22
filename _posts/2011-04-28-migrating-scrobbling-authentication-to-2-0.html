---
layout: post
title: Migrating scrobbling authentication to 2.0
date: 2011-04-28 20:53:00
categories: lastfm api oauth
---

I received this email a few months ago, and it made me smile.

> Anthony from The Hype Machine here. ([http://hypem.com](http://hypem.com)) Good news! We’ve just connected your Hype Machine account to Last.fm using a new secure method recommended by their team (it’s similar to OAuth, if you want to get technical)! To do this, we used the Last.fm username and a scrambled version of the password you’ve given us before. We’ve now deleted the scrambled version of your password from our database for extra security - with this new authentication method, we no longer need it! Have a great week!

Hype Machine is one of the many music sites that allow you to scrobble your listening there to Last.fm. This is done through our Scrobbling protocol, a part of our API, in fact the same way the official Last.fm clients (and even the website) record what you listen to. We’re proud to eat our own dogfood.

Scrobbling is core to Last.fm, each track is a chunk of attention data. It tells us more about what you like, building better recommendations of music, events, etc. The more you scrobble the better it gets, so the more 3rd parties scrobbling the better. “If it doesn’t scrobble it doesn’t count”, as Stefan says.

Having slowly evolved over 8 years the original scrobbling protocol was always a little complex and not very developer friendly. That’s something we’ve tried to improve with Scrobbling 2.0, which is a revolution, rather than evolution of the protocol.

Short history of scrobbling aside, I’m going to talk about how a 3rd party developer can migrate user authentication from the old scrobbling protocol to the new. The two systems use different authentication mechanisms, Submissions 1.3 requires a username + password, while Scrobbling 2.0 uses the same OAuth mechanism as our [API](http://www.last.fm/api).

Having a 3rd party store your Last.fm credentials is not great. Despite the protocol requiring the passport to be hashed (rather plaintext) it still increases the risk of your account being compromised, by a malicious 3rd party or just a careless one that accidentally exposes data (which happens more than anyone would like).

An advantage of OAuth style authentication is that it’s token based, meaning that a 3rd party will never need to ask for a users’ password. To get a token they direct the user to our OAuth endpoint on Last.fm where the user chooses to allow or deny the 3rd party. If allowed then a token is sent back to the 3rd party giving them access+write data for that user. Another advantage is that the user (or Last.fm) can easily revoke access for the 3rd party by deleting that token.

So, all in all OAuth is more secure and offers more control, a “Good Thing”. However, for there is a problem for users of the old srobbling protocol. In order to use Scrobbling 2.0 you need an OAuth token for a user, which is not something they’ll already have. One option would be to send all of their users through the OAuth authentication process and collect each token, but this sucks for everyone. It’s a big pain for the 3d party developers (writing new auth flow, maintaining to scrobbling protocols), the users (getting asked to allow something they’d already allowed) and for Last.fm (probably result in fewer people scrobbling as a result of the fuss). Not ideal.

A few months back one of our partners asked about this problem and we were able to come up with a novel solution that sidestepped that complexity. It relies on two things, 1/ Old-school scrobblers already store usernames and (hashed) passwords, 2/ We offer a second kind of API authentication, which exchanges a hashed username and password for an OAuth token, without direct user interaction.

So, having just said how much better OAuth based authentication is, why do we have offer an auth flow that circumvents it? Basically, user experience. The OAuth flow on mobile generally sucks, often a user won’t be logged in on a mobile device, or a mobile app 3rd party will have difficulty capturing the auth token. Sometimes a level of security has to be sarcraficed to make something more usable. It’s also not all bad, unlike the old scrobbling procotol it doesn’t need to store username and password, only use them once to get an auth token, which is still revokable by the user. It’s not ideal, but it’s an improvement.

Anyway, that authentication method requires the 3rd party to provide the username and password (in a hashed form), which older scrobbling clients already have - no need to ask the user. They can use the existing user credidentials to get an OAuth token via mobile authentication. After that they can store the new token and purge the old and insecure credentials, which is exactly what Anthony described in the opening quote. No fuss for the user, some work for the 3rd party developer, but all of it automatable (and extractable in to a publishable, resuable library).

I’m not going to go in to any actual code, in part because the post is already very long, but also because with the [mobile authentication documentation](http://www.last.fm/api/mobileauth) it’s quite straight forward. But here’s the gist of it:

```
// This is the token format mobile auth expects:
md5(username + md5(password))

// How to generate it from Submissions 1.x auth details
username = scrob1_username
password_hash = scrob1_password_hash

// Generate the token and hit up the mobile auth API method
mobile_auth_token = md5(username + password_hash)
```

Bosh.
