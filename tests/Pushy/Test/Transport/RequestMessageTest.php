<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Test\Transport;

use Pushy\Transport\RequestMessage;

/**
 * Tests for Pushy\Transport\RequestMessage
 */
class RequestMessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * RequestMessage instance
     *
     * @var RequestMessage
     */
    protected $requestMessage;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->requestMessage = new RequestMessage;
    }

    /**
     * Test: Get/Set method
     *
     * @covers \Pushy\Transport\RequestMessage::getMethod
     * @covers \Pushy\Transport\RequestMessage::setMethod
     */
    public function testGetSetMethod()
    {
        $method = 'POST';

        // Ensure object we get back is the RequestMessage for chaining
        $this->assertEquals(
            $this->requestMessage,
            $this->requestMessage->setMethod($method)
        );

        // Ensure method set is what is returned from get
        $this->assertEquals(
            $method,
            $this->requestMessage->getMethod()
        );
    }

    /**
     * Test: Get/Set path
     *
     * @covers \Pushy\Transport\RequestMessage::getPath
     * @covers \Pushy\Transport\RequestMessage::setPath
     */
    public function testGetSetPath()
    {
        $path = 'some/path';

        // Ensure object we get back is the RequestMessage for chaining
        $this->assertEquals(
            $this->requestMessage,
            $this->requestMessage->setPath($path)
        );

        // Ensure path set is what is returned from get
        $this->assertEquals(
            $path,
            $this->requestMessage->getPath()
        );
    }

    /**
     * Test: Get/Set query params
     *
     * @covers \Pushy\Transport\RequestMessage::getQueryParams
     * @covers \Pushy\Transport\RequestMessage::setQueryParam
     */
    public function testGetSetQueryParams()
    {
        // Ensure we start off with no query params
        $this->assertEmpty($this->requestMessage->getQueryParams());

        // Ensure we get back RequestMessage for chaining
        $this->assertEquals(
            $this->requestMessage,
            $this->requestMessage->setQueryParam('test', 'value')
        );

        // Ensure query params is no longer empty
        $this->assertNotEmpty($this->requestMessage->getQueryParams());
    }

    /**
     * Test: Get full Url
     *
     * @covers \Pushy\Transport\RequestMessage::getFullUrl
     */
    public function testGetFullUrl()
    {
        $this->requestMessage->setQueryParam('test', 'value');

        $this->assertEquals(
            RequestMessage::API_DOMAIN . '?test=value',
            $this->requestMessage->getFullUrl()
        );
    }

    /**
     * Test: Get/Set post body field
     *
     * @covers \Pushy\Transport\RequestMessage::getPostBody
     * @covers \Pushy\Transport\RequestMessage::setPostBodyField
     */
    public function testGetSetPostBodyField()
    {
        // Ensure we start off with no query params
        $this->assertEmpty($this->requestMessage->getPostBody());

        // Ensure we get back RequestMessage for chaining
        $this->assertEquals(
            $this->requestMessage,
            $this->requestMessage->setPostBodyField('test', 'value')
        );

        // Ensure query params is no longer empty
        $this->assertNotEmpty($this->requestMessage->getPostBody());
    }
}
