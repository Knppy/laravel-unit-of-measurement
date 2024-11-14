<?php

namespace Knppy\UnitOfMeasurement;

class Unit
{
    /**
     * Create a new instance of the unit.
     */
    public function __construct(protected float $value, protected Measurement $measurement)
    {
        //
    }

    /**
     * Get the measurement.
     */
    public function getMeasurement(): Measurement
    {
        return $this->measurement;
    }

    /**
     * Get the value.
     */
    public function getValue(): float
    {
        return $this->value;
    }
}
