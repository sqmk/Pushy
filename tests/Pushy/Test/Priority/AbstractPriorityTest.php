<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013-2014 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Test\Priority;

use Mockery;

/**
 * Tests for Pushy\Priority\AbstractPriority
 */
class AbstractPriorityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Priority
     *
     * @var AbstractPriority
     */
    protected $priority;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->priority = Mockery::mock('\Pushy\Priority\AbstractPriority')
            ->shouldDeferMissing();
    }

    /**
     * Test: Get code
     *
     * @covers \Pushy\Priority\AbstractPriority::getCode
     */
    public function testGetCode()
    {
        // Reference locally to access constants
        $priority = $this->priority;

        $this->assertEquals($priority::CODE, $this->priority->getCode());
    }

    /**
     * Test: Get API parameters
     *
     * @covers \Pushy\Priority\AbstractPriority::getApiParameters
     */
    public function testGetApiParameters()
    {
        $this->assertEquals(
            [
                'priority' => $this->priority->getCode()
            ],
            $this->priority->getApiParameters()
        );
    }
}
