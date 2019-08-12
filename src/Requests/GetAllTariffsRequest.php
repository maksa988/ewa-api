<?php

namespace Maksa988\EwaAPI\Requests;

class GetAllTariffsRequest extends Request
{
    /**
     * @var string
     */
    protected $url = '/tariff';

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * GetAllTariffs constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setUrl($this->url . '?onlyActive=true');
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