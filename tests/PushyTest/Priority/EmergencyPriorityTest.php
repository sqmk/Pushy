<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace PushyTest\Priority;

use Pushy\Priority\EmergencyPriority;

/**
 * Tests for Pushy\Priority\EmergencyPriority
 */
class EmergencyPriorityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Priority
     *
     * @var AbstractPriority
     */
    protected $priority;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->priority = new EmergencyPriority;
    }

    /**
     * Test: Set retry
     *
     * @covers Pushy\Priority\EmergencyPriority::setRetry
     */
    public function testSetRetry()
    {
        $retryPeriod = 120;

        $this->priority->setRetry($retryPeriod);

        $this->assertAttributeEquals($retryPeriod, 'retry', $this->priority);
    }

    /**
     * Test: Set expire
     *
     * @covers Pushy\Priority\EmergencyPriority::setExpire
     */
    public function testSetExpire()
    {
        $expirePeriod = 1234;

        $this->priority->setExpire($expirePeriod);

        $this->assertAttributeEquals($expirePeriod, 'expire', $this->priority);
    }

    /**
     * Test: Set callback
     *
     * @covers Pushy\Priority\EmergencyPriority::setCallback
     */
    public function testSetCallback()
    {
        $callback = 'http://example.com';

        $this->priority->setCallback($callback);

        $this->assertAttributeEquals($callback, 'callback', $this->priority);
    }
}
