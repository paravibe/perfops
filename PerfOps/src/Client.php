<?php

/**
 * Client class.
 */

namespace paravibe\PerfOps;

class Client implements ClientInterface
{
    protected $token;

    public function setToken(String $token)
    {
        $this->token = $token;
    }

    public function getToken()
    {
        return $this->token;
    }
}
