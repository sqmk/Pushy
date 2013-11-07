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
use Mockery;

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
        $this->mockClient = Mockery::mock('\Pushy\Client')
            ->shouldIgnoreMissing();

        $this->mockTransport = Mockery::mock('\Pushy\Transport\TransportInterface')
            ->shouldIgnoreMissing();

        // Mock message
        $this->mockMessage = Mockery::mock('\Pushy\Message')
            ->shouldIgnoreMissing();

        // Mock user
        $this->mockUser = Mockery::mock('\Pushy\User')
            ->shouldIgnoreMissing();

        // Mock priority
        $this->mockPriority = Mockery::mock('\Pushy\Priority\PriorityInterface')
            ->shouldIgnoreMissing();

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
        $this->mockClient
            ->shouldReceive('getApiToken')
            ->andReturn('abc');

        $this->mockClient
            ->shouldReceive('getTransport')
            ->andReturn($this->mockTransport);

        // Stub mock transport sendRequest and response object
        $responseObject = (object) [
            'receipt' => 'receiptid'
        ];

        $this->mockTransport
            ->shouldReceive('sendRequest')
            ->andReturn($responseObject);

        // Stub mock message methods
        $this->mockMessage
            ->shouldReceive('getUser')
            ->andReturn($this->mockUser);

        $this->mockMessage
            ->shouldReceive('getPriority')
            ->andReturn($this->mockPriority);

        // Stub mock priority getApiParameters
        $this->mockPriority
            ->shouldReceive('getApiParameters')
            ->andReturn([]);

        // Ensure we get a receipt back
        $this->assertEquals(
            $this->sendMessageCommand->send($this->mockClient),
            $responseObject->receipt
        );
    }
}
