<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Test\Transport\Http;

use Mockery;
use Pushy\Transport\AbstractTransport;

/**
 * Tests for Pushy\Transport\AbstractTransport
 */
class AbstractTransportTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Abstract transport instance
     *
     * @var AbstractTransport
     */
    protected $abstractTransport;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->abstractTransport = Mockery::mock(
            '\Pushy\Transport\AbstractTransport'
        )->makePartial();
    }

    /**
     * Test: Get app limit
     *
     * @covers \Pushy\Transport\AbstractTransport::getAppLimit
     */
    public function testGetAppLimit()
    {
        $this->assertNull(
            $this->abstractTransport->getAppLimit()
        );
    }

    /**
     * Test: Get app remaining
     *
     * @covers \Pushy\Transport\AbstractTransport::getAppRemaining
     */
    public function testGetAppRemaining()
    {
        $this->assertNull(
            $this->abstractTransport->getAppRemaining()
        );
    }

    /**
     * Test: Get app remaining
     *
     * @covers \Pushy\Transport\AbstractTransport::getAppReset
     */
    public function testGetAppReset()
    {
        $this->assertNull(
            $this->abstractTransport->getAppReset()
        );
    }
}
