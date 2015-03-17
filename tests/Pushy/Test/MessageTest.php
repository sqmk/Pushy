<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Test;

use Mockery;
use Pushy\Message;

/**
 * Tests for Pushy\Message
 */
class MessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Message
     *
     * @var Message
     */
    protected $message;

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
     * Mock sound
     *
     * @var \Pushy\Sound\SoundInterface
     */
    protected $mockSound;

    /**
     * Set up
     *
     * @covers \Pushy\Message::__construct
     */
    public function setUp()
    {
        $this->message = new Message;

        // Set mocks
        $this->mockUser     = Mockery::mock('\Pushy\User');
        $this->mockPriority = Mockery::mock('\Pushy\Priority\PriorityInterface');
        $this->mockSound    = Mockery::mock('\Pushy\Sound\SoundInterface');
    }

    /**
     * Test: Constructor defaults
     *
     * @covers \Pushy\Message::__construct
     */
    public function testConstructorDefaults()
    {
        // Ensure a priority is automatically set
        $this->assertAttributeInstanceOf(
            '\Pushy\Priority\PriorityInterface', 'priority', $this->message
        );
    }

    /**
     * Test: Get/Set user
     *
     * @covers \Pushy\Message::getUser
     * @covers \Pushy\Message::setUser
     */
    public function testGetSetUser()
    {
        $this->message->setUser($this->mockUser);

        $this->assertEquals(
            $this->mockUser,
            $this->message->getUser()
        );
    }

    /**
     * Test: Get/Set message
     *
     * @covers \Pushy\Message::getMessage
     * @covers \Pushy\Message::setMessage
     */
    public function testGetSetMessage()
    {
        $message = 'PHPUnit Test Message';

        $this->message->setMessage($message);

        $this->assertEquals(
            $message,
            $this->message->getMessage()
        );
    }

    /**
     * Test: Get/Set title
     *
     * @covers \Pushy\Message::getTitle
     * @covers \Pushy\Message::setTitle
     */
    public function testGetSetTitle()
    {
        $title = 'PHPUnit Test Title';

        $this->message->setTitle($title);

        $this->assertEquals(
            $title,
            $this->message->getTitle()
        );
    }

    /**
     * Test: Set invalid length title
     *
     * @covers \Pushy\Message::setTitle
     *
     * @expectedException \InvalidArgumentException
     */
    public function testSetTitleWithInvalidLength()
    {
        $this->message->setTitle(str_repeat('X', 101));
    }

    /**
     * Test: Get/Set URL
     *
     * @covers \Pushy\Message::getUrl
     * @covers \Pushy\Message::setUrl
     */
    public function testGetSetUrl()
    {
        $url = 'http://example.com';

        $this->message->setUrl($url);

        $this->assertEquals(
            $url,
            $this->message->getUrl()
        );
    }

    /**
     * Test: Set invalid length URL
     *
     * @covers \Pushy\Message::setUrl
     *
     * @expectedException \InvalidArgumentException
     */
    public function testSetUrlWithInvalidLength()
    {
        $this->message->setUrl(str_repeat('X', 501));
    }

    /**
     * Test: Get/Set URL title
     *
     * @covers \Pushy\Message::getUrlTitle
     * @covers \Pushy\Message::setUrlTitle
     */
    public function testGetSetUrlTitle()
    {
        $urlTitle = 'PHPUnit Test URL Title';

        $this->message->setUrlTitle($urlTitle);

        $this->assertEquals(
            $urlTitle,
            $this->message->getUrlTitle()
        );
    }

    /**
     * Test: Set invalid length URL title
     *
     * @covers \Pushy\Message::setUrlTitle
     *
     * @expectedException \InvalidArgumentException
     */
    public function testSetUrlTitleWithInvalidLength()
    {
        $this->message->setUrlTitle(str_repeat('X', 51));
    }

    /**
     * Test: Get/Set priority
     *
     * @covers \Pushy\Message::getPriority
     * @covers \Pushy\Message::setPriority
     */
    public function testGetSetPriority()
    {
        $this->message->setPriority($this->mockPriority);

        $this->assertEquals(
            $this->mockPriority,
            $this->message->getPriority()
        );
    }

    /**
     * Test: Get/Set timestamp
     *
     * @covers \Pushy\Message::getTimestamp
     * @covers \Pushy\Message::setTimestamp
     */
    public function testGetSetTimestamp()
    {
        $time = time();

        $this->message->setTimestamp($time);

        $this->assertEquals(
            $time,
            $this->message->getTimestamp()
        );
    }

    /**
     * Test: Get/Set sound
     *
     * @covers \Pushy\Message::getSound
     * @covers \Pushy\Message::setSound
     */
    public function testGetSetSound()
    {
        $this->message->setSound($this->mockSound);

        $this->assertEquals(
            $this->mockSound,
            $this->message->getSound()
        );
    }
}
