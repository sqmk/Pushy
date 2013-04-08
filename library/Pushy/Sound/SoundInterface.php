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
 * Interface for sounds
 */
interface SoundInterface
{
	/**
	 * Return sound parameter value on string conversion
	 *
	 * @return string Sound parameter value
	 */
	public function getParamValue();

	/**
	 * Return sound parameter value on string conversion
	 *
	 * @return string Sound parameter value
	 */
	public function __toString();
}
