<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Command;

use Pushy\MessageStatus;
use Pushy\Client;
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
        $this->receipt = (string) $receipt;
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
