<?php

namespace Maksa988\EwaAPI\Requests;

class GetAllCitiesRequest extends Request
{
    /**
     * @var string
     */
    protected $url = '/place/full';

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * GetAllCities constructor.
     *
     * @param string $country
     */
    public function __construct($country = 'UA')
    {
        parent::__construct();

        $this->setUrl($this->url . '?country=' . $country);
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