<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace PushyTest;

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
        // Set up mocks
        $this->mockMessage   = $this->getMock('\Pushy\Message');
        $this->mockUser      = $this->getMock('\Pushy\User');
        $this->mockPriority  = $this->getMock('\Pushy\Priority\PriorityInterface');
        $this->mockTransport = $this->getMock('\Pushy\Transport\TransportInterface');

        // Mock priority needs list of api params
        $this->mockPriority->expects($this->any())
            ->method('getApiParameters')
            ->will($this->returnValue([]));

        // Mock message needs user
        $this->mockMessage->expects($this->any())
            ->method('getUser')
            ->will($this->returnValue($this->mockUser));

        // Mock message needs priority
        $this->mockMessage->expects($this->any())
            ->method('getPriority')
            ->will($this->returnValue($this->mockPriority));

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
        $mockTransport = $this->getMock('\Pushy\Transport\TransportInterface');

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
        $this->mockTransport->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue(new \stdClass));

        $this->client->getMessageStatus('abcdefghijklmnopqrstuvwxyz0123');
    }

    /**
     * Test: Send command
     *
     * @covers \Pushy\Client::sendCommand
     */
    public function testSendCommand()
    {
        // Set up mock command
        $mockCommand = $this->getMock('\Pushy\Command\CommandInterface');

        // Mock command returns a value
        $dummyValue = 'dummy!';

        $mockCommand->expects($this->any())
            ->method('send')
            ->will($this->returnValue($dummyValue));

        // Assert return value of command matches dummy
        $this->assertEquals(
            $this->client->sendCommand($mockCommand),
            $dummyValue
        );
    }
}
