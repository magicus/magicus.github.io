---
id: 8
title: 'Personal music tag cloud -- Last.FM boffin'
date: 2009-04-04T16:20:47+00:00
author: magicus
layout: post
guid: http://mag.icus.se/blog/?p=8
permalink: /2009-04-04/personal-music-tag-cloud-lastfm-boffin/
categories:
  - music
  - open source
tags:
  - last.fm
  - music
  - tag cloud
  - tagging
---
I just discovered a new program from Last.FM -- [boffin](http://www.last.fm/group/Audioscrobbler+Beta/forum/30705/_/510180). It is still in beta, but I encountered no real problems with it (apart from a slight difficulty at installing it in Ubuntu -- solution below). Boffin indexes your personal music collection on your computer, and relates it to the tags given to the artists on Last.FM. As a result, you get a tag cloud descibing your local music collection. This would be cool to have, but not very useful. The great thing is that after the categorization, you can select one or more tags, and start playing music -- from your own music collection -- that matches these tags!

Currently, I'm listening to music tagged _ebm_ or _synthpop_ or _darkwave_. Music from my own collection. Music I like to listen to, but I never had been able to access in this way.

So, what does my music tag cloud look like? <!--more-->One of the features of boffin is that it can export a list of tag-importance pairs, with the importance value of 1.0 for the most common tag, and a number relative this value for the rest of the tags. This list can be imported into [Wordle](http://www.wordle.net/), and boffin conveniently takes you directly to the upload page with the values loaded on the clipboard. The first time I tried this, though, it made the Wordle java applet crash and bring Firefox down with it (!), so instead I pasted the list to a text editor and just kept the first one third, which was more tags than Wordle could display anyway.

The result is this: [a tagcloud of my music collection](http://www.wordle.net/gallery/wrdl/722224/ihse%27s_last.fm_tag_cloud). It seems to match quite well my idea of what kind of music I have.

![A tag cloud describing my music collection]({{ site.baseurl }}/assets/posts/music-tag-cloud/ihse-music-tag-cloud.png){: class="center_85" }

So, now the only thing I'm missing is a way to integrate this into my SqueezeCenter solution, so I can play this on my Squeezeboxes, and not just on my computer.

So, how do you install this on Ubuntu? First, download the .deb [here](http://www.mediafire.com/?mwmilyyyodz). (Thanks to [trubazoid](http://www.last.fm/group/Audioscrobbler+Beta/forum/30705/_/510180/10#f8990259)!) Then install it with:

`sudo dpkg -i boffin_0.0.4-1_i386.deb`

Add support for the SQLite DB on QT with:

`sudo apt-get install libqt4-sql-sqlite`

If you don't have QT installed, you probably need to install more libraries as well.
