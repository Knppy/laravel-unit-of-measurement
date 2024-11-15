<?php

use Knppy\UnitOfMeasurement\Measurement;
use Knppy\UnitOfMeasurement\Unit;

it('can compare', function () {
    $unit1 = new Unit(50, new Measurement('gram'));
    $unit2 = new Unit(100, new Measurement('gram'));
    $unit3 = new Unit(200, new Measurement('gram'));

    $this->assertEquals(-1, $unit2->compare($unit3));
    $this->assertEquals(1, $unit2->compare($unit1));
    $this->assertEquals(0, $unit2->compare($unit2));

    $this->assertTrue($unit2->equals($unit2));
    $this->assertFalse($unit3->equals($unit2));

    $this->assertTrue($unit3->greaterThan($unit2));
    $this->assertFalse($unit2->greaterThan($unit3));

    $this->assertTrue($unit2->greaterThanOrEqual($unit2));
    $this->assertFalse($unit2->greaterThanOrEqual($unit3));

    $this->assertTrue($unit2->lessThan($unit3));
    $this->assertFalse($unit3->lessThan($unit2));

    $this->assertTrue($unit2->lessThanOrEqual($unit2));
    $this->assertFalse($unit3->lessThanOrEqual($unit2));
});

it('can determine if a unit is positive, negative or zero', function () {
    $unit1 = new Unit(0, new Measurement('gram'));
    $unit2 = new Unit(-1, new Measurement('gram'));
    $unit3 = new Unit(1, new Measurement('gram'));

    $this->assertTrue($unit1->isZero());
    $this->assertTrue($unit2->isNegative());
    $this->assertTrue($unit3->isPositive());
    $this->assertFalse($unit3->isZero());
    $this->assertFalse($unit3->isNegative());
    $this->assertFalse($unit2->isPositive());
});

it('equals another measurement', function () {
    $unit1 = new Unit(1, Measurement::gram());
    $unit2 = new Unit(1, Measurement::kilogram());

    $this->assertTrue($unit1->equalsMeasurement(new Unit(1, Measurement::gram())));
    $this->assertFalse($unit2->equalsMeasurement(new Unit(1, Measurement::gram())));
});

it('throws an exception when comparing different measurements', function () {
    Unit::gram()->compare(Unit::kilogram());
})->expectException(InvalidArgumentException::class);
