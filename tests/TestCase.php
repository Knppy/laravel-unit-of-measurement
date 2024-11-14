<?php

namespace Knppy\UnitOfMeasurement\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Knppy\UnitOfMeasurement\UnitOfMeasurementServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Knppy\\UnitOfMeasurement\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            UnitOfMeasurementServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-unit-of-measurement_table.php.stub';
        $migration->up();
        */
    }
}
