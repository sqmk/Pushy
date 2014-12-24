<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Command;

use Pushy\Client;
use Pushy\MessageStatus;
use Pushy\Transport\RequestMessage;

/**
 * Send get message status command
 */
class GetMessageStatus implements CommandInterface
{
    /**
     * Receipt Id
     *
     * @var string
     */
    protected $receipt;

    /**
     * Instantiates a get message status command
     *
     * @param string $receipt Receipt Id
     */
    public function __construct($receipt)
    {
        $this->setReceipt($receipt);
    }

    /**
     * Set receipt
     *
     * @param string $receipt Receipt Id
     *
     * @return self This object
     */
    public function setReceipt($receipt)
    {
        // Id must be valid format
        if (!preg_match('/^[a-z0-9]{30}$/i', $receipt)) {
            throw new \InvalidArgumentException(
                'Receipt must be 30 characters long and contain character set [A-Za-z0-9]'
            );
        }

        $this->receipt = $receipt;

        return $this;
    }

    /**
     * Send command
     *
     * @param Client $client Pushy client
     *
     * @return MessageStatus Message status object
     */
    public function send(Client $client)
    {
        // Create request message
        $requestMessage = (new RequestMessage)
            ->setMethod('GET')
            ->setPath("receipts/{$this->receipt}.json")
            ->setQueryParam('token', $client->getApiToken());

        // Send request
        $response = $client->getTransport()->sendRequest($requestMessage);

        return new MessageStatus($response);
    }
}
