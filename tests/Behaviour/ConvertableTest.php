<?php

use Knppy\UnitOfMeasurement\Measurement;
use Knppy\UnitOfMeasurement\Unit;

it('can convert from base value', function () {
    $this->assertEquals(1000, Unit::gram()->fromBaseValue(1));
});

it('can convert from base value with pre and post addition', function () {
    // Round them to prevent a lot of decimals
    $this->assertEquals(1, round(Unit::romer()->fromBaseValue(260.769047619048)));
});

it('can be convert to another unit', function () {
    $this->assertEquals(Unit::gram(1000), Unit::kilogram()->to('gram'));
    $this->assertEquals(Unit::gram(1000), Unit::kilogram()->to(Unit::gram()));
    $this->assertEquals(Unit::gram(1000), Unit::kilogram()->to(Measurement::gram()));
});

it('can convert to base value', function () {
    $this->assertEquals(1, Unit::kilogram()->toBaseValue());
});

it('can convert to base unit', function () {
    $this->assertEquals(Unit::kilogram(), Unit::gram(1000)->toBaseUnit());
    $this->assertEquals(Unit::kilogram(), Unit::kilogram()->toBaseUnit());
});

it('can convert to base unit with pre and post addition', function () {
    $this->assertEquals(260.76904761904757, Unit::romer()->toBaseValue());
});
