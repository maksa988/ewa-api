<?php

namespace Maksa988\EwaAPI\Requests;

use Illuminate\Support\Str;

class ContractSellerOtp extends Request
{
    /**
     * @var string
     */
    protected $url = '/contract/{id}/sellerOtp';

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * @var string
     */
    protected $type = 'query';

    /**
     * @var string
     */
    protected $signerPassword;

    /**
     * @var string
     */
    protected $customerPassword;

    /**
     * @var \DateTime
     */
    private $dateTime;

    /**
     * ContractSellerOtp constructor.
     *
     * @param string $id
     * @param string $signerPassword
     * @param string $customerPassword
     *
     * @param \DateTime $dateTime
     */
    public function __construct($id, $signerPassword, $customerPassword, \DateTime $dateTime)
    {
        $url = Str::replaceFirst('{id}', $id, $this->url);

        $this->setUrl($url);

        $this->signerPassword = $signerPassword;
        $this->customerPassword = $customerPassword;
        $this->dateTime = $dateTime;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return array_merge(parent::getData(), [
            'signer' => $this->signerPassword,
            'customer' => $this->customerPassword,
            'customerOtpDate' => $this->dateTime->format("Y-m-d\TH:i:s.v+0000"),
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
