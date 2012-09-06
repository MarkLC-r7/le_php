Logentries to Logentries with Php
=======================================

With these simple steps you can send your Php application logs to Logentries.

Firsly you must register an account on Logentries.com, this only takes a few seconds.

Logentries Setup
----------------

When you have made your account on Logentries. Log in and create a new host with a name that best represents your app.

Then, click on your new host and inside that, create a new log file with a name that represents what you are logging,

example:  myerrors.log. Bear in mind, these names are purely for your own benefit. Under source type, select Token TCP

and click Register. You will notice a token appear beside the name of the log, these is a unique identifier that the logging

library will use to access that logfile. You can copy and paste this now or later.

Code Setup
----------

Now you need to download the library from our Downloads Tab
