<?php

namespace Knppy\UnitOfMeasurement\Behaviour;

use Knppy\UnitOfMeasurement\Measurement;
use Knppy\UnitOfMeasurement\Unit;

trait Convertable
{
    /**
     * Get the value from a given base value.
     */
    public function fromBaseValue(float|int $baseValue): float|int
    {
        $value = $baseValue;

        $value /= $this->getMeasurement()->getFactor();

        return $value;
    }

    /**
     * Convert the unit to another unit.
     *
     * @param string|Measurement|Unit $unit
     * @return Unit
     */
    public function to(string|Measurement|Unit $unit): Unit
    {
        $measurement = match (true) {
            $unit instanceof Measurement => $unit,
            $unit instanceof Unit => $unit->getMeasurement(),
            default => new Measurement($unit),
        };

        $baseUnit = $this->toBaseUnit();

        $newUnit = (new self(1, $measurement));
        $newUnit->setValue($newUnit->fromBaseValue($baseUnit->getValue()));

        return $newUnit;
    }

    /**
     * Convert the value to a base value.
     */
    public function toBaseValue(float|int|null $value = null): float|int
    {
        if ($value === null) {
            $value = $this->getValue();
        }

        $value *= $this->getMeasurement()->getFactor();

        return $value;
    }

    /**
     * Convert the unit to its base unit.
     */
    public function toBaseUnit(): Unit
    {
        $baseMeasurement = $this->getMeasurement()->getBaseMeasurement();

        return $baseMeasurement
            ? new self($this->toBaseValue(), $baseMeasurement)
            : $this;
    }
}
