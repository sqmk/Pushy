<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy;

use Pushy\User;
use Pushy\Sound\SoundInterface;
use Pushy\Sound\PushoverSound;

/**
 * Message for Pushover
 */
class Message
{
    /**
     * User object
     *
     * @var User
     */
    protected $user;

    /**
     * Notification sound
     *
     * @var SoundInterface
     */
    protected $sound;

    /**
     * Instantiate a message object
     */
    public function __construct()
    {
        // Set default sound
        $this->setSound(new PushoverSound);
    }

    /**
     * Set user
     *
     * @param User $user User object
     *
     * @return self This object
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Set sound
     *
     * @param SoundInterface $sound Notification sound
     *
     * @return self This object
     */
    public function setSound(SoundInterface $sound)
    {
        $this->sound = $sound;

        return $this;
    }
}
