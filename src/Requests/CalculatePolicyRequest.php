<?php

namespace Maksa988\EwaAPI\Requests;

use Maksa988\EwaAPI\Types\CustomerCategory;
use Maksa988\EwaAPI\Types\RegistrationType;

class CalculatePolicyRequest extends Request
{
    /**
     * @var string
     */
    protected $url = '/tariff/choose/policy';

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * @var string
     */
    protected $customerCategory;

    /**
     * @var string
     */
    protected $franchise;

    /**
     * @var bool
     */
    protected $taxi;

    /**
     * @var string
     */
    protected $autoCategory;

    /**
     * @var string
     */
    protected $registrationPlace;

    /**
     * @var bool
     */
    protected $outsideUkraine;

    /**
     * @var string
     */
    protected $registrationType;

    /**
     * @var \DateTime|null
     */
    protected $otkDate;

    /**
     * @var \DateTime
     */
    protected $dateFrom;

    /**
     * @var \DateTime
     */
    protected $dateTo;

    /**
     * @var integer
     */
    protected $usageMonths;

    /**
     * @var bool
     */
    protected $driveExp;

    /**
     * @var integer
     */
    protected $salePoint;

    /**
     * CalculatePolicyRequest constructor.
     *
     * @param $salePoint
     * @param $franchise
     * @param $autoCategory
     * @param $registrationPlace
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param $usageMonths
     * @param string $customerCategory
     * @param bool $taxi
     * @param bool $outsideUkraine
     * @param string $registrationType
     * @param \DateTime|null $otkDate
     * @param bool $driveExp
     */
    public function __construct($salePoint, $franchise, $autoCategory, $registrationPlace,
                                \DateTime $dateFrom, \DateTime $dateTo, $usageMonths,
                                $customerCategory = CustomerCategory::NATURAL, $taxi = false, $outsideUkraine = false,
                                $registrationType = RegistrationType::PERMANENT_WITHOUT_OTK, \DateTime $otkDate = null,
                                $driveExp = false)
    {
        parent::__construct();

        $this->salePoint = $salePoint;
        $this->customerCategory = $customerCategory;
        $this->franchise = $franchise;
        $this->taxi = $taxi;
        $this->autoCategory = $autoCategory;
        $this->registrationPlace = $registrationPlace;
        $this->outsideUkraine = $outsideUkraine;
        $this->registrationType = $registrationType;
        $this->otkDate = $otkDate;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->usageMonths = $usageMonths;
        $this->driveExp = $driveExp;

        $this->setUrl($this->url . '?' . http_build_query($this->getData()));
    }

    /**
     * @return array
     */
    public function getData()
    {
        return array_merge(parent::getData(), [
            'salePoint' => $this->salePoint,
            'customerCategory' => $this->customerCategory,
            'franchise' => $this->franchise,
            'taxi' => $this->taxi ? 'true' : 'false',
            'autoCategory' => $this->autoCategory,
            'registrationPlace' => $this->registrationPlace,
            'outsideUkraine' => $this->outsideUkraine ? 'true' : 'false',
            'registrationType' => $this->registrationType,
            'otkDate' => is_null($this->otkDate) ? null : $this->otkDate->format('Y-m-d'),
            'dateFrom' => is_null($this->dateFrom) ? null : $this->dateFrom->format('Y-m-d'),
            'dateTo' => is_null($this->dateTo) ? null : $this->dateTo->format('Y-m-d'),
            'usageMonths' => $this->usageMonths,
            'driveExp' => $this->driveExp ? 'true' : 'false',
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