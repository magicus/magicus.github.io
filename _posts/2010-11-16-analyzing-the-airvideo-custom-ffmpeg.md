---
id: 12
title: Analyzing the Air Video custom ffmpeg
date: 2010-11-16T01:45:23+00:00
author: magicus
layout: post
guid: http://mag.icus.se/blog/?p=12
permalink: /2010-11-16/analyzing-the-airvideo-custom-ffmpeg/
categories:
  - linux
  - open source
tags:
  - airvideo
  - ffmpeg
  - ipad
  - linux
  - open source
---
When I compiled the custom ffmpeg as describe in the [previous post](http://mag.icus.se/blog/2010-11-16/airvideo-on-ubuntu-1010-maverick/), I got curious to the custom build of ffmpeg that was used. I did some digging into [ffmpeg's git repository](http://git.ffmpeg.org/). First I made an intelligent guess on the approximate whereabout of what the custom build was based on, based on the state of the Changelog. Then I did a quick manual bisecting of git commits, coupled with a manual check if the corresponding changes was or was not present in the Air Video custom ffmpeg source.

This left me to conclude that the custom ffmpeg was based on the source including [this commit](http://git.ffmpeg.org/?p=ffmpeg;a=commit;h=3ebca8477a0cad1412212406562b1de1deabde66). (The snapshot of the git repository at this commit can be [downloaded here](http://git.ffmpeg.org/?p=ffmpeg;a=snapshot;h=3ebca8477a0cad1412212406562b1de1deabde66;sf=tgz).)

Also, the custom source code bundle included libswscale including [this commit](http://git.ffmpeg.org/?p=libswscale;a=commitdiff;h=12beb744c2c61620d3259fc832ff1853cef9a9c0). (Snapshot [here](http://git.ffmpeg.org/?p=libswscale;a=snapshot;h=132a00bad4a459eca8a26d648e55a01dab51d45f;sf=tgz).)

On top of this, they had made some patches to the ffmpeg source code (but none to the libswscale source). I created a patch file, it can be downloaded here: [ffmpeg_airvideo.patch]({{ site.baseurl }}/assets/posts/airvideo/ffmpeg_airvideo.patch)

So, what changes have they made?

<!--more-->

First of all, the patch is quite "clean" in that all new code are put in separate files, and the smallest possible changes are made in the existing files. This is probably good for having a patch outside the main line, but not good for having a patch that eventually could be merged upstream.

My quick analysis is that the changes divide into four parts:

  1. Adding a system for merging subtitles on the output stream, complete with two new command line options.
  2. Adding a "segmenter" that chunks the file in parts and send them part by part to the client.
  3. Making fixes for building on Mac OS X or Windows.
  4. Various other small fixes that might represent actual bugs in ffmpeg, or just be a behaviour that was not suitable for Air Video.

The two new command line options are `--conversion-id` and `--port-number`. They actually assume that these are the two firstmost command line options (if they are present), and just remove them from the command line argument array before sending it further on to the normal ffmpeg command line processing.

If you want to run a standard ffmpeg for the Air Video server, this is the very first thing it will fail on, complaining that --conversion-id is an unknown argument.

I keep thinking that it would be possible to solve these problems without modifying ffmpeg. For instance, the segmenter seems to be a completely stand-alone program. It is started by:
```
if (argc > 1 && strcmp(argv[1], "segmenter") == 0)
{
    return segmenter_main(argc, argv);
}
```
in the new main method that they provide in \_overlay.c, which supersedes ffmpeg's original main method, and the file implementing segmenter\_main (_segmenter.c) does not include any ffmpeg-specific header files.

The overlay stuff is used to merge subtitles into the video stream. Appearantly, the Java server acts as a "overlay server" for ffmpeg, which openes a connection to the Java server (only on localhost, on the port provided on the command line) and requests "overlays" for specific parts of the movie, which are then returned by the server and merged on the video stream by the patched ffmpeg.

Interesting solution. Still, I have the feeling this could be made in another manner which would not require patching ffmpeg. No good suggestions right now, though.

If these changes could be moved out of ffmpeg, it would really help in making it easier to deploy this on Linux. Or to have distributions ship this as a package. I'd love to do "sudo apt-get install airvideoserver"...
