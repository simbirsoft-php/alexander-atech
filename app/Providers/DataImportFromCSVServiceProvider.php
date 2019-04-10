<?php

namespace App\Providers;

use App\Contracts\DataImportFromCSV;
use App\Services\DataImportFromCSVService;
use Illuminate\Support\ServiceProvider;

class DataImportFromCSVServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(DataImportFromCSV::class, function () {
            return new DataImportFromCSVService();
        });
    }
}
