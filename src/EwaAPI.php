<?php

namespace Maksa988\EwaAPI;

use GuzzleHttp\Client;
use Maksa988\EwaAPI\Requests\AuthRequest;
use Maksa988\EwaAPI\Requests\Request;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\ClientException;
use Maksa988\EwaAPI\Exceptions\Exception;

class EwaAPI
{
    /**
     * @var string
     */
    const VERSION = '9';

    /**
     * @var string
     */
    const API_URL = 'https://web.ewa.ua/ewa/api/v';

    /**
     * @var string
     */
    const TEST_API_URL = 'https://demo.ewa.ua/ewa/api/v';

    /**
     * @var bool
     */
    protected $testMode = false;

    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $client;

    /**
     * @var string
     */
    protected $sessionId;

    /**
     * @var
     */
    protected $salePoint;

    /**
     * PolisAPI constructor.
     *
     * @param string $login
     * @param string $password
     * @param bool $testMode
     * @throws Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function __construct($login, $password, $testMode = false)
    {
        $this->login = $login;
        $this->password = $password;

        $this->testMode = $testMode;

        $this->client = new Client;

        $this->auth();
    }

    /**
     * @throws Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function auth()
    {
        $request = new AuthRequest($this->login, $this->password);

        $auth = $this->request($request);

        if(isset($auth['sessionId'])) {
            $this->sessionId = $auth['sessionId'];
            $this->salePoint = $auth['user']['salePoint']['id'];
        } else {
            throw new Exception($auth, $request, 'Authorization problem');
        }
    }

    /**
     * @param Request $request
     *
     * @return array|\Psr\Http\Message\StreamInterface
     *
     * @throws Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(Request $request)
    {
        $response = null;

        try {
            $response = $this->client->request($request->getMethod(),$this->getAPIUrl() . $request->getUrl(), [
                'cookies' => $request->getCookies($this->getApiDomain(), $this->sessionId),
                'headers' => $request->getHeaders(),
                $request->getType() => $request->getData(),
            ]);
        } catch (ClientException  $e) {
            $this->throwError($e, $request);
        }

        if(! $request->isFile()) {
            return $this->decodeResponse($response);
        }

        return $response->getBody();
    }

    /**
     * @return mixed
     */
    public function getSalePoint()
    {
        return $this->salePoint;
    }

    /**
     * @return string|null
     */
    public function getApiDomain()
    {
        if($this->testMode) {
            $parse = parse_url(self::TEST_API_URL);
        } else {
            $parse = parse_url(self::API_URL);
        }

        return $parse['host'] ?? null;
    }

    /**
     * @return string
     */
    public function getAPIUrl()
    {
        if($this->testMode) {
            return self::TEST_API_URL . self::VERSION;
        }

        return self::API_URL . self::VERSION;
    }

    /**
     * @return $this
     */
    public function enableTestMode()
    {
        $this->testMode = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function disableTestMode()
    {
        $this->testMode = false;

        return $this;
    }

    /**
     * @param ClientException $e
     *
     * @param Request $request
     * @throws Exception
     */
    protected function throwError(ClientException $e, Request $request)
    {
        $error = $this->decodeResponse($e->getResponse());

        //

        throw new Exception($e->getResponse(), $request);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return array
     */
    protected function decodeResponse(ResponseInterface $response)
    {
        return \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
    }
}
