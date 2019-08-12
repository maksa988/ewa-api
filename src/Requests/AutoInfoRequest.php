<?php

namespace Maksa988\EwaAPI\Requests;

class AutoInfoRequest extends Request
{
    /**
     * @var string
     */
    protected $url = '/auto/mtibu/number';

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * AutoInfoRequest constructor.
     *
     * @param $plate
     */
    public function __construct($plate)
    {
        parent::__construct();

        $this->setUrl($this->url . '?query=' . $plate);
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