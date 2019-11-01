<?php

/**
 * Request class.
 */

namespace paravibe\PerfOps;

use GuzzleHttp\Client;

class Request implements RequestInterface
{
    private $client;
    protected $requestBody;
    protected $timeout;
    protected $sink;
    protected $method = 'get';

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Creates request.
     */
    public function request(String $path)
    {
        $client = $this->createHttpClient();
        $result = $client->request(
            $this->method,
            $path,
            [
                'body' => $this->requestBody,
                'timeout' => $this->timeout,
                'sink' => $this->sink,
            ]
        );

        return $result;
    }

    /**
     * Sets the timeout limit for the request.
     */
    public function setTimeout(int $timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Sets sink for the request.
     */
    public function setSink(String $path)
    {
        $this->sink = $path;

        return $this;
    }

    /**
     * Attach a body to the request.
     */
    public function attachBody($data)
    {
        $this->method = 'post';
        $this->requestBody = $data;

        if (!is_string($data) || !is_a($data, 'GuzzleHttp\\Psr7\\Stream')) {
            $this->requestBody = json_encode($data);
        } else {
            $this->requestBody = $data;
        }

        return $this;
    }

    /**
     * Creates a new http client.
     */
    protected function createHttpClient()
    {
        $client = new Client(
            [
                'base_uri' => self::BASE_URL,
                'headers' => $this->getDefaultHeaders(),
            ]
        );

        return $client;
    }

    /**
     * Returns default request headers.
     */
    protected function getDefaultHeaders()
    {
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => $this->client->getToken(),
        ];

        return $headers;
    }
}
