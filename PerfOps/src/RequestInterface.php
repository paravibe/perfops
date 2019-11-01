<?php

/**
 * Request interface.
 */

namespace paravibe\PerfOps;

interface RequestInterface
{
    const BASE_URL = 'https://api.perfops.net';

    public function request(String $path);
}
