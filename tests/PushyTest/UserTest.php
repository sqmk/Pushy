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
     * @covers Pushy\User::__construct
     */
    public function setUp()
    {
        $this->user = new User;
    }

    /**
     * Test: Get/Set Id
     *
     * @covers Pushy\User::getId
     * @covers Pushy\User::setId
     */
    public function testGetSetId()
    {
        $id = 'pQiRzpo4DXghDmr9QzzfQu27cmVRsG';

        $this->user->setId($id);

        $this->assertEquals($id, $this->user->getId());
    }

    /**
     * Test: Get/Set Device Name
     *
     * @covers Pushy\User::getDeviceName
     * @covers Pushy\User::setDeviceName
     */
    public function testGetSetDeviceName()
    {
        $deviceName = 'test-device';

        $this->user->setDeviceName($deviceName);

        $this->assertEquals($deviceName, $this->user->getDeviceName());
    }
}
