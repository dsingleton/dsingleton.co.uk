# [dsingleton.co.uk](http://dsingleton.co.uk)

[![Build Status](https://travis-ci.org/dsingleton/dsingleton.co.uk.svg?branch=master)](https://travis-ci.org/dsingleton/dsingleton.co.uk)

A straight forward static personal website, powered by [Jekyll](http://jekyllrb.com/).

## Setup

Install dependencies:
```sh
bundle
```

Run the dev server:
```sh
bundle exec jekyll serve
```
### Link checking

Check internal links with:

```sh
bundle exec jekyll build
bundle exec htmlproofer _site/ --disable-external
```

## Github pages

This site is deployed to [github pages](https://jekyllrb.com/docs/github-pages/) and uses the [`pages-gem`](https://github.com/github/pages-gem) to restrict itself to plugins that work in that environment.

Deployment is automatic when pushing to master.
