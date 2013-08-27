<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Test\Transport\Http;

use Pushy\Transport\Http;

/**
 * Tests for Pushy\Transport\Http
 */
class HttpTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Http instance
     *
     * @var Http
     */
    protected $transportHttp;

    /**
     * Mock request message
     *
     * @var \Pushy\Transport\RequestMessage
     */
    protected $mockRequestMessage;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->transportHttp = new Http;

        // Create mock request message
        $this->mockRequestMessage = $this->getMock(
            '\Pushy\Transport\RequestMessage'
        );
    }

    /**
     * Test: Send request
     *
     * @covers \Pushy\Transport\Http::sendRequest
     *
     * @expectedException \Pushy\Transport\Exception\ConnectionException
     */
    public function testSend()
    {
        $this->transportHttp->sendRequest($this->mockRequestMessage);
    }
}
