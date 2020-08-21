---
id: 8
title: 'Personal music tag cloud &#8211; Last.FM boffin'
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
I just discovered a new program from Last.FM &#8212; [boffin](http://www.last.fm/group/Audioscrobbler+Beta/forum/30705/_/510180). It is still in beta, but I encountered no real problems with it (apart from a slight difficulty at installing it in Ubuntu &#8212; solution below). Boffin indexes your personal music collection on your computer, and relates it to the tags given to the artists on Last.FM. As a result, you get a tag cloud descibing your local music collection. This would be cool to have, but not very useful. The great thing is that after the categorization, you can select one or more tags, and start playing music &#8212; from your own music collection &#8212; that matches these tags!

Currently, I&#8217;m listening to music tagged _ebm_ or _synthpop_ or _darkwave_. Music from my own collection. Music I like to listen to, but I never had been able to access in this way.

So, what does my music tag cloud look like? <!--more-->One of the features of boffin is that it can export a list of tag-importance pairs, with the importance value of 1.0 for the most common tag, and a number relative this value for the rest of the tags. This list can be imported into 

[Wordle](http://www.wordle.net/), and boffin conveniently takes you directly to the upload page with the values loaded on the clipboard. The first time I tried this, though, it made the Wordle java applet crash and bring Firefox down with it (!), so instead I pasted the list to a text editor and just kept the first one third, which was more tags than Wordle could display anyway.

The result is this: [a tagcloud of my music collection](http://www.wordle.net/gallery/wrdl/722224/ihse%27s_last.fm_tag_cloud). It seems to match quite well my idea of what kind of music I have.

[<img class="aligncenter size-full wp-image-9" title="ihse-music-tag-cloud" src="http://mag.icus.se/blog/wp-content/uploads/2009/04/ihse-music-tag-cloud.png" alt="A tag cloud describing my music collection" width="500" height="244" srcset="http://mag.icus.se/blog/wp-content/uploads/2009/04/ihse-music-tag-cloud.png 831w, http://mag.icus.se/blog/wp-content/uploads/2009/04/ihse-music-tag-cloud-300x146.png 300w" sizes="(max-width: 500px) 100vw, 500px" />](http://mag.icus.se/blog/wp-content/uploads/2009/04/ihse-music-tag-cloud.png)

So, now the only thing I&#8217;m missing is a way to integrate this into my SqueezeCenter solution, so I can play this on my Squeezeboxes, and not just on my computer.

So, how do you install this on Ubuntu? First, download the .deb [here](http://www.mediafire.com/?mwmilyyyodz). (Thanks to [trubazoid](http://www.last.fm/group/Audioscrobbler+Beta/forum/30705/_/510180/10#f8990259)!) Then install it with:_  
sudo dpkg -i boffin\_0.0.4-1\_i386.deb_

Add support for the SQLite DB on QT with:_  
sudo apt-get install libqt4-sql-sqlite_

If you don&#8217;t have QT installed, you probably need to install more libraries as well.