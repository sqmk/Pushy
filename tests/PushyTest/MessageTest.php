<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace PushyTest;

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
     * @covers Pushy\Message::__construct
     */
    public function setUp()
    {
        $this->message = new Message;

        // Set mocks
        $this->mockUser     = $this->getMock('\Pushy\User');
        $this->mockPriority = $this->getMock('\Pushy\Priority\PriorityInterface');
        $this->mockSound    = $this->getMock('\Pushy\Sound\SoundInterface');
    }

    /**
     * Test: Constructor defaults
     *
     * @covers Pushy\Message::__construct
     */
    public function testConstructorDefaults()
    {
        // Ensure a priority is automatically set
        $this->assertAttributeInstanceOf(
            '\Pushy\Priority\PriorityInterface', 'priority', $this->message
        );

        // Ensure a sound is automatically set
        $this->assertAttributeInstanceOf(
            '\Pushy\Sound\SoundInterface', 'sound', $this->message
        );
    }

    /**
     * Test: Set user
     *
     * @covers Pushy\Message::setUser
     */
    public function testSetUser()
    {
        $this->message->setUser($this->mockUser);

        $this->assertAttributeInstanceOf(
            '\Pushy\Sound\SoundInterface', 'sound', $this->message
        );
    }

    /**
     * Test: Set priority
     *
     * @covers Pushy\Message::setPriority
     */
    public function testSetPriority()
    {
        $this->message->setPriority($this->mockPriority);

        $this->assertAttributeInstanceOf(
            '\Pushy\Priority\PriorityInterface', 'priority', $this->message
        );
    }

    /**
     * Test: Set sound
     *
     * @covers Pushy\Message::setSound
     */
    public function testSetSound()
    {
        $this->message->setSound($this->mockSound);

        $this->assertAttributeInstanceOf(
            '\Pushy\Sound\SoundInterface', 'sound', $this->message
        );
    }

    /**
     * Test: Set message
     *
     * @covers Pushy\Message::setMessage
     */
    public function testSetMessage()
    {
        $message = 'PHPUnit Test Message';

        $this->message->setMessage($message);

        $this->assertAttributeEquals(
            $message, 'message', $this->message
        );
    }

    /**
     * Test: Set title
     *
     * @covers Pushy\Message::setTitle
     */
    public function testSetTitle()
    {
        $title = 'PHPUnit Test Title';

        $this->message->setTitle($title);

        $this->assertAttributeEquals(
            $title, 'title', $this->message
        );
    }

    /**
     * Test: Set URL
     *
     * @covers Pushy\Message::setUrl
     */
    public function testSetUrl()
    {
        $url = 'http://example.com';

        $this->message->setUrl($url);

        $this->assertAttributeEquals(
            $url, 'url', $this->message
        );
    }

    /**
     * Test: Set URL title
     *
     * @covers Pushy\Message::setUrlTitle
     */
    public function testSetUrlTitle()
    {
        $urlTitle = 'PHPUnit Test URL Title';

        $this->message->setUrlTitle($urlTitle);

        $this->assertAttributeEquals(
            $urlTitle, 'urlTitle', $this->message
        );
    }
}
