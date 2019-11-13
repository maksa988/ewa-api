<?php

namespace Maksa988\EwaAPI\Requests;

use Illuminate\Support\Str;

class GetContractReportFile extends Request
{
    /**
     * @var string
     */
    protected $url = '/binary/report/{templateId}';

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * @var string
     */
    protected $type = 'query';

    /**
     * @var bool
     */
    protected $isFile = true;

    /**
     * @var string
     */
    protected $contractId;

    /**
     * @var bool
     */
    protected $draft;

    /**
     * GetContractInfo constructor.
     *
     * @param string|int $templateId
     * @param string|int $contractId
     * @param bool $draft
     */
    public function __construct($templateId, $contractId, $draft = false)
    {
        $url = Str::replaceFirst('{templateId}', $templateId, $this->url);

        $this->setUrl($url);

        $this->contractId = $contractId;
        $this->draft = $draft;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return array_merge(parent::getData(), [
            'contractId' => $this->contractId,
            'draft' => $this->draft,
        ]);
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return array_merge(parent::getHeaders(), [
            'content-type' => 'application/pdf',
        ]);
    }
}
