<?php

namespace Maksa988\EwaAPI\Requests;

class GetAllCountriesRequest extends Request
{
    /**
     * @var string
     */
    protected $url = '/territory/countries';

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * GetAllCities constructor.
     *
     * @param null|string $query
     */
    public function __construct($query = null)
    {
        parent::__construct();

        $this->setUrl($this->url . '?query=' . $query);
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return array_merge(parent::getHeaders(), [
            'content-type' => 'application/json',
        ]);
    }
}