<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 注册模板组件别名
        Blade::component('home.grid-components.aquarius', 'aquarius');
        Blade::component('home.grid-components.aries', 'aries');
        Blade::component('home.grid-components.cancer', 'cancer');
        Blade::component('home.grid-components.capricorn', 'capricorn');
        Blade::component('home.grid-components.gemini', 'gemini');
        Blade::component('home.grid-components.leo', 'leo');
        Blade::component('home.grid-components.libra', 'libra');
        Blade::component('home.grid-components.pisces', 'pisces');
        Blade::component('home.grid-components.sagittarius', 'sagittarius');
        Blade::component('home.grid-components.scorpio', 'scorpio');
        Blade::component('home.grid-components.taurus', 'taurus');
        Blade::component('home.grid-components.virgo', 'virgo');
    }
}
