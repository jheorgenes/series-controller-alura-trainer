<?php

namespace App\Providers;

use App\Repositories\EloquentSeriesRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Support\ServiceProvider;

class SeriesRepositoryProvider extends ServiceProvider
{

    public array $bindings = [
        // Realizando um bind para que SeriesRepository seja um alias para EloquentSeriesRepository
        SeriesRepository::class => EloquentSeriesRepository::class
    ];

    // /**
    //  * Register services.
    //  *
    //  * @return void
    //  */
    // public function register()
    // {
    //     // Realizando um bind para que SeriesRepository seja um alias para EloquentSeriesRepository
    //     $this->app->bind(SeriesRepository::class, EloquentSeriesRepository::class);
    // }

    // /**
    //  * Bootstrap services.
    //  *
    //  * @return void
    //  */
    // public function boot()
    // {
    //     //
    // }
}
