<?php

use Knppy\UnitOfMeasurement\Casts\MeasurementCast;
use Knppy\UnitOfMeasurement\Enums\MeasurementType;
use Knppy\UnitOfMeasurement\Measurement;

it('can be casted', function () {
    $this->assertSame(MeasurementCast::class, Measurement::castUsing([]));
});

it('can be constructed by name', function () {
    $measurement = new Measurement('gram');

    $this->assertInstanceOf(Measurement::class, $measurement);
});

it('can be constructed by symbol', function () {
    $measurement = new Measurement('g');

    $this->assertInstanceOf(Measurement::class, $measurement);
});

it('can be converted to array', function () {
    $measurement = new Measurement('g');

    $this->assertIsArray($measurement->toArray());
});

it('can be converted to json', function () {
    $measurement = new Measurement('g');

    $this->assertJson($measurement->toJson());
    $this->assertJson(json_encode($measurement));
});

it('can be converted to string', function () {
    $measurement = new Measurement('g');

    $this->assertIsString((string) $measurement);
    $this->assertIsString($measurement->render());
});

it('equals another measurement', function () {
    $measurement = new Measurement('g');
    $measurement2 = new Measurement('kg');

    $this->assertTrue($measurement->equals(new Measurement('g')));
    $this->assertFalse($measurement2->equals(new Measurement('g')));
});

it('equals another measurements type', function () {
    $measurement = new Measurement('g');
    $measurement2 = new Measurement('kg');
    $measurement3 = new Measurement('m3');

    $this->assertTrue($measurement->equalsType($measurement2));
    $this->assertFalse($measurement->equalsType($measurement3));
});

it('has factory methods', function () {
    $this->assertEquals(Measurement::gram(), new Measurement('gram'));
    $this->assertEquals(Measurement::kilogram(), new Measurement('kilogram'));
});

it('has getters', function () {
    $measurement = new Measurement('g');

    $this->assertNull($measurement->getBaseMeasurement());
    $this->assertEquals(MeasurementType::MASS, $measurement->getType());
    $this->assertEquals('gram', $measurement->getName());
    $this->assertEquals('g', $measurement->getSymbol());
    $this->assertEquals(1, $measurement->getFactor());
});

it('has macros', function () {
    Measurement::macro('testMacro', fn () => Measurement::gram());

    $this->assertEquals(Measurement::gram(), Measurement::testMacro());
});

it('throws and error if the measurement is invalid', function () {
    new Measurement('unknown');
})->expectException(OutOfBoundsException::class);
