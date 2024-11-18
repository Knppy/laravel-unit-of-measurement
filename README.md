# A Laravel package for converting between standard units of measure.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/knppy/laravel-unit-of-measurement.svg?style=flat-square)](https://packagist.org/packages/knppy/laravel-unit-of-measurement)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/knppy/laravel-unit-of-measurement/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/knppy/laravel-unit-of-measurement/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/knppy/laravel-unit-of-measurement/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/knppy/laravel-unit-of-measurement/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/knppy/laravel-unit-of-measurement.svg?style=flat-square)](https://packagist.org/packages/knppy/laravel-unit-of-measurement)

This package intends to provide tools for formatting and conversion of unit of measurement values in an easy and 
powerful way for Laravel projects

## Installation

You can install the package via composer:

```bash
composer require knppy/laravel-unit-of-measurement
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-unit-of-measurement-config"
```

## Usage

```php
use Knppy\UnitOfMeasurement\Measurement;
use Knppy\UnitOfMeasurement\Unit;

echo Unit::gram(500) // 500 gram
echo new Unit(500, new Measurement('gram')) // 500 gram
echo new Unit(500, Measurement::gram()) // 500 gram
```

### Advanced usage

```php
use Knppy\UnitOfMeasurement\Measurement;
use Knppy\UnitOfMeasurement\Unit;

$measurement1 = Unit::gram();
$measurement2 = Unit::kilogram();

$measurement1->getMeasurement();
$measurement1->equals($measurement2);
$measurement1->equalsMeasurement($measurement2);
$measurement1->compare($measurement2);
$measurement1->greaterThan($measurement2);
$measurement1->greaterThanOrEqual($measurement2);
$measurement1->lessThan($measurement2);
$measurement1->lessThanOrEqual($measurement2);
$measurement1->add($measurement2);
$measurement1->subtract($measurement2);
$measurement1->divide(2);
$measurement1->multiply()2);
$measurement1->isZero();
$measurement1->isPositive();
$measurement1->isNegative();
$measurement1->format(0, ',', '.');
$measurement1->to(Measurement::milligram());
```

### Macros

This package implements the Laravel `Macroable` trait, allowing macros and mixins on both `Unit` and `Measurement`.

```php
\Knppy\UnitOfMeasurement\Unit::macro('absolute', fn() => $this->isPositive() ? $this : $this->multiply(-1));

$unit = \Knppy\UnitOfMeasurement\Unit::gram(1000)->multiply(-1);

$absolute = $unit->absolute();
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Michael Beers](https://github.com/Knppy)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
