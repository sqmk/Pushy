<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013-2014 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Sound;

/**
 * Interface for sounds
 */
interface SoundInterface
{
    /**
     * Return sound name value on string conversion
     *
     * @return string Sound name
     */
    public function getName();

    /**
     * Return sound name on string conversion
     *
     * @return string Sound name
     */
    public function __toString();
}
