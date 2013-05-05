<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Command;

use Pushy\Message;
use Pushy\Client;
use Pushy\Transport\RequestMessage;

/**
 * Send message command
 */
class SendMessage implements CommandInterface
{
    /**
     * Message object
     *
     * @var Message
     */
    protected $message;

    /**
     * Instantiates a send message command
     *
     * @param Message $message Message object
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
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
        // Init api params
        $apiParams = array_merge(
            [
                'token'     => $client->getApiToken(),
                'user'      => $this->message->getUser()->getId(),
                'device'    => $this->message->getUser()->getDeviceName(),
                'message'   => $this->message->getMessage(),
                'title'     => $this->message->getTitle(),
                'url'       => $this->message->getUrl(),
                'url_title' => $this->message->getUrlTitle(),
                'timestamp' => $this->message->getTimestamp(),
                'sound'     => (string) $this->message->getSound(),
            ],
            $this->message->getPriority()->getApiParameters()
        );

        // Create request message
        $requestMessage = (new RequestMessage)
            ->setMethod('POST')
            ->setPath('messages.json');

        // Set API params
        foreach ($apiParams as $param => $value) {
            // Skip param if null
            if ($value === null) {
                continue;
            }

            $requestMessage->setQueryParam($param, $value);
        }

        // Send request
        $response = $client->getTransport()->sendRequest($requestMessage);

        // Return receipt if there is one
        if (isset($response->receipt)) {
            return $response->receipt;
        }
    }
}
