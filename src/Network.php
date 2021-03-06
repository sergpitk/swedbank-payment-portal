<?php

namespace SwedbankPaymentPortal;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

/**
 * Manages xml and guzzle.
 */
class Network
{
    /**
     * @var Client
     */
    private $guzzleClient;

    /**
     * Network constructor.
     */
    public function __construct()
    {
        $this->guzzleClient = new Client();
    }

    /**
     * Sends request with the given data to the given endpoint.
     *
     * @param string $endpoint
     * @param string $data
     *
     * @return Response
     */
    public function sendRequest($endpoint, $data)
    {
        return $this->guzzleClient->post($endpoint, ['body' => $data]);
    }
}
