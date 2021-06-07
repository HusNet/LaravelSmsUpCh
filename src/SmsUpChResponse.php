<?php

namespace Husnet\LaravelSmsUpCh;

/**
 * Class SmsUpChResponse
 * @package Husnet\LaravelSmsUpCh
 */
class SmsUpChResponse
{
    /**
     * @var string
     */
    private $status;

    /**
     * @var array
     */
    private $result;

    /**
     * @var string
     */
    private $errorId;

    /**
     * @var string
     */
    private $errorMsg;

    public function __construct(array $response)
    {
        $this->status = $response['status'];
        $this->errorId = $response['error_id'] ?? '';
        $this->errorMsg = $response['error_msg'] ?? '';
        if (isset($response['result'])) {
          foreach ($response['result'] as $responseMessage) {
            if (array_key_exists('status', $response)) {
                $this->result[] = new SmsUpChResponseMessage($responseMessage);
            }
          }
        }
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return string|null
     */
    public function getErrorId()
    {
        return $this->errorId;
    }

    /**
     * @return string|null
     */
    public function getErrorMsg()
    {
        return $this->errorMsg;
    }
}