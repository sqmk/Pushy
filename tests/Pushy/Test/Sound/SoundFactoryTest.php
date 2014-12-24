<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Test\Sound;

use Pushy\Sound\SoundFactory;

/**
 * Tests for Pushy\Sound\SoundFactory
 */
class SoundFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test: Create name
     *
     * @covers \Pushy\Sound\SoundFactory::createSound
     */
    public function testCreateSound()
    {
        $this->assertInstanceOf(
            '\Pushy\Sound\MagicSound',
            SoundFactory::createSound('magic')
        );
    }

    /**
     * Test: Create name, invalid sound
     *
     * @covers \Pushy\Sound\SoundFactory::createSound
     *
     * @expectedException \Exception
     */
    public function testCreateSoundInvalidSound()
    {
        SoundFactory::createSound('this_doesnt_exist');
    }
}
