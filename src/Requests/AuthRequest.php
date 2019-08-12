<?php

namespace Maksa988\EwaAPI\Requests;

class AuthRequest extends Request
{
    /**
     * @var string
     */
    protected $url = '/user/login';

    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $password;

    /**
     * AuthRequest constructor.
     *
     * @param string $login
     * @param string $password
     */
    public function __construct($login, $password)
    {
        parent::__construct();

        $this->login = $login;
        $this->password = $password;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return array_merge(parent::getHeaders(), [
            'content-type' => 'application/x-www-form-urlencoded',
        ]);
    }

    /**
     * @return array
     */
    public function getData()
    {
        return array_merge(parent::getData(), [
            'email' => $this->login,
            'password' => sha1($this->password),
        ]);
    }
}