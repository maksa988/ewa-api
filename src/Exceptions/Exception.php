<?php

namespace Maksa988\EwaAPI\Exceptions;

use Exception as BaseException;
use Psr\Http\Message\ResponseInterface;

class Exception extends BaseException
{
    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * Exception constructor.
     *
     * @param ResponseInterface $response
     * @param null $message
     */
    public function __construct(ResponseInterface $response, $message = null)
    {
        $error = \GuzzleHttp\json_decode((string) $response->getBody(), true);

        $message = 'EwaAPI: ' . ($error['message'] ?? $message);

        $this->response = $response;

        parent::__construct($message, $response->getStatusCode());
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }
}
