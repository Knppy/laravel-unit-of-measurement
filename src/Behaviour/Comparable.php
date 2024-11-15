<?php

namespace Knppy\UnitOfMeasurement\Behaviour;

use InvalidArgumentException;
use Knppy\UnitOfMeasurement\Unit;

trait Comparable
{
    /**
     * Assert that the current units measurement has the same measurement as the other unit.
     */
    public function assertSameMeasurement(Unit $unit): void
    {
        if (! $this->equalsMeasurement($unit)) {
            throw new InvalidArgumentException('The units measurement must be the same.');
        }
    }

    /**
     * Compare the current unit to another unit.
     */
    public function compare(Unit $unit): int
    {
        $this->assertSameMeasurement($unit);

        if ($this->value < $unit->value) {
            return -1;
        }

        if ($this->value > $unit->value) {
            return 1;
        }

        return 0;
    }

    /**
     * Determine if the current unit is equal to another unit.
     */
    public function equals(Unit $unit): bool
    {
        return $this->compare($unit) == 0;
    }

    /**
     * Determine if the current units measurement equals to another units measurement.
     */
    public function equalsMeasurement(Unit $unit): bool
    {
        return $this->getMeasurement()->equals($unit->getMeasurement());
    }

    /**
     * Determine if the current unit is greater than another unit.
     */
    public function greaterThan(Unit $unit): bool
    {
        return $this->compare($unit) == 1;
    }

    /**
     * Determine if the current unit is greater than or equal to another unit.
     */
    public function greaterThanOrEqual(Unit $unit): bool
    {
        return $this->compare($unit) >= 0;
    }

    /**
     * Determine if the value is negative.
     */
    public function isNegative(): bool
    {
        return $this->value < 0;
    }

    /**
     * Determine if the value is positive.
     */
    public function isPositive(): bool
    {
        return $this->value > 0;
    }

    /**
     * Determine if the value is zero.
     */
    public function isZero(): bool
    {
        return $this->value == 0;
    }

    /**
     * Determine if the current unit is less than another unit.
     */
    public function lessThan(Unit $unit): bool
    {
        return $this->compare($unit) == -1;
    }

    /**
     * Determine if the current unit is less than or equal to another unit.
     */
    public function lessThanOrEqual(Unit $unit): bool
    {
        return $this->compare($unit) <= 0;
    }
}
