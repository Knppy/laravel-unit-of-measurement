<?php

use Knppy\UnitOfMeasurement\Measurement;
use Knppy\UnitOfMeasurement\Unit;

it('can convert from base value', function () {
    $this->assertEquals(1000, Unit::gram()->fromBaseValue(1));
});

it('can be convert to another unit', function () {
    $this->assertEquals(Unit::gram(1000), Unit::kilogram()->to('gram'));
    $this->assertEquals(Unit::gram(1000), Unit::kilogram()->to(Unit::gram()));
    $this->assertEquals(Unit::gram(1000), Unit::kilogram()->to(Measurement::gram()));
});

it('can convert to base value', function () {
    $this->assertEquals(1, Unit::kilogram()->toBaseValue());
});

it('can conver to base unit', function () {
    $this->assertEquals(Unit::kilogram(1), Unit::kilogram()->toBaseUnit());
    $this->assertEquals(Unit::kilogram(), Unit::kilogram()->toBaseUnit());
});
