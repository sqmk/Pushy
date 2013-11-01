# Pushy - A PHP client for Pushover

Master: [![Build Status](https://travis-ci.org/sqmk/Pushy.png?branch=master)](https://travis-ci.org/sqmk/Pushy)

## Introduction

Pushy is a PHP client that makes communicating with [Pushover.net](https://pushover.net)'s API simple.

Pushy makes full use of Pushover's API. This includes sending messages, validating users, and retrieving message statuses.

Interested in sending real-time mobile notifications to your iOS or Android device(s) from your web app? Take a look at [Pushover.net](https://pushover.net). API usage is free, and extremely easy to use with Pushy!

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

For those interested in the complete API, you can check out the auto-generated documentation at [GitApiDoc](http://gitapidoc.com/api/sqmk/Pushy/).

### Initializing client

In order to send a message, verify a user, or get a message status, you'll first need an application API key. You can get an API key by registering a new application on [Pushover.net](https://pushover.net).

Once you acquire your application key, you can now instantiate a Pushy Client object.

```php
// Instantiate a client object with application key
$pushy = new Pushy\Client('KzGDORePK8gMaC0QOYAMyEEuzJnyUi');
```

### Sending messages

You have a client instantiated, now you can send a message. But first, you want to build a user object for the receiving user.

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

After creating a user, you have enough to start creating a message.

```php
// Instantiate a message object with a message body
$message = new Pushy\Message('Your message body');

// Set the recipient of the message
$message->setUser($user);

// Set the title
$message->setTitle('You message title');

// Set a priority (defaults to NormalPriority)
$message->setPriority(
  new Pushy\Priority\LowPriority
);

// Set a sound (defaults to PushoverSound)
$message->setSound(
  new Pushy\Sound\AlienSound
);

// Set a supplementary URL and title
$message->setUrl(
  'http://example.org'
);

$message->setUrlTitle(
  'Example.org'
);

// Set a custom sent timestamp
$message->setTimestamp(1369111110);

// All methods above are chainable
$message = (new Pushy\Message)
  ->setMessage('Your message body')
  ->setTitle('Your message title')
  ->setUser($user);
```

To send the message, pass the message object to the client.

```php
// Send the previous created message
$pushy->sendMessage($message);
```

If no exceptions are thrown, the message was sent successfully. No data is returned by the sendMessage method unless the message has an emergency priority.

#### Emergency priority messages

You can send a message with an emergency priority and get a receipt code. Emergency priorities also have additional options.

```php
// Create a message with emergency priority
$message = (new Pushy\Message)
  ->setMessage('Important message')
  ->setTitle('Important subject')
  ->setUser($user)
  ->setPriority(
    (new Pushy\Priority\EmergencyPriority)
      // Resend message to user every X seconds
      ->setRetry(30)
      // Expire message after X seconds
      ->setExpire(3600)
      // Set callback URL to hit when user acknowledges message
      ->setCallback('http://example.org/api')
  );

// Send message and get receipt code
$receiptCode = $pushy->sendMessage($message);
```

#### Priorities

The list of available priorities in Pushy\Priority:
- LowPriority
- NormalPriority (default)
- HighPriority
- EmergencyPriority

#### Sounds

The list of available sounds in Pushy\Sound:
- AlienSound
- BikeSound
- BugleSound
- CashregisterSound
- ClassicalSound
- ClimbSound
- CosmicSound
- EchoSound
- FallingSound
- GamelanSound
- IncomingSound
- IntermissionSound
- MagicSound
- MechanicalSound
- NoSound
- PersistentSound
- PianobarSound
- PushoverSound (default)
- SirenSound
- TugboatSound
- UpdownSound

### Verifying a user

A user object can be verified with Pushover prior to sending out messages.

```php
// Pass previous instantiated user object to the client
try {
  $pushy->verifyUser($user);
  
  echo 'User is valid';
} catch (Pushy\Transport\Exception\ApiException $e) {
  echo 'User is not valid';
}
```

### Getting message status

When using an emergency priority with a message, you get a receipt code after sending the message successfully. You can get the status of the message by sending the receipt code by way of `getMessageStatus`.

```php
// Get message with the receipt code
$messageStatus = $pushy->getMessageStatus($receiptCode);

// Was the message acknowledged? (true or false)
$messageStatus->isAcknowledged();

// When the message was acknowledged (DateTime or null)
$messageStatus->acknowledgedAt();

// When the message was last delivered (DateTime or null)
$messageStatus->lastDeliveredAt();

// Is the message expired? (true or false)
$messageStatus->isExpired();

// When the message expired (DateTime or null)
$messageStatus->expiresAt();

// Has Pushover contacted the callback URL? (true or false)
$messageStatus->hasCalledBack();

// When Pushover contacted the callback URL (DateTime or null)
$messageStatus->calledBackAt();
```
