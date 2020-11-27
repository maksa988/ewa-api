<?php

namespace Maksa988\EwaAPI\Requests;

class ContractDgoRequest extends Request
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
     * @var array
     */
    protected $insuranceObject = [];

    /**
     * @var mixed
     */
    protected $limit;

    /**
     * @var array
     */
    protected $customFields;

    /**
     * ContractSaveRequest constructor.
     * @param string $tariff_id
     * @param string $tariff_type
     * @param $limit
     * @param \DateTime $date
     * @param \DateTime $startDate
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
     * @param $customFields
     * @param string $state
     */
    public function __construct($tariff_id, $tariff_type, $limit, \DateTime $date, \DateTime $startDate, $tax_number, $first_name, $middle_name, $last_name,
                                $address, $phone, $email, \DateTime $birthDate, $documentType, $documentSeries, $documentNumber, $documentRecord,
                                \DateTime $documentDate, $documentIssued, $insuranceObject, $customFields, $state = 'DRAFT')
    {
        $this->tariff = [
            'type' => $tariff_type,
            'id' => $tariff_id
        ];
        $this->date = $date;
        $this->startDate = $startDate;
        $this->state = $state;
        $this->insuranceObject = $insuranceObject;
        $this->limit = $limit;
        $this->customFields = $customFields;
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
            'type' => 'vcl',
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
            'date' => $this->date->format('Y-m-d'),
            'dateFrom' => $this->startDate->format("Y-m-d\TH:i:s.vO"),
            'customer' => $this->customer,
            'insuranceObject' => $this->insuranceObject,
            'state' => $this->state,
            'customFields' => [$this->customFields],
            'limit' => $this->limit
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
