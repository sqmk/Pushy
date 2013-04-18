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
use Pushy\Priority\PriorityInterface;
use Pushy\Priority\NormalPriority;
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
     * Message
     *
     * @var string
     */
    protected $message;

    /**
     * Title
     *
     * @var string
     */
    protected $title;

    /**
     * Priority
     *
     * @var PriorityInterface
     */
    protected $priority;

    /**
     * URL
     *
     * @var string
     */
    protected $url;

    /**
     * URL Title
     *
     * @var string
     */
    protected $urlTitle;

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
        // Set defaults
        $this->setPriority(new NormalPriority);
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
     * Set message
     *
     * @param string $message Message
     *
     * @return self This object
     */
    public function setMessage($message)
    {
        $this->message = (string) $message;

        return $this;
    }

    /**
     * Set title
     *
     * @param string $title Title
     *
     * @return self This object
     */
    public function setTitle($title)
    {
        $this->title = (string) $title;

        return $this;
    }

    /**
     * Set URL
     *
     * @param string $url      URL
     * @param string $urlTitle URL title
     *
     * @return self This object
     */
    public function setUrl($url, $urlTitle = null)
    {
        $this->url      = (string) $url;
        $this->urlTitle = $urlTitle !== null ? (string) $urlTitle : null;

        return $this;
    }

    /**
     * Set priority
     *
     * @param PriorityInterface $priority Priority number
     *
     * @return self This object
     */
    public function setPriority(PriorityInterface$priority)
    {
        $this->priority = $priority;

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
