<?php

namespace App\Providers;

use App\Contracts\DataImport;
use App\Contracts\DataImportFromCSV;
use App\Services\DataImportService;
use Illuminate\Support\ServiceProvider;

class DataImportServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(DataImport::class, function () {
            return new DataImportService([
            	'csv' => app()->make(DataImportFromCSV::class)
            ]);
        });
    }
}
