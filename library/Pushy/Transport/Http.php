<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Transport;

use Pushy\Transport\Exception\ConnectionException;
use Pushy\Transport\Exception\ApiException;

/**
 * Basic HTTP Client
 */
class Http extends AbstractTransport
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
        $curl    = curl_init();
        $headers = [];
        curl_setopt($curl, CURLOPT_URL, $requestMessage->getFullUrl());
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $requestMessage->getMethod());
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $this->verifyPeer);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $curl,
            CURLOPT_HEADERFUNCTION,
            function($curl, $header) use (&$headers) {
                list($key, $value) = explode(': ', $header);
                $headers[$key] = trim($value);

                return strlen($header);
            }
        );

        // Set JSON body if available
        if ($body = $requestMessage->getPostBody()) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        }

        // Get response body and status code
        $jsonResponse = json_decode(curl_exec($curl));
        $statusCode   = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        // Parse headers for call stats
        $this->processHeaders($headers);

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

    /**
     * Process headers
     *
     * @param array $headers Headers
     */
    protected function processHeaders(array $headers)
    {
        if (isset($headers['X-Limit-App-Limit'])) {
            $this->appLimit = (int) $headers['X-Limit-App-Limit'];
        }

        if (isset($headers['X-Limit-App-Remaining'])) {
            $this->appRemaining = (int) $headers['X-Limit-App-Remaining'];
        }

        if (isset($headers['X-Limit-App-Reset'])) {
            $this->appReset = (int) $headers['X-Limit-App-Reset'];
        }
    }
}
