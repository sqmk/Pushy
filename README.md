# Pushy - A PHP client for Pushover

Master: [![Build Status](https://travis-ci.org/sqmk/Pushy.png?branch=master)](https://travis-ci.org/sqmk/Pushy)

## Introduction

Pushy is a PHP client that makes communicating with [Pushover.net[(https://pushover.net)'s API simple.

Interested in sending real-time mobile notifications to your iOS or Android device(s) from your web app? Take a look at [Pushover.net](https://pushover.net). It's free, and extremely easy to use with Pushy!

## Requirements

- PHP 5.4
- cURL extension

## Installation

You can install Pushy by using [composer](http://getcomposer.org). Simply add the dependency to your `composer.json` configuration:

```json
{
  "require": {
    "sqmk/pushy": "dev-master"
  }
}
```

See [composer](http://getcomposer.org) and [packagist](https://packagist.org)  for more information.

## Usage

Assuming your composer generated or custom autoloader can load Pushy files properly, using it is simple!

### Initializing client

In order to send a message, verify a user, or get a message status, you'll first need an application API key. You can get an API key by registering a new application on [Pushover.net](https://pushover.net).

Once you acquire your application key, you can now instantiate a Pushy Client object.

```php
// Instantiate a client object with application key
$pushy = new Pushy\Client('KzGDORePK8gMaC0QOYAMyEEuzJnyUi');
```

### Sending messages

Now that you have a client instantiated, you can send a message. But first, you want to build a user object for the receiving user.

You'll need to get your user identifier (or user key) at [Pushover.net](https://pushover.net). You'll also want a registered device name if you want to send a message to a single device. You can now create a user object with these details.

```php
// Instantiate a user object (targets all devices)
$user = new Pushy\User('pQiRzpo4DXghDmr9QzzfQu27cmVRsG');

// Alternatively, instantiate a user object with a targeted device
$user = new Pushy\User('pQiRzpo4DXghDmr9QzzfQu27cmVRsG', 'droid2');

// Setting properties by chaining is also possible
$user = (new Pushy\User)
  ->setId('pQiRzpo4DXghDmr9QzzfQu27cmVRsG')
  ->setDeviceName('droid2');
```

### Verifying a user

### Getting message status 
