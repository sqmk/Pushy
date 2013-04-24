<?php
/**
 * Pushy: Pushover PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2013 Michael K. Squires
 * @license   http://github.com/sqmk/Pushy/wiki/License
 */

namespace Pushy\Transport;

/**
 * Request message for HTTP client
 */
class RequestMessage
{
    /**
     * API Domain
     */
    const API_DOMAIN = 'https://api.pushover.net/1/';

    /**
     * Request method
     *
     * @var string
     */
    protected $method = 'GET';

    /**
     * Request path
     *
     * @var string
     */
    protected $path;

    /**
     * Query params
     *
     * @var array
     */
    protected $queryParams;

    /**
     * JSON Fields
     *
     * @var null|array
     */
    protected $jsonFields;

    /**
     * Get request method
     *
     * @return string Request method
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set request method
     *
     * @return self This object
     */
    public function setMethod($method)
    {
        $this->method = (string) $method;

        return $this;
    }

    /**
     * Get request path
     *
     * @return string Request path
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set request path
     *
     * @return self This object
     */
    public function setPath($path)
    {
        $this->path = (string) $path;

        return $this;
    }

    /**
     * Get query params
     *
     * @return string URL-encoded query params
     */
    public function getQueryParams()
    {
        return http_build_query($this->queryParams);
    }

    /**
     * Set query param
     *
     * @param string $paramName Param name
     * @param mixed  $value     Value
     *
     * @return self This object
     */
    public function setQueryParam($paramName, $value)
    {
        $this->queryParams[(string) $paramName] = $value;

        return $this;
    }

    /**
     * Get full request URL
     *
     * @return string Full request URL
     */
    public function getFullUrl()
    {
        $fullPath = self::API_DOMAIN . $this->getPath();

        if ($query = $this->getQueryParams()) {
            $fullPath .= "?{$query}";
        }

        return $fullPath;
    }

    /**
     * Get JSON body
     *
     * @return string JSON
     */
    public function getJsonBody()
    {
        // Return null if no data
        if (!$this->jsonFields) {
            return;
        }

        return json_encode($this->jsonFields);
    }

    /**
     * Set JSON body field
     *
     * @param string $fieldName Field name
     * @param string $value     Value
     *
     * @return self This object
     */
    public function setJsonBodyField($fieldName, $value)
    {
        $this->jsonFields[$fieldName] = $value;

        return $this;
    }
}
