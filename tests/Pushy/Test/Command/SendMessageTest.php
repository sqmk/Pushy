<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Test\Command;

use Pushy\Command\SendMessage;

/**
 * Tests for Pushy\Command\SendMessage
 */
class SendMessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Sned message command
     *
     * @var GetMessageStatus
     */
    protected $sendMessageCommand;

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
     * Mock message
     *
     * @var \Pushy\Message
     */
    protected $mockMessage;

    /**
     * Mock user
     *
     * @var \Pushy\User
     */
    protected $mockUser;

    /**
     * Mock priority
     *
     * @var \Pushy\Priority\PriorityInterface
     */
    protected $mockPriority;

    /**
     * Set up
     *
     * @covers \Pushy\Command\SendMessage::__construct
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

        // Mock message
        $this->mockMessage = $this->getMock(
            '\Pushy\Message'
        );

        // Mock user
        $this->mockUser = $this->getMock(
            '\Pushy\User'
        );

        // Mock priority
        $this->mockPriority = $this->getMock(
            '\Pushy\Priority\PriorityInterface'
        );

        // Instantiate send message command
        $this->sendMessageCommand = new SendMessage($this->mockMessage);
    }

    /**
     * Test: Send command
     *
     * @covers \Pushy\Command\SendMessage::send
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

        // Stub mock transport sendRequest and response object
        $responseObject = (object) [
            'receipt' => 'receiptid'
        ];

        $this->mockTransport->expects($this->once())
            ->method('sendRequest')
            ->will($this->returnValue($responseObject));

        // Stub mock message methods
        $this->mockMessage->expects($this->any())
            ->method('getUser')
            ->will($this->returnValue($this->mockUser));

        $this->mockMessage->expects($this->any())
            ->method('getPriority')
            ->will($this->returnValue($this->mockPriority));

        // Stub mock priority getApiParameters
        $this->mockPriority->expects($this->any())
            ->method('getApiParameters')
            ->will($this->returnValue([]));

        // Ensure we get a receipt back
        $this->assertEquals(
            $this->sendMessageCommand->send($this->mockClient),
            $responseObject->receipt
        );
    }
}
