<?php

namespace Maksa988\EwaAPI\Requests;

use Illuminate\Support\Str;

class ContractSetState extends Request
{
    /**
     * @var string
     */
    protected $url = '/contract/{id}/state/{state}';

    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * @var string
     */
    protected $type = 'json';

    /**
     * ContractSetState constructor.
     *
     * @param string $id
     * @param string $state
     */
    public function __construct($id, $state)
    {
        $url = Str::replaceFirst('{id}', $id, $this->url);
        $url = Str::replaceFirst('{state}', $state, $url);

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
