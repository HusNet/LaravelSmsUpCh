<?php

namespace Husnet\LaravelSmsUpCh;

use Illuminate\Support\Facades\Event;
use Husnet\LaravelSmsUpCh\Events\SmsUpChMessageWasSent;
use Husnet\LaravelSmsUpCh\Exceptions\CouldNotSendNotification;
use Illuminate\Notifications\Notification;
use Husnet\LaravelSmsUpCh\Facades;

/**
 * Class SmsUpChChannel
 * @package Husnet\LaravelSmsUpCh
 */
class SmsUpChChannel
{
    /**
     * SmsUpChannel constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param $notifiable
     * @param Notification $notification
     * @throws CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        /** @var SmsUpChMessage $message */
        $message = $notification->toSmsUpCh($notifiable);

        if (empty($message->getTo())) {
            if (!$to = $notifiable->routeNotificationFor('smsUpCh')) {
                throw CouldNotSendNotification::missingRecipient();
            }
            $message->to($to);
        }

        $message->formatData();

        $response = Facades\SmsUpCh::sendMessage($message);


        $responseArray = json_decode($response->getBody(), true);

        $responseMessage = new SmsUpChResponse($responseArray);

        Event::dispatch(new SmsUpChMessageWasSent($message, $responseMessage));
    }
}
