<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Test\Command;

use Pushy\Command\GetMessageStatus;
use Mockery;

/**
 * Tests for Pushy\Command\GetMessageStatus
 */
class GetMessageStatusTest extends \PHPUnit_Framework_TestCase
{
    /**
     * GetMessageStatus command
     *
     * @var GetMessageStatus
     */
    protected $getMessageStatusCommand;

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
     * @covers \Pushy\Command\GetMessageStatus::__construct
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
        $this->getMessageStatusCommand = new GetMessageStatus(
            '3c0b5952fba0ab27805159217077c1'
        );
    }

    /**
     * Test: Set receipt with invalid value
     *
     * @covers \Pushy\Command\GetMessageStatus::setReceipt
     *
     * @expectedException \InvalidArgumentException
     */
    public function testSetReceiptWithInvalidValue()
    {
        $this->getMessageStatusCommand->setReceipt('invalid');
    }

    /**
     * Test: Send command
     *
     * @covers \Pushy\Command\GetMessageStatus::send
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
            ->andReturn(new \stdClass);

        // Ensure we get a message status back
        $this->assertInstanceOf(
            '\Pushy\MessageStatus',
            $this->getMessageStatusCommand->send($this->mockClient)
        );
    }
}
