<?php

namespace Maksa988\EwaAPI\Requests;

use Maksa988\EwaAPI\Types\CustomerCategory;

class CalculateDgoRequest extends Request
{
    /**
     * @var string
     */
    protected $url = '/tariff/choose/vcl';

    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * @var string
     */
    protected $type = 'json';

    /**
     * @var integer
     */
    protected $salePoint;

    /**
     * @var string
     */
    protected $customerCategory;

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
    protected $registrationPlace;

    /**
     * @var boolean
     */
    protected $outsideUkraine;

    /**
     * @var string
     */
    protected $autoKind;

    /**
     * @var integer
     */
    protected $autoKindLimit;

    /**
     * @var integer
     */
    protected $minAmount;

    /**
     * @var integer
     */
    protected $maxAmount;

    /**
     * CalculateDgoRequest constructor.
     *
     * @param $salePoint
     * @param string $customerCategory
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param $registrationPlace
     * @param $outsideUkraine
     * @param $autoKind
     * @param $autoKindLimit
     * @param $minAmount
     * @param $maxAmount
     */
    public function __construct($salePoint, $customerCategory = CustomerCategory::NATURAL, \DateTime $dateFrom, \DateTime $dateTo,
                                $registrationPlace, $outsideUkraine, $autoKind, $autoKindLimit, $minAmount, $maxAmount)
    {
        parent::__construct();

        $this->salePoint = $salePoint;
        $this->customerCategory = $customerCategory;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->registrationPlace = $registrationPlace;
        $this->outsideUkraine = $outsideUkraine;
        $this->autoKind = $autoKind;
        $this->autoKindLimit = $autoKindLimit;
        $this->minAmount = $minAmount;
        $this->maxAmount = $maxAmount;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return array_merge(parent::getData(), [
            'salePoint' => $this->salePoint,
            'customerCategory' => $this->customerCategory,
            'dateFrom' => $this->dateFrom,
            'dateTo' => $this->dateTo,
            'registrationPlace' => $this->registrationPlace,
            'outsideUkraine' => $this->outsideUkraine,
            'autoKind' => $this->autoKind,
            'autoKindLimit' => $this->autoKindLimit,
            'minAmount' => $this->minAmount,
            'maxAmount' => $this->maxAmount
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
