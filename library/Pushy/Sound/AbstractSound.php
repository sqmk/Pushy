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
 * Abstract Sound
 */
abstract class AbstractSound implements SoundInterface
{
	/**
	 * Get sound name
	 *
	 * @return string Sound name
	 */
	public function getName()
	{
		return static::NAME;
	}

	/**
	 * Return sound name on string conversion
	 *
	 * @return string Sound name
	 */
	public function __toString()
	{
		return $this->getName();
	}
}
