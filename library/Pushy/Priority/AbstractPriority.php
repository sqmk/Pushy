<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Priority;

/**
 * Abstract Priority
 */
abstract class AbstractPriority implements PriorityInterface
{
    /**
     * Priority code
     */
    const CODE = -99;

    /**
     * Get priority code
     *
     * @return int Priority code
     */
    public function getCode()
    {
        return static::CODE;
    }
}
