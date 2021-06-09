<?php

namespace Husnet\LaravelSmsUpCh;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class SmsUp
 * @package Husnet\LaravelSmsUpCh
 */
class SmsUpChManager
{
    /**
     * @const The API URL for SmsUp
     */
    const API_URI = 'api.smsup.ch';

    /**
     * @const The API endpoint to send messages
     */
    const ENDPOINT_SEND = '/send';

    /**
     * @const The API endpoint to send messages
     */
    const ENDPOINT_SIMULATE_SEND = '/send/simulate';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var
     */
    private $config;

    /**
     * SmsUp constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->client = new Client(['timeout' => 15] );
        $this->config = $config;
    }

    /**
     * @param SmsUpChMessage $message
     * @return ResponseInterface
     * @throws Exception|GuzzleException
     */
    public function sendMessage(SmsUpChMessage $message): ResponseInterface
    {
        $token = $this->config['token'];
        $simulate = $this->config['simulate'];

        if ($simulate) {
            $endpoint = self::ENDPOINT_SIMULATE_SEND;
        } else {
            $endpoint = self::ENDPOINT_SEND;
        }
        $params = '?' .
            'text=' . urlencode($message->getText()) . '&' .
            'to=' . $message->getTo() . '&' .
            'sender=' . urlencode($this->config['sender']) . '&' .
            'pushtype=alert';

        try {
            $response = $this->client->get(self::API_URI . $endpoint . $params, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json'
                ],
            ]);
        }
        catch (Exception $e) {
            throw $e;
        }
        finally {
            return $response;
        }
    }

}