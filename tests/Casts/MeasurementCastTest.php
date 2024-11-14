<?php

use Illuminate\Database\Eloquent\Model;
use Knppy\UnitOfMeasurement\Casts\MeasurementCast;
use Knppy\UnitOfMeasurement\Measurement;

beforeEach(function () {
    $this->model = $this->getMockBuilder(Model::class)
        ->disableOriginalConstructor()
        ->getMock();
});

it('can get a measurement from a string', function () {
    $this->assertEquals(new Measurement('gram'), (new MeasurementCast)->get($this->model, '', 'gram', []));
});

it('can set a measurement to a string', function () {
    $this->assertEquals('gram', (new MeasurementCast)->set($this->model, '', new Measurement('gram'), []));
});

it('throws an exception if the get value is not a string', function () {
    (new MeasurementCast)->get($this->model, '', 1, []);
})->expectException(UnexpectedValueException::class);

it('throws an exception if the set value is not a measurement', function () {
    (new MeasurementCast)->set($this->model, '', 'gram', []);
})->expectException(UnexpectedValueException::class);
