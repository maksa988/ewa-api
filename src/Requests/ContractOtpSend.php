<?php

namespace Maksa988\EwaAPI\Requests;

use Illuminate\Support\Str;

class ContractOtpSend extends Request
{
    /**
     * @var string
     */
    protected $url = '/contract/{id}/otp/send';

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * @var string
     */
    protected $type = 'query';

    /**
     * GetContractInfo constructor.
     *
     * @param string $id
     */
    public function __construct($id)
    {
        $url = Str::replaceFirst('{id}', $id, $this->url);

        $this->setUrl($url);
    }

    /**
     * @return array
     */
    public function getData()
    {
        return array_merge(parent::getData(), [
            'customer' => 'true',
        ]);
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
