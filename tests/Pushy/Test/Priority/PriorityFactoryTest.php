<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013-2014 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Test\Priority;

use Pushy\Priority\PriorityFactory;

/**
 * Tests for Pushy\Priority\PriorityFactory
 */
class PriorityFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test: Create name
     *
     * @covers \Pushy\Priority\PriorityFactory::createPriority
     */
    public function testCreatePriority()
    {
        $this->assertInstanceOf(
            '\Pushy\Priority\NormalPriority',
            PriorityFactory::createPriority('normal')
        );
    }

    /**
     * Test: Create name, invalid priority
     *
     * @covers \Pushy\Priority\PriorityFactory::createPriority
     *
     * @expectedException \Exception
     */
    public function testCreatePriorityInvalidPriority()
    {
        PriorityFactory::createPriority('this_doesnt_exist');
    }
}
