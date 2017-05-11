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
     * @var array
     */
    protected $deviceName = array();

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
     * @param string $id User id
     *
     * @return self This object
     */
    public function setId($id)
    {
        // Id must be valid format
        if (!preg_match('/^[a-z0-9]{30}$/i', $id)) {
            throw new \InvalidArgumentException(
                'Id must be 30 characters long and contain character set [A-Za-z0-9]'
            );
        }

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
        return implode(',', $this->deviceName);
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
        // Id must be valid format
        if (!preg_match('/^[a-z0-9-]{0,25}$/i', $deviceName)) {
            throw new \InvalidArgumentException(
                'Device name must be no more than 25 characters long'
                . ' and contain character set [A-Za-z0-9-]'
            );
        }
    
        if (!in_array($deviceName, $this->deviceName)) {
            $this->deviceName[] = (string) $deviceName;
        }

        return $this;
    }
}
