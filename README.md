# MobilyWsSms SMS Sender [mobily.ws](http://www.mobily.ws/)  Wrapper for Laravel 5

## Introduction
...


## Installation

First, you'll need to require the package with Composer:

```sh
composer require abdualrhmanio/mobilywssms
```

Aftwards, run `composer update` from your command line.

Then, update `config/app.php` by adding an entry for the service provider.

```php
'providers' => [
	// ...
	Abdualrhmanio\MobilyWsSms\MobilyWsSmsServiceProvider::class
];
```


Then, register class alias by adding an entry in aliases section

```php
'aliases' => [
	// ...
	'mobilywssms' => Abdualrhmanio\MobilyWsSms\MobilyWsSmsFacade::class
];
```


Finally, from the command line again, run 

```
php artisan vendor:publish --tag=config
``` 

to publish the default configuration file. 
This will publish a configuration file named `mobilywssms.php` which includes your jawalbsms App Credentials.

> **Note:** If the previous command does not publish the config file successfully, please check the steps involving *providers* and *aliases* in the `config/app.php` file.


## Configuration

You need to fill in `mobilywssms.php` file that is found in your applications `config` directory.

## Usage

### Sending a SMS To Specific Number

You can easily send a SMS to Specific Number with the command

    \mobilywssms::sendSMS("Some Message","PhoneNumber");

    

    
