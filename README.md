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

### Verifying a user

### Getting message status 
