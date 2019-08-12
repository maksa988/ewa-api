<?php

namespace Maksa988\EwaAPI\Requests;

class CarMarkAndModelRequest extends Request
{
    /**
     * @var string
     */
    protected $url = '/auto_model/maker_and_model';

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * CarMarkAndModelRequest constructor.
     *
     * @param null $query
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