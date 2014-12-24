<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013-2014 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Transport;

/**
 * Abstract transport
 */
abstract class AbstractTransport implements TransportInterface
{
    /**
     * App call limit
     *
     * @var int
     */
    protected $appLimit;

    /**
     * App calls remaining
     *
     * @var int
     */
    protected $appRemaining;

    /**
     * App calls reset timestamp
     *
     * @var int
     */
    protected $appReset;

    /**
     * Get app call limit
     *
     * @return int Call limit
     */
    public function getAppLimit()
    {
        return $this->appLimit;
    }

    /**
     * Get app remaining calls
     *
     * @return int Calls remaining
     */
    public function getAppRemaining()
    {
        return $this->appRemaining;
    }

    /**
     * Get app reset
     *
     * @return int Calls reset timestamp
     */
    public function getAppReset()
    {
        return $this->appReset;
    }
}
