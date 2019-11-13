<?php

namespace Maksa988\EwaAPI\Requests;

use Illuminate\Support\Str;

class GetContractInfo extends Request
{
    /**
     * @var string
     */
    protected $url = '/contract/{id}';

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * @var string
     */
    protected $type = 'json';

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
    public function getHeaders()
    {
        return array_merge(parent::getHeaders(), [
            'content-type' => 'application/json',
        ]);
    }
}
