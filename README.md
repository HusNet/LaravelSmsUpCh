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
    $message->text($this->text);
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
    try {
        $phone_owner->notify(new ClientNotification($message_text));
    }
    catch (\Exception $e) {
        session()->flash('error', __('Error: SMS API Timeout'));
    }
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

        // flashing to session
        session()->flash('message.to', $message->getTo());
        session()->flash('message.text', $message->getText());

        session()->flash('response.status', $response->getStatus());
        session()->flash('response.message', $response->getMessage());
        session()->flash('response.credits', $response->getCredits());
        session()->flash('response.invalid', $response->getInvalid());

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
