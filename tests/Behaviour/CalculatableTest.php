<?php

use Knppy\UnitOfMeasurement\Measurement;
use Knppy\UnitOfMeasurement\Unit;

it('can add', function () {
    $unit1 = new Unit(1100.101, new Measurement('gram'));
    $unit2 = new Unit(1100.021, new Measurement('gram'));
    $sum = $unit1->add($unit2);

    $this->assertEquals(new Unit(2200.1220000000003, new Measurement('gram')), $sum);
    $this->assertNotEquals($sum, $unit1);
    $this->assertNotEquals($sum, $unit2);
});

it('can add on mutable unit', function () {
    $unit1 = Unit::gram(1100.101)->mutable();
    $unit2 = Unit::gram(1100.021);

    $unit1->add($unit2);

    $this->assertEquals(Unit::gram(2200.1220000000003)->mutable(), $unit1);
    $this->assertNotEquals(Unit::gram(2200.122)->mutable(), $unit2);
});

it ('can divide', function() {
    $unit1 = new Unit(2, new Measurement('gram'));
    $unit2 = new Unit(10, new Measurement('gram'));

    $this->assertEquals($unit1, $unit2->divide(5));
    $this->assertNotEquals($unit1, $unit2->divide(2));
});

it ('can divide on mutable unit', function() {
    $unit = Unit::gram(2);
    $unit2 = Unit::gram(10)->mutable();

    $unit2->divide(5);

    $this->assertEquals(Unit::gram(2)->mutable(), $unit2);
    $this->assertTrue($unit2->equals($unit));
});

it ('can multiply', function() {
    $unit1 = new Unit(15, new Measurement('gram'));
    $unit2 = new Unit(1, new Measurement('gram'));

    $this->assertEquals($unit1, $unit2->multiply(15));
    $this->assertNotEquals($unit1, $unit2->multiply(10));
});

it ('can multiply on mutable unit', function() {
    $unit1 = Unit::gram(15);
    $unit2 = Unit::gram(1)->mutable();

    $unit2->multiply(15);

    $this->assertEquals(Unit::gram(15)->mutable(), $unit2);
    $this->assertTrue($unit2->equals($unit1));
});

it ('can subtract', function() {
    $unit1 = new Unit(100.10, new Measurement('gram'));
    $unit2 = new Unit(100.02, new Measurement('gram'));
    $diff = $unit1->subtract($unit2);

    $this->assertEquals(new Unit(0.0799999999999983, new Measurement('gram')), $diff);
    $this->assertNotSame($diff, $unit1);
    $this->assertNotSame($diff, $unit2);
});

it ('can subtract on mutable unit', function() {
    $unit1 = Unit::gram(100.10)->mutable();
    $unit2 = Unit::gram(100.02);

    $unit1->subtract($unit2);

    $this->assertEquals(Unit::gram(0.0799999999999983)->mutable(), $unit1);
    $this->assertNotEquals(Unit::gram(0.0799999999999983)->mutable(), $unit2);
});

it ('throws exception if addend has different measurements', function() {
    $unit1 = new Unit(100, new Measurement('gram'));
    $unit2 = new Unit(100, new Measurement('kilogram'));

    $unit1->add($unit2);
})->expectException(InvalidArgumentException::class);

it ('throws exception if divisor is zero', function() {
    $unit1 = new Unit(100, new Measurement('gram'));

    $unit1->divide(0);
})->expectException(InvalidArgumentException::class);

it ('throws exception if subtrahend has different measurements', function() {
    $unit1 = new Unit(100, new Measurement('gram'));
    $unit2 = new Unit(100, new Measurement('kilogram'));

    $unit1->subtract($unit2);
})->expectException(InvalidArgumentException::class);
