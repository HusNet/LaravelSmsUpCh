# SmsUp.ch API Integration for Laravel 8+

## Installation

### Install Package
You can install this package via composer:
```bash
composer require husnet/laravel-smsupch
```

## Configuration
Add your SmsUp API key to your `config/services.php` file:
```php
return [   
    ...
    ...
    'smsUpCh' => [
         'token' => env('SMSUPCH_TOKEN'),
         'simulate' => env('SMSUPCH_SIMULATE'), // true or false
         'sender' => env('SMSUPCH_SENDER_NAME', config('app.name')),
    ]
    ...
];
```
Set `simulate` to `true` if you want to simulate submitting messages, it's perfect for testing and debugging, it has no cost.

## Usage

### Using Laravel Notification
Use artisan to create a notification:
```bash
php artisan make:notification someNotification
```
Return `[smsUpCh]` in the `public function via($notifiable)` method of your notification:
```php
public function via($notifiable)
{
    return ['smsUpCh'];
}
```
Add the method `public function toSmsUp($notifiable)` to your notification, and return an instance of `SmsUpChMessage`:
```php
use Husnet\LaravelSmsUpCh\SmsUpChMessage;
...
public function toSmsUpCh($notifiable)
{
    $message = new SmsUpChMessage();
    $message->to('41xxxxxxxxx') 
        ->from('Foo')
        ->text('Text of the SMS');

    return $message;
}
```
If you don't indicate the parameter `to`, make sure your notifiable entity has `routeNotificationForSmsUpCh` method defined:
```php
/**
 * Route notifications for the SmsUp channel.
 *
 * @return string
 */
public function routeNotificationForSmsUpCh(): string
{
    return $this->phone;
}
```
### Using SmsUp Facade

#### Send messages
```php
use Husnet\LaravelSmsUpCh\SmsUpChMessage;
use Husnet\LaravelSmsUpCh\Facades\SmsUpCh;
...
$message1 = new SmsUpChMessage();
$message1->to('41xxxxxxxxx') 
    ->from('Foo')
    ->text('Text of the SMS');
$message2 = new SmsUpChMessage();
$message2->to('41xxxxxxxxx') 
    ->from('Foo')
    ->text('Text of the SMS');
$messages = [
    $message1->formatData(),
    $message2->formatData()
];
SmsUpCh::sendMessages($messages);
```

## Available Events
LaravelSmsUp comes with handy events which provides the required information about the SMS messages.

### Messages Was Sent
Triggered when one or more messages are sent.

Example:
```php
use Husnet\LaravelSmsUpCh\Events\SmsUpChMessageWasSent;

class SmsUpMessageSentListener
{
    /**
     * Handle the event.
     *
     * @param  SmsUpChMessageWasSent  $event
     * @return void
     */
    public function handle(SmsUpChMessageWasSent $event)
    {
        $response = $event->response; // Class SmsUpResponse
        $message = $event->message; // Class SmsUpMessage

        if ($response->getStatus() != 'ok') {
            $yourModel = YourModel::find($message->getCustom());
            $yourModel->sms_status = $response->getStatus();
            $yourModel->sms_error_id = $response->getErrorId();
            $yourModel->sms_error_msg = $response->getErrorMsg();
            $yourModel->save();
        } else {
            foreach ($response->getResult() as $responseMessage) { // class SmsUpResponseMessage
                $yourModel = YourModel::find($responseMessage->getCustom());
                $yourModel->sms_status = $responseMessage->getStatus();
                $yourModel->sms_id = $responseMessage->getSmsId();
                $yourModel->sms_error_id = $responseMessage->getErrorId();
                $yourModel->sms_error_msg = $responseMessage->getErrorMsg();
                $yourModel->save();
            }
        }
    }
}
```
In your `EventServiceProvider`:
````php
protected $listen = [
        ...
        'Husnet\LaravelSmsUpCh\Events\SmsUpChMessageWasSent' => [
            'App\Listeners\SmsUpChMessageSentListener',
        ],
    ];
````


## SmsUp.ch API Documentation
Visit [SmsUp.ch API Documentation](https://doc.smsup.ch/) for more information.

## Support
Feel free to post your issues in the issues section.

## Credits
- [Gaétan Huser](https://github.com/husnet)
- [All Contributors](../../contributors)


- [Inspired by Squareetlabs/LaravelSmsUp](https://github.com/squareetlabs/LaravelSmsUp)

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
