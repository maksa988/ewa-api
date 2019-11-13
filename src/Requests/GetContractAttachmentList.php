<?php

namespace Maksa988\EwaAPI\Requests;

class GetContractAttachmentList extends Request
{
    /**
     * @var string
     */
    protected $url = '/contractattachment/listByContractId';

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * @var string
     */
    protected $type = 'query';

    /**
     * @var integer
     */
    protected $contractId;

    /**
     * ContractSellerOtp constructor.
     *
     * @param string $id
     */
    public function __construct($id)
    {
        $this->contractId = $id;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return array_merge(parent::getData(), [
            'contractId' => $this->contractId,
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
