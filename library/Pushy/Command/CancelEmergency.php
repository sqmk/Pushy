<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013-2014 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Command;

use Pushy\Client;
use Pushy\Message;
use Pushy\Transport\RequestMessage;

/**
 * Cancel emergency command
 */
class CancelEmergency implements CommandInterface
{
    /**
     * Receipt Id
     *
     * @var string
     */
    protected $receipt;

    /**
     * Instantiates a cancel emergency command
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
     * @return null|string null if no receipt, string if there is
     */
    public function send(Client $client)
    {
        // Create request message
        $requestMessage = (new RequestMessage)
            ->setMethod('POST')
            ->setPath("receipts/{$this->receipt}/cancel.json")
            ->setQueryParam('token', $client->getApiToken());

        // Send request
        $response = $client->getTransport()->sendRequest($requestMessage);

        return (bool) $response->status;
    }
}
