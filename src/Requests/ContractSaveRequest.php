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
     * @var string|null
     */
    protected $privilegeType;

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
     * @var mixed
     */
    protected $payment;

    /**
     * ContractSaveRequest constructor.
     * @param string $tariff_id
     * @param string $tariff_type
     * @param string $number
     * @param $payment
     * @param \DateTime $date
     * @param \DateTime $startDate
     * @param $privilegeType
     * @param string $tax_number
     * @param string $first_name
     * @param string $middle_name
     * @param string $last_name
     * @param string $address
     * @param string $phone
     * @param $email
     * @param \DateTime $birthDate
     * @param string $documentType
     * @param string|null $documentSeries
     * @param string|null $documentNumber
     * @param string|null $documentRecord
     * @param \DateTime $documentDate
     * @param string $documentIssued
     * @param array $insuranceObject
     * @param bool $drivingExpLessThreeYears
     * @param string $state
     * @param int $bonusMalus
     */
    public function __construct($tariff_id, $tariff_type, $number, $payment, \DateTime $date, \DateTime $startDate, $privilegeType,
                                $tax_number, $first_name, $middle_name, $last_name, $address, $phone, $email, \DateTime $birthDate,
                                $documentType, $documentSeries, $documentNumber, $documentRecord, \DateTime $documentDate,
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
        $this->payment = $payment;

        $this->privilegeType = $privilegeType;
        $this->customer = [
            'code' => $tax_number,
            'nameLast' => $last_name,
            'nameMiddle' => $middle_name,
            'nameFirst' => $first_name,
            'address' => $address,
            'phone' => $phone,
            'email' => $email,
            'birthDate' => $birthDate->format('Y-m-d'),
            'document' => [
                'type' => $documentType,
                'series' => $documentSeries,
                'number' => $documentNumber,
                'record' => $documentRecord,
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
            'dateFrom' => $this->startDate->format("Y-m-d\TH:i:s.v+0300"),
            'privilegeType' => $this->privilegeType,
            'customer' => $this->customer,
            'insuranceObject' => $this->insuranceObject,
            'state' => $this->state,
            'bonusMalus' => 1,
            'drivingExpLessThreeYears' => $this->drivingExpLessThreeYears,
            'payment' => $this->payment,
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
