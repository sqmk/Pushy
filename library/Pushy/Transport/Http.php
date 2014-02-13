<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013-2014 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Transport;

use Pushy\Transport\Exception\ConnectionException;
use Pushy\Transport\Exception\ApiException;

/**
 * Basic HTTP Client
 */
class Http implements TransportInterface
{
    /**
     * Verify peer status.
     *
     * @var boolean
     */
    protected $verifyPeer = true;

    /**
     * Set verify peer.
     *
     * @param boolean $status Status.
     *
     * @return self This.
     */
    public function setVerifyPeer($status)
    {
        $this->verifyPeer = (bool) $status;

        return $this;
    }

    /**
     * Send request
     *
     * @return array Response data
     */
    public function sendRequest(RequestMessage $requestMessage)
    {
        // Initialize curl and set options
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $requestMessage->getFullUrl());
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $requestMessage->getMethod());
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $this->verifyPeer);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Set JSON body if available
        if ($body = $requestMessage->getPostBody()) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        }

        // Get response body and status code
        $jsonResponse = json_decode(curl_exec($curl));
        $statusCode   = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        // Throw connection exception if no status code or json response
        if ($jsonResponse === null || $statusCode == 0) {
            throw new ConnectionException;
        }

        // Throw API exception if unexpected status code
        if ($statusCode !== 200) {
            throw new ApiException($jsonResponse->errors[0]);
        }

        return $jsonResponse;
    }
}
