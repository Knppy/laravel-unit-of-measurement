<?php

namespace Knppy\UnitOfMeasurement\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Knppy\UnitOfMeasurement\Measurement;
use UnexpectedValueException;

class MeasurementCast implements CastsAttributes
{
    /**
     * Transform the attribute from the underlying model values.
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): Measurement
    {
        if (! is_string($value)) {
            throw new UnexpectedValueException;
        }

        return new Measurement($value);
    }

    /**
     * Transform the attribute to its underlying model values.
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        if (! $value instanceof Measurement) {
            throw new UnexpectedValueException;
        }

        return $value->getName();
    }
}
