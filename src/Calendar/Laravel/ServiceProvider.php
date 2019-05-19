<?php

namespace Mkato\Library\Calendar\Laravel;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
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
        $this->app->singleton('calendar', function(Container $app) {
            $request = $app['request'];
            $api_key = $app['config']->get('api.google.key');
            return new Calendar($request, $api_key);
        });
        AliasLoader::getInstance()->alias('Calendar', Facades\Calendar::class);
    }
}