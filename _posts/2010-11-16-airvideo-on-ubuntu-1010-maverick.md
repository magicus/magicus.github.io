---
id: 11
title: Air Video on Ubuntu 10.10 (maverick)
date: 2010-11-16T00:35:09+00:00
author: magicus
layout: post
guid: http://mag.icus.se/blog/?p=11
permalink: /2010-11-16/airvideo-on-ubuntu-1010-maverick/
categories:
  - linux
  - open source
tags:
  - airvideo
  - ipad
  - linux
  - ubuntu
---
I've recently gotten myself an iPad. Of course you want to watch videos on an iPad, right? Of couse you want them optimized for the iPad hardware, right? Of course you don't want to do that ahead of time and transfer to the iPad, but on-the-fly directly from your media library, right?

There's an app for that! (Surprise...) Probably several. But the one that rocks is [Air Video](http://www.inmethod.com/air-video/index.html "AirVideo").

Air Video needs a special server, and it need quite competent hardware to do on-the-fly conversion. But the server is only distributed for Windows and Mac OS X (once again: surprise...). Fortunately, it is quite easy to get it running under Linux. This is what I did.

<!--more-->

The server consists basically of two parts, a Java jar file and a special build of ffmpeg that is called from the Java server to do the actual conversion.

Basically following the hints on [http://wiki.birth-online.de/know-how/hardware/apple-iphone/airvideo-server-linux](http://wiki.birth-online.de/know-how/hardware/apple-iphone/airvideo-server-linux), but simplifying as much as possible, I did the following steps:

1. Download Alpha 4 of the jar file [here](http://inmethod.com/air-video/download/linux/alpha4/AirVideoServerLinux.jar). You might want to check for a newer version [here](http://www.inmethod.com/forum/posts/list/1856.page). Save it somewhere nice, like /usr/local/lib/airvideo.

2. Download the source code for the patched ffmpeg [here](http://www.inmethod.com/air-video/download/ffmpeg-for-2.2.5.tar.bz2). (That is for Air Video version 2.2.5; you might want to check for a newer version [here](http://www.inmethod.com/air-video/licenses.html).) Save it somewhere temporary, e.g. /tmp/airvideo_ffmpeg

3. At the command line, run `sudo apt-get install faac libx264-dev libmp3lame-dev libfaad-dev mpeg4ip-server git-core pkg-config` to install tools needed to build the ffmpeg and to run the Air Video server.

4. Build the custom ffmpeg and install it in /usr/local/bin by:
```
./configure --enable-pthreads --disable-shared --enable-static  --enable-gpl --enable-libx264 --enable-libmp3lame --enable-libfaad --disable-decoder=aac
make
sudo make install
```

5. Create a configuration file in e.g. /usr/local/etc/airvideo.properties, containing:
  ```
path.ffmpeg = /usr/local/bin/ffmpeg
path.mp4creator = /usr/bin/mp4creator
path.faac = /usr/bin/faac
password =
subtitles.encoding = windows-1250
subtitles.font = Verdana
folders = Movies:/path/to/my/Movies,MoreMovies:/path/to/more/Movies
  ```
  Replace the value for "folders" with something that match your system.

6. Now you can start the server by:
<br>
    `java -jar /usr/local/lib/airvideo/AirVideoServerLinux.jar /usr/local/etc/airvideo.properties`

7. As a bonus, to get autodiscovery to work, add a file /etc/avahi/services/airvideo.service containing:
    ```
    <?xml version="1.0" standalone='no'?><!--*-nxml-*-->
    <!DOCTYPE service-group SYSTEM "avahi-service.dtd">
    <service-group>
    <name replace-wildcards="yes">%h Air Video server</name>
    <service>
    <type>_airvideoserver._tcp</type>
    <port>45631</port>
    </service>
    </service-group>
    ```

8. Restart the bonjour service avahi by `sudo service avahi-daemon restart`

9.  That should be it! Now you should be able to find your server from the Air Video app, and you should be able to play videos on it by on-the-fly conversion, just if you had been using the server under Windows or Mac OS X.

10. (Starting the service automatically is left as an excercise for the reader; see [mbirth's wiki](http://wiki.birth-online.de/know-how/hardware/apple-iphone/airvideo-server-linux) for a suggestion on how to do this.)
