<?php

namespace Maksa988\EwaAPI\Requests;

use Maksa988\EwaAPI\Types\CustomerCategory;

class CalculateTourismRequest extends Request
{
    /**
     * @var string
     */
    protected $url = '/tariff/choose/tourism';

    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * @var string
     */
    protected $type = 'json';

    /**
     * @var bool
     */
    protected $multivisa = false;

    /**
     * @var \DateTime
     */
    protected $coverageFrom;

    /**
     * @var \DateTime
     */
    protected $coverageTo;

    /**
     * @var integer
     */
    protected $coverageDays;

    /**
     * @var integer
     */
    protected $country;

    /**
     * @var array
     */
    protected $risks = [];

    /**
     * @var array
     */
    protected $birthdays = [];

    /**
     * @var integer
     */
    protected $salePoint;

    /**
     * @var string
     */
    protected $customerCategory;

    /**
     * @var bool
     */
    protected $simplified = false;

    /**
     * @var null
     */
    protected $tripPurpose = null;

    /**
     * CalculateTourismRequest constructor.
     *
     * @param integer $salePoint
     * @param boolean $multivisa
     * @param \DateTime $coverageFrom
     * @param \DateTime $coverageTo
     * @param integer $coverageDays
     * @param integer $country
     * @param string $customerCategory
     * @param array $birthdays
     * @param array $risks
     * @param bool $simplified
     * @param null $tripPurpose
     */
    public function __construct($salePoint, $multivisa, \DateTime $coverageFrom, \DateTime $coverageTo,
                                $coverageDays, $country, $customerCategory = CustomerCategory::NATURAL,
                                $birthdays = [], $risks = [], $simplified = false, $tripPurpose = null)
    {
        parent::__construct();

        $this->salePoint = $salePoint;
        $this->customerCategory = $customerCategory;
        $this->multivisa = $multivisa;
        $this->coverageFrom = $coverageFrom;
        $this->coverageTo = $coverageTo;
        $this->coverageDays = $coverageDays;
        $this->country = $country;
        $this->birthdays = $birthdays;
        $this->risks = $risks;
        $this->simplified = $simplified;
        $this->tripPurpose = $tripPurpose;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return array_merge(parent::getData(), [
            'salePoint' => $this->salePoint,
            'customerCategory' => $this->customerCategory,
            'multivisa' => (boolean) $this->multivisa,
            'coverageFrom' => $this->coverageFrom->format('Y-m-d'),
            'coverageTo' => $this->coverageTo->format('Y-m-d'),
            'coverageDays' => $this->coverageDays,
            'country' => $this->country,
            'risks' => $this->risks,
            'birthDays' => $this->birthdays,
            'simplified' => $this->simplified,
            'tripPurpose' => $this->tripPurpose,
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
