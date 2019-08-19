<?php

namespace Maksa988\EwaAPI\Requests;

class ContractSaveRequest extends Request
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
     * @var boolean
     */
    protected $drivingExpLessThreeYears;

    /**
     * @var array
     */
    protected $insuranceObject = [];

    /**
     * ContractSaveRequest constructor.
     * @param string $tariff_id
     * @param string $tariff_type
     * @param string $number
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
     * @param array $insuranceObject
     * @param bool $drivingExpLessThreeYears
     * @param string $state
     * @param int $bonusMalus
     */
    public function __construct($tariff_id, $tariff_type, $number, \DateTime $date, \DateTime $startDate,
                                $tax_number, $first_name, $last_name, $address, $phone, \DateTime $birthDate,
                                $documentType, $documentSeries, $documentNumber, \DateTime $documentDate,
                                $documentIssued, $insuranceObject, $drivingExpLessThreeYears = true, $state = 'DRAFT', $bonusMalus = 1)
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
        $this->drivingExpLessThreeYears = $drivingExpLessThreeYears;
        $this->insuranceObject = $insuranceObject;

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
            'type' => 'epolicy',
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
            'customer' => $this->customer,
            'insuranceObject' => $this->insuranceObject,
            'state' => $this->state,
            'bonusMalus' => 1,
            'drivingExpLessThreeYears' => $this->drivingExpLessThreeYears,
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