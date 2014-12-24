<?php
/**
 * Example: Send emergency priority and cancel.
 *
 * Usage: APP_KEY=xxxxx USER_KEY=yyyyy USER_DEVICE=zzzzz php send-emergency-and-cancel.php
 */

require_once 'common.php';

$pushy = new Pushy\Client($appKey);
$user  = new Pushy\User($userKey, $userDevice);

echo 'Sending an emergency message and canceling immediately.', "\n";

// Build message with emergency priority
$message = (new Pushy\Message)
    ->setTitle('Emergency test')
    ->setMessage('This is just a test')
    ->setUser($user)
    ->setPriority(new Pushy\Priority\EmergencyPriority);

// Send message and get receipt
$receiptId = $pushy->sendMessage($message);

// Immediately cancel the emergency
$pushy->cancelEmergency($receiptId);

echo 'Call limit: ', $pushy->getAppLimit(), "\n",
    'Calls remaining: ', $pushy->getAppRemaining(), "\n",
    'Calls reset: ', $pushy->getAppReset(), "\n";
