<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Command;

use Pushy\Client;

/**
 * Interface for commands
 */
interface CommandInterface
{
	/**
	 * Send command
	 *
	 * @param Client $client Pushy client
	 *
	 * @return mixed Command's return value
	 */
    public function send(Client $client);
}
