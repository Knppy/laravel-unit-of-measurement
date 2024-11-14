<?php

namespace Knppy\UnitOfMeasurement\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Knppy\UnitOfMeasurement\UnitOfMeasurement
 */
class UnitOfMeasurement extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Knppy\UnitOfMeasurement\UnitOfMeasurement::class;
    }
}
