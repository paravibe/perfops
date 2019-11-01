<?php

/**
 * Client interface.
 */

namespace paravibe\PerfOps;

interface ClientInterface
{
    public function setToken(String $token);

    public function getToken();
}
