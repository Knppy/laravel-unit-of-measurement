<?php

namespace Knppy\UnitOfMeasurement;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Knppy\UnitOfMeasurement\Commands\UnitOfMeasurementCommand;

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
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_unit_of_measurement_table')
            ->hasCommand(UnitOfMeasurementCommand::class);
    }
}
