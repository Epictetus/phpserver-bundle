# PHPServerBundle 

Have you ever wanted something like `python manage.py runserver` or `rails server` in your PHP apps for local development? 

So you're in good place ;)

## About ##

The PHPServerBundle adds `server:run` command to your `app/console` which allows you to run Symfony2 without using Apache, Nginx, Cherokee etc. 

**It's meant for dev usage only!**

**Caution:** PHP 5.4 is needed to use this bundle, as it uses PHP's integrated webserver. 

## Downloading ##

### Using `deps` file: ###

Add following lines to your `deps` file:

    [WebkattePHPServerBundle]
        git=git://github.com/webkatte/phpserver-bundle.git
        target=/bundles/Webkatte/PHPServerBundle

Then run the `./bin/vendors install` command to download.

### Using `git submodule` ###

Run the following commands:

    $ git submodule add git://github.com/webkatte/phpserver-bundle.git vendor/bundles/Webkatte/PHPServerBundle

### Using `git clone` ###

    $ git clone git://github.com/webkatte/phpserver-bundle.git vendor/bundles/Webkatte/PHPServerBundle

## Instalation ##

You have to register `Webkatte` namespace in your `app/autoload.php`:

``` php
<?php
	$loader->registerNamespaces(array(
    	//...
		'Webkatte'         => __DIR__.'/../vendor/bundles'
	));
```

Then add **PHPServerBundle** to your `app/AppKernel.php` file: 

``` php
<?php
	public function registerBundles()
	{
        $bundles = array(
    		//...
            new Webkatte\PHPServerBundle\WebkattePHPServerBundle()
        );
        //...
    }
```

## Usage ##

Run command with default values: 
	
	$ app/console server:run
	
And output should look like that:
	
	Symfony2 Development server started at Mon, 05 Mar 2012 20:12:17 +0100
	Your application URL: http://localhost:8080/app_dev.php
	Document root set to: /www/symfony/web

	Press Ctrl + C to quit.

**And that's all - go to your application URL and you should your symfony app.**

If you want some configuration, run 

	$ app/console help server:run
	
It will return something like that: 

	Usage:
 	 server:run [--host="..."] [--port="..."]

	Options:
	 --host  Hostname for running server (default: localhost)
	 --port  Port for running server (usually running on ports < 1024 require sudo) (default: 8080)

You can also set environment using built in `-e` option. Depending on that setting, your URL will contain `app_dev.php` or `app.php`. 

Another environments are also possible - look at [How to Master and Create new Environments](http://symfony.com/doc/current/cookbook/configuration/environments.html) at Symfony Docs. 


## License ##

It's distributed on MIT license.