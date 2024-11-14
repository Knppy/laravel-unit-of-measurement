<?php

use Illuminate\Database\Eloquent\Model;
use Knppy\UnitOfMeasurement\Casts\UnitCast;
use Knppy\UnitOfMeasurement\Unit;
use Knppy\UnitOfMeasurement\Measurement;

beforeEach(function () {
    $this->model = $this->getMockBuilder(Model::class)
        ->disableOriginalConstructor()
        ->getMock();
});

it('can get a measurement from a string', function () {
    $json = '{"value":1,"measurement":"gram"}';


    $this->assertEquals(new Unit(1, new Measurement('gram')), (new UnitCast)->get($this->model, '', $json, []));
});

it('can set a measurement to a string', function () {
    $json = '{"value":1,"measurement":"gram"}';

    $this->assertEquals($json, (new UnitCast)->set($this->model, '', new Unit(1, new Measurement('gram')), []));
});

it('throws an exception if the get value is not a string', function () {
    (new UnitCast)->get($this->model, '', 1, []);
})->expectException(UnexpectedValueException::class);

it('throws an exception if the get value is not a valid json', function () {
    (new UnitCast)->get($this->model, '', '{"key::"value"}', []);
})->expectException(UnexpectedValueException::class);

it('throws an exception if the set value is not a measurement', function () {
    (new UnitCast)->set($this->model, '', 'gram', []);
})->expectException(UnexpectedValueException::class);
