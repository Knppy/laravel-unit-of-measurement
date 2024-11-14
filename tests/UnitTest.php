<?php

use Knppy\UnitOfMeasurement\Measurement;
use Knppy\UnitOfMeasurement\Unit;

it('can be constructed', function () {
    $unit = new Unit(1, Measurement::gram());

    $this->assertInstanceOf(Unit::class, $unit);
});

it('has getters', function () {
    $unit = new Unit(1, Measurement::gram());

    $this->assertEquals(Measurement::gram(), $unit->getMeasurement());
    $this->assertEquals(1.0, $unit->getValue());
});
