<?php

namespace Maksa988\EwaAPI\Requests;

class CarMarksRequest extends Request
{
    /**
     * @var string
     */
    protected $url = '/auto_model/makers';

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * CarMarksRequest constructor.
     */
    public function __construct($query = null)
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