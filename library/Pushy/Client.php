<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy;

use Pushy\Command\CancelEmergency;
use Pushy\Command\CommandInterface;
use Pushy\Command\GetMessageStatus;
use Pushy\Command\SendMessage;
use Pushy\Command\VerifyUser;
use Pushy\Transport\Http;
use Pushy\Transport\TransportInterface;

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
     * Transport option (Http only for now)
     *
     * @var TransportInterface
     */
    protected $transport;

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
     * Get API token
     *
     * @return string API Token
     */
    public function getApiToken()
    {
        return $this->apiToken;
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
        // Id must be valid format
        if (!preg_match('/^[a-z0-9]{30}$/i', $apiToken)) {
            throw new \InvalidArgumentException(
                'API Token must be 30 characters long'
                . ' and contain character set [A-Za-z0-9]'
            );
        }

        $this->apiToken = (string) $apiToken;

        return $this;
    }

    /**
     * Get transport
     *
     * @return TransportInterface Transport object
     */
    public function getTransport()
    {
        // Set transport if haven't already
        if (!$this->transport) {
            $this->setTransport(new Http);
        }

        return $this->transport;
    }

    /**
     * Set transport
     *
     * @param TransportInterface $transport Transport object
     *
     * @return self This object
     */
    public function setTransport(TransportInterface $transport)
    {
        $this->transport = $transport;

        return $this;
    }

    /**
     * Send a message
     *
     * @param Message $message Message
     *
     * @return mixed Send message result
     */
    public function sendMessage(Message $message)
    {
        return $this->sendCommand(
            new SendMessage($message)
        );
    }

    /**
     * Verify user
     *
     * @param User $user User
     *
     * @return bool True if user is valid
     */
    public function verifyUser(User $user)
    {
        return $this->sendCommand(
            new VerifyUser($user)
        );
    }

    /**
     * Get message status
     *
     * @param string $receipt Receipt Id
     *
     * @return MessageStatus Message status object
     */
    public function getMessageStatus($receipt)
    {
        return $this->sendCommand(
            new GetMessageStatus($receipt)
        );
    }

    /**
     * Cancel emergency
     *
     * @param string $receipt Receipt Id
     *
     * @return bool True if canceled
     */
    public function cancelEmergency($receipt)
    {
        return $this->sendCommand(
            new CancelEmergency($receipt)
        );
    }

    /**
     * Get app limit
     *
     * @return int Call limit
     */
    public function getAppLimit()
    {
        return $this->getTransport()->getAppLimit();
    }

    /**
     * Get app remaining
     *
     * @return int Calls remaining
     */
    public function getAppRemaining()
    {
        return $this->getTransport()->getAppRemaining();
    }

    /**
     * Get app reset date
     *
     * @return int Calls reset timestamp
     */
    public function getAppReset()
    {
        return $this->getTransport()->getAppReset();
    }

    /**
     * Send command
     *
     * @param CommandInterface $command Command to send
     *
     * @return mixed Return value from command
     */
    public function sendCommand(CommandInterface $command)
    {
        return $command->send($this);
    }
}
