<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013-2014 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Test\Command;

use Mockery;
use Pushy\Command\CancelEmergency;

/**
 * Tests for Pushy\Command\CancelEmergency
 */
class CancelEmergencyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * CancelEmergency command
     *
     * @var CancelEmergency
     */
    protected $cancelEmergencyCommand;

    /**
     * Mock client
     *
     * @var \Pushy\Client
     */
    protected $mockClient;

    /**
     * Mock transport
     *
     * @var \Pushy\Transport\TransportInterface
     */
    protected $mockTransport;

    /**
     * Set up
     *
     * @covers \Pushy\Command\CancelEmergency::__construct
     */
    public function setUp()
    {
        // Mock client and transport
        $this->mockClient = Mockery::mock('\Pushy\Client')
            ->shouldIgnoreMissing();

        $this->mockTransport = Mockery::mock(
            '\Pushy\Transport\TransportInterface'
        );

        // Instantiate get message status command
        $this->cancelEmergencyCommand = new CancelEmergency(
            '3c0b5952fba0ab27805159217077c1'
        );
    }

    /**
     * Test: Set receipt with invalid value
     *
     * @covers \Pushy\Command\CancelEmergency::setReceipt
     *
     * @expectedException \InvalidArgumentException
     */
    public function testSetReceiptWithInvalidValue()
    {
        $this->cancelEmergencyCommand->setReceipt('invalid');
    }

    /**
     * Test: Send command
     *
     * @covers \Pushy\Command\CancelEmergency::send
     */
    public function testSend()
    {
        // Stub mock client getAPiToken and getTransport
        $this->mockClient
            ->shouldReceive('getApiToken')
            ->andReturn('abc');

        $this->mockClient
            ->shouldReceive('getTransport')
            ->andReturn($this->mockTransport);

        // Stub mock transport sendRequest
        $this->mockTransport
            ->shouldReceive('sendRequest')
            ->andReturn(
                (object) ['status' => 1]
            );

        // Ensure we get a message status back
        $this->assertTrue(
            $this->cancelEmergencyCommand->send($this->mockClient)
        );
    }
}
