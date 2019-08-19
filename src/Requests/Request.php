<?php

namespace Maksa988\EwaAPI\Requests;

use GuzzleHttp\Cookie\CookieJar;

abstract class Request
{
    /**
     * @var static
     */
    protected $url;

    /**
     * @var string
     */
    protected $locale = "uk_UA";

    /**
     * @var string
     */
    protected $method = "GET";

    /**
     * @var string
     */
    protected $type = "form_params";

    /**
     * @var bool
     */
    protected $isFile = false;

    /**
     * @var array
     */
    protected $cookies = [];

    /**
     * @var array
     */
    const SUPPORTED_METHODS = ["POST", "GET", "PUT", "DELETE", "PATCH"];

    /**
     * Request constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale = "ru_RU")
    {
        $this->locale = $locale;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return [
            //
        ];
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param $method
     *
     * @return bool
     */
    public function setMethod($method)
    {
        if(! in_array($method, self::SUPPORTED_METHODS)) {
            return false;
        }

        $this->method = $method;

        return true;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return [
            //
        ];
    }

    /**
     * @param string $domain
     * @param string $sessionID
     *
     * @return CookieJar
     */
    public function getCookies($domain, $sessionID)
    {
        return CookieJar::fromArray(array_merge([
            'JSESSIONID' => $sessionID,
        ], $this->cookies), $domain);
    }

    /**
     * @return bool
     */
    public function isFile()
    {
        return $this->isFile;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}