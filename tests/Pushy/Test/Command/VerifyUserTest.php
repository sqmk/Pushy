<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Test\Command;

use Mockery;
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
        $this->mockClient = Mockery::mock('\Pushy\Client')
            ->shouldIgnoreMissing();

        $this->mockTransport = Mockery::mock('\Pushy\Transport\TransportInterface')
            ->shouldIgnoreMissing();

        $this->mockUser = Mockery::mock('\Pushy\User')
            ->shouldIgnoreMissing();

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

        // Stub mock user getId and getDeviceName
        $this->mockUser
            ->shouldReceive('getId')
            ->andReturn('pQiRzpo4DXghDmr9QzzfQu27cmVRsG');

        $this->mockUser
            ->shouldReceive('getDeviceName')
            ->andReturn('droid2');

        // Ensure we get true back
        $this->assertTrue(
            $this->verifyUserCommand->send($this->mockClient)
        );
    }
}
