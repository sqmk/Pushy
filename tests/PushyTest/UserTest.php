<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace PushyTest;

use Pushy\User;

/**
 * Tests for Pushy\User
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * User
     *
     * @var User
     */
    protected $user;

    /**
     * Set up
     *
     * @covers \Pushy\User::__construct
     */
    public function setUp()
    {
        $this->user = new User('pQiRzpo4DXghDmr9QzzfQu27cmVRsG');
    }

    /**
     * Test: Get/Set Id
     *
     * @covers \Pushy\User::getId
     * @covers \Pushy\User::setId
     */
    public function testGetSetId()
    {
        $id = 'GsRVmc72uQfzzQ9rmDhgXD4opzRiQp';

        $this->user->setId($id);

        $this->assertEquals($id, $this->user->getId());
    }

    /**
     * Test: Set Id with an invalid value
     *
     * @covers \Pushy\User::setId
     *
     * @expectedException \InvalidArgumentException
     */
    public function testSetIdWithInvalidValue()
    {
        $this->user->setId('dummy');
    }

    /**
     * Test: Get/Set Device Name
     *
     * @covers \Pushy\User::getDeviceName
     * @covers \Pushy\User::setDeviceName
     */
    public function testGetSetDeviceName()
    {
        $deviceName = 'test-device';

        $this->user->setDeviceName($deviceName);

        $this->assertEquals($deviceName, $this->user->getDeviceName());
    }

    /**
     * Test: Set device name with an invalid value
     *
     * @covers \Pushy\User::setDeviceName
     *
     * @expectedException \InvalidArgumentException
     */
    public function testSetDeviceNameWithInvalidValue()
    {
        $this->user->setDeviceName('du.mmy');
    }
}
