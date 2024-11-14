<?php

namespace Knppy\UnitOfMeasurement;

use Illuminate\Support\Collection;
use Knppy\UnitOfMeasurement\Enums\MeasurementType;
use OutOfBoundsException;

class Measurement
{
    private static ?Collection $measurements = null;

    private MeasurementType $type;
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
        $measurementAttributes = $measurements->firstWhere('name', '=', $measurement);

        if (!$measurementAttributes) {
            $measurementAttributes = $measurements->firstWhere('symbol', '=', $measurement);
        }

        if (!$measurementAttributes) {
            throw new OutOfBoundsException('Invalid measurement "' . $measurement . '"');
        }

        $this->name = (string)$measurementAttributes['name'];
        $this->type = MeasurementType::from($measurementAttributes['type']);
        $this->symbol = (string)$measurementAttributes['symbol'];
        $this->factor = (float)$measurementAttributes['factor'];
    }

    /**
     * Get the factor.
     */
    public function getFactor(): float
    {
        return $this->factor;
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
     * Get the type.
     *
     * @return MeasurementType
     */
    public function getType(): MeasurementType
    {
        return $this->type;
    }
}
