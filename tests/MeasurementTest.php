<?php

use Knppy\UnitOfMeasurement\Enums\MeasurementType;
use Knppy\UnitOfMeasurement\Measurement;

it('can be constructed by name', function () {
    $measurement = new Measurement('gram');

    $this->assertInstanceOf(Measurement::class, $measurement);
});

it('can be constructed by symbol', function () {
    $measurement = new Measurement('g');

    $this->assertInstanceOf(Measurement::class, $measurement);
});

it('has getters', function () {
    $measurement = new Measurement('g');

    $this->assertNull($measurement->getBaseMeasurement());
    $this->assertEquals(MeasurementType::MASS, $measurement->getType());
    $this->assertEquals('gram', $measurement->getName());
    $this->assertEquals('g', $measurement->getSymbol());
    $this->assertEquals(1, $measurement->getFactor());
});

it('throws and error if the measurement is invalid', function () {
    new Measurement('unknown');
})->expectException(OutOfBoundsException::class);
