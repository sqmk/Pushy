<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Test;

use Pushy\MessageStatus;

/**
 * Tests for Pushy\MessageStatus
 */
class MessageStatusTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Message status
     *
     * @var MessageStatus
     */
    protected $messageStatus;

    /**
     * Mock response data
     *
     * @var \stdClass
     */
    protected $mockResponseData;

    /**
     * Set up
     *
     * @covers \Pushy\MessageStatus::__construct
     */
    public function setUp()
    {
        // Mock response data
        $this->mockResponseData = (object) [
            'acknowledged'      => 1,
            'acknowledged_at'   => 1360019238,
            'last_delivered_at' => 1360001238,
            'expired'           => 1,
            'expires_at'        => 1360019290,
            'called_back'       => 1,
            'called_back_at'    => 1360019239,
        ];

        // Instantiate message status
        $this->messageStatus = new MessageStatus($this->mockResponseData);
    }

    /**
     * Test: Is acknowledged
     *
     * @covers \Pushy\MessageStatus::isAcknowledged
     */
    public function testIsAcknowledged()
    {
        $this->assertTrue($this->messageStatus->isAcknowledged());
    }

    /**
     * Test: Acknowledged at
     *
     * @covers \Pushy\MessageStatus::acknowledgedAt
     */
    public function testAcknowledgedAt()
    {
        $this->assertInstanceOf(
            '\DateTime',
            $this->messageStatus->acknowledgedAt()
        );
    }

    /**
     * Test: Acknowledged at with no value
     *
     * @covers \Pushy\MessageStatus::acknowledgedAt
     */
    public function testAcknowledgedAtWithNoValue()
    {
        $this->mockResponseData->acknowledged_at = 0;

        $this->assertNull(
            $this->messageStatus->acknowledgedAt()
        );
    }

    /**
     * Test: Last delivered at
     *
     * @covers \Pushy\MessageStatus::lastDeliveredAt
     */
    public function testLastDeliveredAt()
    {
        $this->assertInstanceOf(
            '\DateTime',
            $this->messageStatus->lastDeliveredAt()
        );
    }

    /**
     * Test: Last delivered at with no value
     *
     * @covers \Pushy\MessageStatus::lastDeliveredAt
     */
    public function testLastDeliveredAtWithNoValue()
    {
        $this->mockResponseData->last_delivered_at = 0;

        $this->assertNull(
            $this->messageStatus->lastDeliveredAt()
        );
    }

    /**
     * Test: Is expired
     *
     * @covers \Pushy\MessageStatus::isExpired
     */
    public function testIsExpired()
    {
        $this->assertTrue($this->messageStatus->isExpired());
    }

    /**
     * Test: Expires at
     *
     * @covers \Pushy\MessageStatus::expiresAt
     */
    public function testExpiresAt()
    {
        $this->assertInstanceOf(
            '\DateTime',
            $this->messageStatus->expiresAt()
        );
    }

    /**
     * Test: Expires at with no value
     *
     * @covers \Pushy\MessageStatus::expiresAt
     */
    public function testExpiresAtWithNoValue()
    {
        $this->mockResponseData->expires_at = 0;

        $this->assertNull(
            $this->messageStatus->expiresAt()
        );
    }

    /**
     * Test: Has called back
     *
     * @covers \Pushy\MessageStatus::hasCalledBack
     */
    public function testHasCalledBack()
    {
        $this->assertTrue($this->messageStatus->hasCalledBack());
    }

    /**
     * Test: Called back at
     *
     * @covers \Pushy\MessageStatus::calledBackAt
     */
    public function testCalledBackAt()
    {
        $this->assertInstanceOf(
            '\DateTime',
            $this->messageStatus->calledBackAt()
        );
    }

    /**
     * Test: Called back at with no value
     *
     * @covers \Pushy\MessageStatus::calledBackAt
     */
    public function testCalledBackWithNoValue()
    {
        $this->mockResponseData->called_back_at = 0;

        $this->assertNull(
            $this->messageStatus->calledBackAt()
        );
    }
}
