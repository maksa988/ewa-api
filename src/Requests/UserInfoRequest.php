<?php

namespace Maksa988\EwaAPI\Requests;

class UserInfoRequest extends Request
{
    /**
     * @var string
     */
    protected $url = '/user/current';

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * UserInfoRequest constructor.
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