<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Priority;

/**
 * Emergency Priority
 */
class EmergencyPriority extends AbstractPriority
{
    /**
     * Priority code
     */
    const CODE = 2;

    /**
     * Retry period in seconds
     *
     * @var int
     */
    protected $retry = 30;

    /**
     * Expires in seconds
     *
     * @var int
     */
    protected $expire = 86400;

    /**
     * Callback URL
     *
     * @var string
     */
    protected $callback;

    /**
     * Set retry
     *
     * @param int $seconds Seconds
     *
     * @return self This object
     */
    public function setRetry($seconds)
    {
        $this->retry = (int) $seconds;

        return $this;
    }

    /**
     * Set expire
     *
     * @param int $seconds Seconds
     *
     * @return self This object
     */
    public function setExpire($seconds)
    {
        $this->expire = (int) $seconds;

        return $this;
    }

    /**
     * Set callback URL
     *
     * @param string $url Callback URL
     */
    public function setCallback($url)
    {
        $this->callback = (string) $url;

        return $this;
    }
}
