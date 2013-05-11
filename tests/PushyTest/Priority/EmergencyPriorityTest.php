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
     * @var EmergencyPriority
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
     * @covers \Pushy\Priority\EmergencyPriority::getRetry
     * @covers \Pushy\Priority\EmergencyPriority::setRetry
     */
    public function testGetSetRetry()
    {
        $retryPeriod = 120;

        $this->priority->setRetry($retryPeriod);

        $this->assertEquals(
            $retryPeriod,
            $this->priority->getRetry()
        );
    }

    /**
     * Test: Set retry with invalid value.
     *
     * @covers \Pushy\Priority\EmergencyPriority::setRetry
     *
     * @expectedException \InvalidArgumentException
     */
    public function testSetRetryInvalid()
    {
        $this->priority->setRetry(20);
    }

    /**
     * Test: Set expire
     *
     * @covers \Pushy\Priority\EmergencyPriority::getExpire
     * @covers \Pushy\Priority\EmergencyPriority::setExpire
     */
    public function testGetSetExpire()
    {
        $expirePeriod = 1234;

        $this->priority->setExpire($expirePeriod);

        $this->assertEquals(
            $expirePeriod,
            $this->priority->getExpire()
        );
    }

    /**
     * Test: Set expire with invalid value.
     *
     * @covers \Pushy\Priority\EmergencyPriority::setExpire
     *
     * @expectedException \InvalidArgumentException
     */
    public function testSetExpireInvalid()
    {
        $this->priority->setExpire(86500);
    }

    /**
     * Test: Set callback
     *
     * @covers \Pushy\Priority\EmergencyPriority::getCallback
     * @covers \Pushy\Priority\EmergencyPriority::setCallback
     */
    public function testGetSetCallback()
    {
        $callback = 'http://example.com';

        $this->priority->setCallback($callback);

        $this->assertEquals(
            $callback,
            $this->priority->getCallback()
        );
    }

    /**
     * Test: Get API parameters.
     *
     * @covers \Pushy\Priority\EmergencyPriority::getApiParameters
     */
    public function testGetApiParameters()
    {
        $this->assertInternalType(
            'array',
            $this->priority->getApiParameters()
        );
    }
}
