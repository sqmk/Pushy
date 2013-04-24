<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Command;

use Pushy\User;
use Pushy\Client;
use Pushy\Transport\RequestMessage;

/**
 * Verify user command
 */
class VerifyUser implements CommandInterface
{
	/**
	 * User object
	 *
	 * @var User
	 */
	protected $user;

	/**
	 * Instantiates a verify user command
	 *
	 * @param User $user User object
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
	}

	/**
	 * Send command
	 *
	 * @param Client $client Pushy client
	 *
	 * @return bool true if valid, false if not
	 */
	public function send(Client $client)
	{
		// Create request message
		$requestMessage = (new RequestMessage)
			->setPath('users/validate.json')
			->setQueryParam('token', $client->getApiToken())
			->setQueryParam('user', $this->user->getId());

		// Set device name if one is available on the user
		if ($device = $this->user->getDeviceName()) {
			$requestMessage->setQueryParam('device', $device);
		}
	}
}
