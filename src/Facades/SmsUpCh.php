<?php

namespace Husnet\LaravelSmsUpCh\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class SmsUpCh
 * @package Husnet\LaravelSmsUpCh\Facades
 */
class SmsUpCh extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'smsUpCh';
    }
}