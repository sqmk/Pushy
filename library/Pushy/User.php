<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy;

/**
 * User for Pushover
 */
class User
{
    /**
     * User's key
     *
     * @var string
     */
    protected $key;

    /**
     * User's device name
     *
     * @var string
     */
    protected $deviceName = null;

    /**
     * Instantiate a user object
     *
     * @param string $userKey User key
     */
    public function __construct($userKey)
    {
        // Set user key
        $this->setKey($userKey);
    }

    /**
     * Set user key
     *
     * @param string $key User key
     */
    protected function setKey($key)
    {
        $this->key = (string) $key;
    }

    /**
     * Set device name
     *
     * @param string $deviceName Device name
     *
     * @return self This object
     */
    protected function setDeviceName($deviceName)
    {
        $this->deviceName = (string) $deviceName;

        return $this;
    }
}
