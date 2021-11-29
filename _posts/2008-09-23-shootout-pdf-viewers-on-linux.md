---
id: 7
title: 'Shootout -- PDF viewers on Linux'
date: 2008-09-23T16:47:49+00:00
author: magicus
layout: post
guid: http://mag.icus.se/blog/2008-09-23/shootout-pdf-viewers-on-linux/
permalink: /2008-09-23/shootout-pdf-viewers-on-linux/
categories:
  - benchmark
  - linux
  - open source
  - pdf
---
I have recently switched my primary desktop computer at home from Windows XP to Linux (Kubuntu Hardy). One of the things I assumed would work out better, but in fact worked out worse, is PDF viewing.

The Acrobat Reader on Windows is a memory-hungry monster, and I assumed that the Linux desktop would be full of lean-and-mean and cool PDF viewers. I was disappointed. I recently gave up and installed Adobe's closed-source reader, and it worked better than all the open source readers I tested. I've been testing kpdf, kghostview and evince. All of them have rendering issues with different PDF files, downloaded from the Internet. I think the best one have been evince, but not even evince have been without rendering bugs.

And then comes the issue of speed.

<!--more-->

I made a simple benchmark on loading a ~ 5 MB large PDF with complex graphics. The PDF is downloaded from [here](1045-1943-8441-4888-7323-8288). (It shows the frequency of MC accidents in the Stockholm area, but that's not really relevant.)

My test included:

  1. Warmup -- start the selected application on the PDF from Konqueror. Close the PDF (if possible).
  2. Open the PDF from the Recently opened menu, and measure time until the PDF is fully rendered.
  3. Close the application and redo step one, this time measuring the time until the PDF is fully rendered.

The warmup step was included to try to populate the cache, so hard disk loading time would not be affecting the test. Anyway, the test is not extremely scientific, since the timing was done by a stop-watch and me looking out for the rendering. So +/- 1 second is probably a reasonable margin of error.

Nevertheless, the results was interesting:

| Application          | Load PDF | Start and load PDF |
|----------------------|----------|--------------------|
| Adobe Acrobat Reader |     13 s |               18 s |
| KPDF                 |     18 s |               19 s |
| evince               |     10 s |               13 s |


kghostview couldn't render this PDF, so it's unfortunately not included.

So what can you learn from this? Acrobat has the longest loading time, enforcing my intuition on this bloatware. However, it was quite good at rendering time, which was made even better since the partial renderings were shown to the user, making the PDF usable from the first few seconds. Neither of the other PDF viewers made this. They didn't even have a progress meter, making it difficult to know how much longer you'd have to wait to view the PDF.

Evince was by all measures the fastest of the viewers, but they could still do some work on their startup time.

And me..? I'll stick with the Acrobat reader. It's fast enough (better than KPDF, the default in Kubuntu), it gives a good indication on how much is left to load/render, and I have yet to find any rendering issues (not so surprising considering that it's the de facto reference implementation). I tried hard to use the open source alternatives, but they didn't measure up.
