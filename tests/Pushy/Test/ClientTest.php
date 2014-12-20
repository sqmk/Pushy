<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013-2014 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Test;

use Mockery;
use Pushy\Client;

/**
 * Tests for Pushy\Client
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Client
     *
     * @var Client
     */
    protected $client;

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
     * Mock message
     *
     * @var \Pushy\Message
     */
    protected $mockMessage;

    /**
     * Mock transport
     *
     * @var \Pushy\Transport\TransportInterface
     */
    protected $mockTransport;

    /**
     * Set up
     *
     * @covers \Pushy\Client::__construct
     */
    public function setUp()
    {
        // Set up mock user
        $this->mockUser = Mockery::mock('\Pushy\User')
            ->shouldIgnoreMissing();

        // Set mock priority
        $this->mockPriority = Mockery::mock('\Pushy\Priority\PriorityInterface')
            ->shouldIgnoreMissing()
            ->shouldReceive('getApiParameters')
            ->andReturn([])
            ->getMock();

        // Set up mock message
        $this->mockMessage = Mockery::mock('\Pushy\Message')
            ->shouldIgnoreMissing();

        $this->mockMessage
            ->shouldReceive('getUser')
            ->andReturn($this->mockUser);

        $this->mockMessage
            ->shouldReceive('getPriority')
            ->andReturn($this->mockPriority);

        // Set mock transport
        $this->mockTransport = Mockery::mock('\Pushy\Transport\TransportInterface')
            ->shouldIgnoreMissing();

        // Set up client
        $this->client = new Client('KzGDORePK8gMaC0QOYAMyEEuzJnyUi');
        $this->client->setTransport($this->mockTransport);
    }

    /**
     * Test: Get/Set API token
     *
     * @covers \Pushy\Client::getApiToken
     * @covers \Pushy\Client::setApiToken
     */
    public function testGetSetApiToken()
    {
        $apiToken = 'iUynJzuEEyMAYOQ0CaMg8KPeRODGzK';

        $this->client->setApiToken($apiToken);

        $this->assertEquals(
            $this->client->getApiToken(),
            $apiToken
        );
    }

    /**
     * Test: Set invalid API token
     *
     * @covers \Pushy\Client::setApiToken
     *
     * @expectedException \InvalidArgumentException
     */
    public function testSetInvalidApiToken()
    {
        $this->client->setApiToken('badtoken');
    }

    /**
     * Test: Get/Set transport
     *
     * @covers \Pushy\Client::getTransport
     * @covers \Pushy\Client::setTransport
     */
    public function testGetSetTransport()
    {
        $mockTransport = Mockery::mock('\Pushy\Transport\TransportInterface');

        $this->client->setTransport($mockTransport);

        $this->assertEquals(
            $this->client->getTransport(),
            $mockTransport
        );
    }

    /**
     * Test: Get default transport.
     *
     * @covers \Pushy\Client::getTransport
     */
    public function testGetDefaultTransport()
    {
        $client = new Client('KzGDORePK8gMaC0QOYAMyEEuzJnyUi');

        $this->assertInstanceOf(
            '\Pushy\Transport\TransportInterface',
            $client->getTransport()
        );
    }

    /**
     * Test: Send message
     *
     * @covers \Pushy\Client::sendMessage
     */
    public function testSendMessage()
    {
        $this->client->sendMessage($this->mockMessage);
    }

    /**
     * Test: Verify user
     *
     * @covers \Pushy\Client::verifyUser
     */
    public function testVerifyUser()
    {
        $this->client->verifyUser($this->mockUser);
    }

    /**
     * Test: Get message status
     *
     * @covers \Pushy\Client::getMessageStatus
     */
    public function testGetMessageStatus()
    {
        // Message status object expects stdClass from transport
        $this->mockTransport
            ->shouldReceive('sendRequest')
            ->andReturn(new \stdClass);

        $this->client->getMessageStatus('abcdefghijklmnopqrstuvwxyz0123');
    }

    /**
     * Test: Cancel emergency
     *
     * @covers \Pushy\Client::cancelEmergency
     */
    public function testCancelEmergency()
    {
        // Transport should at least send a response with status property
        $this->mockTransport
            ->shouldReceive('sendRequest')
            ->andReturn(
                (object) ['status' => 1]
            );

        $this->client->cancelEmergency('abcdefghijklmnopqrstuvwxyz0123');
    }

    /**
     * Test: Send command
     *
     * @covers \Pushy\Client::sendCommand
     */
    public function testSendCommand()
    {
        // Command returns a value
        $dummyValue = 'dummy!';

        // Mock command
        $mockCommand = Mockery::mock('\Pushy\Command\CommandInterface')
            ->shouldReceive('send')
            ->times(1)
            ->andReturn($dummyValue)
            ->getMock();

        // Assert return value of command matches dummy
        $this->assertEquals(
            $this->client->sendCommand($mockCommand),
            $dummyValue
        );
    }
}
