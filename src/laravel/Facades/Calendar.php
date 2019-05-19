<?php

namespace Mkato\Library\Calendar\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class Calendar extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'calendar';
    }
}