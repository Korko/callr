Callr package for Laravel
=========================

This package simply implements the Callr api and add a layer to quickly use it in Laravel 5.4

Installation
------------

In order to install this package, you simply have to execute this command (using Composer):
    composer install korko/callr

### Laravel 5.5+

If you're using Laravel 5.5 or above, the provider is already set thanks to the auto discovery added in Laravel 5.5.
You can still add an alias as described for Laravel 5.4 if you want.

### Laravel 5.4 and below

You have to manually add the provider and maybe a facade if you want:

#### Provider

In the `config/app.php` file, add the provider:
    Korko\Callr\CallrServiceProvider::class

#### Alias

If you want to use an alias to test and remove the link between this specific package and your code, you can add in `config/app.php` an alias like this:

    'Sms'          => Facades\Korko\Callr\CallrClient::class,

I prefer to use facade as alias for tests purposes but you should be able to use directly `Korko\Callr\CallrClient::class` as it's already a singleton.

Configuration
-------------

I tend to prefer using the .env to specify my config, especially because my projects are open source so if you wanna use the same system, just add this in your .env:
```
CALLR_USERNAME = <my callr username>
CALLR_PASSWORD = <my callr password>
CALLR_ALIAS = <my callr alias, once added to my account, if I want to use one>
CALLR_SENDER = <my callr sender, once added to my account, if I want to use one>
```

If you want to include your config in your project directly, you can use the command `php artisan vendor:publish`.
This will import the callr config file and then you can change the values directly in this file.

Usage
-----

### Command

To test my implementation, I can use the command `php artisan callr:sms <number in "+prefix number" format> [<message>]"

### Client call

In my code, I just have to call the client (I use the alias added before):

    Sms::message(<number in "+prefix number" format>, <message>, <mode=CallrClient::ALERTING>);

The mode can also take the value `CallrClient::MARKETING`. Those constants are just an alias for the values "ALERTING" and "MARKETING" used in the API.

You can also call `CallrClient::getApi()` to get the instance of callr's API.
