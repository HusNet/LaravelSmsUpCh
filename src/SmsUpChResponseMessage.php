<?php

namespace Husnet\LaravelSmsUpCh;

/**
 * Class SmsUpChResponseMessage
 * @package Husnet\LaravelSmsUpCh
 */
class SmsUpChResponseMessage
{
    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $smsId;

    /**
     * @var string
     */
    private $custom;

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
        $this->smsId = $response['sms_id'];
        $this->custom = $response['custom'] ?? '';
        $this->errorId = $response['error_id'] ?? '';
        $this->errorMsg = $response['error_msg'] ?? '';
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getSmsId()
    {
        return $this->smsId;
    }

    /**
     * @return string|null
     */
    public function getCustom()
    {
        return $this->custom;
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