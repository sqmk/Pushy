<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Test\Sound;

use Mockery;

/**
 * Tests for Pushy\Sound\AbstractSound
 */
class AbstractSoundTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Sound
     *
     * @var AbstractSound
     */
    protected $sound;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->sound = Mockery::mock('\Pushy\Sound\AbstractSound')
            ->shouldDeferMissing();
    }

    /**
     * Test: Get name
     *
     * @covers \Pushy\Sound\AbstractSound::getName
     */
    public function testGetName()
    {
        // Reference locally to access constants
        $sound = $this->sound;

        $this->assertEquals($sound::NAME, $this->sound->getName());
    }

    /**
     * Test: Convert Sound to string
     *
     * @covers \Pushy\Sound\AbstractSound::__toString
     */
    public function testToString()
    {
        // Reference locally to access constants
        $sound = $this->sound;

        $this->assertEquals($sound::NAME, (string) $this->sound);
    }
}
