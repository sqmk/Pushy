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
 * Basic HTTP Client
 */
class Http implements TransportInterface
{
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
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Set JSON body if available
        if ($body = $requestMessage->getJsonBody()) {
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
