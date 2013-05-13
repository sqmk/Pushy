<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace PushyTest\Command;

use Pushy\Command\VerifyUser;

/**
 * Tests for Pushy\Command\VerifyUser
 */
class VerifyUserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * VerifyUser command
     *
     * @var VerifyUser
     */
    protected $verifyUserCommand;

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
     * Mock user
     *
     * @var \Pushy\User
     */
    protected $mockUser;

    /**
     * Set up
     *
     * @covers \Pushy\Command\VerifyUser::__construct
     */
    public function setUp()
    {
        // Mock client, transport, and user
        $this->mockClient = $this->getMockBuilder('\Pushy\Client')
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockTransport = $this->getMock(
            '\Pushy\Transport\TransportInterface'
        );

        $this->mockUser = $this->getMockBuilder('\Pushy\User')
            ->disableOriginalConstructor()
            ->getMock();

        // Instantiate verify user status command
        $this->verifyUserCommand = new VerifyUser($this->mockUser);
    }

    /**
     * Test: Send command
     *
     * @covers \Pushy\Command\VerifyUser::send
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

        // Stub mock user getId and getDeviceName
        $this->mockUser->expects($this->once())
            ->method('getId')
            ->will($this->returnValue('pQiRzpo4DXghDmr9QzzfQu27cmVRsG'));

        $this->mockUser->expects($this->once())
            ->method('getDeviceName')
            ->will($this->returnValue('droid2'));

        // Ensure we get true back
        $this->assertTrue(
            $this->verifyUserCommand->send($this->mockClient)
        );
    }
}
