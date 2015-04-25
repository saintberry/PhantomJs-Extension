PhantomJS-Extension
==============

PhantomJS-Extension supplies a `phantomjs` driver to Behat's Mink Extension. This driver is a simple extension of the `selenium2` driver with a simple addition, it will start and stop PhantomJs automatically as your suites run.

Usage
----------------------------------
Ensure that the extension is loaded in your `behat.yml`:
```
default:
    extensions:
		Behat\PhantomJsExtension: ~
```
The extension has no direct configuration options.

Make the PhantomJs driver your driver for `javascript_sessions` in Mink Extension config:
```
Behat\MinkExtension:
    javascript_session: phantomjs
```
With the configuration above whenever an `@javascript` step is found in your suite Mink's `selenium2` driver will use the test your application through `phantomjs` running in `webdriver mode` on port 	`8643`

Configuration Options 
----------------------------------
The PhantomJsDriver's options are an extension of Selenium2 driver. Default config options follow:
```
extensions:
	Behat\PhantomJsExtension: ~
	Behat\MinkExtension:
		javascript_session: phantomjs
		phantomjs:
			wd_host: http://localhost:8643/wd/hub
			wd_port: 8643
			bin: /usr/local/bin/phantomjs
	        browser: firefox
	        capabilities: ~
```
To do
----------------------------------
As `Symfony/Process` is used to manage the `phantomjs` binary it's quite easy to capture `stdout` or `stderr` output. Configuration options could be added to manage log file locations where this data could be directed.
