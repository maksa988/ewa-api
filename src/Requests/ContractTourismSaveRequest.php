<?php

namespace Maksa988\EwaAPI\Requests;

class ContractTourismSaveRequest extends Request
{
    /**
     * @var string
     */
    protected $url = '/contract/save';

    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * @var string
     */
    protected $type = 'json';

    /**
     * @var array
     */
    protected $tariff;

    /**
     * @var string
     */
    protected $number;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @var \DateTime
     */
    protected $startDate;

    /**
     * @var array
     */
    protected $customer;

    /**
     * @var string
     */
    protected $state = 'DRAFT';

    /**
     * @var mixed
     */
    protected $bonusMalus;

    /**
     * @var array
     */
    protected $insuranceObjects = [];

    /**
     * @var bool
     */
    protected $multiObject = true;

    /**
     * @var int
     */
    protected $days;

    /**
     * @var int
     */
    protected $country;

    /**
     * @var array
     */
    protected $risks;

    /**
     * @var array
     */
    protected $customFields;

    /**
     * ContractSaveRequest constructor.
     * @param string $tariff_id
     * @param string $tariff_type
     * @param string $number
     * @param integer $days
     * @param \DateTime $date
     * @param \DateTime $startDate
     * @param string $tax_number
     * @param string $first_name
     * @param string $last_name
     * @param string $address
     * @param string $phone
     * @param \DateTime $birthDate
     * @param string $documentType
     * @param string $documentSeries
     * @param string $documentNumber
     * @param \DateTime $documentDate
     * @param string $documentIssued
     * @param integer $country
     * @param bool $multiObject
     * @param array $customFields
     * @param array $insuranceObjects
     * @param array $risks
     * @param string $state
     * @param int $bonusMalus
     */
    public function __construct($tariff_id, $tariff_type, $number, $days, \DateTime $date, \DateTime $startDate,
                                $tax_number, $first_name, $last_name, $address, $phone, \DateTime $birthDate,
                                $documentType, $documentSeries, $documentNumber, \DateTime $documentDate,
                                $documentIssued, $country, $multiObject = true, $customFields = [],
                                $insuranceObjects = [], $risks = [], $state = 'DRAFT', $bonusMalus = 1)
    {
        $this->tariff = [
            'type' => $tariff_type,
            'id' => $tariff_id
        ];
        $this->number = $number;
        $this->date = $date;
        $this->startDate = $startDate;
        $this->state = $state;
        $this->bonusMalus = $bonusMalus;
        $this->insuranceObjects = $insuranceObjects;
        $this->days = $days;
        $this->country = $country;
        $this->multiObject = $multiObject;
        $this->risks = $risks;
        $this->customFields = $customFields;

        $this->customer = [
            'code' => $tax_number,
            'nameLast' => $last_name,
            'nameFirst' => $first_name,
            'address' => $address,
            'phone' => $phone,
            'birthDate' => $birthDate->format('Y-m-d'),
            'document' => [
                'type' => $documentType,
                'series' => $documentSeries,
                'number' => $documentNumber,
                'date' => $documentDate->format('Y-m-d'),
                'issuedBy' => $documentIssued,
            ],
        ];
    }

    /**
     * @return array
     */
    public function getData()
    {
        return array_merge(parent::getData(), [
            'type' => 'tourism',
            'salePoint' => [
                'id' => config('services.ewa.salePoint'),
                'company' => [
                    'type' => 'broker',
                    'id' => 2,
                ],
            ],
            'user' => [
                'id' => config('services.ewa.user_id'),
            ],
            'tariff' => $this->tariff,
            'number' => $this->number,
            'date' => $this->date->format('Y-m-d'),
            'dateFrom' => $this->startDate->format("Y-m-d\TH:i:s.v+0000"),
            "coverageDays" => $this->days,
            'customer' => $this->customer,
            'insuranceObjects' => $this->insuranceObjects,
            'multiObject' => $this->multiObject,
            'state' => $this->state,
            'customFields' => $this->customFields,
            'bonusMalus' => 1,
            'country' => [
                'id' => $this->country
            ],
            'risks' => $this->risks,
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
