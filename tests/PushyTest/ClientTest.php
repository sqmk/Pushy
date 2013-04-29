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
     * Set up
     *
     * @covers Pushy\Client::__construct
     */
    public function setUp()
    {
        $this->mockMessage   = $this->getMock('\Pushy\Message');
        $this->mockUser      = $this->getMock('\Pushy\User');
        $this->mockTransport = $this->getMock('\Pushy\Transport\TransportInterface');

        $this->client = new Client('apikey123');
        $this->client->setTransport($this->mockTransport);
    }

    /**
     * Test: Get/Set Id
     *
     * @covers Pushy\Client::setApiToken
     */
    public function testSetApiToken()
    {
        $apiToken = 'KzGDORePK8gMaC0QOYAMyEEuzJnyUi';

        $this->client->setApiToken($apiToken);

        $this->assertAttributeEquals($apiToken, 'apiToken', $this->client);
    }

    /**
     * Test: Send message
     *
     * @covers Pushy\Client::sendMessage
     */
    public function testSendMessage()
    {
        $this->client->sendMessage($this->mockMessage);
    }

    /**
     * Test: Verify user
     *
     * @covers Pushy\Client::verifyUser
     */
    public function testVerifyUser()
    {
        $this->client->verifyUser($this->mockUser);
    }
}
