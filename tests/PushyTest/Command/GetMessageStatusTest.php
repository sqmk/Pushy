<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace PushyTest\Command;

use Pushy\Command\GetMessageStatus;

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
        $this->mockClient = $this->getMockBuilder('\Pushy\Client')
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockTransport = $this->getMock(
            '\Pushy\Transport\TransportInterface'
        );

        // Instantiate get message status command
        $this->getMessageStatusCommand = new GetMessageStatus('receipt-name');
    }

    /**
     * Test: Send command
     *
     * @covers \Pushy\Command\GetMessageStatus::send
     */
    public function testSend()
    {
        // Stub mock client getAPiToken and getTransport
        $this->mockClient->expects($this->once())
            ->method('getApiToken')
            ->will($this->returnValue('abc'));

        $this->mockClient->expects($this->once())
            ->method('getTransport')
            ->will($this->returnValue($this->mockTransport));

        // Stub mock transport sendRequest
        $this->mockTransport->expects($this->once())
            ->method('sendRequest')
            ->will($this->returnValue(new \stdClass));

        // Ensure we get a message status back
        $this->assertInstanceOf(
            '\Pushy\MessageStatus',
            $this->getMessageStatusCommand->send($this->mockClient)
        );
    }
}
