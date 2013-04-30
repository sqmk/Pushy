<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy;

use Pushy\Priority\PriorityInterface;
use Pushy\Priority\NormalPriority;
use Pushy\Sound\SoundInterface;
use Pushy\Sound\PushoverSound;

/**
 * Message
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
     * Timestamp
     *
     * @var int
     */
    protected $timestamp;

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
        $this->setTimestamp();
        $this->setSound(new PushoverSound);
    }

    /**
     * Get user
     *
     * @return User User
     */
    public function getUser()
    {
        return $this->user;
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
     * Get message
     *
     * @return string Message
     */
    public function getMessage()
    {
        return $this->message;
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
     * Get title
     *
     * @return string Title
     */
    public function getTitle()
    {
        return $this->title;
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
     * Get URL
     *
     * @return string URL
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get URL Title
     *
     * @return string URL title
     */
    public function getUrlTitle()
    {
        return $this->urlTitle;
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
     * Get priority
     *
     * @return PriorityInterface Priority
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set priority
     *
     * @param PriorityInterface $priority Priority number
     *
     * @return self This object
     */
    public function setPriority(PriorityInterface $priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return int Timestamp
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set timestamp
     *
     * @param int $timestamp Timestamp
     *
     * @return self This object
     */
    public function setTimestamp($timestamp = null)
    {
        $this->timestamp = $timestamp === null
                         ? (int) $timestamp
                         : time();

        return $this;
    }

    /**
     * Get sound
     *
     * @return SoundInterface Sound
     */
    public function getSound()
    {
        return $this->sound;
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
