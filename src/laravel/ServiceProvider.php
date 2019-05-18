<?php

namespace Mkato\Library\Laravel;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // 動作確認用メッセージ
        dump('Hello Laravel!');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}