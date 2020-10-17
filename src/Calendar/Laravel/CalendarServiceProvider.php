<?php

namespace Mkato\Library\Calendar\Laravel;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Mkato\Library\Calendar\Services\CalendarManagers\CalendarManager;
use Mkato\Library\Calendar\Services\CalendarManagers\GoogleCalendarManager;

class CalendarServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerCalendar();
    }

    /**
     * register for library-calendar
     *
     * @return void
     */
    private function registerCalendar()
    {
        $this->app->singleton(
            CalendarManager::class,
            GoogleCalendarManager::class
        );
    }
}
