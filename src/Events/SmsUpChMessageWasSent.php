<?php

namespace Husnet\LaravelSmsUpCh\Events;

use Husnet\LaravelSmsUpCh\SmsUpChMessage;
use Husnet\LaravelSmsUpCh\SmsUpChResponse;

/**
 * Class SmsUpChMessageWasSent
 * @package Husnet\LaravelSmsUpCh\Events
 */
class SmsUpChMessageWasSent
{
    /**
     * @var SmsUpChMessage
     */
    public $message;

    /**
     * @var SmsUpChResponse
     */
    public $response;

    /**
     * SmsUpMessageWasSent constructor.
     * @param SmsUpChMessage $message
     * @param SmsUpChResponse $response
     */
    public function __construct(SmsUpChMessage $message, SmsUpChResponse $response)
    {
        $this->message = $message;
        $this->response = $response;
    }
}