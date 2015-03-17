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
 * Priority factory
 */
class PriorityFactory
{
    /**
     * Create priority
     *
     * @param string $name Priority name
     *
     * @return AbstractPriority Priority
     * @throws \Exception
     */
    public static function createPriority($name)
    {
        // Generate class name
        $className = __NAMESPACE__ . '\\' . ucfirst(strtolower($name)) . 'Priority';

        // Determine if class exists
        if (!class_exists($className)) {
            throw new \Exception("{$name} is not a valid priority");
        }

        return new $className;
    }
}
