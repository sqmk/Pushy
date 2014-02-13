<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013-2014 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy;

use DateTime;

/**
 * Message status
 */
class MessageStatus
{
    /**
     * Response data
     *
     * @var stdClass
     */
    protected $responseData;

    /**
     * Instantiate a message status object
     *
     * @param \stdClass Response data
     */
    public function __construct(\stdClass $responseData)
    {
        $this->responseData = $responseData;
    }

    /**
     * Message is acknowledged
     *
     * @return bool true if acknowledged, false if not
     */
    public function isAcknowledged()
    {
        return (bool) $this->responseData->acknowledged;
    }

    /**
     * Get acknowledge date
     *
     * @return DateTime|null DateTime if date available, null if not
     */
    public function acknowledgedAt()
    {
        if (!$this->responseData->acknowledged_at) {
            return null;
        }

        return DateTime::createFromFormat('U', $this->responseData->acknowledged_at);
    }

    /**
     * Last delivered at
     *
     * @return DateTime|null DateTime if date available, null if not
     */
    public function lastDeliveredAt()
    {
        if (!$this->responseData->last_delivered_at) {
            return null;
        }

        return DateTime::createFromFormat('U', $this->responseData->last_delivered_at);
    }

    /**
     * Is expired.
     *
     * @return bool true if expired, false if not
     */
    public function isExpired()
    {
        return (bool) $this->responseData->expired;
    }

    /**
     * Expired at
     *
     * @return DateTime|null DateTime if date available, null if not
     */
    public function expiresAt()
    {
        if (!$this->responseData->expires_at) {
            return null;
        }

        return DateTime::createFromFormat('U', $this->responseData->expires_at);
    }

    /**
     * Has called back
     *
     * @return bool true if called back, false if not
     */
    public function hasCalledBack()
    {
        return (bool) $this->responseData->called_back;
    }

    /**
     * Called back at
     *
     * @return DateTime|null DateTime if date available, null if not
     */
    public function calledBackAt()
    {
        if (!$this->responseData->called_back_at) {
            return null;
        }

        return DateTime::createFromFormat('U', $this->responseData->called_back_at);
    }
}
