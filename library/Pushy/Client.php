<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy;

/**
 * Client for Pushover
 */
class Client
{
    /**
     * API Token
     *
     * @var string
     */
    protected $apiToken;

    /**
     * Instantiates messenger object
     *
     * @param string $apiToken API Token
     */
    public function __construct($apiToken)
    {
        $this->setApiToken($apiToken);
    }

    /**
     * Set API token
     *
     * @param string $apiToken API token
     *
     * @return self This object
     */
    public function setApiToken($apiToken)
    {
        $this->apiToken = (string) $apiToken;

        return $this;
    }

    /**
     * Send a message
     *
     * @param Message $message Message
     */
    public function sendMessage(Message $message)
    {
    }

    /**
     * Verify user
     *
     * @param User $user User
     */
    public function verifyUser(User $user)
    {
    }
}
