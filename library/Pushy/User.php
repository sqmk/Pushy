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
 * User
 */
class User
{
    /**
     * User's Id
     *
     * @var string
     */
    protected $id;

    /**
     * User's device name
     *
     * @var string
     */
    protected $deviceName;

    /**
     * Instantiate a user object
     *
     * @param string $id         User Id
     * @param string $deviceName Device name
     */
    public function __construct($id = null, $deviceName = null)
    {
        // Set user Id and device
        $this->setId($id);
        $this->setDeviceName($deviceName);
    }

    /**
     * Get User Id
     *
     * @return string User Id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user Id
     *
     * @param string $key User key
     *
     * @return self This object
     */
    public function setId($id)
    {
        $this->id = (string) $id;

        return $this;
    }

    /**
     * Get device name
     *
     * @return string Device name
     */
    public function getDeviceName()
    {
        return $this->deviceName;
    }

    /**
     * Set device name
     *
     * @param string $deviceName Device name
     *
     * @return self This object
     */
    public function setDeviceName($deviceName)
    {
        $this->deviceName = (string) $deviceName;

        return $this;
    }
}
