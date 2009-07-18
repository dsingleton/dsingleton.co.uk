#!/bin/bash

sudo cat  /var/log/apache2/access.log | grep lifestream | grep -v \"grabicon\|_assets\|.css\" | awk '{print $11}' | grep -v "dsingleton.co.uk" | sort | uniq -c | sort -r
