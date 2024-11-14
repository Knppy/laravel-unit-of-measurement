<?php

namespace Knppy\UnitOfMeasurement\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Knppy\UnitOfMeasurement\Measurement;
use Knppy\UnitOfMeasurement\Unit;
use UnexpectedValueException;

class UnitCast implements CastsAttributes
{
    /**
     * Transform the attribute from the underlying model values.
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): Unit
    {
        if (! is_string($value)) {
            throw new UnexpectedValueException;
        }

        /** @var null|array{value:float, measurement:string} $value */
        $value = json_decode($value, true);
        if (! is_array($value) || ! isset($value['value']) || ! isset($value['measurement'])) {
            throw new UnexpectedValueException;
        }

        return new Unit(
            $value['value'],
            new Measurement($value['measurement'])
        );
    }

    /**
     * Transform the attribute to its underlying model values.
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        if (! $value instanceof Unit) {
            throw new UnexpectedValueException;
        }

        return json_encode([
            'value' => $value->getValue(),
            'measurement' => $value->getMeasurement()->getName(),
        ]);
    }
}
