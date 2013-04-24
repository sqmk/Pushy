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
 * Transport Interface
 */
interface TransportInterface
{
    /**
     * Instantiate a transport object
     *
     * @param RequestMessage $requestMessage Request message
     */
    public function __construct(RequestMessage $requestMessage);

    /**
     * Send a request
     *
     * @return array Response data
     */
    public function sendRequest();
}
