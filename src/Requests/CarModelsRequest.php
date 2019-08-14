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
     *
     * @param null|string $maker
     */
    public function __construct($maker = null)
    {
        parent::__construct();

        $this->setUrl($this->url . '?maker=' . $maker);
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