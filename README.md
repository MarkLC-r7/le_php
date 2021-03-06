Logging to Logentries with Php
=======================================

With these simple steps you can send your Php application logs to Logentries.

Firsly you must register an account on Logentries.com, this only takes a few seconds.

Logentries Setup
----------------

When you have made your account on Logentries. Log in and create a new host with a name that best represents your app.

Then, click on your new host and inside that, create a new log file with a name that represents what you are logging,

example:  'myerrors'. Bear in mind, these names are purely for your own benefit. Under source type, select Token TCP

and click Register. You will notice a token appear beside the name of the log, these is a unique identifier that the logging

library will use to access that logfile. You can copy and paste this now or later.

Parameter Setup
---------------
Inside the `LeLogger-0.1` folder, open `logentries.php` as you need to fill in two parameters, `LOGGER_NAME` and `LOGENTRIES_TOKEN`.

`LOGGER_NAME` is the name of that particular logger which is for your benefit should you choose to have more than one.

`LOGENTRIES_TOKEN` is the token we copied earlier from the Logentries UI. It associates that logger with the log file on Logentries.


Optional Parameters
-------------------

You can also enter a third and fourth parameter called `opt_tcp` and `opt_severity`.

`opt_tcp` is a boolean indicating whether you would like to use tcp over udp. It is false by default and setting to true may have an impact response time as logging takes place in-process.

`opt_severity` lets you set a minimum severity for this logger. Is is set to DEBUG by default which allows all messages to be sent. The choices for this are:

	LeLogger::ERROR
	LeLogger::WARN
	LeLogger::NOTICE
	LeLogger::INFO
	LeLogger::DEBUG


Code Setup
----------

Now you need to download the library from the Downloads Tab, unzip and place the folder in your apps directory.

To use it in your code, enter the following lines, making changes accordingly if you place it in a different location.

	require dirname(__FILE__) . '/LeLogger-0.1/logentries.php';
	
	$log->Info("Hello Logentries, I'm an Info message");


Note
----

Be sure to conform to Php rules when using the optional parameters. If you wish to set `opt_severity`, you must also place true or false for `opt_tcp`

