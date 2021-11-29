---
id: 4
title: Detecting if gdb is attached
date: 2008-08-10T13:39:09+00:00
author: magicus
layout: post
guid: http://mag.icus.se/blog/2008-08-10/detecting-if-gdb-is-attached/
permalink: /2008-08-10/detecting-if-gdb-is-attached/
categories:
  - Uncategorized
---
When writing programs that should be easy to debug, it is often useful to know if you are running with a debugger attached. In Linux, there is no reliable way of doing this, but you can make a clever hack that is quite okay. gdb and other debuggers work by using ptrace, but in Linux, only one process at a time can ptrace another. So, the trick is to try to ptrace ourselves, and if it fails, we can assume that we are running in a debugger. (Or in strace, for that matter.) Doing this properly requires starting a new thread, however. It's not very hard, but it's a bit tricky getting everything right, and Ihave the feeling I'm doing this over and over again.

<!--more-->

And there never seems to be any good code to find on Google, either. So, as a courtesy to the rest of the world, here is a code snippet:

```
#include <pthread.h>
#include <stdlib.h>
#include <stdbool.h>
#include <sys/ptrace.h>

static void*
test_trace(void* ignored)
{
	return (void*)ptrace(PTRACE_TRACEME, 0, NULL, NULL);
}

bool
is_debugger_attached(void)
{
	pthread_attr_t attr;
	void* result;
	pthread_t thread;

	pthread_attr_init(&attr);
	pthread_attr_setdetachstate(&attr, PTHREAD_CREATE_JOINABLE);
	if (pthread_create(&thread, &attr, test_trace, NULL) != 0) {
		pthread_attr_destroy(&attr);
		return false;
	}
	pthread_attr_destroy(&attr);
	if (pthread_join(thread, &result) != 0) {
		return false;
	}

	return result != NULL;
}
```
