<?php

namespace Maksa988\EwaAPI\Requests;

class CarModelsRequest extends Request
{
    /**
     * @var string
     */
    protected $url = '/auto_model/models';

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * CarModelsRequest constructor.
     */
    public function __construct()
    {
        parent::__construct();
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