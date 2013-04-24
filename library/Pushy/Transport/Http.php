<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Transport;

/**
 * HTTP Client for Pushover
 */
class Http implements TransportInterface
{
    /**
     * Request message
     *
     * @var RequestMessage
     */
    protected $requestMessage;

    /**
     * Instantiates HTTP client
     *
     * @param RequestMessage $requestMessage Request message
     */
    public function __construct(RequestMessage $requestMessage)
    {
        $this->requestMessage = $requestMessage;
    }

    /**
     * Send request
     *
     * @return array Response data
     */
    public function sendRequest()
    {
        // Initialize curl and set options
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->requestMessage->getFullUrl());
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $this->requestMessage->getMethod());
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Set JSON body if available
        if ($body = $this->requestMessage->getJsonBody()) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        }

        // Get response body, code, content type
        $response = [
            'body'         => curl_exec($this->curl),
            'code'         => curl_getinfo($this->curl, CURLINFO_HTTP_CODE),
            'content_type' => curl_getinfo($this->curl, CURLINFO_CONTENT_TYPE),
        ];

        curl_close($curl);

        return $response;
    }
}
