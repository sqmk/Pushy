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
     * Get app call limit
     *
     * @return int Call limit
     */
    public function getAppLimit();

    /**
     * Get app remaining calls
     *
     * @return int Calls remaining
     */
    public function getAppRemaining();

    /**
     * Get app call reset timestamp
     *
     * @return int Timestamp
     */
    public function getAppReset();

    /**
     * Send a request
     *
     * @param RequestMessage $requestMessage Request message
     *
     * @return array Response data
     */
    public function sendRequest(RequestMessage $requestMessage);
}
