<?php

namespace Knppy\UnitOfMeasurement;

use Illuminate\Database\Schema\Blueprint;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class UnitOfMeasurementServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-unit-of-measurement')
            ->hasConfigFile();
    }

    public function packageRegistered(): void
    {
        Blueprint::macro('unit', function (string $column) {
            return $this->json($column);
        });
    }
}
