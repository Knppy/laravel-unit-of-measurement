<?php

namespace Knppy\UnitOfMeasurement\Behaviour;

use InvalidArgumentException;
use Knppy\UnitOfMeasurement\Unit;

trait Calculatable
{
    /**
     * Add the value by the addend.
     */
    public function add(int|float|Unit $addend): Unit
    {
        if ($addend instanceof Unit) {
            $this->assertSameMeasurement($addend);

            $addend = $addend->getValue();
        }

        $value = $this->value + $addend;

        if ($this->isImmutable()) {
            return new self($value, $this->getMeasurement());
        }

        $this->value = $value;

        return $this;
    }

    /**
     * Divide the value by the divisor.
     */
    public function divide(int|float $divisor): Unit
    {
        $this->assertDivisor($divisor);

        $value = $this->value / $divisor;

        if ($this->isImmutable()) {
            return new self($value, $this->getMeasurement());
        }

        $this->value = $value;

        return $this;
    }

    /**
     * Multiply the value by the multiplier.
     */
    public function multiply(int|float $multiplier): Unit
    {
        $value = $this->value * $multiplier;

        if ($this->isImmutable()) {
            return new self($value, $this->getMeasurement());
        }

        $this->value = $value;

        return $this;
    }

    /**
     * Subtract the value by the subtrahend.
     */
    public function subtract(int|float|Unit $subtrahend): Unit
    {
        if ($subtrahend instanceof Unit) {
            $this->assertSameMeasurement($subtrahend);

            $subtrahend = $subtrahend->getValue();
        }

        $value = $this->value - $subtrahend;

        if ($this->isImmutable()) {
            return new self($value, $this->getMeasurement());
        }

        $this->value = $value;

        return $this;
    }

    /**
     * Assert that the divisor is not zero.
     */
    protected function assertDivisor(int|float $divisor): void
    {
        if ($divisor == 0) {
            throw new InvalidArgumentException('Division by zero');
        }
    }
}
