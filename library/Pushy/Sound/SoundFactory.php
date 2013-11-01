<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Sound;

/**
 * Sound factory
 */
class SoundFactory
{
	/**
	 * Create sound
	 *
	 * @param string $name Sound name
	 *
	 * @return AbstractSound Sound
	 */
	public static function createSound($name)
	{
		// Generate class name
		$className = __NAMESPACE__ . '\\' . ucfirst(strtolower($name)) . 'Sound';

		// Determine if class exists
		if (!class_exists($className)) {
			throw new \Exception("{$name} is not a valid sound");
		}

		return new $className;
	}
}
