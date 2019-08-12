<?php

namespace Maksa988\EwaAPI\Requests;

class GetPolicyTariffsRequest extends Request
{
    /**
     * @var string
     */
    protected $url = '/tariff/policy';

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * GetPolicyTariffs constructor.
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