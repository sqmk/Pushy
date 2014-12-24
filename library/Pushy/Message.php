<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy;

use Pushy\Priority\NormalPriority;
use Pushy\Priority\PriorityInterface;
use Pushy\Sound\SoundInterface;

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
     *
     * @param string Message message
     */
    public function __construct($message = null)
    {
        // Set defaults
        $this->setMessage($message);
        $this->setPriority(new NormalPriority);
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
        // Message must be of valid length
        if (strlen($message) > 512) {
            throw new \InvalidArgumentException(
                'Message may not exceed 512 characters'
            );
        }

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
        // Title must be of valid length
        if (strlen($title) > 100) {
            throw new \InvalidArgumentException(
                'Title may not exceed 100 characters'
            );
        }

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
     * Set URL
     *
     * @param string $url URL
     *
     *
     * @return self This object
     */
    public function setUrl($url)
    {
        // URL must be valid length
        if (strlen($url) > 500) {
            throw new \InvalidArgumentException(
                'URL may not exceed 500 characters'
            );
        }

        $this->url = (string) $url;

        return $this;
    }

    /**
     * Get URL title
     *
     * @return string URL title
     */
    public function getUrlTitle()
    {
        return $this->urlTitle;
    }

    /**
     * Set URL title
     *
     * @param string $urlTitle URL title
     */
    public function setUrlTitle($urlTitle)
    {
        // URL must be valid length
        if (strlen($urlTitle) > 50) {
            throw new \InvalidArgumentException(
                'URL title may not exceed 50 characters'
            );
        }

        $this->urlTitle = (string) $urlTitle;

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
    public function setTimestamp($timestamp)
    {
        $this->timestamp = (int) $timestamp;

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
