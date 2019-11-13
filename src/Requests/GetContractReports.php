<?php

namespace Maksa988\EwaAPI\Requests;

class GetContractReports extends Request
{
    /**
     * @var string
     */
    protected $url = '/contract/reports';

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
    protected $id;

    /**
     * @var string
     */
    protected $code;

    /**
     * ContractSellerOtp constructor.
     *
     * @param integer $id
     * @param string $code
     */
    public function __construct($id, $code)
    {
        $this->id = $id;
        $this->code = $code;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return array_merge(parent::getData(), [
            'id' => $this->id,
            'code' => $this->code,
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
