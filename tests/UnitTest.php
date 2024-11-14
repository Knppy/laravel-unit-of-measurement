<?php

use Knppy\UnitOfMeasurement\Casts\UnitCast;
use Knppy\UnitOfMeasurement\Measurement;
use Knppy\UnitOfMeasurement\Unit;

it('can be casted', function () {
    $this->assertSame(UnitCast::class, Unit::castUsing([]));
});

it ('can be constructed from expression', function() {
    $unit = Unit::from('1 gram');

    $this->assertEquals(new Unit(1, Measurement::gram()), $unit);
});

it('can be constructed', function () {
    $unit = new Unit(1, Measurement::gram());

    $this->assertInstanceOf(Unit::class, $unit);
});

it('can be converted to array', function () {
    $unit = new Unit(1, Measurement::gram());

    $this->assertIsArray($unit->toArray());
});

it('can be converted to json', function () {
    $unit = new Unit(1, Measurement::gram());

    $this->assertJson($unit->toJson());
    $this->assertJson(json_encode($unit));
});

it('can be converted to string', function () {
    $unit = new Unit(1, Measurement::gram());

    $this->assertIsString((string) $unit);
    $this->assertIsString($unit->render());
});

it('has factory methods', function () {
    $this->assertEquals(Unit::gram(), new Unit(1, new Measurement('gram')));
    $this->assertEquals(Unit::kilogram(), new Unit(1, new Measurement('kilogram')));
});

it('has getters', function () {
    $unit = new Unit(1, Measurement::gram());

    $this->assertEquals(Measurement::gram(), $unit->getMeasurement());
    $this->assertEquals(1.0, $unit->getValue());
});

it('has macros', function () {
    Unit::macro('testMacro', fn () => Unit::gram());

    $this->assertEquals(Unit::gram(), Unit::testMacro());
});
