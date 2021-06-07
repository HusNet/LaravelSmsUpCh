<?php

namespace Husnet\LaravelSmsUpCh\Exceptions;

/**
 * Class CouldNotSendNotification
 * @package Husnet\LaravelSmsUpCh\Exceptions
 */
class CouldNotSendNotification extends \Exception
{
    /**
     * Get a new could not send notification exception with
     * missing recipient message.
     *
     * @return static
     */
    public static function missingRecipient()
    {
        $message = 'The recipient of the sms message is missing.';
        return new static($message);
    }
}