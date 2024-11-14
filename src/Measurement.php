<?php

namespace Knppy\UnitOfMeasurement;

use Illuminate\Support\Collection;
use OutOfBoundsException;

class Measurement
{
    private static ?Collection $measurements = null;

    private string $name;

    private string $symbol;

    private float $factor;

    /**
     * Get a collection of all measurements.
     */
    public static function measurements(): Collection
    {
        return self::$measurements ??= collect(config('unit-of-measurement.measurements', []));
    }

    /**
     * Create a new instance of the measurement.
     */
    public function __construct(string $measurement)
    {
        $measurements = self::measurements();
        $measurementAttributes = $measurements->where('name', '=', $measurement)->first();

        if (! $measurementAttributes) {
            $measurementAttributes = $measurements->where('symbol', '=', $measurement)->first();
        }

        if (! $measurementAttributes) {
            throw new OutOfBoundsException('Invalid measurement "'.$measurement.'"');
        }

        $this->name = (string) $measurementAttributes['name'];
        $this->symbol = (string) $measurementAttributes['symbol'];
        $this->factor = (float) $measurementAttributes['factor'];
    }

    /**
     * Get the name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the symbol.
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * Get the factor.
     */
    public function getFactor(): float
    {
        return $this->factor;
    }
}
