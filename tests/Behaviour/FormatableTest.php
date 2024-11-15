<?php

use Knppy\UnitOfMeasurement\Unit;

it('can format', function (string $expected, string $cur, float $amount, string $message) {
    $this->assertEquals($expected, (string) Unit::$cur($amount), $message);
})->with([
    ['15 g', 'gram', 15, 'Example: '.__LINE__],
    ['15,5 g', 'gram', 15.50, 'Example: '.__LINE__],
    ['15,56 g', 'gram', 15.556, 'Example: '.__LINE__],
    ['154.848 g', 'gram', 154848, 'Example: '.__LINE__],
    ['154.848,26 g', 'gram', 154848.25895, 'Example: '.__LINE__],
]);

it('can format simple', function (string $expected, string $cur, float $amount, string $message) {
    $this->assertEquals($expected, Unit::$cur($amount)->formatSimple(), $message);
})->with([
    ['15', 'gram', 15, 'Example: '.__LINE__],
    ['15,5', 'gram', 15.50, 'Example: '.__LINE__],
    ['15,56', 'gram', 15.556, 'Example: '.__LINE__],
    ['154.848', 'gram', 154848, 'Example: '.__LINE__],
    ['154.848,26', 'gram', 154848.25895, 'Example: '.__LINE__],
]);
