<?php

namespace Maksa988\EwaAPI\Exceptions;

use Exception as BaseException;
use Maksa988\EwaAPI\Requests\Request;
use Psr\Http\Message\ResponseInterface;

class Exception extends BaseException
{
    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var Request
     */
    protected $request;

    /**
     * Exception constructor.
     *
     * @param ResponseInterface $response
     * @param Request $request
     * @param null $message
     */
    public function __construct(ResponseInterface $response, Request $request, $message = null)
    {
        $error = \GuzzleHttp\json_decode((string) $response->getBody(), true);

        $message = 'EwaAPI: ' . ($error['message'] ?? $message);

        $this->response = $response;
        $this->request = $request;

        parent::__construct($message, $response->getStatusCode());
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }
}
