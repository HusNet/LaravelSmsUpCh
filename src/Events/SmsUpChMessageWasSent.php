<?php

namespace Husnet\LaravelSmsUpCh\Events;

use Husnet\LaravelSmsUpCh\SmsUpChMessage;
use Husnet\LaravelSmsUpCh\SmsUpChResponse;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class SmsUpChMessageWasSent
 * @package Husnet\LaravelSmsUpCh\Events
 */
class SmsUpChMessageWasSent
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

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